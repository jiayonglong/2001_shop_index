<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>修改密码-用户中心</title>
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
   <strong>修改密码</strong>
  </div>
  <table class="order_table">
   <tr>
    <span class="tips_errors error4"></span>
    <td width="80" align="right">原始密码：</td>
    <td><input type="password" class="textbox oldpwd" />
    <span class="tips_errors error1"></span>
  </td>
   </tr>
   <tr>
    <td width="80" align="right">设置新密码：</td>
    <td><input type="password" class="textbox newpwd1"/>
    <span class="tips_errors error2"></span>
  </td>
   </tr>
   <tr>
    <td width="80" align="right">确认新密码：</td>
    <td><input type="password" class="textbox newpwd2"/>
    <span class="tips_errors error3"></span>
  </td>
   </tr>
   <tr>
    <td width="80" align="right"></td>
    <td><input type="button" class="group_btn" value="修改密码"/></td>
   </tr>
  </table>
 </div>
</section>
<!--footer-->
@include('layout.foot')
   <script>
      $(document).on('click','.group_btn',function(){
          var _this = $(this);
          var oldpwd = $(".oldpwd").val();
          var newpwd1 = $(".newpwd1").val();
          var newpwd2 = $(".newpwd2").val();
          
          if(!oldpwd){
              $('.error1').text("初始密码不能为空哦~");
              return;
          }else{
              $('.error1').text("");
          }
          if(!newpwd1){
              $('.error2').text("新密码不能为空哦~");
              return;
          }else{
              $('.error2').text("");
          }
          if(!newpwd2){
              $('.error3').text("确认密码不能为空哦~");
              return;
          }else{
              $('.error3').text("");
          }

          if(newpwd1 != newpwd2){
            $('.error3').text("新密码与确认密码要保持一致哦~");
            return;
          }else if(newpwd1.length <= 6){
            $('.error2').text("密码长度太短哦~");
            return;
          }else{
              $.post('/changepwd',{oldpwd:oldpwd,newpwd2:newpwd2},function(rets){
                  if(rets.code == 0){
                    location.href="/login?refer="+location.href;
                  }else{
                    $('.error4').text(rets.msg);
                  }
              },'json');
              // 
          }
          
         
          
      });

   </script>
@include('layout.search_type')

</body>
</html>
