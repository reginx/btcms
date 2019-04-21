const SparkMD5 = require('spark-md5')

/**
 * 分片助手类
 * @type {Object}
 */
export class ChunkUploaderHelper {
  file = null
  size = 0
  items = []
  index = 0
  total = 0
  /**
   *  初始化
   * @param  {[type]} file [description]
   * @param  {[type]} opts [description]
   * @return {[type]}      [description]
   */
  constructor (file, size) {
    this.file = file
    this.size = size || 2048000
    this.nums = Math.ceil(file.size / this.size)
    this.index = 0
    this.items = []
    this.total = file.size
    // 计算分割位置
    for (let i = 0; i < this.nums; i++) {
      this.items[i] = [i * this.size, Math.min((i + 1) * this.size, this.file.size)]
    }
  }
  /**
   * 获取分割方法
   * @return {[type]} [description]
   */
  getBlobSliceFunc () {
    return File.prototype.mozSlice || File.prototype.webkitSlice || File.prototype.slice
  }

  /**
   * 获取任务
   * @param  {[type]}   succ [description]
   * @param  {Function} next [description]
   * @return {[type]}        [description]
   */
  getData (index) {
    return new Promise((resolve, reject) => {
      if (index >= this.items.length) {
        reject(new Error('index not exists ' + index))
      }
      let ret = {}
      let spark = new SparkMD5()
      let fileReader = new FileReader()
      ret.type = this.file.type
      ret.name = this.file.name
      ret.size = this.file.size
      ret.ext = this.file.name.split('.').pop()
      ret.nums = this.nums
      ret.blob = this.getBlobSliceFunc().call(this.file, this.items[index][0], this.items[index][1])
      ret.index = index + 1
      fileReader.onload = function (e) {
        spark.appendBinary(fileReader.content || e.target.result)
        ret['md5'] = spark.end()
        resolve(ret)
      }
      fileReader.readAsBinaryString(ret.blob)
    })
  }

  /**
   * 执行上传
   * @param  {[type]} http   [description]
   * @param  {[type]} config [description]
   * @param  {[type]} index  [description]
   * @return {[type]}        [description]
   */
  execUpload (http, config, index) {
    index = index || 0
    this.getData(index).then(ret => {
      http.putFile('admin/upload/chunk', ret, config).then(d => {
        config['success'](d)
        if (index < this.items.length - 1) {
          this.execUpload(http, config, index + 1)
        }
      })
    })
  }

  /**
   * 是否完成
   * @return {Boolean} [description]
   */
  isCompleted () {
    return this.index === this.items.length
  }
}

export default {
  /**
   * 安装
   * @param  {[type]} v    [description]
   * @param  {[type]} http [description]
   * @return {[type]}      [description]
   */
  install (v, http) {
    v.prototype.$chunkUploader = this
    this.http = http
  },

  /**
   * 执行上传
   * @param  {[type]} file   [description]
   * @param  {[type]} config [description]
   * @return {[type]}        [description]
   */
  upload (file, config) {
    config = config || {
      size: 2048000,
      success: function (d) {
        console.log('ChunkUploader Success ', d)
      },
      onUploadProgress: function (d) {
        console.log('ChunkUploader progress ', d)
      }
    }
    let helper = new ChunkUploaderHelper(file, config['size'] || 2048000)
    helper.execUpload(this.http, config)
  }
}
