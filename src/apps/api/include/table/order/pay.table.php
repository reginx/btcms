<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + 支付记录 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:44
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class order_pay_table extends table {

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
        'pay_id' => [
            'name'               => 'pay_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '记录ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_trade_no' => [
            'name'               => 'pay_trade_no',
            'type'               => 'char',
            'field_type'         => 'char',
            'min'                => 0,
            'max'                => 32,
            'label'              => '记录编号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_out_no' => [
            'name'               => 'pay_out_no',
            'type'               => 'char',
            'field_type'         => 'char',
            'min'                => 0,
            'max'                => 64,
            'label'              => '外部编号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_amount' => [
            'name'               => 'pay_amount',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '支付金额',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_type' => [
            'name'               => 'pay_type',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '支付方式',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_user_id' => [
            'name'               => 'pay_user_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '所属用户',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_desc' => [
            'name'               => 'pay_desc',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '支付备注',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_adate' => [
            'name'               => 'pay_adate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '生成日期',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_status' => [
            'name'               => 'pay_status',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '支付状态',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'pay_ddate' => [
            'name'               => 'pay_ddate',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '到账日期',
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
        'key' => 'pay_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'pay_id'      => 0,
        'pay_trade_no'=> '',
        'pay_out_no'  => '',
        'pay_amount'  => 0,
        'pay_type'    => 0,
        'pay_user_id' => 0,
        'pay_desc'    => '',
        'pay_adate'   => 0,
        'pay_status'  => 0,
        'pay_ddate'   => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'pay_id'      => ['re\rgx\filter', 'int'],
        'pay_trade_no'=> ['re\rgx\filter', 'char'],
        'pay_out_no'  => ['re\rgx\filter', 'char'],
        'pay_amount'  => ['re\rgx\filter', 'int'],
        'pay_type'    => ['re\rgx\filter', 'int'],
        'pay_user_id' => ['re\rgx\filter', 'int'],
        'pay_desc'    => ['re\rgx\filter', 'char'],
        'pay_adate'   => ['re\rgx\filter', 'int'],
        'pay_status'  => ['re\rgx\filter', 'int'],
        'pay_ddate'   => ['re\rgx\filter', 'int'],
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
