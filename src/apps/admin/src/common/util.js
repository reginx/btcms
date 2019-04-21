export default {

  /**
   * 安装
   * @param  {[type]} v   [description]
   * @param  {[type]} opt [description]
   * @return {[type]}     [description]
   */
  install (v, opt) {
    v.prototype.$util = this
  },

  /**
   * 获取随机字符
   * @param  {[type]} len [description]
   * @return {[type]}     [description]
   */
  rand_str (len) {
    const text = 'abcdefghijklmnopqrstuvwxyz0123456789'
    const rdmIndex = text => Math.random() * text.length | 0
    let rdmString = ''
    for (; rdmString.length < len;) {
      rdmString += text.charAt(rdmIndex(text))
    }
    return rdmString
  },

  /**
   * 设置焦点
   * @param {[type]} refs [description]
   * @param {[type]} ele  [description]
   */
  set_focus (refs, ele) {
    if (refs[ele]) {
      refs[ele].$el.focus()
    }
  }
}
