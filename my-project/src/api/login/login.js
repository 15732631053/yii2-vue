import fetch from '@/utils/fetch';

export const AxiosCreate = {
    login(data) {
        return fetch({
            url: 'user/user/login',
            method: 'post',
            data: data
        });
    },
	regist(data) {
        return fetch({
            url: 'user/user/regist',
            method: 'post',
            data: data
        });
    },
    checkoutName(data) {
        return fetch({
            url: 'user/user/checkout-name',
            method: 'post',
            data: data
        });
    },
}
