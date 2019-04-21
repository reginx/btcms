<?php
namespace re\rgx;

/**
 * 杂项助手类
 * @author reginx.com
 */
class misc_helper extends rgx {

    /**
     * option格式转换
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function option_format ($data) {
        $ret = [];
        foreach ($data as $k => $v) {
            $ret[] = [
                'value' => (string)$k,
                'label' => $v
            ];
        }
        return $ret;
    }
}
