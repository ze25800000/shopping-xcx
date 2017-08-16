import {Base} from "../../utils/base";

class Home extends Base {
    constructor() {
        super()
    }

    getBannerData(id, callBack) {
        let params = {
            url: 'banner/' + id,
            sCallback: callBack
        };
        this.request(params);
    }

    /*首页主题*/
    getThemeData(callback) {
        var param = {
            url: 'theme?ids=1,2,3',
            sCallback: callback
        };
        this.request(param);
    }

    /*首页部分商品*/
    getProductorData(callBack) {
        var param = {
            url: 'product/recent',
            sCallback: callBack
        };
        this.request(param);
    }
}

export {Home};