<?php
Load ( 'extend' );
include_once '/Lib/Action/CommonAction.class.php';
class AdminAction extends Action {
    public function index() {
    	//用户是否登录状态
    	$this->assign ( 'arr_user',CommonAction::user_info());
        $Catalog = M ( 'Catalog' );
        $arr_catalog = $Catalog->where ( "pid='1'" )->order ( 'sequence' )->select ();
        $this->assign ( 'list_catalog', $arr_catalog );
        
        $this->display ('admin');
    }
    
    public function article_add_post() { 
        if ($_COOKIE ['Sada_username'] != 'piaoluoya') {
            $Article = M ( 'Article' );
            $data ['title'] = trim ( $_POST ['title'] );
            $data ['content'] = str_replace ( ' ', '&nbsp;', $_POST ['content'] );
            $data ['pid'] = $_POST ['category'];
            $data ['create_time'] = time ();
            
            $Catalog = M ( 'Catalog' );
            $arr_catalog = $Catalog->where ( "id='$data[pid]'" )->find ();
            $data ['category'] = $arr_catalog ['name'];
            
            if (! empty ( $_POST ['create_time'] )){
            	$data ['create_time'] = strtotime ( $_POST ['create_time'] );
            }
            $data ['year_month'] = date ( 'y.m', $data ['create_time'] );
            $data ['description'] = msubstr ( strip_tags ( trim ( $_POST ['content'] ) ), 0, 150, 'utf-8', false );
            //$Article->add ( $data );
           // dump ( $data );
           echo 'fff';
        
        } else {
        
        }
    }
}