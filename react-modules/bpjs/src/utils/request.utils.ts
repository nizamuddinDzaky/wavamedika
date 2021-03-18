import {NotifyError} from '../services/notification.service';
import store from "../stores/store";
const requestCaller = (req: Request): Promise<any> => {
    return fetch(req).then(async (resp) => {
        if (resp.status === 200 || resp.status === 201) {
            // if(resp.data.meta)
            // console.log('meta', await resp);
            try {
                const json = await resp.json();

                if(json?.metadata?.error) {
                    NotifyError(`Error Code: ${json?.metadata?.code}`, `${json?.metadata?.message}`);
                    return Promise.reject(json);
                }

                if(json?.metadata?.err_code === 1) {
                    NotifyError(`Error Code: ${json?.metadata?.err_code}`, `${json?.metadata?.message}`);
                }

                return Promise.resolve(json);
            } catch (e) {
                NotifyError(`Error 500`, e);
                return Promise.reject(e);
            }

        } else {
            return Promise.reject(resp);
        }
    }).catch((err) => {
        return Promise.reject(err);
    });
};

const get = async (url: string, headers?: any): Promise<any> => {
    const request = new Request(url, {
        headers,
        method: 'GET'
    });
    return requestCaller(request);
};

const post = async (url: string, body: any, headers?: any): Promise<any> => {
    const request = new Request(url, {
        headers,
        body,
        method: 'POST'
    });
    return requestCaller(request);
};

const put = async (url: string, body?: any, headers?: any): Promise<any> => {
    const request = new Request(url, {
        headers,
        body,
        method: 'PUT'
    });
    return requestCaller(request);
};

const del = async (url: string, body?: any, headers?: any): Promise<any> => {
    const request = new Request(url, {
        headers,
        body,
        method: 'DELETE'
    });
    return requestCaller(request);
};

export default class RequestUtils {
    baseUrl: string = '';
    headers: any = {};

    constructor(baseUrl: string, interceptor: Function) {
        this.baseUrl = baseUrl;
        interceptor(this.headers);
    }

    get = (url: string, headers?: any) => {
        let headerConfig = Object.assign({}, headers, this.headers);
        return get(this.baseUrl + url, headerConfig);
    };

    post = (url: string, body: any, headers?: any) => {
        let headerConfig = Object.assign({}, headers, this.headers);

        const reduxStore = store.getState();
        let operator;
        if(reduxStore) {
            operator = reduxStore?.auth?.user?.id_karyawan

            if(operator) {
                body = Object.assign(body, {
                    operator: operator
                });
            }
        }

        body = Object.assign(body, {
            operator: operator
        });

        return post(this.baseUrl + url, JSON.stringify(body), headerConfig);
    };

    put = (url: string, body: any, headers?: any) => {
        let headerConfig = Object.assign({}, headers, this.headers);

        const reduxStore = store.getState();
        let operator;
        if(reduxStore) {
            operator = reduxStore?.auth?.user?.id_karyawan

            if(operator) {
                body = Object.assign(body, {
                    operator: operator
                });
            }
        }

        return put(this.baseUrl + url, JSON.stringify(body), headerConfig);
    };

    delete = (url: string, body: any, headers?: any) => {
        let headerConfig = Object.assign({}, headers, this.headers);

        const reduxStore = store.getState();
        let operator;
        if(reduxStore) {
            operator = reduxStore?.auth?.user?.id_karyawan

            if(operator) {
                body = Object.assign(body, {
                    operator: operator
                });
            }
        }

        body = Object.assign(body, {
            operator: operator
        });


        return del(this.baseUrl + url, JSON.stringify(body), headerConfig);
    }
}
