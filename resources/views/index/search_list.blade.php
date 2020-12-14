<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>商品列标-产品详情</title>
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
  //冒泡
  $(".favorite_list li a").click(function(){
	window.location.href='product.html';
	});
	$(".favorite_list li .shop_collect_goods").click(function(){
	event.stopPropagation();
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
 
<section class="wrap shop_goods_li">
  <ul class="favorite_list">
   @if(count($search_data) > 0)
   @foreach($search_data as $v)
   <li>
    <a href="/goods/{{$v['goods_id']}}">
     <img src="{{$v['goods_img']}}"/>
     <h3>{{$v['goods_name']}}</h3>
     <p class="price"><span class="rmb_icon">298.00</span></p>
    </a>
   </li>
   @endforeach
   @else
   <section class="wrap shop_header">
 <div class="shop_logo"><img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=4018625787,1425206529&fm=26&gp=0.jpg"/></div>
 <div class="shop_infor">
  <h2 class="user_vip accredited" title="认证企业">Error</h2>
  <p>
   <span>未搜索到相关商品</span>
   <span></span>
   <span></span>
  </p>
  <p>建议您换个关键字重新搜索</p>
 </div>
</section>
   @endif
  
  </ul>

</section>
<!--footer-->
@include('layout.foot')
@include('layout.search_type')

</body>
</html>
