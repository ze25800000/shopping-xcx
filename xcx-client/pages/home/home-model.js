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
}

export {Home};