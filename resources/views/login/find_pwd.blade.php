<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>找回密码</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="static/images/icon/favicon.ico" type="image/x-icon">
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
  <h2>找回密码</h2>
  <ul>
   <li class="user_icon">
    <input type="text" class="textbox text1" placeholder="手机号码"/>
    <span class="span1" style="color: red;"></span>
   </li>
   <li class="link_li btn">
    <input type="button" id="span_tel" value="获取手机校验码" class="get_num_btn"/>
   </li>
   <li class="user_cc">
    <input type="text" class="textbox text2" placeholder="手机校验码"/>
    <span class="span2" style="color: red;"></span>
   </li>
   <li class="user_pwd">
    <input type="password" class="textbox text3" placeholder="设置新密码"/>
    <span class="span3" style="color: red;"></span>
   </li>
   <li class="user_pwd">
    <input type="password" class="textbox text4" placeholder="确认新密码"/>
    <span class="span4" style="color: red;"></span>
   </li>
   <li class="link_li">
    <input type="button" value="找回密码" class="sbmt_btn"/>
   </li>
  </ul>
 </div>
</section>
<!--footer-->
@include('layout.foot');

<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).on('click','.get_num_btn',function(){
        var _this = $(this);
        var plone = $('.text1').val();
        _this.val('60s');
		times = setInterval(goTime, 1000);
        if(!plone){
            $('.span1').html("手机号码不能为空");
            return false;
        }

        var myreg = /^[1][3,5,7,8,9][0-9]{9}$/;
        if (!myreg.test(plone)) {
            $('.span1').html("请输入正确的手机号");
            return;
        }else{
            $('.span1').html("");
        }
        $.post('/find_pwddo',{plone:plone},function(res){
                if(res.code == 0){
                    alert(res.msg);
                }else{
                   alert(res.msg);
                }
            },'json');
    });


    function goTime(){ 
        var c = $("#span_tel").text(); 
        // console.log(s); 
        c = parseInt(c); 
        //倒计时停止 
        if(c <= 0){ 
        clearInterval(times); 
        $("#span_tel").text('获取'); 
        $(".btn").css('pointer-events','auto'); 
        }else{ 
        c = c-1; 
        $("#span_tel").text(c+'s'); 
        $('.btn').css('pointer-events','none'); 
        } 
 } 
    $('.sbmt_btn').click(function(){

        //手机号验证条件
        var plone = $('.text1').val();
        var myreg = /^[1][3,5,7,8,9][0-9]{9}$/;
        //code验证条件
        var code  = $('.text2').val();
        //密码验证条件
        var pwd1  = $('.text3').val();
        //确认密码密码验证条件
        var pwd2  = $('.text4').val();

        //验证手机号
        var flag1 = false;
        if(!plone){
            $('.span1').html("手机号码不能为空");
            flag1 = false;
        }else if(!myreg.test(plone)) {
            $('.span1').html("请输入正确的手机号");
            flag1 = false;
        }else{
            $('.span1').html("");
            flag1 = true;
        }

        //验证code
        var flag2 = false;
        if(!code){
            $('.span2').html("请输入长度为6位的效验码");
            flag2 = false;
        }else if(code.length != 6) {
            $('.span2').html("验证码为6位");
            flag2 = false;
        }else{
            $('.span2').html("");
            flag2 = true;
        }

        //验证密码
        var flag3 = false;
        if(!pwd1){
            $('.span3').html("请输入长度大于6位的密码");
            flag3 = false;
        }else if(pwd1.length != 7) {
            $('.span3').html("密码长度最小为7位");
            flag3 = false;
        }else{
            $('.span3').html("");
            flag3 = true;
        }

        //验证确认密码
        var flag4 = false;
        if(!pwd2){
            $('.span4').html("请输入确认密码");
            flag4 = false;
        }else if(pwd1 != pwd2) {
            $('.span4').html("密码与确认密码必须保持一致");
            flag4 = false;
        }else{
            $('.span4').html("");
            flag4 = true;
        }

        if(flag1===false || flag2===false || flag3===false || flag4===false){
            return false;
        }
        $.post('/find_pwds',{plone:plone,code:code,pwd:pwd1},function(ret){
                if(ret.code==0){
                    location.href="/login";
                }else{
                    alert(ret.msg);
                }
        },'json');
        // 




    });

</script>

</body>
</html>
