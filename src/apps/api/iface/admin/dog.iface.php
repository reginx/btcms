<?php
namespace re\rgx;

/**
 * 犬只操作接口类
 * @author reginx.com
 */
class admin_dog_iface extends admin_base_iface {

    /**
     * 获取犬只数据
     * @return [type] [description]
     */
    public function get_action () {
        $dog = OBJ('dog_table')->get(intval($this->data['dog_id']) ?: 0);
        $images = [];
        $pater = [];
        $mater = [];
        if (!empty($dog)) {
            $dog['dog_birthday'] = $dog['dog_birthday'] ? date('Y-m-d', $dog['dog_birthday']) : '';
            $pms = OBJ('dog_table')->akey()->get_all([
                'dog_id'    => [$dog['dog_pater'] ?: 0, $dog['dog_mater'] ?: 0]
            ]);
            if (isset($pms[$dog['dog_pater']])) {
                $pater[] = [
                    'value' => $dog['dog_pater'],
                    'label' => $pms[$dog['dog_pater']]['dog_nick']
                ];
            }
            if (isset($pms[$dog['dog_mater']])) {
                $mater[] = [
                    'value' => $dog['dog_mater'],
                    'label' => $pms[$dog['dog_mater']]['dog_nick']
                ];
            }
            $dog['cover'] = UPLOAD_URL . image::get_thumb_name($dog['dog_cover'], '500x309');
            OBJ('album_table')->map(function ($img) use (&$images) {
                $images[] = [
                    'url'   => UPLOAD_URL . $img['album_url'],
                    'thumb' => UPLOAD_URL . image::get_thumb_name($img['album_url'], '500x309'),
                    'img'   => $img['album_url']
                ];
                return null;
            })->order('album_sort asc')->get_all([
                'album_dog_id'  => $dog['dog_id']
            ]);
        }
        $this->success('', [
            'dog'       => $dog,
            'images'    => $images,
            'attrs'     => [
                'mater'     => $mater,
                'pater'     => $pater,
                'types'     => misc_helper::option_format(dog_helper::$types),
                'gender'    => misc_helper::option_format(dog_helper::$gender)
            ]
        ]);
    }

    /**
     * 快速添加
     * @return [type] [description]
     */
    public function quick_action () {
        $name = filter::text($this->data['name']);
        $gender = intval($this->data['gender']);
        $tab = OBJ('dog_table');
        if (!empty($name)) {
            if ($tab->load([
                    'dog_nick'      => $name,
                    'dog_gender'    => $gender,
                    'dog_type'      => 1,
                    'dog_adate'     => REQUEST_TIME,
                    'dog_udate'     => REQUEST_TIME,
                    'dog_paternal'  => '#0#',
                    'dog_maternal'  => '#0#',
                ])) {
                if ($tab->insert()['code'] === 0) {
                    $this->success('操作成功');
                }
            }
        }
        $this->failure($tab->get_error_desc());
    }

    /**
     * 犬只查询
     * @return [type] [description]
     */
    public function query_action () {
        $key = filter::text($this->data['key']);
        $gender = intval($this->data['gender']);
        $tab = OBJ('dog_table')->where([
            'dog_gender'    => $gender,
            'dog_type'      => 1
        ]);
        if (!empty($key)) {
            $tab->where("dog_name like '{$key}%' or dog_nick like '{$key}%'");
        }
        $tab->akey()->fields('dog_id, dog_name, dog_nick')->map(function ($row) {
            return "{$row['dog_nick']}" . ( $row['dog_name'] ? " - {$row['dog_name']}" : '');
        })->limit(10);
        $this->success('', [
            'list'  => misc_helper::option_format($tab->get_all())
        ]);
    }

