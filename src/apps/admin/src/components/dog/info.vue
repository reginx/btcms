<template>
  <div>
    <v-card :bordered="false" :noHovering="true" :bodyStyle="{padding: 0}" :loading="infoLoading">
      <table class="table table-padding-sm table-border table-border-limit">
        <tbody>
          <tr>
            <td rowspan="4" width="20%" style="border-bottom: none;">
              <img :src="dog.cover" style="width: 100%;border-radius: 3px;"/>
            </td>
            <td class="text-center text-sm" width="10%">名称</td>
            <td class="text-left" width="30%">
              {{dog.dog_nick}}
            </td>
            <td class="text-center text-sm" width="10%">类型</td>
            <td class="text-left" width="30%">
              <v-tag v-if="dog.dog_type === '1'">{{attrs.types[dog.dog_type]}}</v-tag>
              <v-tag v-else-if="dog.dog_type === '2'">{{attrs.types[dog.dog_type]}}</v-tag>
              <v-tag v-else>未知</v-tag>
            </td>
          </tr>
          <tr>
              <td class="text-center text-sm">性别</td>
              <td class="text-left text-sm">
                <small v-if="dog.dog_gender > 0">{{attrs.gender[dog.dog_gender]}}</small>
              </td>
              <td class="text-center text-sm">父亲</td>
              <td class="text-left text-sm">
                <router-link :to="{path:'/dog/info', query: {id: dog.dog_pater}}" v-if="dog.dog_pater > 0">
                  <small>{{attrs.pms[dog.dog_pater]['dog_nick']}}</small>
                </router-link>
                <small v-else>-</small>
              </td>
          </tr>
          <tr>
              <td class="text-center text-sm" >出生日期</td>
              <td class="text-left text-sm">
                <small v-if="dog.dog_birthday > 0">{{dog.dog_birthday|time('yyyy-mm-dd')}}</small>
                <small v-else>-</small>
              </td>
              <td class="text-center text-sm">母亲</td>
              <td class="text-left text-sm">
                <router-link :to="{path:'/dog/info', query: {id: dog.dog_mater}}" v-if="dog.dog_pater > 0">
                  <small v-if="dog.dog_mater > 0">{{attrs.pms[dog.dog_mater]['dog_nick']}}</small>
                </router-link>
                <small v-else>-</small>
              </td>
          </tr>
          <tr>
              <td class="text-center text-sm">更新时间</td>
              <td class="text-left text-sm">
                <small v-if="dog.dog_udate > 0">{{dog.dog_udate|time('yyyy-mm-dd HH:MM')}}</small>
              </td>
              <td class="text-center text-sm"></td>
              <td class="text-left text-sm">
              </td>
          </tr>
        </tbody>
      </table>
      <div class="section-block">
        <v-form :model="setting" direction="horizontal">
          <v-form-item label="记录类型" :label-col="labelCol" :wrapper-col="wrapperCol">
            <v-radio-group type="button" v-model="setting.dots"
                :data="[{value: 'inside', text: '内部'},{value: 'outside', text: '外部'},{value: 'none', text: '不显示'}]">
            </v-radio-group>
          </v-form-item>
          <v-form-item label="切换箭头" :label-col="labelCol" :wrapper-col="wrapperCol">
             <v-radio-group type="button" v-model="setting.arrow"
                :data="[{value: 'hover', text: '悬停时显示'},{value: 'always', text: '一直显示'},{value: 'never', text: '不显示'}]">
            </v-radio-group>
          </v-form-item>
          <v-form-item label="指示器触发方式" :label-col="labelCol" :wrapper-col="wrapperCol">
            <v-radio-group type="button" v-model="setting.trigger"
                :data="[{value: 'click', text: '点击'},{value: 'hover', text: '悬停'}]">
            </v-radio-group>
          </v-form-item>
        </v-form>
      </div>
    </v-card>
  </div>
</template>

<script>
export default {
  name: 'DogInfo',
  metaInfo: {
    title: '成长记录 - 管理平台'
  },
  data () {
    return {
      infoLoading: true,
      pn: 1,
      rows: [],
      dog: {},
      pageTitle: '加载中 ...',
      attrs: {},
      setting: {},
      labelCol: {
        span: 4
      },
      wrapperCol: {
        span: 16
      }
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
    this.$http.list('admin/info', {
      pn: this.pn,
      dog_id: this.$route.query['id'] || 0
    }).then(d => {
      this.infoLoading = false
      if (d.code === 0) {
        this.rows = d.data.list
        this.pn = d.data.paging.pn
        this.total = d.data.paging.max
        this.dog = d.data.dog
        this.pageTitle = d.data.dog['dog_nick']
        this.attrs = d.data.attrs
        this.$store.state.breadcrumb = [{
          'name': '犬只管理',
          'url': '/dog'
        }, {
          'name': d.data.dog['dog_nick']
        }]
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
