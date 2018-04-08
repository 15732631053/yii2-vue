<?php
$modules = [];
$dirs = glob('..'.DIRECTORY_SEPARATOR .'modules'.DIRECTORY_SEPARATOR .'*');

foreach ($dirs as $id) {
    if (is_dir($id)) {
        $id = basename($id);
        $modules[$id] = ['class' => 'backend\\modules\\'.$id.'\\'.'Module'];
    }
}
//手动定义
//$modules = [
//    'setting'=> [
//        'class'=> '@backend.modules.setting.settingModule',
//        'modules'=> [
//
//            'admin'=> [
//                'class'=> '@backend.modules.setting.modules.admin.AdminModule',
//                'modules'=> [
//
//                    'test'=> [
//                        'class'=> '@backend.modules.setting.modules.admin.modules.test.TestModule'
//                    ]
//                ]
//            ]
//        ]
//
//    ]
//];
//var_dump($modules);die;
return $modules;
