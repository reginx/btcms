<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + 文章表 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:42
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class article_table extends table {

    /*
      +--------------------------
      + 编码
      +--------------------------
    */
    protected $_charset = 'utf8mb4';

    /*
      +--------------------------
      + 字段
      +--------------------------
    */
    protected $_fields = [
        'article_id' => [
            'name'               => 'article_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '文章ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_title' => [
            'name'               => 'article_title',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 128,
            'label'              => '文章标题',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_user_id' => [
            'name'               => 'article_user_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '所属会员',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_points' => [
            'name'               => 'article_points',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '售价',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_cat_id' => [
            'name'               => 'article_cat_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '分类ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_tags' => [
            'name'               => 'article_tags',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 128,
            'label'              => '标签',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_keyword' => [
            'name'               => 'article_keyword',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 128,
            'label'              => '关键字',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_desc' => [
            'name'               => 'article_desc',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 128,
            'label'              => '描述',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_status' => [
            'name'               => 'article_status',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '审核状态',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_has_cover' => [
            'name'               => 'article_has_cover',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '是否存在封面',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_cover' => [
            'name'               => 'article_cover',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '封面',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_via' => [
            'name'               => 'article_via',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '来源',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_via_url' => [
            'name'               => 'article_via_url',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 255,
            'label'              => '来源地址',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_stat_fav' => [
            'name'               => 'article_stat_fav',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '收藏数',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_stat_like' => [
            'name'               => 'article_stat_like',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '赞数',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_stat_view' => [
            'name'               => 'article_stat_view',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '浏览数',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_stat_comments' => [
            'name'               => 'article_stat_comments',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '评论数',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_adate' => [
            'name'               => 'article_adate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '发布时间',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_udate' => [
            'name'               => 'article_udate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '更新时间',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
    ];

    /*
      +--------------------------
      + 主键
      +--------------------------
    */
    protected $_primary_key = [
        'key' => 'article_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'article_id'              => 0,
        'article_title'           => '',
        'article_user_id'         => 0,
        'article_points'          => 0,
        'article_cat_id'          => 0,
        'article_tags'            => '',
        'article_keyword'         => '',
        'article_desc'            => '',
        'article_status'          => 0,
        'article_has_cover'       => 0,
        'article_cover'           => '',
        'article_via'             => 0,
        'article_via_url'         => '',
        'article_stat_fav'        => 0,
        'article_stat_like'       => 0,
        'article_stat_view'       => 0,
        'article_stat_comments'   => 0,
        'article_adate'           => 0,
        'article_udate'           => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'article_id'              => ['re\rgx\filter', 'int'],
        'article_title'           => ['re\rgx\filter', 'char'],
        'article_user_id'         => ['re\rgx\filter', 'int'],
        'article_points'          => ['re\rgx\filter', 'int'],
        'article_cat_id'          => ['re\rgx\filter', 'int'],
        'article_tags'            => ['re\rgx\filter', 'char'],
        'article_keyword'         => ['re\rgx\filter', 'char'],
        'article_desc'            => ['re\rgx\filter', 'char'],
        'article_status'          => ['re\rgx\filter', 'int'],
        'article_has_cover'       => ['re\rgx\filter', 'int'],
        'article_cover'           => ['re\rgx\filter', 'char'],
        'article_via'             => ['re\rgx\filter', 'int'],
        'article_via_url'         => ['re\rgx\filter', 'char'],
        'article_stat_fav'        => ['re\rgx\filter', 'int'],
        'article_stat_like'       => ['re\rgx\filter', 'int'],
        'article_stat_view'       => ['re\rgx\filter', 'int'],
        'article_stat_comments'   => ['re\rgx\filter', 'int'],
        'article_adate'           => ['re\rgx\filter', 'int'],
        'article_udate'           => ['re\rgx\filter', 'int'],
    ];

    /*
      +--------------------------
      + 唯一性检测
      +--------------------------
    */
    public $unique_check = [
        
    ];

    /*
      +--------------------------
      + 自定义字段验证规则
      +--------------------------
    */
    public $validate = [];

}
