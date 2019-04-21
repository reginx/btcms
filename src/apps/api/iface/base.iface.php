<?php
namespace re\rgx;

/**
 * 接口实现基类
 * @author reginx
 */
class base_iface extends rgx {

    /**
     * 请求参数
     * @var array
     */
    public $data = [];

    /**
     * 模块实例
     * @var null
     */
    public $mod  = null;

    /**
     * 日志实例
     * @var null
     */
    public $log  = null;

    /**
     * 登录用户
     * @var null
     */
    public $login = null;

    /**
     * 当前请求的操作
     * @var string
     */
    public $action = '';

    /**
     * 架构函数
     * @param [type] $mod   [description]
     * @param [type] $data  [description]
     * @param [type] $login [description]
     */
    public function __construct ($params = []) {
        $this->mod = $params['mod'];
        $this->log = $params['mod']->log;
        $this->data = $params['data'];
        $this->action = $params['action'];
    }

    /**
     * 回话数据写入
     * @param  [type] $key [description]
     * @param  [type] $val [description]
     * @return [type]      [description]
     */
    public function sess_set ($key, $val) {
        $this->mod->sess_set($key, $val);
    }

    /**
     * 回话数据读取
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function sess_get ($key) {
        $this->mod->sess_get($key);
    }

    /**
     * 数据验证
     * @param  [type] $rules [description]
     * @return [type]        [description]
     */
    public function verify ($rules, $ref = null) {
        $ref = is_string($ref) ? $this->data[$ref] : (empty($ref) ? $this->data : $ref);
        foreach ($rules as $k => $rule) {
            $result = true;
            $value  = $ref[$k] ?: null;
            //  跳过可为空的字段
            if ($rule['allow_empty'] && ($value == '' || $value == null)) {
                continue;
            }
            if (is_callable($rule['rule'])) {
                $result = $rule['rule']($value);
            }
            else if (is_array($rule['rule'])) {
                $result = call_user_func_array($rule['rule'], [$value]);
            }
            else {
                $result = preg_match($rule['rule'], $value);
            }

            if (!$result) {
                $this->failure($rule['msg'], isset($rule['code']) ? $rule['code'] : 1, ['via' => $k]);
            }
        }
    }

    /**
     * 默认调用
     * @param  [type] $method [description]
     * @param  array  $args   [description]
     * @return [type]         [description]
     */
    public function __call ($method, $args = []) {
        $this->failure('Resource not found : ' . $method, 999);
    }

    /**
     * 成功输出
     * @param  [type]  $msg  [description]
     * @param  [type]  $data [description]
     * @param  integer $code [description]
     * @return [type]        [description]
     */
    public function success ($msg, $data = [], $code = 0) {
        $this->mod->ajax_out([
            'code'  => $code,
            'msg'   => $msg,
            'data'  => $data,
            'access_token'  => $this->mod->sess_id()
        ]);
    }

    /**
     * 输出错误消息
     * @param  [type]  $msg  [description]
     * @param  integer $code [description]
     * @return [type]        [description]
     */
    public function failure ($msg, $code = 100, $data = []) {
        $this->mod->ajax_out([
            'code'  => $code,
            is_array($msg) ? 'error' : 'msg' => $msg,
            'data'  => $data
        ]);
    }
}
