<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + pre_order 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:44
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class order_table extends table {

    /*
      +--------------------------
      + 编码
      +--------------------------
    */
    protected $_charset = 'utf8';

    /*
      +--------------------------
      + 字段
      +--------------------------
    */
    protected $_fields = [
        'order_id' => [
            'name'               => 'order_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '订单ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'order_user_id' => [
            'name'               => 'order_user_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '订单所属用户',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'order_ref_id' => [
            'name'               => 'order_ref_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '所属内容',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'order_type' => [
            'name'               => 'order_type',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '订单类型',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'order_status' => [
            'name'               => 'order_status',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '订单状态',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'order_fee' => [
            'name'               => 'order_fee',
            'type'               => 'int',
            'field_type'         => 'bigint',
            'min'                => 0,
            'max'                => 1.844674407371E+19,
            'label'              => '总费用',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'order_memo' => [
            'name'               => 'order_memo',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '订单备注',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'order_adate' => [
            'name'               => 'order_adate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '生成日期',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'order_udate' => [
            'name'               => 'order_udate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '更新日期',
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
        'key' => 'order_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'order_id'        => 0,
        'order_user_id'   => 0,
        'order_ref_id'    => 0,
        'order_type'      => 0,
        'order_status'    => 0,
        'order_fee'       => 0,
        'order_memo'      => '',
        'order_adate'     => 0,
        'order_udate'     => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'order_id'        => ['re\rgx\filter', 'int'],
        'order_user_id'   => ['re\rgx\filter', 'int'],
        'order_ref_id'    => ['re\rgx\filter', 'int'],
        'order_type'      => ['re\rgx\filter', 'int'],
        'order_status'    => ['re\rgx\filter', 'int'],
        'order_fee'       => ['re\rgx\filter', 'int'],
        'order_memo'      => ['re\rgx\filter', 'char'],
        'order_adate'     => ['re\rgx\filter', 'int'],
        'order_udate'     => ['re\rgx\filter', 'int'],
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
