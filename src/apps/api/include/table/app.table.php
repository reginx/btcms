<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + pre_app 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:42
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class app_table extends table {

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
        'app_id' => [
            'name'               => 'app_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '应用编号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'app_name' => [
            'name'               => 'app_name',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '应用名称',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'app_key' => [
            'name'               => 'app_key',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '通信key',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'app_salt' => [
            'name'               => 'app_salt',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '安全码',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'app_adate' => [
            'name'               => 'app_adate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '添加日期',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'app_edate' => [
            'name'               => 'app_edate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => -2147483648,
            'max'                => 2147483647,
            'label'              => 'app_edate',
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
        'key' => 'app_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'app_id'      => 0,
        'app_name'    => '',
        'app_key'     => '',
        'app_salt'    => '',
        'app_adate'   => 0,
        'app_edate'   => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'app_id'      => ['re\rgx\filter', 'int'],
        'app_name'    => ['re\rgx\filter', 'char'],
        'app_key'     => ['re\rgx\filter', 'char'],
        'app_salt'    => ['re\rgx\filter', 'char'],
        'app_adate'   => ['re\rgx\filter', 'int'],
        'app_edate'   => ['re\rgx\filter', 'int'],
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
