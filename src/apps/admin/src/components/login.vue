<template>
  <div id="login">
    <div class="login-wrapper">
      <h1>管理登录</h1>
      <div class="login-form">
        <form>
          <div class="form-group">
            <v-input type="text" ref="account" v-model="account" placeholder="用户名"/>
          </div>
          <div class="form-group">
            <v-input type="password" ref="passwd" v-model="passwd" placeholder="密码" maxlength="24"/>
          </div>
          <div class="form-group">
            <v-button type="primary" @click="submit" style="width: 100%" :loading="btnLoading" size="large">登录</v-button>
            <span class="clearfix"></span>
          </div>
        </form>
      </div>
    </div>
</div>
</template>

<style src="@/assets/style/login.css" scoped></style>

<script>
export default {
  name: 'Login',
  metaInfo: {
    title: '管理登录'
  },
  data () {
    return {
      account: '',
      passwd: '',
      btnLoading: false
    }
  },
  methods: {
    submit: function (e) {
      if (this.account === '') {
        this.$notify.info({
          message: '请输入您的用户名'
        }).then(() => {
          this.$util.set_focus(this.$refs, 'account')
        })
      } else if (this.passwd === '') {
        this.$notify.info({
          message: '请输入您的密码'
        }).then(() => {
          this.$util.set_focus(this.$refs, 'passwd')
        })
      } else {
        this.exec_login()
      }
    },

    exec_login: function () {
      this.btnLoading = true
      this.$http.post('admin/login', {
        account: this.account,
        passwd: this.passwd
      }).then(d => {
        this.btnLoading = false
        if (d.code !== 0) {
          this.$loading.hide()
          this.$notify.info({
            message: d.msg
          }).then(() => {
            this.$util.set_focus(this.$refs, d.data.via)
          })
        } else {
          this.$loading.show({
            msg: '获取信息中 ...',
            type: 'info',
            left_offset: '0px'
          })
          this.$store.state.is_login = true
          this.$cache.set('access_token', d.data['access_token'])
          this.$http.post('admin/info', {}).then(d => {
            this.$loading.hide()
            if (d.code !== 0) {
              this.$notify.error({
                message: d.msg
              })
            } else {
              this.$cache.set('login', d.data)
              this.$router.replace({path: this.$route.query['redirect'] ? this.$route.query['redirect'] : '/'})
            }
          })
        }
      })
    }
  }
}
</script>
