<?php
namespace re\rgx;

/**
 * 记录信息管理接口
 * @author reginx
 */
class admin_info_iface extends admin_base_iface {

    /**
     * VPS 列表
     * @return [type] [description]
     */
    public function list_action () {
        $dog = OBJ('dog_table')->get(
            intval($this->data['dog_id'])
        );
        if (!empty($dog)) {
            $dog['cover'] = UPLOAD_URL . image::get_thumb_name($dog['dog_cover'], '500x309');
        }
        $tab = OBJ('info_table');
        $paging = new paging_helper($tab, (int)$this->data['pn'], 24);
        $ids = [];
        $list = $tab->get_all();

        $this->success('', [
            'list'      => $list,
            'dog'       => $dog,
            'paging'    => $paging->to_array(),
            'attrs'     => [
                'gender'    => dog_helper::$gender,
                'types'     => dog_helper::$types,
                'pms'       => OBJ('dog_table')->akey()->fields("dog_id,dog_name,dog_nick")->get_all([
                    'dog_id'   => [$dog['dog_pater'], $dog['dog_mater']]
                ])
            ]
        ]);
    }
}
