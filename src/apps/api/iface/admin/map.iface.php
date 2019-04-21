<?php
namespace re\rgx;

/**
 * 犬只血统接口类
 * @author reginx.com
 */
class admin_map_iface extends admin_base_iface {

    public function get_action () {
        $this->success('', [
            'dogs'   => map_helper::get((int)$this->data['id'], 2)
        ]);
    }
}
