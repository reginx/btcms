<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + pre_app_token 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:42
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class app_token_table extends table {

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
        'at_id' => [
            'name'               => 'at_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '编号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'at_app_id' => [
            'name'               => 'at_app_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '所属应用',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'at_token' => [
            'name'               => 'at_token',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 32,
            'label'              => ' token',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'at_ip' => [
            'name'               => 'at_ip',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '来源IP',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'at_udate' => [
            'name'               => 'at_udate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '最近使用',
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
        'key' => 'at_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'at_id'       => 0,
        'at_app_id'   => 0,
        'at_token'    => '',
        'at_ip'       => 0,
        'at_udate'    => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'at_id'       => ['re\rgx\filter', 'int'],
        'at_app_id'   => ['re\rgx\filter', 'int'],
        'at_token'    => ['re\rgx\filter', 'char'],
        'at_ip'       => ['re\rgx\filter', 'int'],
        'at_udate'    => ['re\rgx\filter', 'int'],
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
