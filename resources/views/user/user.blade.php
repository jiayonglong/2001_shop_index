<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>用户中心</title>
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

   <!-- 个人订单 -->
   @include('layout.myorder')


 <!--右侧：内容区域-->
 <div class="user_rt_cont">
  <div class="top_title">
   <strong><em>{{$plone}}</em>欢迎回到用户中心</strong>
  </div>
  <!--用户信息-->
  <div class="user_factbook">
   <a href="profile.html" class="user_icon">
    <img src="static/images/2260223289996446_avatar.png"/>
    <span>修改头像</span>
   </a>
   <div class="user_infor">
    <p><strong>{{$plone}}</strong>（商户会员）</br><span class="user_vip unaccredited">未认证！</span><a href="authenticate.html">申请入驻</a></p><!--**未认证的class值为"unaccredited"**-->
    <p>上次登录时间：<time>2013-01-14 13:55</time>，登录ip：{{$remote_addr}}</p>
    <!-- <p>账户余额：<strong class="rmb_icon">0.00</strong><a href="account.html" class="btn">充值</a><a href="account.html" class="btn">提现</a></p> -->
   </div>
  </div>
  <!--买家订单提醒-->
  <dl class="user_order_tips">
   <dt>买家订单提醒 <a href="/userorderlist"  title="点击可查看所有订单">查看全部订单</a></dt>

   <dd>
     <strong>{{$obligation}}</strong>
     <em>待付款订单</em>
   </dd>
   <dd>
     <strong>{{$deliver}}</strong>
     <em>待发货订单</em>
   </dd>
   <dd>
     <strong>{{$afrmm}}</strong>
     <em>待确认订单</em>
    </a>
   </dd>
   <dd>
     <strong>{{$evaluate}}</strong>
     <em>待评价订单</em>
   </dd>
  </dl>
  <!--卖家订单提醒-->
  <dl class="user_order_tips">
   <dt>卖家订单提醒</dt>
   <dd>
    <a href="#">
     <strong>9</strong>
     <em>待付款订单</em>
    </a>
   </dd>
   <dd>
    <a href="#">
     <strong>10</strong>
     <em>待发货订单</em>
    </a>
   </dd>
   <dd>
    <a href="#">
     <strong>20</strong>
     <em>待评价订单</em>
    </a>
   </dd>
   <dd>
    <a href="#">
     <strong>2</strong>
     <em>退换货订单</em>
    </a>
   </dd>
  </dl>
 </div>
</section>
<!--footer-->
@include('layout.foot');
@include('layout.search_type')

</body>
</html>
