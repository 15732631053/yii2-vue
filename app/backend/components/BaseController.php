<?php
/**
 * Created by PhpStorm.
 * AppLication mobo
 * User: mobo
 * Date: 2018/3/27
 * Time: 15:41
 */

namespace backend\components;

use common\components\Hashids\Hashids;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;
use Yii;

class BaseController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Access-Control-Request-Method' => ['*'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Headers' => ['*'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ]
        ];
        return $behaviors;
    }



    public function beforeSend($event)
    {
        /* @var $response \yii\web\Response */
        $response = $event->sender;

        $isSuccessful = $response->isSuccessful;
        if ($response->statusCode>=400) {
            //异常处理
            if (true && $exception = Yii::$app->getErrorHandler()->exception) {
                $response->data = $this->convertExceptionToArray($exception);
            }
            //Model出错了
            if ($response->statusCode==422) {
                $messages=[];
                foreach ($response->data as $v) {
                    $messages[] = $v['message'];
                }
                //请求错误时数据为  {"success":false,"data":{"name":"Not Found","message":"页面未找到。","code":0,"status":404}}
                $response->data = [
                    'name'=> 'valide error',
                    'message'=> implode("  ", $messages),
                    'info'=>$response->data
                ];
            }
            $response->statusCode = 200;
        }
        elseif ($response->statusCode>=300) {
            $response->statusCode = 200;
            $response->data = $this->convertExceptionToArray(new ForbiddenHttpException(Yii::t('yii', 'Login Required')));
        }
        //请求正确时数据为  {"success":true,"data":{...}}
//        $response->data = $response->data; //在这里可以重置响应数据

        $response->format = Response::FORMAT_JSON;

        //jsonp 格式输出
        if (isset($_GET['callback'])) {
            $response->format = Response::FORMAT_JSONP;
            $response->data = [
                'callback' => $_GET['callback'],
                'data'=>$response->data,
            ];
        }
    }
    protected function convertExceptionToArray($exception)
    {
        if (!YII_DEBUG && !$exception instanceof UserException && !$exception instanceof HttpException) {
            $exception = new HttpException(500, Yii::t('yii', 'An internal server error occurred.'));
        }
        $array = [
            'name' => ($exception instanceof Exception || $exception instanceof ErrorException) ? $exception->getName() : 'Exception',
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ];
        if ($exception instanceof HttpException) {
            $array['status'] = $exception->statusCode;
        }
        if (YII_DEBUG) {
            $array['type'] = get_class($exception);
            if (!$exception instanceof UserException) {
                $array['file'] = $exception->getFile();
                $array['line'] = $exception->getLine();
                $array['stack-trace'] = explode("\n", $exception->getTraceAsString());
                if ($exception instanceof \yii\db\Exception) {
                    $array['error-info'] = $exception->errorInfo;
                }
            }
        }
        if (($prev = $exception->getPrevious()) !== null) {
            $array['previous'] = $this->convertExceptionToArray($prev);
        }
        return $array;
    }
}