    /**
     * 保存犬只
     * @return [type] [description]
     */
    public function save_action () {
        $dog = $this->data['dog'];
        $this->verify([
            'dog_nick' => [
                'code' => 100,
                'msg'  => '请输入犬只呼名',
                'rule' => filter::$rules['require'],
            ],
            'dog_type'  => [
                'code' => 101,
                'msg'  => '请选择犬只类型',
                'rule' => function ($v) {
                    return isset(dog_helper::$types[$v]);
                },
            ],
            'dog_gender'  => [
                'code' => 101,
                'msg'  => '请选择犬只性别',
                'rule' => function ($v) {
                    return isset(dog_helper::$gender[$v]);
                },
            ],
            'dog_birthday'  => [
                'code' => 101,
                'msg'  => '请选择犬只出生日期',
                'rule' => function ($v) {
                    return preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $v);
                },
            ],
            'dog_pater'  => [
                'code' => 101,
                'msg'  => '请选择犬只父亲',
                'rule' => function ($v) {
                    return preg_match('/^\d+$/', $v);
                },
            ],
            'dog_mater'  => [
                'code' => 101,
                'msg'  => '请选择犬只母亲',
                'rule' => function ($v) {
                    return preg_match('/^\d+$/', $v);
                },
            ],
            'dog_cover'  => [
                'code' => 101,
                'msg'  => '请设置犬只头像',
                'rule' => function ($v) {
                    return upload_helper::is_upload_file($v);
                },
            ],
        ], $dog);

        $dog['dog_birthday'] = strtotime($dog['dog_birthday']);

        $pmaters = OBJ('dog_table')->akey()->get_all([
            'dog_id'    => [$dog['dog_pater'], $dog['dog_mater']]
        ]);
        if (!isset($pmaters[$dog['dog_pater']])) {
            $this->failure('犬只父亲不存在');
        }
        if (!isset($pmaters[$dog['dog_mater']])) {
            $this->failure('犬只母亲不存在');
        }
        $dog['dog_paternal'] = $pmaters[$dog['dog_pater']]['dog_paternal'] . "{$dog['dog_pater']}#";
        $dog['dog_maternal'] = $pmaters[$dog['dog_mater']]['dog_maternal'] . "{$dog['dog_mater']}#";
        $dog['dog_adate'] = REQUEST_TIME;
        $dog['dog_udate'] = REQUEST_TIME;
        $dog['dog_id'] = intval($dog['dog_id']);
        $tab = OBJ('dog_table');
        if ($tab->load($dog)) {
            $ret = $tab->save();
            if ($ret['code'] === 0) {
                $dog_id = $ret['row_id'] ?: $dog['dog_id'];
                $atab = OBJ('album_table');
                if ($dog_id > 0) {
                    $atab->delete([
                        'album_dog_id'  => $dog_id
                    ]);
                }
                $images = $this->data['images'];
                foreach ($images as $k => $img) {
                    $atab->insert([
                        'album_dog_id'  => $dog_id,
                        'album_url'     => $img['img'],
                        'album_sort'    => $k
                    ]);
                }
                $this->success('操作成功');
            }
        }
        $this->failure($tab->get_error_desc());
    }

    /**
     * 列表
     * @return [type] [description]
     */
    public function list_action () {
        $tab = OBJ('dog_table');
        $paging = new paging_helper($tab, (int)$this->data['pn'], 24);
        $pm_ids = [];
        $list = $tab->map(function ($row) use (&$pm_ids) {
            $pm_ids[] = $row['dog_pater'];
            $pm_ids[] = $row['dog_mater'];
            $row['cover'] = UPLOAD_URL . image::get_thumb_name($row['dog_cover'], '500x309');
            return $row;
        })->order('dog_id desc')->get_all();
        
        $this->success('', [
            'list'      => $list,
            'paging'    => $paging->to_array(),
            'pms'       => $tab->akey()->fields("dog_id,dog_name,dog_nick")->get_all([
                'dog_id'   => $pm_ids ?: [0]
            ]),
            'gender'    => dog_helper::$gender,
            'types'     => dog_helper::$types
        ]);
    }
}
