export default {
  full: [
    {
      name: '管理主页',
      icon: 'fa fa-home',
      selected: true,
      expand: true,
      children: [
        {
          url: '/',
          name: '管理首页',
          icon: 'fa fa-home',
          active: true
        },
        {
          url: '/system/article',
          name: '资讯列表',
          icon: 'fa fa-newspaper-o',
          active: false
        },
        {
          url: '/article/category',
          name: '资讯分类',
          icon: 'fa fa-lemon-o',
          active: false
        },
        {
          url: '/system/article/tags',
          name: '标签管理',
          icon: 'fa fa-tags',
          active: false
        },
        {
          url: '/system/user',
          name: '用户管理',
          icon: 'fa fa-th-list',
          active: false
        },
        {
          url: '/system/comment',
          name: '评论管理',
          icon: 'fa fa-comments-o',
          active: false
        },
        {
          url: '/system/trade',
          name: '交易流水',
          icon: 'fa fa-paypal',
          active: false
        },
        {
          url: '/system/stat',
          name: '数据统计',
          icon: 'fa fa-area-chart',
          active: false
        }
      ]
    },
    {
      name: '系统管理',
      icon: 'fa fa-delicious',
      children: [
        {
          url: '/system/advert',
          name: '广告管理',
          icon: 'fa fa-file-audio-o',
          active: false
        },
        {
          url: '/system/admin',
          name: '管理账号',
          icon: 'fa fa-user-o',
          active: false
        },
        {
          url: '/system/config',
          name: '系统配置',
          icon: 'fa fa-bell-o',
          active: false
        },
        {
          url: '/system/help',
          name: '获取帮助',
          icon: 'fa fa-question-circle',
          active: false
        },
        {
          url: '/system/flush',
          name: '缓存更新',
          icon: 'fa fa-refresh',
          active: false
        }
      ]
    }
  ]
}
