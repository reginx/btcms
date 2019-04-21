<template>
  <v-card :title="'购买 - ' + (soft.soft_name || 'loading')" :bordered="false" :loading="infoLoading" :noHovering="true">
    <template v-if="systemError">
      <v-alert type="error" style="width: 60%;margin: 50px auto 0 auto;" message="系统提示" show-icon :description="systemErrorDesc"></v-alert>
    </template>
    <template v-else>
      <v-form direction="horizontal">
          <v-form-item label="卡号" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
              <v-input placeholder="请输入卡号 ( 4位数字或字母组合 )" v-model="card.uc_account" size="large"></v-input>
          </v-form-item>
          <v-form-item label="密码" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
              <v-input placeholder="请输入密码 ( 4位数字或字母组合 )" v-model="card.uc_passwd" size="large"></v-input>
          </v-form-item>
          <v-form-item label="天数" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
            <v-select placeholder="请选择开卡天数" v-if="attrs.mode.code === 'select'" style="width: 40%;" :data="attrs.mode.options" v-model="card.uc_days"></v-select>
            <v-input placeholder="请输入开卡天数)" v-if="attrs.mode.code === 'input'" v-model="card.uc_days" size="large"></v-input>
          </v-form-item>
          <v-form-item label="平台" :label-col="labelCol" :wrapper-col="wrapperCol" :required="true">
            <v-select placeholder="请选择卡密使用的平台" style="width: 40%;" :data="attrs.platform" v-model="card.card_platform"></v-select>
          </v-form-item>
      </v-form>
    </template>
  </v-card>
</template>

<script>
export default {
  name: 'SoftBuy',
  metaInfo: {
    title: '开卡 - 会员中心'
  },
  data () {
    return {
      labelCol: {
        span: 4
      },
      wrapperCol: {
        span: 12
      },
      infoLoading: true,
      systemError: false,
      systemErrorDesc: '',
      soft: {},
      card: {},
      attrs: {
        mode: {
          code: ''
        }
      }
    }
  },
  beforeMounted () {
    this.systemError = false
  },
  mounted () {
    this.$store.state.breadcrumb = [{
      'name': '软件列表',
      'url': '/soft'
    }]
    this.$http.get('portal/soft', {id: this.$route.query['id']}).then((d) => {
      if (d.code === 0) {
        this.soft = d.data.soft
        this.attrs = d.data.attrs
        this.$store.state.breadcrumb.push({
          'name': '开卡 - ' + this.soft.soft_name
        })
      } else {
        this.systemError = true
        this.systemErrorDesc = d.msg
      }
      this.infoLoading = false
    })
  }
}
</script>
