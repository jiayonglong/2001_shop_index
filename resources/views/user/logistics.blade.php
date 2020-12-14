<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>物流信息</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="/jyl/images/icon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/jyl/css/style.css" /><script src="/jyl/js/html5.js"></script>
<link rel="stylesheet" href="/static/css/layui.css"  media="all">

<script src="/jyl/js/jquery.js"></script>
<script>
$(document).ready(function(){
  $("nav .indexAsideNav").hide();
  $("nav .category").mouseover(function(){
	  $(".asideNav").slideDown();
	  });
  $("nav .asideNav").mouseleave(function(){
	  $(".asideNav").slideUp();
	  });
	$(".favorite_list li .shop_collect_goods").click(function(){
	alert("收藏本店铺");
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
     });
    document.oncontextmenu=new Function("event.returnValue=false;");
    document.onselectstart=new Function("event.returnValue=false;"); 
  </script>
    
    <section class="wrap list_class_page">
    <div class="lt_area">
    
    <div class="attr_filter">
        <h2>物流信息</h2>
    </div> 
     
    <ul class="layui-timeline" style="margin-top:25px;z-index:-1">

   @foreach($logisticResult['Traces'] as $v)
    <li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis">O</i>
        <div class="layui-timeline-content layui-text">
        <h3 class="layui-timeline-title">{{$v['AcceptTime']}}</h3>
        <p>{{$v['AcceptStation']}}</p>
        <ul>
            <li>{{$v['Remark']}}</li>
        </ul>
        </div>
    </li>
     @endforeach
</ul>  



    </section>
 </div>
</section>

<!--footer-->
@include('layout.foot')
@include('layout.search_type')
</body>
</html>

