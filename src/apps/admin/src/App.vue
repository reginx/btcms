<template>
  <div id="app" class="container-fluid">
      <div class="app_mask"></div>
      <v-layout class="layout">
        <v-sider :width="180" collapsible v-model="collapsed" style="background: #0066bc;height: 100vh;">
          <div class="logo"></div>
          <v-menu theme="dark" :key="$store.state.perms" ref="leftMenu" class="admin-menu" :mode="collapsed?'vertical':'inline'" :data="menuLeft" style="padding-bottom: 50px;">
            <template slot-scope="{data}">
              <i v-if="data.icon" :class="'' + data.icon"></i>
              <span class="nav-text" v-if="!data.url && !data.click">&nbsp; {{data.name}}</span>
              <router-link :to="data.url" style="display:inline" v-if="data.url"> &nbsp; {{data.name}}</router-link>
              <span class="nav-text" @click="fClick(data.click, data.code || '')" style="display:inline" v-if="data.click"> &nbsp; {{data.name}}</span>
            </template>
            <template slot-scope="{data}" slot="sub">
              <i v-if="data.icon" :class="'' + data.icon"></i>
              <span class="nav-text" v-if="!data.url && !data.click">&nbsp; {{data.name}}</span>
              <router-link :to="data.url" style="display:inline" v-if="data.url"> &nbsp; {{data.name}}</router-link>
              <span class="nav-text" @click="fClick(data.click, data.code || '')" style="display:inline" v-if="data.click"> &nbsp; {{data.name}}</span>
            </template>
          </v-menu>
        </v-sider>
        <v-layout style="padding:0 14px 14px;min-width: 800px">
          <v-breadcrumb :style="{ margin: '8px 14px' }">
              <v-breadcrumb-item>
                <router-link :to="{path: '/'}" ><i class="fa fa-home"></i> 首页</router-link>
              </v-breadcrumb-item>
              <v-breadcrumb-item v-for="(v, k) in $store.state.breadcrumb" :key="k">
                <router-link :to="v.url" v-if="v.url" >{{v.name}}</router-link>
                <span v-if="!v.url" >{{v.name}}</span>
              </v-breadcrumb-item>
          </v-breadcrumb>
          <v-content  class="admin-layout">
            <router-view :key="$route.fullPath"/>
          </v-content>
          <v-back-top></v-back-top>
        </v-layout>
      </v-layout>
  </div>
</template>

<script>
import store from '@/store'

export default {
  name: 'App',
  store,
  metaInfo: {
    title: '系统管理'
  },
  data () {
    return {
      collapsed: false
    }
  },
  watch: {
    collapsed (ov, v) {
      this.$store.commit('setCollapsed', v)
    }
  },
  computed: {
    menuLeft () {
      return this.$store.state.navigate[this.$store.state.perms]
    }
  },
  methods: {
    fClick (v, code) {
      if (this[v]) {
        this[v](code)
      }
    },
    setMenuLeft (code) {
      this.menuLeft = this.$store.state.navigate[this.$store.state.perms][code]
    },
    logout () {
      this.$sess.logout(this.$cache)
      this.$store.state.is_login = false
      this.$router.push({path: '/login'})
    }
  },
  beforeMount () {
    // 查看本地存储token
    this.$store.state.isLogin = this.$sess.isLogin()
    // 检验token是否有效
    if (this.$store.state.isLogin) {
      this.$http.post('admin/info', {}).then(d => {
        this.$store.commit('setPerms', {
          perms: this.$sess.login.perms
        })
        if (d.code !== 0) {
          this.$notify.error({
            message: d.msg
          }).then(() => {
            this.$router.push({path: '/login'})
          })
        }
      })
    }
  }
}
</script>
