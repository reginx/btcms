<template>
  <v-card :body-style="{ padding: '12px' }" noHovering class="image-uploader-card">
    <h5 class="image-uploader-h5">
      {{title}}
      <span class="pull-right">
        <v-button type="info" size="small" @click="fSelectFiles">
          <i class="fa fa-file-photo-o"></i>
          {{localImageCount > 0 ? '继续选择' : '选择图片'}}
        </v-button>
        &nbsp;
        <v-button type="success" :loading="uploadBtnLoading" size="small" @click="fStartUpload" :disabled="localImageCount === 0">
          <i class="fa fa-upload"></i>
          {{localImageCount > 0 ? ('开始上传 ( ' + localImageCount + ' )') : '暂无任务'}}
        </v-button>
      </span>
    </h5>
    <input type="file" ref="imageUploaderInput" style="display: none" @change="fOnInputChange">
    <v-row class="image-uploader-row" :gutter="8">
      <v-col span="4" v-for="(v, k) in imageMaps" :key="k" class="image-uploader-col">
        <div class="image-uploader-box">
          <img :src="v.thumb" alt="image" :ref="`img_` + v.key" @click="fPreview(v)">
          <div v-if="v.status > 0" :class="'image-uploader-status-' + v.status">
            {{v.desc}}
          </div>
          <span class="image-uploader-btn-wrap">
            <a class="image-uploader-btn-remove" @click="fRemoveImage(v)" title="删除图片"><i class="fa fa-trash-o"></i></a>
            <a class="image-uploader-btn-cover" @click="fSetCover(v)" title="设为封面"><i class="fa fa-image"></i></a>
          </span>
        </div>
      </v-col>
    </v-row>
    <v-modal
       :width="previewModalWidth"
       :visible="previewModalVisible"
       @cancel="fPreviewModalClose"
       maskClosable
       :modalStyle="{top:previewModalTop}"
       wrapClassName="image-uploader-preview">
      <div style="text-align: center;">
        <img :src="previewModalImgUrl" style="max-width: 100%;" />
      </div>
      <div slot="footer"></div>
    </v-modal>
  </v-card>
</template>

