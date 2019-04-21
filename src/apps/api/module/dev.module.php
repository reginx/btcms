<?php
namespace com\api_default;
use \re\rgx as R;

class dev_module extends R\module {

    public function foo_action () {
        var_dump($_SERVER);
    }

    public function region_action () {
        R\soft_helper::get_soft_regions(R\OBJ('soft_table')->get(1));
    }

    /**
     * 添加客户端连接
     * @return [type] [description]
     */
    public function addclients_action () {
        $clients = [];
        $serv_list = R\OBJ('server_table')->map(function ($s) use (&$clients) {
            $clients[] = [
                'key'       => $s['server_key'],
                'ip'        => $s['server_ipaddr'],
                'type'      => $s['server_type'],
                'port'      => $s['server_port'],
                'localport' => $s['server_id'] + 19870
            ];
            return $s;
        })->get_all();
        $m = new R\manager_helper();
        var_dump($m->get_error());
        $m->add_client($clients);
        // $m->add_client([[
        //     'key'       => 'aa',
        //     'ip'        => '127.0.0.1',
        //     'type'      => 3,
        //     'port'      => 19878,
        //     'localport' => 19870
        // ]]);
        var_dump($clients);
    }
}
