<?php
class User{
    
    /**
     * 用户是否登录信息
     */
    static  function user_info($t) {
        $refer = str_replace ( 'index.php/', '', $_SERVER ['REQUEST_URI'] ); // 当前url
        if (isset ( $_COOKIE ['Sada_username'] ) && isset ( $_COOKIE ['Sada_password'] )) {
            $data ['username'] = $_COOKIE ['Sada_username'];
            $data ['password'] = $_COOKIE ['Sada_password'];
            //$arr_user = $User->where ( $data )->find ();
            $arr_user = 'ffff';
            if (! empty ( $arr_user )) {
                $t->assign ( 'arr_user', '欢迎你，' . $data ['username'] . '&nbsp;&nbsp;|&nbsp;<a href="/user/logout.html">退出</a>' );
            } else {
                $t->assign ( 'arr_user', '<a href="'.ROOT.'/user/login.html?refer=' . $refer . '">登录</a> &nbsp;&nbsp; <a href="'.ROOT.'/user/register.html?refer=' . $refer . '">注册</a>' );
            }
        } else {
            $t->assign ( 'arr_user', '<a href="'.ROOT.'/user/login.html?refer=' . $refer . '">登录</a> &nbsp;&nbsp; <a href="'.ROOT.'/user/register.html?refer=' . $refer . '">注册</a>' );
        }
    }
}