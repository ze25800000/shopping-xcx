import {Home} from "./home-model";

let home = new Home();
Page({
    data: {},

    onLoad: function (options) {
        this._loadData();
    },
    _loadData() {
        var id   = 1;
        var data = home.getBannerData(id, (data) => {
            console.log(data);
        });
    }
});