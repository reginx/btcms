<?php
namespace re\rgx;

/*
  +-----------------------------------------------------------------
  + 文章内容 表模型
  + ----------------------------------------------------------------
  + @date 2019-02-12 00:46:43
  + @desc 若修改了表结构, 请使用下面的命令更新模型文件
  + @cmd  php rgx/build.php table --prefix=./ --name=\* --allow-empty --allow-null --force --exec
  + @generator RGX v1.0.0.20171212_RC
  +-----------------------------------------------------------------
*/
class article_detail_table extends table {

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
        'article_id' => [
            'name'               => 'article_id',
            'type'               => 'int',
            'field_type'         => 'int',
            'min'                => 0,
            'max'                => 4294967295,
            'label'              => '所属文章',
            'allow_empty_string' => true,
            'allow_null'         => true
        ],
        'article_detail' => [
            'name'               => 'article_detail',
            'type'               => 'char',
            'field_type'         => 'mediumtext',
            'min'                => 0,
            'max'                => 16777215,
            'label'              => '文章详情',
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
        'key' => 'article_id',
        'inc' => false
    ];

    /*
      +--------------------------
      + 字段默认值
      +--------------------------
    */
    public $defaults = [
        'article_id'      => 0,
        'article_detail'  => '',
    ];

    /*
      +--------------------------
      + 字段过滤规则
      +--------------------------
    */
    public $filter = [
        'article_id'      => ['re\rgx\filter', 'int'],
        'article_detail'  => ['re\rgx\filter', 'char'],
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
