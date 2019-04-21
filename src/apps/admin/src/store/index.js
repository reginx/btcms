import Vue from 'vue'
import Vuex from 'vuex'
import mutations from './mutations'
import actions from './actions'
import navigate from '@/common/navigate'

Vue.use(Vuex)

const state = {
  isLogin: false,
  perms: 'empty',
  breadcrumb: [],
  navigate: navigate,
  collapsed: true
}

export default new Vuex.Store({
  state,
  actions,
  mutations
})
