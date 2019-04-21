export default {
  access_token: '',
  login: null,
  cache: null,
  install: function (v, opt) {
    this.cache = opt.cache
    this.login = this.cache.get('login')
    this.access_token = opt.cache.get('access_token') || ''
    v.prototype.$sess = this
  },
  logout: function (c) {
    c.del('login')
    c.del('access_token')
  },
  isLogin () {
    this.login = this.cache.get('login') || null
    this.access_token = this.cache.get('access_token') || ''
    return this.login ? 1 : 0
  }
}
