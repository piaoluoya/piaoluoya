<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>日记 ｜ 飘落涯个人博客</title>
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
      <?php if(is_array($list_article)): $i = 0; $__LIST__ = $list_article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="article">
         <h2 class="entry_title"><a href="/me/diary/content.html?id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></h2>
         <p class="entry_content"><?php echo ($vo["description"]); ?><a href="__SELF__content.html?id=<?php echo ($vo["id"]); ?>" class="color-b" style="font-size:12px;">&nbsp;[浏览全文]</a></p>
         <p class="entry_meta color-b"><?php echo ($vo["category"]); ?>&nbsp;<span class="color-6">|</span>&nbsp;<?php echo ($vo["comment_num"]); ?> 条回复&nbsp;&nbsp;<?php echo (date("m月d日 H:i",$vo["create_time"])); ?></p>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
   </div>
   
   <div id="columns">
     <div class="column">
        <h2 class="column_title">日记本</h2>
        <ul class="diary">
          <?php if(is_array($list_catalog)): $i = 0; $__LIST__ = $list_catalog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/me/diary/?id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
       <!--   <li><a href="">那些事</a></li><li><a href="">那些人</a></li>--></ul>
     </div>
     <div class="column margin-t30">
         <h2 class="column_title">日记归档</h2>
         <ul class="archive"><?php if(is_array($list_archive)): $i = 0; $__LIST__ = $list_archive;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/me/diary/?archive=<?php echo ($vo["year_month"]); ?>">20<?php echo (str_replace('.','年',$vo["year_month"])); ?>月&nbsp;<span class="color-o">[<?php echo ($vo["num"]); ?>]</span></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul>
     </div>
   </div>
</div>
<div id="footer">版权所有&copy;2012 &nbsp;&nbsp;飘落涯</div>
</body>
</html>