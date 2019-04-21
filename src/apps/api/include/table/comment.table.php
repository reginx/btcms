<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + 评论表 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:43
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class comment_table extends table {

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
        'comment_id' => [
            'name'               => 'comment_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '评论ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_user_id' => [
            'name'               => 'comment_user_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '发布人',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_user_nick' => [
            'name'               => 'comment_user_nick',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 32,
            'label'              => '发布人昵称',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_status' => [
            'name'               => 'comment_status',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '发布状态',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_type' => [
            'name'               => 'comment_type',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '所属频道',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_ref_id' => [
            'name'               => 'comment_ref_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '内容ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_detail' => [
            'name'               => 'comment_detail',
            'type'               => 'char',
            'field_type'         => 'text',
            'min'                => 0,
            'max'                => 65535,
            'label'              => '评论内容',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_adate' => [
            'name'               => 'comment_adate',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '发布日期',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_reply_id' => [
            'name'               => 'comment_reply_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '评论对象',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_stat_like' => [
            'name'               => 'comment_stat_like',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '赞数',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_stat_reply' => [
            'name'               => 'comment_stat_reply',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '回复数',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'comment_via_client' => [
            'name'               => 'comment_via_client',
            'type'               => 'int',
            'field_type'         => 'tinyint',
            'min'                => 0,
            'max'                => 255,
            'label'              => '评论来源',
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
        'key' => 'comment_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'comment_id'          => 0,
        'comment_user_id'     => 0,
        'comment_user_nick'   => '',
        'comment_status'      => 0,
        'comment_type'        => 0,
        'comment_ref_id'      => 0,
        'comment_detail'      => '',
        'comment_adate'       => 0,
        'comment_reply_id'    => 0,
        'comment_stat_like'   => 0,
        'comment_stat_reply'  => 0,
        'comment_via_client'  => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'comment_id'          => ['re\rgx\filter', 'int'],
        'comment_user_id'     => ['re\rgx\filter', 'int'],
        'comment_user_nick'   => ['re\rgx\filter', 'char'],
        'comment_status'      => ['re\rgx\filter', 'int'],
        'comment_type'        => ['re\rgx\filter', 'int'],
        'comment_ref_id'      => ['re\rgx\filter', 'int'],
        'comment_detail'      => ['re\rgx\filter', 'char'],
        'comment_adate'       => ['re\rgx\filter', 'int'],
        'comment_reply_id'    => ['re\rgx\filter', 'int'],
        'comment_stat_like'   => ['re\rgx\filter', 'int'],
        'comment_stat_reply'  => ['re\rgx\filter', 'int'],
        'comment_via_client'  => ['re\rgx\filter', 'int'],
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
