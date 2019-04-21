<?php
namespace re\rgx;

/**
 * admin 助手类
 */
class admin_helper extends rgx {

    /**
     * 验证用户密码
     * @param  [type] $src_pwd [description]
     * @param  [type] $passwd  [description]
     * @param  string $salt    [description]
     * @return [type]          [description]
     */
    public static function verify_passwd ($src_pwd, $passwd, $salt = '') {
        return md5(md5($src_pwd) . $salt) === $passwd;
    }

    /**
     * 生成密码
     * @param  [type] $pwd  [description]
     * @param  string $salt [description]
     * @return [type]       [description]
     */
    public static function generate_passwd ($pwd, $salt = '') {
        return md5(md5($pwd) . $salt);
    }

    /**
     * 获取登录信息
     * @param  [type] $admin [description]
     * @return [type]        [description]
     */
    public static function get_login ($admin) {
        return $admin;
    }
}
