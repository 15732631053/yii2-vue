import fetch from '@/utils/fetch';

export const AxiosCreate = {
    getlist(data) {
        return fetch({
            url: 'article/article/list',
            method: 'post',
            data: data
        });
    },
    getdetail(data) {
        return fetch({
            url: 'article/article/detail',
            method: 'post',
            data: data
        });
    },
    create(data) {
        return fetch({
            url: 'article/article/create',
            method: 'post',
            data: data
        });
    },

}
