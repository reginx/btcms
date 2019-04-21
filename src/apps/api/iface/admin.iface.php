<?php
namespace re\rgx;

/**
 * 管理接口
 */
class admin_iface extends base_iface {

    /**
     * session 前缀
     * @var string
     */
    public $pre = 'admin_';

    /**
     * 架构函数
     * @param array $params [description]
     */
    public function __construct ($params = []) {
        parent::__construct($params);
        $this->login = $this->sess_get('login');
        if ($this->action != 'login_action') {
            $this->check_login();
        }
    }

    /**
     * 检测登录状态
     * @return [type] [description]
     */
    public function check_login () {
        if (empty($this->login)) {
            $this->failure('请先登录', 100);
        }
    }

    /**
     * 设置会话内容
     * @param  [type] $key [description]
     * @param  [type] $val [description]
     * @return [type]      [description]
     */
    public function sess_set ($key, $val) {
        return $this->mod->sess_set($this->pre . $key, $val);
    }

    /**
     * 获取会话内容
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function sess_get ($key) {
        return $this->mod->sess_get($this->pre . $key);
    }

    /**
     * 删除会话内容
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function sess_del ($key) {
        return $this->mod->sess_del($this->pre . $key);
    }

    /**
     * 当前登录状态
     * @return [type] [description]
     */
    public function info_action () {
        if (empty($this->login)) {
            $this->failure('请先登录');
        }
        $this->success('', [
            'admin_id'      => $this->login['admin_id'],
            'admin_account' => $this->login['admin_account'],
            'perms'         => 'full'
        ]);
    }

    /**
     * 管理登录
     * @return [type] [description]
     */
    public function login_action () {
        $this->verify([
            'account' => [
                'code' => 100,
                'msg'  => '请输入有效的账号',
                'rule' => filter::$rules['uid'],
            ],
            'passwd'  => [
                'code' => 101,
                'msg'  => '请输入您的密码',
                'rule' => function ($v) {
                    return !empty($v);
                },
            ],
        ]);
        
        $tab = OBJ('admin_table');
        $admin = $tab->get([
            'admin_account' => $this->data['account'],
        ]);
        
        if (empty($admin)) {
            $this->failure('该账号不存在', 102, ['via' => 'account']);
        }
        
        if (admin_helper::verify_passwd($this->data['passwd'], $admin['admin_passwd'], $admin['admin_salt'])) {
            $this->sess_set('login', $admin);
            $tab->update([
                'admin_id'          => $admin['admin_id'],
                'admin_lastlogin'   => REQUEST_TIME,
                'admin_lastip'      => ip2long(app::get_ip())
            ]);
            $this->success('登录成功');
        }
        $this->failure('账号或密码有误', 103);
    }
}
