<template>
  <div style="">
    <template v-if="systemError">
      <v-alert type="error" style="width: 60%;margin: 50px auto 0 auto;" message="系统提示" show-icon :description="systemErrorDesc"></v-alert>
    </template>
    <template v-else>
      <v-row :gutter="16">
        <v-col :span="15">
          <v-card title="犬只信息" :bordered="false" noHovering>
            <v-form direction="horizontal">
              <v-form-item label="呼名" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
                <v-input placeholder="请输入呼名" ref="dog_nick" v-model="dog.dog_nick" size="large" style="width: 50%"></v-input>
                <v-input placeholder="请输入英文名" ref="dog_name" v-model="dog.dog_name" size="large" style="width: 49%"></v-input>
              </v-form-item>
              <v-form-item label="犬只类型" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
                <v-select placeholder="请选择犬只类型" ref="dog_type" style="width: 50%;" size="lg" :data="attrs.types" v-model="dog.dog_type"/>
                <v-select placeholder="请选择犬只性别" ref="dog_gender" style="width: 49%;" size="lg" :data="attrs.gender" v-model="dog.dog_gender"/>
              </v-form-item>
              <v-form-item label="出生日期" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
                <v-date-picker v-model="dog.dog_birthday" ref="dog_birthday" clearable style="width: 80%"></v-date-picker>
              </v-form-item>
              <v-form-item label="父亲" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
                <v-select search size="lg" :loading="sPLoading" ref="dog_pater" style="width: 80%" placeholder="请设置父亲" :remote-method="fSearchPater" notFoundContent="暂无相关记录 (点击右侧按钮新增)" :data="attrs.pater" v-model="dog.dog_pater"/>
                &nbsp;
                <v-button type="info" size="small" @click="fAddDog(1)">新增</v-button>
              </v-form-item>
              <v-form-item label="母亲" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
                <v-select search :loading="sMLoading" size="lg" ref="dog_mater" style="width: 80%" placeholder="请设置母亲" :remote-method="fSearchMater" notFoundContent="暂无相关记录 (点击右侧按钮新增)" :data="attrs.mater" v-model="dog.dog_mater"/>
                &nbsp;
                <v-button type="primary" size="small" @click="fAddDog(2)">新增</v-button>
              </v-form-item>
            </v-form>
          </v-card>
        </v-col>
        <v-col :span="9">
            <v-card title="犬只头像" :bordered="false" noHovering :body-style="{ padding: '10px', height: '334px', position: 'relative' }">
              <img :src="dog.cover" alt="" class="cover">
            </v-card>
        </v-col>
      </v-row>
      <imageUploader v-model="images" @cover="onSetCover" cover title="犬只图集" @error="onError" @delete="onDelete" style="margin-top:16px;"/>
      <div style="margin-top:16px;text-align: right;">
        <v-button type="success" :loading="submitLoading" @click="fSubmit">确认提交</v-button>
      </div>
      <v-modal
        :title="addModalTitle"
        :visible="addModalVisible"
        @ok="fAddModalSubmit"
        @cancel="fCancel">
          <v-form direction="horizontal"  @submit.native.prevent>
            <v-form-item label="呼名" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
              <v-input placeholder="请输入呼名" @keyup.enter.native="fAddModalSubmit" ref="add_modal_name" v-model="addModalName" size="large" style="width: 100%"></v-input>
            </v-form-item>
          </v-form>
      </v-modal>
    </template>
  </div>
</template>

<script>
import imageUploader from '@/common/imageUploader'

