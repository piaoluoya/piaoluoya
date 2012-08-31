<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册 ｜ 飘落涯个人博客</title>
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
      <h1 class="register-h1">注册</h1>
      <form id="register_form" name="register_form" method="post" action="/me/user/register_p.html" >
        <div class="item">
            <label><span class="star">*&nbsp;</span>帐号</label>
            <input id="username" name="username" type="text" class="basic-input" maxlength="60"  tabindex="1">
        </div>
        <div class="item">
            <label><span class="star">*&nbsp;</span>密码</label>
            <input id="password" name="password" type="password" class="basic-input" maxlength="18" tabindex="2">
        </div>
        <div class="item">
            <label><span class="star">*&nbsp;</span>重复密码</label>
            <input id="repassword" name="repassword" type="password" class="basic-input" maxlength="18" tabindex="2">
        </div>
        <div class="item">
            <label>头像</label>
            <input id="avatar" name="avatar" type="text" class="basic-input" maxlength="200" tabindex="2">
            <span class="form_tip">(复制豆瓣、微博、QQ空间的头像图片路径粘贴此处)</span>
        </div>
        <div class="item">
            <label>邮箱</label>
            <input id="email" name="email" type="text" class="basic-input" maxlength="20" tabindex="2">
            <span class="form_tip">(只博主可见)</span>
        </div>
        <div class="item">
            <label>QQ</label>
            <input id="qq" name="qq" type="text" class="basic-input" maxlength="10" tabindex="2">
            <span class="form_tip">(只博主可见)</span>
        </div>
        <div class="item">
            <label>手机号</label>
            <input id="cellphone" name="cellphone" type="text" class="basic-input" maxlength="11" tabindex="2">
            <span class="form_tip">(只博主可见)</span>
        </div>
        <div class="item">
            <label>真名</label>
            <input id="realname" name="realname" type="text" class="basic-input" maxlength="20" tabindex="2">
            <span class="form_tip">(只有通过博主认证的用户才能看到)</span>
        </div>
        <div class="item">
            <label>个人博客/微博</label>
            <input id="blog" name="blog" type="text" class="basic-input" maxlength="50" tabindex="2">
            <span class="form_tip">(只有通过博主认证的用户才能看到)</span>
        </div>
        
       
        <div class="item">
            <label>&nbsp;</label>
            <input type="submit" value="注册"  class="btn-submit" tabindex="4">
        </div>
      </form>
     <div class="register-tip">已有账号，请&nbsp;<a href="/me/user/login.html" style="color:#E17F2D">登录</a></div>
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
	   var url = $('#register_form').attr('action');
	   //手机号验证 
	   jQuery.validator.addMethod("cellphone", function(value, element) { 
	        return this.optional(element) || /^1[0-9]{10}$/.test(value); 
	        }, "请输入正确的手机号"); 

	   $('#register_form').validate({
		  rules:{
			  username:{required:true, remote:url},
			  password:{required:true, minlength:6, maxlength:18},
			  repassword:{equalTo:"#password"},
			  email:{email:true},
			  avatar:{url:true},
			  qq:{minlength:5, maxlength:10},
			  cellphone:{cellphone:true}
		  },
		  messages:{
			  username:{required:'请输入帐号！', remote:'帐号已存在！'},
			  password:{required:'请输入密码！', minlength:jQuery.format("密码不能少于6个字符"),maxlength:jQuery.format("密码不能多于18个字符") },
			  repassword:'两次输入的密码不一样！',
			  email:'邮箱格式不正确！',
			  avatar:'请粘贴正确的头像网址',
			  qq:{minlength:jQuery.format("QQ号不能少于5个位"),maxlength:jQuery.format("QQ号不能多于10个位") },
		  },
		  errorPlacement: function(error, element){
              error.appendTo(element.parent());
          },    
		 });
   });
</script>
</body>
</html>