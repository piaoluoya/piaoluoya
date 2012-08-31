<?php
class DiaryAction extends Action {
    /**
     * 日记列表
     */
    public function index() {
        $refer = str_replace ( '/index.php', '', $_SERVER ['PHP_SELF'] );
        
        $data = array ();
        $this->user_info ();
        
        // 日记分类
        $Catalog = M ( 'Catalog' );
        $arr_catalog = $Catalog->where ( "pid='1'" )->order ( 'sequence' )->select ();
        $this->assign ( 'list_catalog', $arr_catalog );
        
        // 日记展示
        $Article = M ( 'Article' );
        $id = ( int ) $_GET ['id'];
        $archive = $_GET ['archive'];
        if (! empty ( $id ))
            $data ['pid'] = $id;
        if (! empty ( $archive ))
            $data ['year_month'] = $archive;
        $arr_article = $Article->where ( $data )->order ( 'create_time desc' )->limit ( '3' )->select ();
        $this->assign ( 'list_article', $arr_article );
        
        // 日记归档
        $arr_archive = $Article->query ( "SELECT COUNT(id) AS num, `year_month` FROM __TABLE__  GROUP BY `year_month` ORDER BY `year_month` DESC" );
        $this->assign ( 'list_archive', $arr_archive );
        
        $this->display ();
    }
    
    /**
     * 日记内容
     */
    public function content() {
        
        $id = ( int ) $_GET ['id'];
        $this->user_info ();
        if (! empty ( $id )) {
            // 日记分类
            $Catalog = M ( 'Catalog' );
            $arr_catalog = $Catalog->where ( "pid='1'" )->order ( 'sequence' )->select ();
            $this->assign ( 'list_catalog', $arr_catalog );
            
            // 日记内容展示
            $Article = M ( 'Article' );
            $arr_diary = $Article->where ( "id='$id'" )->find ();
            $arr_diary ['content'] = nl2br ( $arr_diary ['content'] );
            $this->assign ( 'arr_diary', $arr_diary );
            
            // 日记归档
            $arr_archive = $Article->query ( "SELECT COUNT(id) AS num, `year_month` FROM __TABLE__  GROUP BY `year_month` ORDER BY `year_month` DESC" );
            $this->assign ( 'list_archive', $arr_archive );
            $this->display ();
        } else {
        
        }
    
    }
    
    /**
     * 用户是否登录信息
     */
    private function user_info() {
        $refer = str_replace ( 'index.php/', '', $_SERVER ['REQUEST_URI'] ); // 当前url
        
        if (isset ( $_COOKIE ['Sada_username'] ) && isset ( $_COOKIE ['Sada_password'] )) {
            $User = M ( 'User' );
            $data ['username'] = $_COOKIE ['Sada_username'];
            $data ['password'] = $_COOKIE ['Sada_password'];
            $arr_user = $User->where ( $data )->find ();
            if (! empty ( $arr_user )) {
                $this->assign ( 'arr_user', '欢迎你，' . $data ['username'] . '&nbsp;&nbsp;|&nbsp;<a href="/user/logout.html">退出</a>' );
            } else {
                $this->assign ( 'arr_user', '<a href="/user/login.html?refer=' . $refer . '">登录</a> &nbsp;&nbsp; <a href="/user/register.html?refer=' . $refer . '">注册</a>' );
            }
        } else {
            $this->assign ( 'arr_user', '<a href="/user/login.html?refer=' . $refer . '">登录</a> &nbsp;&nbsp; <a href="/user/register.html?refer=' . $refer . '">注册</a>' );
        }
    }

}