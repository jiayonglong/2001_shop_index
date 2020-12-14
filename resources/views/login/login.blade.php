<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>登录</title>
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
 @include('layout.header');
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
 
<section class="wrap user_form">
 <div class="lt_img">
  <img src="static/images/form_bg.jpg"/>
 </div>
 <div class="rt_form">
  <h2>会员登录</h2>
  <ul>
   <li class="user_icon">
    <input type="text" name="user_plone" class="textbox" placeholder="账号"/><span></span>
   </li>
   <li class="user_pwd">
    <input type="password" name="user_pwd" class="textbox" placeholder="密码"/><span></span>
   </li>
   <li class="link_li">
    <a href="{{url('/reg')}}" title="注册新用户" class="fl">注册新用户</a>
    <a href="{{url('/find_pwd')}}" title="忘记密码" class="fr">忘记密码？</a>
   </li>
   <li class="link_li">
    <input type="button" id="login" value="立即登录" class="sbmt_btn"/>
   </li>
  </ul>
 </div>
</section>
<!--footer-->
@include('layout.foot');
</body>
</html>
<script src="/static/js/jquery.js"></script>
<script>
     $("#login").click(function () {
        // alert(111);
        var falg = false;
        var user_plone = $('input[name="user_plone"]').val();
            if (user_plone == '') {
                $("input[name='user_plone']+span").html("<font color='red'>用户名不能为空</font>");
                falg = false;
            } else {
                $("input[name='user_plone']+span").html("<font color='green'>√</font>");
                falg = true;
            }
        var pfalg = false;
        var user_pwd = $('input[name="user_pwd"]').val();
         if (user_pwd == '') {
                $("input[name='user_pwd']+span").html("<font color='red'>密码不能为空</font>");
                pfalg = false;
            } else {
                $("input[name='user_pwd']+span").html("<font color='green'>√</font>");
                pfalg = true;
            }
          if (falg === false || pfalg === false) {
                return false;
          }
        $.post('/logdo',{user_plone:user_plone,user_pwd:user_pwd},function (res) {
            console.log(res);
            // alert(res);
            if(res.code==00002){
              alert(res.msg);
            }

            if(res.code==00003){
              alert(res.msg);
            }
            if(res.code==00000){
              if(window.location.href.indexOf('refer') > -1){
                   window.history.go(-1); //返回上一页
                 }else{
                  location.href = "/";
                 }
            }else{
              alert(res.msg);
            }

        },'json');
    });






</script>
