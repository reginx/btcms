<?php
namespace re\rgx;

/**
 * 关系助手类
 * @author reginx.com
 */
class map_helper extends rgx {

    /**
     * 获取关系数组
     * @param  [type]  $dog_id [description]
     * @param  integer $plies  [description]
     * @return [type]          [description]
     */
    public static function get ($dog_id, $plies = 3) {
        $ret = [];
        $row = OBJ('dog_table')->get_row(self::get_sql($dog_id, $plies));
        foreach ($row as $k => $v) {
            list($id, $key) = explode('_', $k, 2);
            if (!isset($ret[$id])) {
                $ret[$id] = [
                    $key    => $v
                ];
            } else {
                $ret[$id][$key] = $v === null ? '' : $v;
                if ($key == 'dog_cover') {
                    $ret[$id]['cover'] = UPLOAD_URL . image::get_thumb_name($ret[$id][$key], '500x309');
                }
                if ($key == 'dog_nick') {
                    $ret[$id][$key] = $ret[$id][$key] ?: '暂无';
                }
            }
        }
        return $ret;
    }

    /**
     * 获取查询sql
     * @param  [type]  $dog_id [description]
     * @param  integer $plies  [description]
     * @return [type]          [description]
     */
    public static function get_sql ($dog_id, $plies = 3) {
        $get_part = function ($index, $ref_index, $field = '') {
            return [
                'fields'    => "\n    " . join(', ', [
                    "{$index} as {$index}_index",
                    "t{$index}.dog_id as {$index}_dog_id",
                    "t{$index}.dog_nick as {$index}_dog_nick",
                    "t{$index}.dog_cover as {$index}_dog_cover",
                    "t{$index}.dog_gender as {$index}_dog_gender",
                ]),
                'join'      => "    left join pre_dog as t{$index} on t{$ref_index}.{$field} = t{$index}.dog_id "
            ];
        };
        $fields = [
            $get_part(1, 0)['fields']
        ];
        $joins = [];
        for ($i = 2; $i < (2 << $plies); $i ++) {
            $part = $get_part($i, ($i >> 1), ['dog_pater', 'dog_mater'][$i % 2]);
            $fields[] = $part['fields'];
            $joins[]  = $part['join'];
        }
        return sprintf(
            "select %s from pre_dog t1 %s where t1.dog_id = {$dog_id}",
            join(', ', $fields),
            join("\n", $joins)
        );
    }
}