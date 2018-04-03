import fetch from '@/utils/fetch';

export const AxiosCreate = {
    //新增和复制
    submitAdd(data) {
        return fetch({
            url: 'user/user/index',
            method: 'post',
            data: data
        });
    },

}
