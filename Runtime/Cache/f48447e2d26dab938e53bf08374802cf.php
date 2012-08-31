<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言簿 ｜ 飘落涯个人博客</title>
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
      <?php echo ($login_tip); ?>
      <div id="message">
           <?php echo ($list_comment); ?>
      </div><!--end  #message-->
      
   </div><!--end #content-->
   
   <div id="columns">
      <div class="ami">
        <p>你何时来?</p>
        <p>你何时走?</p>
        <p>你走了之后是否会再来?</p>
        <p>你再来时是否会回到这里?</p>
        <p>你回到这里时是否会回到今天?</p>
        <p>那时的你是快乐还是忧伤?</p>
        <p class="from"> ——&nbsp;&nbsp;玛吉阿米的留言簿</p>
      </div> 
   </div><!---end #columns-->
   
</div>
<div id="footer">版权所有&copy;2012 &nbsp;&nbsp;飘落涯</div>
<script type="text/javascript">
  $().ready(function(){
	  $('.m-child-item dt:only-child').parent().hide();  //隐藏没有回复的边框
	  $('form').live('submit', function(){
		 var comment = $.trim($(this).children('textarea[name="comment"]').val()),
		 pid = $(this).children('input[name="pid"]').val();
		 if(comment == ''){
			new Dialog('<p class="color-r">内容不能为空</p>', {title:'错误提示', closeText:'<img src="/Common/image/dialog_close.gif" />'}).show();
			return false;
		 }
		 $(this).children('div').children('div').children('span').children('input').attr('disabled','disabled'); //禁用按钮
		 url = $(this).attr('action');
		 $.post(url, {mod:true, comment:comment, pid:pid}, function(data){
			 jsonText = eval('('+data+')'); 
			 if(jsonText.status =='0'){
				 new Dialog('<p class="color-r">'+jsonText.info+'</p>', {title:'错误提示', closeText:'<img src="/Common/image/dialog_close.gif" />'}).show();
			 }else if(jsonText.status =='1'){
				 new Dialog('<p>'+jsonText.info+'</p>', {title:'提示', closeText:'<img src="/Common/image/dialog_close.gif" />'}).show();
				 $('textarea[name="comment"]').val(''); //提交成功后清空
			 } 
		 });
		 $(this).children('div').children('div').children('span').children('input').removeAttr('disabled'); //启用按钮  注：this不能在post、get的ajax里用
		 return false;
	  });
	  
	  $('.m-reply').click(function(){
		 $('.m_form').remove();
		 var pid = $(this).children('a').attr('data'),
		 html = '<form action="/me/message/m_post.html" method="post" class="m_form" style="display:none; height:44px;"><input type="hidden" name="pid" value="'+pid+'" />' 
	         +'<textarea name="comment" class="m_text" style="height:20px; width:80%;"></textarea>'
	         +'<div class="ui-button skin-button-willsilver" style="width: 60px; margin-top:2px; ">'
	         +'<span class="ui-button-bg-left skin-button-willsilver-bg-left"></span>'
	         +'<div class="ui-button-label skin-button-willsilver-label">'
	         +'<span class="ui-button-text skin-button-willsilver-text"><input type="submit" value="回复" class="btn"></span>'
	         +'</div>'
	         +'</div>'
	         +'</form>';
	     $(this).parent().append(html);
	     $('.m_form').slideDown('slow');
	     return false;
	  });
  });
</script>
</body>
</html>