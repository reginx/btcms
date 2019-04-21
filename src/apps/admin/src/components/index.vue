<template>
  <v-card title="欢迎登录" :bordered="false" :loading="infoLoading" :noHovering="true">
    <v-row class="info-row">
        <v-col span="2">当前账号</v-col>
        <v-col span="18">{{user.user_mobile}}</v-col>
    </v-row>
    <v-row class="info-row">
        <v-col span="2">积分余额</v-col>
        <v-col span="18"><code class="danger">{{user.user_points}}</code></v-col>
    </v-row>
    <v-row class="info-row">
        <v-col span="2">累计充值</v-col>
        <v-col span="18"><code class="success">{{user.user_stat_recharge}}</code> <code>元</code></v-col>
    </v-row>
    <v-row class="info-row">
        <v-col span="2">累计消费</v-col>
        <v-col span="18"><code class="warning">{{user.user_stat_spending}}</code> 积分</v-col>
    </v-row>
    <v-row class="info-row">
        <v-col span="2">所在团队</v-col>
        <v-col span="18">{{user.team_name}}</v-col>
    </v-row>
    <v-row class="info-row">
        <v-col span="2">注册时间</v-col>
        <v-col span="18">{{user.user_adate}}</v-col>
    </v-row>
  </v-card>
</template>

<script>
export default {
  name: 'Index',
  metaInfo: {
    title: '欢迎页 - 犬只库'
  },
  data () {
    return {
      infoLoading: true,
      user: {}
    }
  },
  mounted () {
    this.$store.state.breadcrumb = [{
      'name': '欢迎页'
    }]
    this.$http.post('portal/user/summary').then((d) => {
      this.infoLoading = false
      if (d.code === 0) {
        this.user = d.data
      }
    })
  }
}
</script>
