<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + 文章购买记录 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:43
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class article_purchase_table extends table {

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
        'ap_id' => [
            'name'               => 'ap_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '购买编号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'ap_user_id' => [
            'name'               => 'ap_user_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '购买用户',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'ap_article_id' => [
            'name'               => 'ap_article_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '文章编号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'ap_adate' => [
            'name'               => 'ap_adate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '购买时间',
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
        'key' => 'ap_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'ap_id'           => 0,
        'ap_user_id'      => 0,
        'ap_article_id'   => 0,
        'ap_adate'        => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'ap_id'           => ['re\rgx\filter', 'int'],
        'ap_user_id'      => ['re\rgx\filter', 'int'],
        'ap_article_id'   => ['re\rgx\filter', 'int'],
        'ap_adate'        => ['re\rgx\filter', 'int'],
    ];

    /*
      +--------------------------
      + 唯一性检测
      +--------------------------
    */
    public $unique_check = [
        ['ap_user_id', 'ap_article_id']
    ];

    /*
      +--------------------------
      + 自定义字段验证规则
      +--------------------------
    */
    public $validate = [];

}
