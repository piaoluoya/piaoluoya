<?php
class CommonAction extends Action {
	/**
	 * 用户是否登录信息
	 */
	static  function user_info($is_refer = true) {
		if($is_refer){
			$refer = str_replace ( 'index.php/', '', $_SERVER ['REQUEST_URI'] ); // 当前url
		}
		if (isset ( $_COOKIE ['Sada_username'] ) && isset ( $_COOKIE ['Sada_password'] )) {
			$User = M ( 'User' );
			$data ['username'] = $_COOKIE ['Sada_username'];
			$data ['password'] = $_COOKIE ['Sada_password'];
			$arr_user = $User->where ( $data )->find ();
			if (! empty ( $arr_user )) {
				return '欢迎你，' . $data ['username'] . '&nbsp;&nbsp;|&nbsp;<a href="/user/logout.html">退出</a>';
			} else {
				return '<a href="'.ROOT.'/user/login.html?refer=' . $refer . '">登录</a> &nbsp;&nbsp; <a href="'.ROOT.'/user/register.html?refer=' . $refer . '">注册</a>';
			}
		} else {
			return '<a href="'.ROOT.'/user/login.html?refer=' . $refer . '">登录</a> &nbsp;&nbsp; <a href="'.ROOT.'/user/register.html?refer=' . $refer . '">注册</a>';
		}
	}
}