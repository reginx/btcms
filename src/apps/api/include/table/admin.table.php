<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + 管理表 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:42
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class admin_table extends table {

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
        'admin_id' => [
            'name'               => 'admin_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '管理编号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'admin_salt' => [
            'name'               => 'admin_salt',
            'type'               => 'char',
            'field_type'         => 'char',
            'min'                => 0,
            'max'                => 6,
            'label'              => 'admin_salt',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'admin_account' => [
            'name'               => 'admin_account',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '管理账号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'admin_passwd' => [
            'name'               => 'admin_passwd',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 32,
            'label'              => '管理密码',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'admin_group' => [
            'name'               => 'admin_group',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '权限组',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'admin_lastlogin' => [
            'name'               => 'admin_lastlogin',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '最近登录时间',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'admin_lastip' => [
            'name'               => 'admin_lastip',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '最近登录IP',
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
        'key' => 'admin_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'admin_id'        => 0,
        'admin_salt'      => '',
        'admin_account'   => '',
        'admin_passwd'    => '',
        'admin_group'     => 0,
        'admin_lastlogin' => 0,
        'admin_lastip'    => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'admin_id'        => ['re\rgx\filter', 'int'],
        'admin_salt'      => ['re\rgx\filter', 'char'],
        'admin_account'   => ['re\rgx\filter', 'char'],
        'admin_passwd'    => ['re\rgx\filter', 'char'],
        'admin_group'     => ['re\rgx\filter', 'int'],
        'admin_lastlogin' => ['re\rgx\filter', 'int'],
        'admin_lastip'    => ['re\rgx\filter', 'int'],
    ];

    /*
      +--------------------------
      + 唯一性检测
      +--------------------------
    */
    public $unique_check = [
        ['admin_account']
    ];

    /*
      +--------------------------
      + 自定义字段验证规则
      +--------------------------
    */
    public $validate = [];

}
