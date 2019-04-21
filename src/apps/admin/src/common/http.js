import axios from 'axios'

/**
 * http post 请求
 * @param  {[type]} url    [description]
 * @param  {[type]} params [description]
 * @return {[type]}        [description]
 */
export function fetch (url, params) {
  return new Promise((resolve, reject) => {
    axios.post(url, params).then(response => {
      resolve(response.data)
    }, (err) => {
      if (axios.isCancel(err)) {
        console.log('Request canceled', err.message)
      } else {
        reject(err)
      }
    }).catch((err) => {
      if (axios.isCancel(err)) {
        console.log('Request canceled', err.message)
      } else {
        reject(err)
      }
    })
  })
}

/**
 * 上传操作
 * @param  {[type]} url    [description]
 * @param  {[type]} data   [description]
 * @param  {[type]} config [description]
 * @return {[type]}        [description]
 */
export function upload (url, data, config) {
  return new Promise((resolve, reject) => {
    axios.post(url, data, config).then(response => {
      resolve(response.data)
    }, (err) => {
      if (axios.isCancel(err)) {
        console.log('Request canceled', err.message)
      } else {
        reject(err)
      }
    }).catch((err) => {
      if (axios.isCancel(err)) {
        console.log('Request canceled', err.message)
      } else {
        reject(err)
      }
    })
  })
}

/**
 * 获取取消token
 * @return {[type]} [description]
 */
export function getRequestToken () {
  return axios.CancelToken.source()
}

/**
 * 上传操作类
 */
export default {
  /**
   * 处理对象
   * @type {[type]}
   */
  handle: axios,

  /**
   * 接口地址
   * @type {String}
   */
  gateway: '',

  /**
   * 授权码
   * @type {String}
   */
  token: '',

  /**
   * 缓存操作对象
   * @type {[type]}
   */
  cache: null,

  /**
   * 加载操作对象
   * @type {[type]}
   */
  loading: null,

  /**
   * 安装
   * @param  {[type]} v   [description]
   * @param  {[type]} opt [description]
   * @return {[type]}     [description]
   */
  install: function (v, opt) {
    this.cache = opt.cache
    this.token = this.cache.get('access_token') || ''
    this.loading = opt.loading
    this.handle.defaults.timeout = 8000
    // 请求预处理
    this.handle.interceptors.request.use((config) => {
      if (config['onUploadProgress'] === undefined || config.data['raw'] !== undefined) {
        this.token = config.data['access_token'] || this.token || this.cache.get('access_token')
        config.headers.common['authkey'] = this.token
        if (config.method === 'post') {
          config.data['authkey'] = this.token
          config.data = JSON.stringify(config.data || {})
        }
      }
      return config
    }, (error) => {
      return Promise.reject(error)
    })

    // 响应预处理
    this.handle.interceptors.response.use((res) => {
      if (res.status !== 200) {
        return Promise.reject(res)
      } else {
        if (res.headers.authkey || res.data['access_token']) {
          this.cache.set('access_token', res.headers.authkey || res.data['access_token'])
          this.token = res.headers.authkey || res.data['access_token']
        }
      }
      return res
    }, (error) => {
      return Promise.reject(error)
    })

    v.prototype.$http = this
  },
  /**
   * post 封装
   * @param  {[type]} uri    [description]
   * @param  {[type]} params [description]
   * @return {[type]}        [description]
   */
  post (uri, params) {
    return fetch(this.gateway, {
      uri: uri,
      data: params
    }).then(d => {
      return d
    })
  },
  /**
   * 获取
   * @param  {[type]} uri  [description]
   * @param  {[type]} data [description]
   * @return {[type]}      [description]
   */
  get (uri, data) {
    data = data || {}
    return this.post(uri + '/get', data)
  },
  /**
   * 删除操作
   * @param  {[type]} uri  [description]
   * @param  {[type]} data [description]
   * @return {[type]}      [description]
   */
  del (uri, data) {
    return this.post(uri + '/del', data)
  },
  /**
   * 新增或更新
   * @param  {[type]} uri  [description]
   * @param  {[type]} data [description]
   * @return {[type]}      [description]
   */
  save (uri, data) {
    return this.post(uri + '/save', data)
  },
  /**
   * 检索
   * @param  {[type]} uri  [description]
   * @param  {[type]} data [description]
   * @return {[type]}      [description]
   */
  query (uri, data) {
    data = data || {}
    return this.post(uri + '/query', data)
  },
  /**
   * 更新
   * @param  {[type]} uri  [description]
   * @param  {[type]} data [description]
   * @return {[type]}      [description]
   */
  update (uri, data) {
    return this.post(uri + '/update', data)
  },
  /**
   * 列表请求
   * @param  {[type]} uri  [description]
   * @param  {[type]} data [description]
   * @return {[type]}      [description]
   */
  list (uri, data) {
    return this.post(uri + '/list', data)
  },
  /**
   * 设置
   * @param {[type]} uri  [description]
   * @param {[type]} data [description]
   */
  set (uri, data) {
    data = data || {}
    return this.post(uri + '/set', data)
  },
  /**
   * 上传
   * @param  {[type]} uri    [description]
   * @param  {[type]} file   [description]
   * @param  {[type]} config [description]
   * @return {[type]}        [description]
   */
  put (uri, file, config) {
    let data = new FormData()
    data.append('raw', JSON.stringify({
      uri: uri,
      authkey: this.cache.get('access_token')
    }))
    data.append('file', file)
    config['timeout'] = config['timeout'] || 99990000
    return upload(this.gateway, data, config)
  },
  /**
   * 上传
   * @param  {[type]} uri    [description]
   * @param  {[type]} file   [description]
   * @param  {[type]} config [description]
   * @return {[type]}        [description]
   */
  putFile (uri, d, config) {
    let data = new FormData()
    let raw = {
      uri: uri,
      authkey: this.cache.get('access_token'),
      data: {}
    }
    for (let k in d) {
      if (d.hasOwnProperty(k) && k !== 'blob') {
        raw['data'][k] = d[k]
      }
    }
    data.append('raw', JSON.stringify(raw))
    data.append('file', d['blob'])
    config['timeout'] = config['timeout'] || 99990000
    return upload(this.gateway, data, config)
  },
  /**
   * 获取 操作 token
   * @return {[type]} [description]
   */
  requestToken () {
    return getRequestToken()
  }
}
