<template>
  <v-card :title="server.server_name || 'loading'" :bordered="false" :loading="infoLoading" :noHovering="true">
    <v-form direction="horizontal">
        <v-form-item label="SSH" :label-col="labelCol" :wrapper-col="wrapperCol">
            <span class="ant-form-text text-success">
              {{server.server_ipaddr}}:{{server.server_port}}
              <code class="info">{{server.server_key}}</code>
            </span>
        </v-form-item>
        <v-form-item label="状态" :label-col="labelCol" :wrapper-col="wrapperCol" required>
         <v-select placeholder="请选择服务器状态" style="width: 180px;" v-model="server.server_status" :data="status"></v-select>
        </v-form-item>
        <v-form-item label="刷新周期" :label-col="labelCol" :wrapper-col="wrapperCol" required>
          <v-input-number :min="1" :max="12" style="width: 80px;" v-model="server.server_dial_cycle" placeholder="请输入IP刷新周期(单位: 小时)"></v-input-number>
        </v-form-item>
        <v-form-item label="资源等级" :label-col="labelCol" :wrapper-col="wrapperCol" required>
         <v-select placeholder="请选择资源等级" style="width: 180px;" v-model="server.server_level" :data="level"></v-select>
        </v-form-item>
        <v-form-item label="类型" :label-col="labelCol" :wrapper-col="wrapperCol" required>
         <v-select placeholder="请选择服务器类型" style="width: 180px;" v-model="server.server_type" :data="types"></v-select>
        </v-form-item>

        <v-form-item label="IP地区" :label-col="labelCol" :wrapper-col="wrapperCol" required>
          <v-cascader size="large" :data="regions" v-model="server.region"></v-cascader>
        </v-form-item>
        <v-form-item label="所在机房" :label-col="labelCol" :wrapper-col="wrapperCol" required>
         <v-select placeholder="请选择所在机房" style="width: 180px;" v-model="server.server_idc_id" :data="idcs"></v-select>
        </v-form-item>
        <v-form-item label="有效时间" :label-col="labelCol" :wrapper-col="wrapperCol" required>
          <v-date-picker range showTime v-model="server.date"></v-date-picker>
        </v-form-item>
        <v-form-item label="备注" :label-col="labelCol" :wrapper-col="wrapperCol">
            <v-input type="textarea" v-model="server.server_memo" placeholder="服务器备注信息"></v-input>
        </v-form-item>
        <v-form-item :wrapper-col="{span:12,offset:2}" style="margin-top:24px;text-align: right;">
            <v-button type="success" @click="save" :loading="submitLoading">{{submitLoading ? '提交中' : '确 定'}}</v-button>
        </v-form-item>
    </v-form>
  </v-card>
</template>

<script>
export default {
  name: 'ServerAdd',
  metaInfo: {
    title: '服务器 - 会员中心'
  },
  data () {
    return {
      infoLoading: true,
      submitLoading: false,
      labelCol: {
        span: 2
      },
      wrapperCol: {
        span: 12
      },
      server: {
        server_id: this.$route.query['id'] || 0
      },
      idcs: {},
      level: {},
      types: {},
      status: {},
      regions: {}
    }
  },
  mounted () {
    this.$store.state.breadcrumb = [{
      'name': '服务器',
      'url': '/server'
    }]
    this.$http.get('admin/server', {
      id: this.server.server_id
    }).then((d) => {
      this.infoLoading = false
      if (d.code === 0) {
        this.$store.state.breadcrumb.push({
          'name': d.data.server.server_name
        })
        this.server = d.data.server
        this.idcs = d.data.idcs
        this.status = d.data.status
        this.level = d.data.level
        this.types = d.data.type
        this.regions = d.data.region
      }
    })
  },
  methods: {
    save () {
      this.submitLoading = true
      this.$http.save('admin/server', this.server).then(d => {
        this.submitLoading = false
        if (d.code === 0) {
          this.$notify.success({
            message: d.msg
          }).then(() => {
            this.$router.push({
              path: '/server'
            })
          })
        } else {
          this.$notify.error({
            message: d.msg
          }).then(() => {
            if (d.data && d.data['via']) {
              this.$util.set_focus(this.$refs, d.data.via)
            }
            if (d.code === 9999) {
              this.$router.push({
                path: '/login'
              })
            }
          })
        }
      })
    }
  }
}
</script>
