<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>商品列表</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="/jyl/images/icon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/jyl/css/style.css" /><script src="/jyl/js/html5.js"></script>
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
  //冒泡
//   $(".favorite_list li a").click(function(){
// 	alert("链接");
// 	window.location.href='shop.html';
// 	});
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
     $("#zixun").click(function(){
        $(".inputWrap input[type='text']").attr("placeholder","输入关键词查找文章内容");
        });
     $("#wenku").click(function(){
        $(".inputWrap input[type='text']").attr("placeholder","输入关键词查找文库内容");
        });
     });
    document.oncontextmenu=new Function("event.returnValue=false;");
    document.onselectstart=new Function("event.returnValue=false;"); 
  </script>
  
<section class="wrap list_class_page">
 <div class="lt_area">
 
   <div class="attr_filter">
      <h2>属性筛选</h2>
      <ul>
         <li>
         <dl>
         <dt>按品牌筛选：</dt>    
               @foreach($brandInfo as $v)
                  <dd class="searc" field="brand_id" value="{{$v['brand_id']}}" title="{{$v['brand_name']}}">
                     <a @if(isset($query['brand_id']) && $query['brand_id']==$v['brand_id']) class="redhover" @endif>{{$v['brand_name']}}</a>
                  </dd>
            @endforeach
         </dl>
         </li>
         <li>
         <dl>
         <dt>按价格筛选：</dt>
         @foreach($priceInfo as $v)
               <dd class="searc" field="shop_price" value="{{$v}}"> 
                  <a @if(isset($query['shop_price']) && $query['shop_price']==$v) class="redhover" @endif>{{$v}}</a>
               </dd>
            @endforeach
         </dl>
         </li>
      </ul>
   </div>

  <!--产品列表-->
    <section class="shop_li">
     <h2>商品列表</h2>
      <ul class="favorite_list">
         @foreach($goodsInfo as $v)
         <li>
         <a href="{{url('goods/'.$v['goods_id'])}}">
            <img src="{{$v['goods_img']}}"/>
            <h3>{{$v['goods_name']}}</h3>
            <p class="shop_collect_goods" title="收藏该产品"><span>&#115;</span></p>
         </a>
      
         </li>
         @endforeach

      </ul>
    
       <!--分页-->
       <div class="paging">
          
       </div>
    </section>

 </div>

 <aside class="rtWrap">
  <dl class="rtLiTwoCol">
   <dt>历史浏览记录</dt>
   @foreach($listhistory as $k=>$v)
      <dd>
         <a href="{{url('goods/'.$v['goods_id'])}}">
         <img src="{{$v['goods_img']}}"/>
         <!-- <p>{{$v['goods_name']}}</p> -->
         </a>
      </dd>
   @endforeach
   <a href="javascript:void(0)" class="delhistory">清空历史浏览记录</a>
  </dl>  
 </aside>

</section>
<!--footer-->
@include('layout.foot')
</body>
<script src="/static/js/jquery.js"></script>
   <script>
     //搜索
      $(document).ready(function(){
         $('.searc').click(function(){ 
            $(this).find('a').addClass('redhover');
            $(this).siblings().find('a').removeClass('redhover');
            var searc = '';
            // var s_val=$('.redhover').val();
            $('.redhover').each(function(i,k){
               var s_key = $(this).parent().attr('field');
               var s_val = $(this).parent().attr('value');
               searc += s_key+'='+s_val+'&';
              
           });
            var url="{{$urls}}";
            //将搜索条件中多余符号删除
            if(searc){
               url += '?'+searc.substring(0, searc.length -1);
               location.href=url;
            }
          
         })
      })

      //登录后 清空历史浏览记录
      $(document).on('click','.delhistory',function(){
         $.get('http://2001.shop.index.com/delhistorys',function(res){
            if(res.code==0){
               alert(res.msg);
               location.reload()
            }
         },'json')
      })




  
</script>

</html>
@include('layout.search_type')