export default {
  name: 'DogAdd',
  metaInfo () {
    return {
      title: '犬只编辑 - 管理平台'
    }
  },
  components: {
    imageUploader
  },
  data () {
    return {
      systemError: false,
      systemErrorDesc: '',
      labelCol: {
        span: 3
      },
      wrapperCol: {
        span: 20
      },
      infoLoading: true,
      btnLoading: false,
      dog: {
        dog_id: this.$route.query['id'] || 0,
        cover: '',
        dog_cover: ''
      },
      attrs: {
        pater: [],
        mater: []
      },
      images: [],
      sPLoading: false,
      sMLoading: false,
      addModalName: '',
      addModalTitle: '',
      addModalGender: 0,
      addModalVisible: false,
      submitLoading: false
    }
  },
  methods: {
    fAddModalSubmit () {
      if (this.addModalName === '') {
        this.$notify.info({
          message: '请输入呼名'
        }).then(() => {
          this.$util.set_focus(this.$refs, 'add_modal_name')
        })
      } else {
        this.$http.post('admin/dog/quick', {
          name: this.addModalName,
          gender: this.addModalGender
        }).then(d => {
          if (d.code === 0) {
            this.$notify.success({
              message: d.msg
            }).then(() => {
              this.addModalVisible = false
            })
          } else {
            this.$notify.error({
              message: d.msg
            })
          }
        })
      }
    },
    fCancel () {
      this.addModalVisible = false
    },
    fAddDog (t) {
      if (t === 1) {
        this.addModalTitle = '添加犬只父亲'
      } else {
        this.addModalTitle = '添加犬只母亲'
      }
      this.addModalName = ''
      this.addModalVisible = true
      this.addModalGender = t
      setTimeout(() => {
        this.$util.set_focus(this.$refs, 'add_modal_name')
      }, 300)
    },
    fSearchPater (query) {
      if (query !== '') {
        this.sPLoading = true
        this.$http.query('admin/dog', {
          key: query,
          gender: 1
        }).then(d => {
          this.attrs.pater = d.data.list
          this.sPLoading = false
        })
      }
    },
    fSearchMater (query) {
      if (query !== '') {
        this.sMLoading = true
        this.$http.query('admin/dog', {
          key: query,
          gender: 2
        }).then(d => {
          this.attrs.mater = d.data.list
          this.sMLoading = false
        })
      }
    },
    onSetCover (f) {
      this.dog['dog_cover'] = f.img
      this.dog['cover'] = f.url
    },
    onError (msg) {
      this.$notify.error({
        message: msg
      })
    },
    onDelete (img) {
      if (this.dog['dog_cover'] === img.img) {
        this.dog['dog_cover'] = ''
        this.dog['cover'] = ''
      }
    },
    fSubmit () {
      this.submitLoading = true
      this.$http.save('admin/dog', {
        dog: this.dog,
        images: this.images
      }).then(d => {
        this.submitLoading = false
        if (d.code !== 0) {
          this.$notify.info({
            message: d.msg
          }).then(() => {
            this.$util.set_focus(this.$refs, d.data.via)
          })
        } else {
          this.$notify.success({
            message: d.msg
          }).then(() => {
            this.$router.push({
              path: '/dog'
            })
          })
        }
      })
    }
  },
  beforeMounted () {
    this.systemError = false
    this.btnLoading = false
    this.infoLoading = false
  },
  mounted () {
    this.$store.dispatch('setLeftMenuChecked', {
      vm: this,
      url: '/dog/add'
    })
    this.$store.state.breadcrumb = [{
      'name': '犬只管理',
      'url': '/dog'
    }]
    this.$http.get('admin/dog', {
      dog_id: this.dog.dog_id
    }).then((d) => {
      if (d.code === 0) {
        this.systemError = false
        if (d.data.dog) {
          this.$store.state.breadcrumb.push({
            'name': '编辑 - ' + d.data.dog.dog_nick
          })
        } else {
          this.$store.state.breadcrumb.push({
            'name': '新增犬只'
          })
        }
        this.dog = d.data.dog || this.dog
        this.images = d.data.images
        this.attrs = d.data.attrs || {}
      } else {
        this.systemError = true
        this.systemErrorDesc = d.msg
      }
      this.infoLoading = false
    })
  }
}
</script>
<style scoped>
  .cover {
    max-width: 96%;
    max-height: 96%;
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    margin: auto;
    border-radius: 3px;
  }
</style>
