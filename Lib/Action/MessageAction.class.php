<?php
Load ( 'extend' );
class MessageAction extends Action {
    public function index() {
        global $m_html;
        $this->user_info ();
        
        if (empty ( $_COOKIE ['Sada_username'] ) || empty ( $_COOKIE ['Sada_userid'] )) {
            $login_tip = '<p class="login_tip" style="margin-top:20px; border-bottom:solid 1px #ddd;">留言须&nbsp;<a href="/user/login.html" class="color-o bold">登录</a>，&nbsp;如果你没有帐号，请&nbsp;<a href="/user/register.html" class="color-o bold">注册</a>&nbsp;一下<a href="/user/register.html" ><span class="register_good">注册的好处</span></a></p>';
        } else {
            $login_tip = '<h1 class="message-h1">我听不见你的跫音，为什么不留下你的脚印！</h1>
      <form action="/message/m_post.html" method="post" id="m_form">
         <textarea name="comment" class="m_text"></textarea>
         <div class="ui-button skin-button-willsilver"style="width: 60px; margin-top:32px; ">
             <span class="ui-button-bg-left skin-button-willsilver-bg-left"></span>
             <div class="ui-button-label skin-button-willsilver-label">
                  <span class="ui-button-text skin-button-willsilver-text"><input type="submit" value="提交"  class="btn"/></span>
             </div>
         </div>
      </form>';
        }
        $this->assign ( 'login_tip', $login_tip );
        
        $Model = new Model ();
        $arr_comment = $Model->query ( "SELECT c.id AS cid, pid, `comment`, c.create_time AS createtime, username,realname, avatar FROM my_comment AS c, my_user AS u 
       		WHERE(article_id='10000' and pid=0 AND c.userid = u.id) order by createtime desc" );
        
        $m_html = '';
        foreach ( $arr_comment as $key => $value ) { // 回复记录
            $m_html .= '<div class="m-item clearfix">
              <div class="pb-avatar"><a class="blog-avatar" href="#" style="background-image:url(' . $arr_comment [$key] ['avatar'] . '); background-size:65px 65px;">' . $arr_comment [$key] ['username'] . '</a></div>
              <div class="m-item-container">
                 <span class="m-user">';
            if ($_COOKIE ['Sada_username'] == 'piaoluoya')
                $m_html .= $arr_comment [$key] ['realname'] . '--'; // 是博客主显示用户真名
            $m_html .= $arr_comment [$key] ['username'] . '： </span>
                 <p style="display:inline;">' . $arr_comment [$key] ['comment'] . '</p><span class="m-reply color-b pointer">';
            if (! empty ( $_COOKIE ['Sada_username'] ))
                $m_html .= '<a href="#" type="reply" data="' . $arr_comment [$key] ['cid'] . '">回复</a>'; // 登录用户显示回复
            if ($_COOKIE ['Sada_username'] == 'piaoluoya')
                $m_html .= '&nbsp;&nbsp;删除'; // 博主显示删除
            $m_html .= '</span><span class="m-time color-6">' . date ( 'Y-m-d H:i', $arr_comment [$key] ['createtime'] ) . '</span>';
            $id = $arr_comment [$key] ['cid'];
            
            $_SESSION ['father_name'] = $arr_comment [$key] ['username']; // 记录当前用户名，以便下一层使用
            
            $m_html .= '<div class="m-child-item">
                    <dl class="comment W_textc W_linecolor W_bgcolor">
                      <dt class="arrow W_bgcolor_arrow"><em class="W_arrline">◆</em><span>◆</span></dt>';
            $this->list_layer ( $Model, '10000', $id );
            
            $m_html .= ' </dl>
                 </div> <!--end .m-child-item-->';
            $m_html .= '</div> <!--end .m-item-container-->     
        </div><!--end .m-item -->';
        }
        $this->assign ( 'list_comment', $m_html );
        $this->display ();
    }
    
    /**
     * 处理评论留言表单
     */
    public function m_post() {
        $mod = $_POST ['mod'];
        if (! empty ( $mod )) { // Ajax提交
            if (! empty ( $_POST ['pid'] )) { // 回复
                $data ['pid'] = ( int ) $_POST ['pid'];
                $info = '回复成功';
            } else {
                $data ['pid'] = '0';
            }
            
            if (empty ( $_POST ['article_id'] )) { // 留言
                $data ['article_id'] = '10000';
            } else { // 评论
                $data ['article_id'] = ( int ) $_POST ['article_id'];
            }
            
            $data ['comment'] = strip_tags ( trim ( $_POST ['comment'] ) );
            $data ['userid'] = $_COOKIE ['Sada_userid'];
            $data ['username'] = $_COOKIE ['Sada_username'];
            $data ['create_time'] = time ();
            $data ['ip'] = get_user_ip ();
            
            if (! empty ( $data ['username'] )) {
                $Comment = M ( 'Comment' );
                $Comment->add ( $data );
                if ($data ['article_id'] == '10000' && empty ( $_POST ['pid'] )) {
                    $info = '留言成功！';
                } else if (empty ( $_POST ['pid'] )) {
                    $info = '评论成功';
                }
                $this->ajaxReturn ( '', $info, 1 ); // 回复、评论、留言成功
            } else {
                $this->ajaxReturn ( '', '出错了', 0 ); // 回复、评论、留言失败
            }
        } else {
        
        }
    
    }
    
    /**
     * 子元素
     */
    private function list_layer($Model, $article_id, $id) {
        global $m_html;
        $arr_comment_child = $Model->query ( "SELECT c.id AS cid, pid, `comment`, c.create_time AS createtime, username,realname, avatar FROM my_comment AS c, my_user AS u
    			WHERE(article_id='$article_id' and pid='$id' AND c.userid = u.id) order by createtime desc" );
        foreach ( $arr_comment_child as $key => $value ) {
            $m_html .= '<dd class="clearfix"><img src="' . $arr_comment_child [$key] ['avatar'] . '"  style="height:30px;float:left;" />
                          <div class="m-child-item-container" style="float:right; width:420px;">
                              <span class="m-user">';
            if ($_COOKIE ['Sada_username'] == 'piaoluoya')
                $m_html .= $arr_comment_child [$key] ['realname'] . '--'; // 是博客主显示用户真名
            $m_html .= $arr_comment_child [$key] ['username'] . '&nbsp;@' . $_SESSION ['father_name'] . ' </span>  
                              <p style="display:inline;">' . $arr_comment_child [$key] ['comment'] . '</p><span class="m-reply color-b pointer">';
            if (! empty ( $_COOKIE ['Sada_username'] ))
                $m_html .= '<a href="#" type="reply" data="' . $arr_comment_child [$key] ['cid'] . '">回复</a>'; // 登录用户显示回复
            if ($_COOKIE ['Sada_username'] == 'piaoluoya')
                $m_html .= '&nbsp;&nbsp;删除';
            $m_html .= '</span><span class="m-time color-6">' . date ( 'Y-m-d H:i', $arr_comment_child [$key] ['createtime'] ) . '</span>
                          </div>
                      </dd>';
            $id = $arr_comment_child [$key] ['cid'];
            $_SESSION ['father_name'] = $arr_comment_child [$key] ['username'];
            $this->list_layer ( $Model, '10000', $id, $m_html ); //
        }
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