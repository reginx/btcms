export default {
  /**
   * 设置左侧菜单选中
   * @param {[type]} cx     [description]
   * @param {[type]} params [description]
   */
  setLeftMenuChecked (cx, params) {
    if (params.vm.$root.$el.id === 'app' && params.vm.$store.state.collapsed) {
      params.vm.$root.$children[0].$refs['leftMenu'].setCheck({
        url: params.url
      })
    }
  }
}
