<template>
  <v-card title="我的账户" :bordered="false" :loading="infoLoading">
      <p>Card content</p>
      <p>Card content</p>
      <p>Card content</p>
  </v-card>
</template>

<script>
export default {
  name: 'UserIndex',
  metaInfo: {
    title: '我的账户 - 会员中心'
  },
  data () {
    return {
      infoLoading: true
    }
  },
  mounted () {
    this.$store.state.breadcrumb = [{
      'name': '我的账户'
    }]
  }
}
</script>