<script>
export default {
  name: 'imageUploader',
  props: {
    uri: {
      type: String,
      default: 'admin/upload/image'
    },
    title: {
      type: String,
      default: '图片管理'
    },
    accept: {
      type: String,
      default: 'image/*'
    },
    cover: {
      type: Boolean,
      default: false
    },
    multiple: {
      type: Boolean,
      default: true
    },
    value: {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  data () {
    return {
      maxWidth: parseInt(document.body.clientWidth * 0.9),
      maxHeight: parseInt(document.body.clientHeight * 0.9),
      previewModalTop: '50px',
      previewModalWidth: 640,
      previewModalImgUrl: '',
      previewModalVisible: false,
      taskCount: 0,
      localImageCount: 0,
      totalImageCount: this.value.length,
      imageMaps: this.fInitImages(this.value),
      uploadBtnLoading: false
    }
  },
  watch: {
    /**
     * 仅仅在空值时候执行
     * @param  {[type]} v [description]
     * @return {[type]}   [description]
     */
    value (v) {
      if (Object.keys(this.imageMaps).length === 0) {
        this.totalImageCount = v.length
        this.imageMaps = this.fInitImages(v)
      }
    }
  },
  methods: {
    fStartUpload () {
      this.uploadBtnLoading = true
      this.taskCount = 0
      for (let k of Object.keys(this.imageMaps)) {
        if (this.imageMaps[k].status === 3) {
          this.$set(this.imageMaps[k], 'status', 2)
          this.taskCount++
          this.imageMaps[k]['token'] = this.$http.requestToken()
          this.$http.put(this.uri, this.imageMaps[k].ref, {
            cancelToken: this.imageMaps[k]['token'].token,
            onUploadProgress: e => {
              var complete = (e.loaded / e.total * 100 | 0)
              if (this.imageMaps[k]) {
                this.$set(this.imageMaps[k], 'desc', '上传中 ' + complete + '%')
              }
            }
          }).then((d) => {
            this.taskCount--
            this.localImageCount--
            if (this.taskCount === 0) {
              this.uploadBtnLoading = false
            }
            if (d.code === 0) {
              this.$set(this.imageMaps[k], 'status', 0)
              this.imageMaps[k]['img'] = d.data.image
              this.imageMaps[k]['url'] = d.data.url
              this.$emit('input', this.fGetValues())
            } else if (this.imageMaps[k]) {
              this.$set(this.imageMaps[k], 'status', 1)
              this.$set(this.imageMaps[k], 'desc', '上传失败了, ' + d.msg)
            }
          })
        }
      }
    },
    fPreview (img) {
      let nw = this.$refs['img_' + img.key][0].naturalWidth || 0
      let nh = this.$refs['img_' + img.key][0].naturalHeight || 0
      if (nw > 0) {
        this.previewModalWidth = nw > this.maxWidth ? this.maxWidth : nw
        this.previewModalTop = nh > this.maxHeight ? '10px' : '50px'
        this.previewModalImgUrl = img.url || img.thumb
        this.previewModalVisible = true
      }
    },
    fPreviewModalClose () {
      this.previewModalVisible = false
    },
    fRemoveImage (v) {
      if (v.status === 1 && v.token['cancel']) {
        v.token.cancel('Operation canceled by the user.')
      }
      this.$delete(this.imageMaps, v.key)
      if (v.status === 0) {
        this.$emit('delete', v)
        this.$emit('input', this.fGetValues())
      }
      if (v.status !== 0) {
        this.localImageCount--
      }
      if (this.localImageCount === 0) {
        this.uploadBtnLoading = false
      }
    },
    fSetCover (v) {
      if (v.status === 0) {
        this.$emit('cover', v)
      } else {
        this.$emit('error', '图片尚未上传, 无法操作')
      }
    },
    fGetValues () {
      let ret = []
      for (let v of Object.keys(this.imageMaps)) {
        if (this.imageMaps[v].status === 0) {
          ret.push({
            url: this.imageMaps[v].url,
            img: this.imageMaps[v].img
          })
        }
      }
      return ret
    },
    fInitImages (vals) {
      let ret = {}
      vals.forEach(function (v, k) {
        ret[k] = {
          thumb: v.thumb,
          url: v.url,
          img: v.img,
          key: k,
          name: k,
          size: 0,
          status: 0
        }
      })
      return ret
    },
    fSelectFiles () {
      this.$refs['imageUploaderInput'].accept = this.accept
      this.$refs['imageUploaderInput'].multiple = this.multiple
      this.$refs['imageUploaderInput'].click()
    },
    fGetFileURL (file) {
      var ret = null
      if (window.createObjectURL !== undefined) { // basic
        ret = window.createObjectURL(file)
      } else if (window.URL !== undefined) { // mozilla(firefox)
        ret = window.URL.createObjectURL(file)
      } else if (window.webkitURL !== undefined) { // webkit or chrome
        ret = window.webkitURL.createObjectURL(file)
      }
      return ret
    },
    fOnInputChange (e) {
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) {
        this.$emit('error', '请选择文件')
        return false
      }
      for (let k = 0; k < files.length; k++) {
        let tmp = {
          thumb: this.fGetFileURL(files[k]),
          url: '',
          img: '',
          key: this.$util.rand_str(16),
          name: files[k].name,
          size: (files[k].size / 1024 / 1024).toFixed(2),
          type: files[k].type,
          status: 3,
          desc: '待上传',
          token: null,
          ref: files[k]
        }
        this.$set(this.imageMaps, tmp['key'], tmp)
        this.localImageCount++
      }
    }
  }
}
</script>
<style>
  .image-uploader-card {
    border: none;
    border-top: 4px solid #f7f7f7;
    border-bottom: 4px solid #f7f7f7;
  }
  .image-uploader-h5 {
    font-size: 13px;
    font-weight: 350;
    color: #353535;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
  }
  .image-uploader-row {
    margin: 10px 0;
  }
  .image-uploader-col {
    margin: 4px 0;
  }
  .image-uploader-box {
    background: #eee;
    border-radius: 3px;
    position: relative;
    height: 150px;
  }
  .image-uploader-box img {
    max-width: 98%;
    max-height: 98%;
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    margin: auto;
    cursor: pointer;
  }
  .image-uploader-preview .ant-modal-body {
    padding: 8px;
    line-height: 1;
  }
  .image-uploader-preview .ant-modal-footer {
    display: none;
  }
  .image-uploader-preview .ant-modal-body img {
    border-radius: 3px;
  }
  .image-uploader-status-3 {
    background: rgba(0, 0, 0, 0.4);
    text-align: center;
    font-size: 12px;
    color: #fff;
    position: absolute;
    bottom: 0;
    width: 100%;
  }
  .image-uploader-status-2 {
    background: #4CAF50;
    text-align: center;
    font-size: 12px;
    color: #fff;
    position: absolute;
    bottom: 0;
    width: 100%;
  }
  .image-uploader-status-1 {
    background: #F44336;
    text-align: center;
    font-size: 12px;
    color: #fff;
    position: absolute;
    bottom: 0;
    width: 100%;
  }
  .image-uploader-btn-wrap{
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    height: 45px;
    text-align: center;
  }
  .image-uploader-btn-remove {
    font-size: 38px;
    color: #F44336;
    background: #fff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    text-align: center;
    padding: 2px;
    line-height: 40px;
    display: none;
    opacity: 0.6;
    margin: 0 5px;
  }
  .image-uploader-btn-remove:hover {
    opacity: 1;
    color: #F44336;
  }
  .image-uploader-btn-cover {
    font-size: 32px;
    color: #2196F3;
    background: #fff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    text-align: center;
    padding: 2px;
    line-height: 40px;
    display: none;
    opacity: 0.6;
    margin: 0 5px;
  }
  .image-uploader-btn-cover:hover {
    opacity: 1;
  }
  .image-uploader-box:hover .image-uploader-btn-remove,
  .image-uploader-box:hover .image-uploader-btn-cover {
    display: inline-block;
  }
</style>
