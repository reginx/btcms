import 'vue-beauty/package/style/vue-beauty.min.css'
import 'font-awesome/css/font-awesome.css'
import '@/assets/style/base.css'
import '@/assets/themes/v1/style.css'

import Vue from 'vue'
import App from './App'
import router from './router'

import vueBeauty from 'vue-beauty'
import http from '@/common/http'
import cache from '@/common/cache'
import sess from '@/common/sess'
import util from '@/common/util'
import notify from '@/common/notify'

import loading from '@/common/loading'

http.gateway = ''
// 接口配置
if (process.env.NODE_ENV === 'development') {
  http.gateway = 'http://btcms.d/api/index.php'
}

Vue.config.productionTip = false

Vue.use(util)
Vue.use(cache)
Vue.use(sess, {cache})
Vue.use(loading)
Vue.use(http, {sess, cache, loading})
Vue.use(vueBeauty)
Vue.use(notify)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
