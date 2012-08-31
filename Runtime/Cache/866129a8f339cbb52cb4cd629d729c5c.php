<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录 ｜ 飘落涯个人博客</title>
<meta name="keywords" content="追寻真实，做自己喜欢做的事" />
<link rel="stylesheet" type="text/css" media="all" href="/Common/style/reset.css" />
<script src="/Common/js/jquery-1.7.js" type="text/javascript"></script>
<script src="/Common/js/common.js" type="text/javascript"></script>
<script src="/Common/js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
   $().ready(function(){
	   var main_height = $('#main').css('height');
	   main_height = main_height.replace('px', '');
	   if(main_height < 380){
	      $('#main').css({'height':'380px'});
	   }
	});
   
</script>
</head>
<body>
<div id="header"> <img class="logo" src="/Common/image/logo.jpg" alt="飘落涯个人博客"/><span class="signature">每个人心中都有一所房子，面朝大海……</span>
  <div id="user"><?php echo ($arr_user); ?></div>
  <div id="navigator">
    <ul>
      <li class="first"><a href="/me/">主页</a></li>
      <li><a href="/me/diary/">日记</a></li>
      <li><a href="/me/gallery/">相册</a></li>
      <li><a href="/me/message/">留言簿</a></li>
      <li><a href="/me/about/">关于我</a></li>
    </ul>
  </div>
</div>

<div id="main" class="clearfix">
   <div id="content">  
      <h1 class="login-h1">登录</h1>
      <form id="login_form" name="login_form" method="post" action="/me/user/login_p.html" >
        <div class="item">
            <label>帐号</label>
            <input id="username" name="username" type="text" class="basic-input" maxlength="60"  tabindex="1">
        </div>
        <div class="item">
            <label>密码</label>
            <input id="password" name="password" type="password" class="basic-input" maxlength="20" tabindex="2">
        </div>
        <div class="item">
            <label>&nbsp;</label>
            <p class="remember">
                <input type="checkbox" id="remember" name="remember" tabindex="3" value="1">
                <label for="remember" class="remember">下次自动登录</label>&nbsp;|&nbsp;<a href="http://www.douban.com/accounts/resetpassword">忘记密码了</a>
            </p>
        </div>
        <div class="item">
            <label>&nbsp;</label>
            <input type="submit" value="登录" name="user_login" class="btn-submit" tabindex="4">
        </div>
      </form>
     <div class="login-tip">木有账号，还等什么，<a href="/me/user/register.html" style="color:#E17F2D">马上去注册</a></div>
   </div>
   <div id="columns">
      <p>注册登录的好处：</p>
      <p>1、更快捷、更方便的留言评论；</p>
      <p>2、自定义个性头像；</p>
      <p>3、获得被回复的优先权(不保证回复每一条评论或留言)；</p>
      <p>4、查看博客主的联系方式；</p>
      <p>5、后续将优先获得更好的体验等等。</p>
   </div>
</div>
<div id="footer">版权所有&copy;2012 &nbsp;&nbsp;飘落涯</div>
<script type="text/javascript">
 $().ready(function(){
	$('#login_form').submit(function(){
		var username = $.trim($('input[name="username"]').val()),
		password = $('input[name="password"]').val(),
		remember = $('input[name="remember"]:checked').val(),
		url = $(this).attr('action');
		$.post(url,{mod:true, username:username, password:password, remember:remember}, function(data){
			jsonText = eval('('+ data +')');
			if(jsonText.status == '0'){
				$('<div id="login_error">' + jsonText.info + '</div>').insertBefore('.item:eq(0)');
			}else if(jsonText.status == '1'){
				window.history.back(-1);
			}
			
		});
		return false;
	});
 });
</script>
</body>
</html>