<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理中心</title>
<meta name="keywords" content="追寻真实，做自己喜欢做的事" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo (ROOT); ?>/Common/style/admin_reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo (ROOT); ?>/Common/style/admin.css" />
<script src="<?php echo (ROOT); ?>/Common/js/jquery-1.7.js" type="text/javascript"></script>
<script src="<?php echo (ROOT); ?>/Common/js/common.js" type="text/javascript"></script>
<script src="<?php echo (ROOT); ?>/Common/js/jquery.validate.js" type="text/javascript"></script>
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
	<div id="header">
		<h1>飘落涯个人博客管理中心</h1>
		<div id="user"><?php echo ($arr_user); ?></div>
	</div>

<div id="main" class="clearfix">
	<div id="column">
		<ul>
			<li class="panel">控制面板</li>
			<li class="aticle">添加文章</li>
			<li class="photo">上传照片</li>
			<li class="comment">评论</li>
			<li class="user">用户</li>
			<li class="config">配置</li>
		</ul>
	</div>
	<div id="content">
		<form action="/admin/remember_post.html" method="post" id="r_form">
			<div class="item">
				<label>标题</label><input type="text" name="title"
					class="basic-input r_title" />
			</div>
			<div class="item">
				<textarea name="content" class="m_text r_content"></textarea>
			</div>
			<div class="item">
				<label>类别</label><select name="category" class="r_category">
					<?php if(is_array($list_catalog)): $i = 0; $__LIST__ = $list_catalog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
			<div class="item">
				<label>日期</label><input type="text" name="create_time"
					class="basic-input r_create_time" />
			</div>
			<div class="item">
				<input type="submit" value="预览" class="btn-submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" value="发表" class="btn-submit" />
			</div>
		</form>
	</div>
</div>
<div id="footer">版权所有&copy;2012 &nbsp;&nbsp;飘落涯</div>
</body>
</html>