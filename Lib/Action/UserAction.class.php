<?php
Load ( 'extend' );
class UserAction extends Action {
    public function login() {
        $this->user_info ();
        $this->display ();
    }
    
    /**
     * 处理登录
     */
    public function login_p() {
        $ajax_mod = $_POST ['mod'];
        $User = M ( 'User' );
        
        $data ['username'] = trim ( $_POST ['username'] );
        $data ['password'] = md5 ( 'Piao_' . $_POST ['password'] );
        $refer = $_GET ['refer'];
        
        if (! empty ( $_POST ['refer'] ))
            $refer = $_POST ['refer'];
        $arr_user = $User->where ( $data )->find ();
        if (! empty ( $ajax_mod )) { // ajax登录
            if (! empty ( $arr_user )) { // 成功
                                   // 设置cookie
                if (! empty ( $_POST ['remember'] )) {
                    $remember = 'expire=1728000&'; // cookie记录20天
                } else {
                    $remember = 'expire=0&'; // cookie随浏览器
                }
                $userid = $arr_user ['id'];
                cookie ( 'userid', $userid, $remember . 'prefix=Sada_' );
                cookie ( 'username', $data ['username'], $remember . 'prefix=Sada_' );
                cookie ( 'password', $data ['password'], $remember . 'prefix=Sada_' );
                $this->ajaxReturn ( '', '登录成功！', 1 );
                // header('Location:'.$refer);
            } else { // 失败
                $this->ajaxReturn ( '', '帐号或密码错误！', 0 );
            }
        } else {
        
        }
    
    }
    
    public function register() {
        $this->assign ( 'refer', $_GET ['refer'] );
        $this->user_info ();
        $this->display ();
    }
    
    /**
     * 处理注册
     */
    public function register_p() {
        $arr_post = $_POST;
        $User = M ( 'User' );
        $data = array ();
        // ajax判断用户是否存在
        if (isset ( $_GET ['username'] )) {
            $data ['username'] = trim ( $_GET ['username'] );
            $arr_id = $User->field ( 'id' )->where ( $data )->find ();
            if (empty ( $arr_id )) {
                echo 'true';
            } else {
                echo 'false';
            }
            unset ( $data );
            exit ();
        } else { // 注册
            if (! $User->autoCheckToken ( $_POST )) { // 手动进行令牌验证
                $this->_empty ();
            } else {
                // 自动创建添加数据
                foreach ( $_POST as $key => $value ) {
                    $data [$key] = trim ( $value );
                }
                $refer = $_GET ['refer'];
                if (isset ( $data ['refer'] )) {
                    $refer = $data ['refer'];
                    unset ( $data ['refer'] ); // 注销$data['refer']
                }
                unset ( $data ['__hash__'] ); // 注销$data['__hash__']
                $data ['password'] = md5 ( 'Piao_' . $data ['password'] );
                $data ['create_time'] = time ();
                $data ['ip'] = get_user_ip ();
                $add_id = $User->add ( $data );
                $refer = $_GET ['refer'];
                if ($add_id) {
                    // 设置cookie
                    $userid = $User->getLastInsID ();
                    cookie ( 'userid', $userid, 'prefix=Sada_' );
                    cookie ( 'username', $data ['username'], 'prefix=Sada_' );
                    cookie ( 'password', $data ['password'], 'prefix=Sada_' );
                    $javasctipt = 'new Dialog("<p>恭喜你，注册成功了啦！</p>", {
    	                                       title:"提示", closeText:\'<img src="/Common/image/dialog_close.gif" />\'}).show();  
				                   window.location.href= ' . $refer . ';';
                } else {
                    $javasctipt = 'new Dialog("<p>Sorry， 出错了，服务器正忙……</p>", {
    				                           title:"提示", closeText:\'<img src="/Common/image/dialog_close.gif" />\'}).show();';
                }
                $this->assign ( 'javascript', $javasctipt );
                $this->display ( 'register' );
            }
        
        }
    
    }
    
    /**
     * 处理退出
     */
    public function logout() {
        cookie ( null, 'Sada_' ); // 删除前缀为Sada_的cookie
        header ( 'Location:/' ); // undo
    }
    
    /**
     * 空操作
     */
    public function _empty() {
        header ( "Location: /404.html" );
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