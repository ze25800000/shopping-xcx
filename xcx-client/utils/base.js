import {config} from "./config";

class Base {
    constructor() {
        this.baseRequestUrl = config.restUrl;
    }

    request(params) {
        var url = this.baseRequestUrl + params.url;
        wx.request({
            url: url,
            data: params.data,
            method: params.type || "GET",
            header: {
                'content-type': 'application/json',
                'token': wx.getStorageSync('token')
            },
            success(res) {
                params.sCallback && params.sCallback(res.data);
            }
            ,
            fail(err) {

            }
        })
    }
}

export {Base};