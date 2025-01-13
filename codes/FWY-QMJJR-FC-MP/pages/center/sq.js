// pages/center/sq.js
const app = getApp();
import {
  phone,
  brokerregist
} from '../../utils/api';
Page({

  /**
   * 页面的初始数据
   */
  data: {
      name:'',
      hy:'',
      tc:'',
      content:'',
      show:true,
      phone:'',
      desc:'',
      bkconfig:null,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
      var broker = JSON.parse(wx.getStorageSync('broker'))
      this.setData({
        bkconfig:broker,
        desc:broker.content
      })
      wx.setNavigationBarTitle({
        title: "申请"+broker.broker,
      })
  },
  up()
  {
    if(this.data.name.length==0)
    {
        wx.showToast({
          title: '请输入您的姓名',
          icon:'none'
        })
        
    }else if(this.data.phone.length==0)
    {
        wx.showToast({
            title: '请输入您的手机号',
            icon:'none'
          })
          
    }
    // else if(this.data.hy.length==0)
    // {
    //     wx.showToast({
    //         title: '请输入您目前从事的行业',
    //         icon:'none'
    //       })
          
    // }else if(this.data.tc.length==0)
    // {
    //     wx.showToast({
    //         title: '请输入您的特长',
    //         icon:'none'
    //       })
          
    // }else if(this.data.desc.length==0)
    // {
    //     wx.showToast({
    //         title: '请输入您申请的原因或优势',
    //         icon:'none'
    //       })
          
    // }
    else
    {
        var that = this
        wx.showLoading({
            title: '加载中...',
        })
        var dic = {}
        dic.name = that.data.name
        dic.industry = that.data.hy
        dic.skill = that.data.tc
        dic.reason = that.data.content

        brokerregist(dic).then(res => {
            if(res.code==0)
            {
                wx.showToast({
                  title: '申请成功，请等待审核',
                  icon:"none"
                })
                setTimeout(() => {
                    wx.navigateBack({
                      delta: 0,
                    })
                }, 2000);
            }else
            {
                wx.showToast({
                    title: res.msg,
                    icon:"none"
                  })
            }
        })
    } 
    
  },
  getPhoneNumber(e)
  {
      console.log(e)
      var that = this
      phone({code:e.detail.code}).then(res => {
        console.log(e, 9999)
        var data = res.data
        that.setData({
            phone:data.phone_info.phoneNumber
        })
      })
  },
  getname(e)
  {
      this.setData({
          name:e.detail.value
      })
      
  },
  gethy(e)
  {
      this.setData({
          hy:e.detail.value
      })
  },
  gettc(e)
  {
      this.setData({
          tc:e.detail.value
      })
  },
  getcon(e)
  {
      this.setData({
          content:e.detail.value
      })
  },

  cancle()
  {
      wx.navigateBack({
        delta: 0, 
      })
  },
  agree()
  {
      this.setData({
          show:false
      })
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

})