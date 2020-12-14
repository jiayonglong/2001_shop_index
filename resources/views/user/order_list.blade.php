<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>用户中心</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="/static/images/icon/favicon.ico" type="/static/image/x-icon">
<link rel="stylesheet" type="text/css" href="/static/css/style.css" /><script src="/static/js/html5.js"></script>

<script src="/static/js/jquery.js"></script>
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
 <!--左侧导航-->
 @include('layout.myorder')
@if(count($data))
 <!--右侧：内容区域-->
 <div class="user_rt_cont">
  <div class="top_title">
   <strong>我的订单</strong>
  </div>
  <!--条件检索-->
  <div style="margin:8px 0;">
   <select class="select">
    <option>订单状态</option>
    <option>待付款</option>
    <option>待发货</option>
    <option>待确认</option>
    <option>待评价</option>
    <option>退货</option>
   </select>
   <input type="text" class="textbox textbox_225" placeholder="输入订单编号"/>
   <input type="button" value="查询" class="group_btn"/>
  </div>
  <ul class="order_li">
  @foreach($data as $v)
  <input type="hidden" name="order_id" value="{{$v['order_id']}}">

  <li>
    <table class="order_table">
     <caption>
      <strong>订单编号：{{$v['order_sn']}}</strong>
      <em class="shop_name">{{$v['seuser_plone']}}</em>
      @if($v['is_paid'] == 0)
      <a href="/pay/{{$v['order_id']}}" class="a_btn">支付</a>
      @elseif($v['is_paid'] == 1 && $v['order_status'] == 0 && $v['is_deliver'] == 0 && $v['is_evaluate'] == 0)
      <a href="order_comment.html" class="a_btn">催发货</a>
      @elseif($v['is_paid'] == 1 && $v['order_status'] == 0 && $v['is_deliver'] == 1 && $v['is_evaluate'] == 0)
      <a style="margin-left:20px;" href="order_comment.html" class="a_btn">确认收货</a>
     
      <a  href="/logistics" class="a_btn">查看物流</a>
      @elseif($v['is_paid'] == 1 && $v['order_status'] == 1 && $v['is_deliver'] == 1 && $v['is_evaluate'] == 0)
      <a href="order_comment.html" class="a_btn">评价</a>
      @endif
     </caption>
     @foreach($v['goods_data'] as $vv)
     <tr>
      <td class="center"><a href="/goods/{{$vv['goods_id']}}"><img src="{{$vv['goods_img']}}" style="width:50px;height:50px;"/></a></td>
      <td><a href="/goods/{{$vv['goods_id']}}">{{$vv['goods_name']}}</a></td>
      <td class="center"><span class="rmb_icon">{{$vv['shop_price']}}</span></td>
      <td class="center"><b>{{$vv['buy_number']}}</b></td>
      <td class="center"><strong class="rmb_icon">{{$vv['shop_price']*$vv['buy_number']}}</strong></td>
     </tr>
     @endforeach
  
    </table>
   </li>
   @endforeach

  </ul>
   <!--分页-->
   <div class="paging" style="text-align:right">
    <a>第一页</a>
    <a class="active">2</a>
    <a>3</a>
    <a>...</a>
    <a>89</a>
    <a>最后一页</a>
   </div>
 </div>
</section>
@else
<div class="paysuccess">
				<div class="success">
					<h3><img src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=49030976,3287915018&fm=26&gp=0.jpg" width="48" height="48">　您还没有任何订单哦~</h3>
					<div class="paydetail">
					<p>您可以购买商品后再来哦~</p>
					<p class="button"><a href="/" class="sui-btn btn-xlarge btn-danger">去购物</a>&nbsp;&nbsp;&nbsp;&nbsp;</p>
				    </div>
				</div>
			</div>

@endif
@include('layout.foot');
@include('layout.search_type')

</body>
</html>
