<?php
include_once '/Lib/Action/CommonAction.class.php';
class HomeAction extends Action {
    public function index() {
    	//用户是否登录状态
    	$this->assign ( 'arr_user',CommonAction::user_info());
        // 日记分类
        $Catalog = M ( 'Catalog' );
        $arr_catalog = $Catalog->where ( "pid='1'" )->order ( 'sequence' )->select ();
        $this->assign ( 'list_catalog', $arr_catalog );
        
        // 文章展示
        $Article = M ( 'Article' );
        $id = ( int ) $_GET ['id'];
        if (! empty ( $id ))
            $data ['pid'] = $id;
        $arr_article = $Article->where ( $data )->order ( 'create_time desc' )->limit ( '3' )->select ();
        $this->assign ( 'list_article', $arr_article );
        
        $this->display ('home');
    }
    
    
}