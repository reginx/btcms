<?php
namespace re\rgx;

/**
 * admin 助手类
 */
class dog_helper extends rgx {

    /**
     * 犬只类型
     * @var [type]
     */
    public static $types = [
        1       => '成犬',
        2       => '幼犬'
    ];
    
    /**
     * 性别
     * @var [type]
     */
    public static $gender = [
        1       => '雄性',
        2       => '雌性'
    ];

    public static $info_type = [
        1       => '洗澡',
        2       => '称重',
        3       => '驱虫',
        4       => '出售情况',
        5       => '疫苗',
        6       => '断甲',
        7       => '口腔清洁',
        8       => '发情时间',
        9       => '配种时间',
        10      => '掉毛期'
    ];
}
