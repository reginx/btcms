<template>
  <v-card title="" :bordered="false" :noHovering="true" :bodyStyle="{padding: 0}" :loading="infoLoading">
    <div v-for="(v) in rows" :key="v.dog_id" class="server-block">
      <h2>
        &nbsp;
        {{v.dog_nick}}
        &nbsp;
        <small v-if="v.dog_name">( {{v.dog_name}} )</small>
        <span class="pull-right">
          <v-button @click="modify(v.dog_id)" type="info" size="small">
            <i class="fa fa-pencil"></i> 编辑信息
          </v-button>
          &nbsp;
          <v-button type="success" size="small" @click="fGoInfo(v.dog_id)">
            <small><i class="fa fa-area-chart"></i> 成长记录</small>
          </v-button>
          &nbsp;
          <v-button type="error" size="small" @click="fGoMap(v.dog_id)">
            <small><i class="fa fa-sitemap"></i> 血统信息</small>
          </v-button>
        </span>
      </h2>
      <table class="table table-border table-border-limit table-striped">
        <tbody>
            <tr>
                <td rowspan="4" width="20%" style="border-bottom: none;">
                  <img :src="v.cover" style="width: 100%;border-radius: 3px;"/>
                </td>
                <td class="text-center text-sm" width="10%">类型</td>
                <td class="text-left" width="30%">
                  <v-tag color="orange-inverse" v-if="v.dog_type === '1'">{{attrs.types[v.dog_type]}}</v-tag>
                  <v-tag color="green-inverse" v-else-if="v.dog_type === '2'">{{attrs.types[v.dog_type]}}</v-tag>
                  <v-tag v-else>未知</v-tag>
                </td>
                <td class="text-center text-sm" width="10%"></td>
                <td class="text-left" width="30%">
                </td>
            </tr>
            <tr>
                <td class="text-center text-sm">性别</td>
                <td class="text-left text-sm">
                  <small>{{attrs.gender[v.dog_gender]}}</small>
                </td>
                <td class="text-center text-sm">父亲</td>
                <td class="text-left text-sm">
                  <router-link :to="{path:'/dog/add', query: {id: v.dog_pater}}" v-if="v.dog_pater > 0">
                    <small>{{attrs.pms[v.dog_pater]['dog_nick']}}</small>
                  </router-link>
                  <small v-else>-</small>
                </td>
            </tr>
            <tr>
                <td class="text-center text-sm" >出生日期</td>
                <td class="text-left text-sm">
                  <small v-if="v.dog_birthday > 0">{{v.dog_birthday|time('yyyy-mm-dd')}}</small>
                </td>
                <td class="text-center text-sm">母亲</td>
                <td class="text-left text-sm">
                  <router-link :to="{path:'/dog/add', query: {id: v.dog_mater}}" v-if="v.dog_pater > 0">
                    <small v-if="v.dog_mater > 0">{{attrs.pms[v.dog_mater]['dog_nick']}}</small>
                  </router-link>
                  <small v-else>-</small>
                </td>
            </tr>
            <tr>
                <td class="text-center text-sm">更新时间</td>
                <td class="text-left text-sm">
                  <small v-if="v.dog_udate > 0">{{v.dog_udate|time('yyyy-mm-dd HH:MM')}}</small>
                </td>
                <td class="text-center text-sm"></td>
                <td class="text-left text-sm">
                </td>
            </tr>
          </tbody>
        </table>
    </div>
    <v-pagination  v-if="total > 1" show-size-changer @sizechange="refresh" @change="refresh" :total="total"></v-pagination>
  </v-card>
</template>

<script>
export default {
  name: 'DogIndex',
  metaInfo () {
    return {
      title: '犬只管理 - 管理平台'
    }
  },
  data () {
    return {
      infoLoading: false,
      rows: {},
      attrs: {},
      pn: 1,
      total: 1,
      modal_open: false,
      modal_data: {}
    }
  },
  methods: {
    refresh: function () {
      this.$loading.show({
        msg: '加载中 ...'
      })
      this.$http.list('admin/dog', {pn: this.pn}).then(d => {
        this.$loading.hide()
        if (d.code === 0) {
          this.rows = d.data.list
          this.pn = d.data.paging.pn
          this.attrs.types = d.data.types
          this.attrs.gender = d.data.gender
          this.attrs.pms = d.data.pms
          this.total = d.data.paging.max
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
    },
    fGoInfo (id) {
      this.$router.push({
        path: '/dog/info',
        query: {id}
      })
    },
    fGoMap (id) {
      this.$router.push({
        path: '/map/modify',
        query: {id}
      })
    },
    modify: function (id) {
      this.$router.push({
        path: '/dog/add',
        query: {id}
      })
    },
    save: function () {
      this.$loading.show({
        msg: '加载中 ...'
      })
      this.$http.save('admin/server', this.modal_data).then(d => {
        this.$loading.hide()
        if (d.code === 0) {
          this.modal_open = false
          this.refresh()
        } else {
          this.$alert({
            title: '系统提示',
            content: d.msg
          }, (msg) => {
            if (d.code === 9999) {
              this.$router.go(-1)
            }
          })
        }
      })
    }
  },
  mounted: function () {
    this.$store.state.breadcrumb = [{
      'name': '犬只管理'
    }]
    this.$store.dispatch('setLeftMenuChecked', {
      vm: this,
      url: '/dog'
    })
    this.refresh()
  },
  destroyed: function () {
    this.$loading.hide()
  },
  activated: function () {
    this.refresh()
  }
}
</script>
