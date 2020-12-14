<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>个人资料-用户中心</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="static/images/icon/favicon.ico" type="static/image/x-icon">
<link rel="stylesheet" type="text/css" href="static/css/style.css" /><script src="static/js/html5.js"></script>
<script src="static/js/jquery.js"></script>
<script>
$(document).ready(function(){
  $("nav .indexAsideNav").hide();
  $("nav .category").mouseover(function(){
	  $(".asideNav").slideDown();
	  });
  $("nav .asideNav").mouseleave(function(){
	  $(".asideNav").slideUp();
	  });
});
</script>
</head>
<body>
<!--header-->
@include('layout.header')
 <script>
 $(document).ready(function(){
   //测试效果，程序对接如需变动重新编辑
   $(".switchNav li").click(function(){
     $(this).addClass("active").siblings().removeClass("active");
     });
   $("#chanpin").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入产品关键词或货号");
     });
   $("#shangjia").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入商家店铺名");
     });
   $("#zixun").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入关键词查找文章内容");
     });
   $("#wenku").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入关键词查找文库内容");
     });
   });
   
 </script>
 
<section class="wrap user_center_wrap">
 @include('layout.myorder')
 <!--右侧：内容区域-->
 <div class="user_rt_cont">
  <div class="top_title">
   <strong>个人资料基础信息</strong>
  </div>
  <table class="order_table">
   <tr>
    <td width="80" align="right">个人头像：</td>
    <td>
      <label class="uploadImg">
       <input type="file" style="display:none;"/>
       <span>上传图片</span>
      </label>
      <mark class="tips_errors">这里是提示性信息</mark>
    </td>
   </tr>
   <tr>
    <td width="80" align="right">昵称：</td>
    <td><input type="text" class="textbox" value="会飞的猫"/></td>
   </tr>
   <tr>
    <td width="80" align="right">姓名：</td>
    <td><input type="text" class="textbox" value="DeathGhost"/></td>
   </tr>
   <tr>
    <td width="80" align="right">手机号码：</td>
    <td><input type="text" class="textbox" value="18811111111" readonly/></td>
   </tr>
   <tr>
    <td width="80" align="right">电子邮箱：</td>
    <td><input type="text" class="textbox textbox_225" value="admin@admin.com"/></td>
   </tr>
   <tr>
    <td width="80" align="right"></td>
    <td><input type="button" class=" group_btn" value="更新保存"/></td>
   </tr>
  </table>
 </div>
</section>
<!--footer-->
@include('layout.foot')
@include('layout.search_type')

</body>
</html>
