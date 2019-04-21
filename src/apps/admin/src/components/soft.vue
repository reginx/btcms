<template>
  <v-card title="软件管理" :bordered="false" :noHovering="true" :bodyStyle="{padding: 0}" :loading="infoLoading">
    <table class="table table-padding-sm table-border table-border-limit">
      <thead>
        <tr>
          <th class="text-left"><small>软件名称</small></th>
          <th class="text-center" width="100"><small>状态</small></th>
          <th class="text-center" width="180"><small>服务器级别</small></th>
          <th class="text-center" width="150"><small>更新时间</small></th>
        </tr>
      </thead>
      <tbody>
          <tr v-for="(v) in rows" :key="v.soft_id">
              <td class="text-left">
                <a @click="modify(v.soft_id)" class="text-default">
                  <code>{{type[v.soft_type]}}</code> {{v.soft_name}}
                </a>
              </td>
              <td class="text-center">
                <small :class="'text-' + v.status_class">「{{v.status_label}}」</small>
              </td>
              <td class="text-center">
                <small>
                  <code>{{level[v.soft_server_level]}}</code>
                </small>
              </td>
              <td class="text-center">
                <small>{{v.soft_adate|time('yyyy-mm-dd HH:MM:ss')}}</small>
              </td>
          </tr>
      </tbody>
    </table>
  </v-card>
</template>

<script>
export default {
  name: 'SoftIndex',
  metaInfo: {
    title: '软件列表 - 管理平台'
  },
  data () {
    return {
      infoLoading: true,
      pn: 1,
      rows: [],
      status: {},
      type: {},
      level: {}
    }
  },
  methods: {
    /**
     * 软件购买
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    fSoftBuy (id) {
      this.$router.push({
        path: '/soft/buy',
        query: {id}
      })
    }
  },
  mounted () {
    this.$store.state.breadcrumb = [{
      'name': '软件列表'
    }]
    this.$http.list('admin/soft', {pn: this.pn}).then(d => {
      this.infoLoading = false
      if (d.code === 0) {
        this.rows = d.data.list
        this.pn = d.data.paging.pn
        this.total = d.data.paging.max
        this.status = d.data.status
        this.level = d.data.level
        this.type = d.data.type
      } else if (d.code === 9999) {
        this.$alert({
          title: '系统提示',
          content: d.msg
        }, (msg) => {
          this.$router.go(-1)
        })
      } else {
        this.rows = []
      }
    })
  }
}
</script>
