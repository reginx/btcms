<?php
namespace re\rgx;

/**
 * 平台管理 admin
 * @author reginx
 */
class admin_base_iface extends admin_iface {
    
    /**
     * 架构方法
     * @param array $params [description]
     */
    public function __construct ($params = []) {
        parent::__construct($params);
        $this->check_login();
    }
}
