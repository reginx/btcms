<template>
  <div class="map-wrap">
    <v-row style="padding:0;height: 100%;" :gutter="0">
        <v-col :span="24 / matrix_x" v-for="i in getNumbers(0, matrix_x)" :key="i" :class="'col-' + i">
          <div class="dog-box" v-for="j in (0, 1 << i)" :key="j"
            :style="'background-image:url(' + (dogs[getIndex(i, j)] ? dogs[getIndex(i, j)]['cover'] : '') + ')'">
            <a class="dog-box-set-btn" @click="fDogView(getIndex(i, j))"><i class="fa fa-cog"></i></a>
            <a class="dog-box-title" @click="fShowModal(getIndex(i, j))">
              {{dogs[getIndex(i, j)] ? dogs[getIndex(i, j)]['dog_nick'] : '暂无'}}
            </a>
          </div>
        </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  name: 'MapModify',
  metaInfo: {
    title: '血统库 - 犬只库'
  },
  data () {
    return {
      matrix_x: 3,
      matrix_y: 4,
      dogs: {}
    }
  },
  filters: {
    getIndex (x, y) {
      return (1 << x) + y - 1
    }
  },
  methods: {
    getNumbers (start, stop, step = 1) {
      return new Array(stop / step).fill(start).map((n, i) => (i) * step)
    },
    getIndex (x, y) {
      return (1 << x) + y - 1
    },
    fShowModal (index) {
      if (this.dogs[index]['dog_id']) {
        this.$router.push({
          path: '/dog/view',
          query: {
            id: this.dogs[index]['dog_id']
          }
        })
      }
    },
    fDogView (index) {
    }
  },
  mounted () {
    this.$store.state.breadcrumb = [{
      'name': '犬只管理',
      'url': '/dog'
    }, {
      'name': '血统库'
    }]
    this.$store.dispatch('setLeftMenuChecked', {
      vm: this,
      url: '/dog'
    })
    this.$http.get('admin/map', {
      id: this.$route.query['id']
    }).then((d) => {
      this.infoLoading = false
      if (d.code === 0) {
        this.dogs = d.data.dogs
      }
    })
  }
}
</script>
<style scoped>
  .map-wrap {
    padding: 10px;
    height: calc(4 * 150px);
    background: #fff;
  }
  .col-0, .col-1, .col-2, .col-3 {
    height: 100%;
    position: relative;
    padding-top: 30px;
  }
  .col-1, .col-3 {
    background: #f7f7f7;
  }
  .dog-box {
    width: 150px;
    height: 90px;
    background-size: cover;
    margin: auto;
    box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.15);
    position: relative;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
  }
  .dog-box-title {
    text-align: center;
    font-size: 12px;
    position: absolute;
    width: 100%;
    background: rgba(0,0,0, .4);
    bottom: 0;
    margin: 0;
    padding: 0;
    color: #fff;
    height: 18px;
    cursor: pointer;
  }
  .dog-box-set-btn {
    text-align: center;
    font-size: 14px;
    width: 20px;
    height: 20px;
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    color: #fff;
    cursor: pointer;
  }
  .col-0:before {
    content:"当前犬只";
    font-size: 20px;
    color: #80808052;
    position: absolute;
    margin: auto;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    text-align: center;
    width: 100%;
  }
  .col-1:before {
    content:"父母信息";
    font-size: 20px;
    color: #80808052;
    position: absolute;
    margin: auto;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    text-align: center;
    width: 100%;
  }
  .col-2:before {
    content:"祖辈信息";
    font-size: 20px;
    color: #80808052;
    position: absolute;
    margin: auto;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    text-align: center;
    width: 100%;
  }
  .col-3:before {
    content:"曾祖信息";
    font-size: 20px;
    color: #80808052;
    position: absolute;
    margin: auto;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    text-align: center;
    width: 100%;
  }
  .col-0 .dog-box {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
  }
  .col-1 .dog-box:first-child {
    position: absolute;
    top: 100px;
    left: 0;
    right: 0;
    margin: auto;
  }
  .col-1 .dog-box:last-child {
    position: absolute;
    bottom: 100px;
    left: 0;
    right: 0;
    margin: auto;
  }
  .col-2 .dog-box {
    margin-top: 30px;
    margin-bottom: 30px;
  }
  .col-3 .dog-box {
    margin: 10px auto;
    position: relative;
  }
</style>
