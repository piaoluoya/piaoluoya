<?php
class AboutAction extends Action {
    public function index() {
        $this->user_info ();
        $this->display ();
    }
    
    private function user_info() {
        if (isset ( $_COOKIE ['Sada_username'] ) && isset ( $_COOKIE ['Sada_password'] )) {
            $User = M ( 'User' );
            $data ['username'] = $_COOKIE ['Sada_username'];
            $data ['password'] = $_COOKIE ['Sada_password'];
            $arr_user = $User->where ( $data )->find ();
            if (! empty ( $arr_user )) {
                $this->assign ( 'arr_user', '欢迎你，' . $data ['username'] . '&nbsp;&nbsp;|&nbsp;<a href="/user/logout.html">退出</a>' );
            } else {
                $this->assign ( 'arr_user', '<a href="/user/login.html">登录</a> &nbsp;&nbsp; <a href="/user/register.html">注册</a>' );
            }
        } else {
            $this->assign ( 'arr_user', '<a href="/user/login.html">登录</a> &nbsp;&nbsp; <a href="/user/register.html">注册</a>' );
        }
    }
}