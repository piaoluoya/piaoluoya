<?php
Load ( 'extend' );
include_once '/Lib/Action/CommonAction.class.php';
class AdminAction extends Action {
    public function index() {
        //用户是否登录状态
        $this->assign ( 'arr_user',CommonAction::user_info());
        //
        $Catalog = M ( 'Catalog' );
        $arr_catalog = $Catalog->where ( "pid='1'" )->order ( 'sequence' )->select ();
        $this->assign ( 'list_catalog', $arr_catalog );
        //文章列表
        $Article = M ( 'Article' );
        $arr_article = $Article->select();
        $this->assign('arr_article', $arr_article);
        
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
            if (isset ( $_GET ['preview'] )) { // 预览
                // 日记分类
                $arr_catalog = $Catalog->where ( "pid='1'" )->order ( 'sequence' )->select ();
                $this->assign ( 'list_catalog', $arr_catalog );
                // 日记内容展示
                $data ['content'] = nl2br( $data ['content']);
                $this->assign ( 'arr_diary', $data );
                // 日记归档
                $arr_archive = $Article->query ( "SELECT COUNT(id) AS num, `year_month` FROM __TABLE__  GROUP BY `year_month` ORDER BY `year_month` DESC" );
                $this->assign ( 'list_archive', $arr_archive );
                $this->display ('Diary:content');
            } else { // 发表
                $id = $Article->add($data);
                if($id){
                    $this->ajaxReturn($id,'发表成功', 1);
                }else{
                    $this->ajaxReturn(0,'Sorry, 发表失败……', 0);
                }
            }
        } else {
        
        }
    }
}