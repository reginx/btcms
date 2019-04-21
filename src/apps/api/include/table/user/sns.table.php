<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + SNS登录表 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:44
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class user_sns_table extends table {

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
        'sns_user_id' => [
            'name'               => 'sns_user_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '用户ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'sns_type' => [
            'name'               => 'sns_type',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '登录类型',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'sns_key' => [
            'name'               => 'sns_key',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '用户标识',
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
        'key' => ['sns_user_id', 'sns_type', 'sns_key'],
        'inc' => false
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'sns_user_id' => 0,
        'sns_type'    => 0,
        'sns_key'     => '',
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'sns_user_id' => ['re\rgx\filter', 'int'],
        'sns_type'    => ['re\rgx\filter', 'int'],
        'sns_key'     => ['re\rgx\filter', 'char'],
    ];

    /*
      +--------------------------
      + 唯一性检测
      +--------------------------
    */
    public $unique_check = [
        ['sns_user_id', 'sns_type', 'sns_key']
    ];

    /*
      +--------------------------
      + 自定义字段验证规则
      +--------------------------
    */
    public $validate = [];

}
