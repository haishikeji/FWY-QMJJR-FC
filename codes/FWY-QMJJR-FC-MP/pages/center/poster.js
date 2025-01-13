// pages/center/poster.js
import util from '../../utils/util.js';
Page({

  /**
   * 页面的初始数据
   */
  data: {
      bg:'/images/poster.png',
      codeimg:'/images/code.png',
      money:'88.8',
      posterImage:'',
      canvasStatus:false
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
      this.goPoster()
  },


    /**
   * 生成海报
  */
 goPoster:function(){
    var that = this;
    that.setData({ canvasStatus: true });
    var arr2 = [that.data.bg,that.data.codeimg];
    util.PosterCanvas(arr2,  that.data.money, function (tempFilePath) {
        that.setData({
          posterImage: tempFilePath,
          showposterImage:tempFilePath,
          canvasStatus: false,
        })
      });
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady() {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh() {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom() {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage() {

  }
})