<template>
  <v-card title="" :bordered="false" :noHovering="true" :bodyStyle="{padding: 0}" :loading="infoLoading">
    <h1 class="card-title card-title-border">
      资讯分类
      <span class="pull-right">
        <v-button type="info" @click="onModify()">
          <i class="fa fa-plus-square"></i> 新增
        </v-button>
      </span>
    </h1>
    <table class="table table-border table-border-limit table-striped">
      <thead>
          <tr>
            <th class="text-left">名称</th>
            <th class="text-center" width="120">状态</th>
            <th class="text-center" width="100">排序</th>
            <th class="text-center" width="80">操作</th>
          </tr>
      </thead>
      <tbody>
        <tr v-for="(v) in rows" :key="v.cat_id">
          <td class="text-left">
            <a @click="onModify(v)"><span :class="v.class"></span>{{v.cat_name}}</a>
          </td>
          <td class="text-center"><code><small>{{v.status}}</small></code></td>
          <td class="text-center">{{v.cat_sort}}</td>
          <td class="text-center">
              <v-button size="small" type="error" @click="onDel(v.cat_id)"><i class="fa fa-trash-o"></i></v-button>
          </td>
        </tr>
      </tbody>
    </table>
    <v-modal
      :width="480"
      :title="modalTitle"
      :visible="modalVisible"
      @ok="fModalOk"
      @cancel="fModalClose">
        <v-form-item label="">
          <v-input placeholder="请输入分类名称" ref="cat_name" v-model="form.cat_name" size="large"></v-input>
        </v-form-item>
        <v-form-item label="">
          <v-input placeholder="请输入路由入口" ref="cat_route" v-model="form.cat_route" size="large"></v-input>
        </v-form-item>
        <v-form-item label="">
          <select v-model="form.cat_parent" class="form-control">
            <option v-for="(v) in attrs.opts" v-bind:key="v.cat_id" :value="v.cat_id" v-html="v.space">
            </option>
          </select>
        </v-form-item>
    </v-modal>
  </v-card>
</template>

<script>
export default {
  name: 'ArticleCategory',
  metaInfo () {
    return {
      title: '资讯分类 - 资讯管理 - 管理平台'
    }
  },
  data () {
    return {
      infoLoading: false,
      rows: {},
      attrs: {
        opts: []
      },
      form: {},
      modalTitle: 'Loading',
      modalVisible: false
    }
  },
  methods: {
    refresh: function () {
      this.$loading.show({
        msg: '加载中 ...'
      })
      this.$http.list('admin/article/category').then(d => {
        this.$loading.hide()
        if (d.code === 0) {
          this.rows = d.data.rows
          this.attrs.opts = d.data.options
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
    fModalOk () {
      this.$loading.show({
        msg: '加载中 ...'
      })
      this.$http.save('admin/article/category', this.form).then(d => {
        this.$loading.hide()
        if (d.code === 0) {
          this.modalVisible = false
          this.form = {}
          this.refresh()
        } else {
          this.$notify.info({
            message: d.msg
          }).then(() => {
            if (d.code === 9999) {
              this.$router.go(-1)
            }
          })
        }
      })
    },
    fModalClose () {
      this.modalVisible = false
    },
    /**
     * 删除
     * @param  {[type]} cus [description]
     * @return {[type]}     [description]
     */
    onDel (id) {
      this.$notify.confirm({
        title: '操作提示',
        msg: '确认删除 ?',
        ok: () => {
          this.$http.del('admin/article/category', {
            id: id
          }).then(d => {
            if (d.code === 0) {
              this.refresh()
            } else {
              this.$notify.error({
                message: d.msg
              })
            }
          })
        }
      })
    },
    onModify: function (v) {
      v = v || {
        cat_id: 0,
        cat_name: '',
        cat_parent: 0,
        cat_route: ''
      }
      this.form = v
      this.modalVisible = true
      this.modalTitle = v['cat_name'] ? ('编辑分类 - ' + v['cat_name']) : '新增分类'
    }
  },
  mounted: function () {
    this.$store.state.breadcrumb = [{
      'name': '资讯分类'
    }]
    this.$store.dispatch('setLeftMenuChecked', {
      vm: this,
      url: '/article/category'
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
