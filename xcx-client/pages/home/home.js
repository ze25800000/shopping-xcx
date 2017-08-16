import {Home} from "./home-model";

let home = new Home();
Page({
    data: {},

    onLoad: function (options) {
        this._loadData();
    },
    _loadData() {
        var id = 1;
        home.getBannerData(id, (data) => {
            this.setData({
                bannerArr: data.items
            })
        });
        /*获取主题信息*/
        home.getThemeData((data) => {
            this.setData({
                themeArr: data,
                loadingHidden: true
            });
        });
        /*获取单品信息*/
        home.getProductorData((data) => {
            this.setData({
                productsArr: data
            });
        });
    }
});