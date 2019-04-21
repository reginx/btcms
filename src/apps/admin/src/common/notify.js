import Vue from 'vue'

export default {
  install: function (v) {
    v.prototype.$notify = this
  },

  /**
   * 显示通知
   * @param  {[type]} func [description]
   * @param  {[type]} opt  [description]
   * @return {[type]}      [description]
   */
  _show: function (func, opt) {
    return new Promise(function (resolve, reject) {
      var _onClose = opt.onClose || null
      var onCloseFunc = function () {
        if (_onClose) {
          _onClose()
        }
        resolve()
      }
      opt.duration = opt.duration || 1.75
      opt.onClose = onCloseFunc
      func(opt)
      setTimeout(function () {
        resolve()
      }, opt.duration * 1000 + 20)
    })
  },

  /**
   * 普通信息
   * @param  {[type]} opt [description]
   * @return {[type]}     [description]
   */
  info: function (opt) {
    return this._show(Vue.$notification.info, opt)
  },

  /**
   * 警告
   * @param  {[type]} opt [description]
   * @return {[type]}     [description]
   */
  warning: function (opt) {
    return this._show(Vue.$notification.warning, opt)
  },

  /**
   * 成功
   * @param  {[type]} opt [description]
   * @return {[type]}     [description]
   */
  success: function (opt) {
    return this._show(Vue.$notification.success, opt)
  },

  /**
   * 异常 或 错误
   * @param  {[type]} opt [description]
   * @return {[type]}     [description]
   */
  error: function (opt) {
    return this._show(Vue.$notification.error, opt)
  },
  /**
   * 确认框
   * @param  {[type]} opt [description]
   * @return {[type]}     [description]
   */
  confirm (opt) {
    Vue.$modal.confirm({
      title: opt.title,
      content: opt.msg,
      onOk: opt.ok || function () {},
      onCancel: opt.cancel || function () {}
    })
  }
}
