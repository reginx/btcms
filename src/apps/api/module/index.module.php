<?php
namespace com\api_default;
use \re\rgx as R;

/**
 * 接口路由类
 * @author reginx
 */
class index_module extends R\module {

    /**
     * 当前请求参数
     * @var array
     */
    public $params = [];

    /**
     * 默认入口
     * @return [type] [description]
     */
    public function index_action () {
        // 跨域
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Headers: authkey,requri");
        header("Access-Control-Expose-Headers: authkey,requri");
        // OPTIONS Resp
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            $this->ajax_success('helo');
        }

        $request = isset($_POST['raw']) ? $_POST['raw'] : file_get_contents('php://input');
        $this->params = json_decode($request, 1);
        if (json_last_error() > 0 || empty($this->params)) {
            $this->ajax_failure('invalid request ' . $request, 999);
        }
        $request = null;
        unset($request);

        if (!preg_match('/^\w+(\/\w+?){1,}$/i', $this->params['uri'])) {
            $this->ajax_failure('invalid request', 998);
        }

        // session
        $sess_id = $_SERVER['HTTP_AUTHKEY'] ?: $this->params['authkey'];
        if (empty($sess_id) || !preg_match('/^RS\d{1,3}\-[\w\-]+$/i', $sess_id)) {
            $sess_id = null;
        }
        $this->sess('authkey', $sess_id ?: null);

        // iface & action
        $uri = explode('/', $this->params['uri']);
        $action = array_pop($uri) . '_action';
        if (empty($uri) && count($uri) > 3) {
            $this->ajax_failure('Resource not found', 996);
        }
        $iface = join('_', $uri) . '_iface';

        $this->log = R\app::log($this->params['uri'], function ($obj) {
            $obj->init($this->params['uri']);
            $obj->write(PHP_EOL . json_encode($this->params, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL);
        });
        try {
            $obj = R\OBJ($iface, true, [
                'mod'       => $this, 
                'data'      => $this->params['data'] ?: [],
                'action'    => $action
            ]);
        }
        catch (\Exception $e) {
            $this->log->write($e->getMessage());
            $this->ajax_failure('System Error  ' . 
                (RUN_MODE == 'debug' ? $e->getMessage() : ' 执行失败了'), 995);
        }

        // 判断资源是否存在
        if (!is_callable([$obj, $action])) {
            $this->ajax_failure('Resource not found', 994);
        }

        $obj->$action();
    }
}
