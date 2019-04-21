<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + 资讯图片表 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:43
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class article_image_table extends table {

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
        'ai_id' => [
            'name'               => 'ai_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '图片ID',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'ai_article_id' => [
            'name'               => 'ai_article_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '所属资讯',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'ai_url' => [
            'name'               => 'ai_url',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 128,
            'label'              => '图片地址',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'ai_desc' => [
            'name'               => 'ai_desc',
            'type'               => 'char',
            'field_type'         => 'varchar',
            'min'                => 0,
            'max'                => 255,
            'label'              => '图片说明',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'ai_sort' => [
            'name'               => 'ai_sort',
            'type'               => 'int',
            'field_type'         => 'smallint',
            'min'                => 0,
            'max'                => 65535,
            'label'              => '图片排序',
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
        'key' => 'ai_id',
        'inc' => true
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'ai_id'           => 0,
        'ai_article_id'   => 0,
        'ai_url'          => '',
        'ai_desc'         => '',
        'ai_sort'         => 0,
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'ai_id'           => ['re\rgx\filter', 'int'],
        'ai_article_id'   => ['re\rgx\filter', 'int'],
        'ai_url'          => ['re\rgx\filter', 'char'],
        'ai_desc'         => ['re\rgx\filter', 'char'],
        'ai_sort'         => ['re\rgx\filter', 'int'],
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
