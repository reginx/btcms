<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + 用户表 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:44
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class user_table extends table {

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
        'user_id' => [
            'name'               => 'user_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '用户ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_nick' => [
            'name'               => 'user_nick',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '用户昵称',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_account' => [
            'name'               => 'user_account',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '会员账号',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_passwd' => [
            'name'               => 'user_passwd',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 32,
            'label'              => '用户密码',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_salt' => [
            'name'               => 'user_salt',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 16,
            'label'              => '随机盐值',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_points' => [
            'name'               => 'user_points',
            'type'               => 'int',
            'field_type'         => 'bigint',
            'min'                => 0,
            'max'                => 1.844674407371E+19,
            'label'              => '用户积分',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_email' => [
            'name'               => 'user_email',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 64,
            'label'              => '用户邮箱',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_mobile' => [
            'name'               => 'user_mobile',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 16,
            'label'              => '手机号码',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_wechat' => [
            'name'               => 'user_wechat',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 16,
            'label'              => '用户微信',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_qq' => [
            'name'               => 'user_qq',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 16,
            'label'              => '用户QQ',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_ip' => [
            'name'               => 'user_ip',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '最后登录IP',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_adate' => [
            'name'               => 'user_adate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '注册日期',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_ldate' => [
            'name'               => 'user_ldate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '最后登录时间',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_avatar' => [
            'name'               => 'user_avatar',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 255,
            'label'              => '头像',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'user_level' => [
            'name'               => 'user_level',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '用户等级',
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
        'key' => 'user_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'user_id'     => 0,
        'user_nick'   => '',
        'user_account'=> '',
        'user_passwd' => '',
        'user_salt'   => '',
        'user_points' => 0,
        'user_email'  => '',
        'user_mobile' => '',
        'user_wechat' => '',
        'user_qq'     => '',
        'user_ip'     => 0,
        'user_adate'  => 0,
        'user_ldate'  => 0,
        'user_avatar' => '',
        'user_level'  => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'user_id'     => ['re\rgx\filter', 'int'],
        'user_nick'   => ['re\rgx\filter', 'char'],
        'user_account'=> ['re\rgx\filter', 'char'],
        'user_passwd' => ['re\rgx\filter', 'char'],
        'user_salt'   => ['re\rgx\filter', 'char'],
        'user_points' => ['re\rgx\filter', 'int'],
        'user_email'  => ['re\rgx\filter', 'char'],
        'user_mobile' => ['re\rgx\filter', 'char'],
        'user_wechat' => ['re\rgx\filter', 'char'],
        'user_qq'     => ['re\rgx\filter', 'char'],
        'user_ip'     => ['re\rgx\filter', 'int'],
        'user_adate'  => ['re\rgx\filter', 'int'],
        'user_ldate'  => ['re\rgx\filter', 'int'],
        'user_avatar' => ['re\rgx\filter', 'char'],
        'user_level'  => ['re\rgx\filter', 'int'],
    ];

    /*
      +--------------------------
      + 唯一性检测
      +--------------------------
    */
    public $unique_check = [
        ['user_account']
    ];

    /*
      +--------------------------
      + 自定义字段验证规则
      +--------------------------
    */
    public $validate = [];

}
