<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>首页</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="static/images/icon/favicon.ico" type="static/image/x-icon">
<link rel="stylesheet" type="text/css" href="static/css/style.css" /><script src="static/js/html5.js"></script>
<script src="static/js/jquery.js"></script>
<script src="static/js/swiper.min.js"></script>
<script>
$(document).ready(function(){
	//焦点图
	var mySwiper = new Swiper('#slide',{
		  autoplay:5000,
		  visibilityFullFit : true,
		  loop:true,
		  pagination : '.pagination',
	  });
})
</script>
</head>
<body>
<!--advertisment<div class="wrap"><img src="upload/banner.jpg"/></div>-->
<!--header-->
<!-- 头部 -->
   @include('layout.header')


 
<!--advertisment area-->
<section class="wrap">
 <!--ctCont-->
 <div class="IdxmainArea">
    <!--slide-->
    <div id="slide">
     <!-- 轮播图 -->
      <div class="swiper-wrapper">
        @foreach($slideshow as $k=>$v)
        <div class="swiper-slide">
         <a href="{{url('goods/'.$v['goods_id'])}}" width="575" height="198">
          <img src="{{$v['goods_img']}}"/>
         </a>
        </div>
        @endforeach
      </div>
     
      <div class="pagination"></div>  
    </div>

    <!--singleAd-->
    <div class="singleAd">
     <a href="#">
      <img src="static/upload/sigleAd.jpg"/>
     </a>
    </div>

    
     <!--bestShop-->
    <dl class="bestShop">
     <dt>
      <strong>猜你喜欢</strong>
      <a href="shop_list.html" class="fr">更多</a>
     </dt>

    
    @foreach($goodsInfo['goodslove'] as $v)

     <dd>
      <a href="{{url('goods/'.$v['goods_id'])}}">
      <img src="{{$v['goods_img']}}" width="169" height="90"/>
       <h2>{{$v['goods_name']}}</h2>
      </a>
     </dd>
     @endforeach
   
  
    </dl>
 </div>
 <!--asdCont-->
 <div class="IdxAsideRt">
  <!--login-->
  @php  use Illuminate\Support\Facades\Redis; @endphp
  @php  $user_id=Redis::hmget('reg','user_id','user_plone'); @endphp
      @if($user_id[0]==false||$user_id[1]==false||empty($user_id))
  <div class="idxRtLogin">
   <div class="fstArea">
     <a href="#" class="userIcon">
      <img src="static/images/icon/DefaultAvatar.jpg">
     </a>
     <div class="rtInfor">
      <p>Hi!你好,请登录</p>
      <p class="obviousText">免费入驻，提升品牌效应！</p>
     </div>
    </div>
    <div class="secArea">
     <a href="/login">登录</a>
     <a href="/reg">免费注册</a>
    </div>
   </div> 
   @else 
   <div class="idxRtLogin">
   <div class="fstArea">
     <a href="#" class="userIcon">
      <img src="static/images/icon/DefaultAvatar.jpg">
     </a>
     <div class="rtInfor">
      <p>Hi!你好:</br>@php echo $user_id[1] @endphp</p>
      <p class="obviousText">免费入驻，提升品牌效应！</p>
     </div>
    </div>
    <div class="secArea">
     <a href="/sereg">成为商家</a>
     <a href="/business">登录商家</a>
    </div>
   </div>
   @endif

   <dl class="idxRtAtc">
    <dt>
     <em class="obviousText">最新公告</em>
     <a href="{{url('/notice_list')}}">more</a>
    </dt>
    @foreach($noticeinfo as $v)
    <dd><a href="{{url('/notice_read')}}">{{$v['notice_desc']}}</a></dd>
   @endforeach
   </dl>
 
  </div>
</section>
<!--productList-->
<section class="wrap idxproLi">
 <h2>
  <strong>
   <a href="channel.html">产品展示区</a>
  </strong>
 </h2>
 <div class="ltArea">
  <!--ad:category pic-->
   <a href="https://www.taobao.com/">
   <script src="/static/ads/1.js"></script>
   </a>
 </div>
 <div class="ctLi">
  <ul>
   <li>
    <a href="https://www.jd.com/">
     <h3>2020时尚新款</h3>
     <script src="/static/ads/2.js"></script>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
     <h3>2020时尚新款</h3>
     <script src="/static/ads/3.js"></script>
    </a>
   </li>
   <li>
    <a href="https://www.jd.com/">
    <script src="/static/ads/4.js"></script>
     <h3>2020时尚新款</h3>
    </a>
   </li>
   <li>
    <a href="https://www.taobao.com/">
    <script src="/static/ads/5.js"></script>
     <h3>2020时尚新款</h3>
    </a>
   </li>
   <li>
    <a href="https://www.taobao.com/">
    <script src="/static/ads/6.js"></script>
     <h3>2020时尚新款</h3>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
    <script src="/static/ads/7.js"></script>
     <h3>2020时尚新款</h3>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
    <script src="/static/ads/8.js"></script>
     <h3>2020时尚新款</h3>
    </a>
   </li>
   <li>
    <a href="https://www.jd.com/">
    <script src="/static/ads/9.js"></script>
     <h3>2020时尚新款</h3>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
    <script src="/static/ads/10.js"></script>
     <h3>2020时尚新款</h3>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
    <script src="/static/ads/11.js"></script>
     <h3>2020时尚新款</h3>
    </a>
   </li>
  </ul>
  <!--bestBrand-->
  <div class="idxBrandLi">
   <a href="https://www.jd.com/"><script src="/static/ads/12.js"></script></a>
   <a href="https://www.taobao.com/"><script src="/static/ads/13.js"></script></a>
   <a href="https://www.jd.com/"><script src="/static/ads/14.js"></script></a>
   <a href="https://www.taobao.com/"><script src="/static/ads/15.js"></script></a>
  </div>
 </div>
</section>

<section class="wrap idxproLi">
 <h2>
  <strong>
   <a href="channel.html">热卖商品</a>
  </strong>
 </h2>
 <div class="ltArea">
  <!--ad:category pic-->
  @foreach($goodsInfo['goodshot'] as $v)
   <a href="{{url('goods/'.$v['goods_id'])}}"><img src="{{$v['goods_img']}}"/></a>
   @endforeach
 </div>
 
 <div class="ctLi">
  <ul>
   @foreach($goodsInfo['goodshot'] as $v)
   <li>
    <a href="{{url('goods/'.$v['goods_id'])}}">
     <img src="{{$v['goods_img']}}"/>
     <h3>{{$v['goods_name']}}</h3>
    </a>
   </li>
   @endforeach
  </ul>
  <!--bestBrand-->
  <div class="idxBrandLi">
   <a href="https://www.jd.com/"><script src="/static/ads/16.js"></script></a>
   <a href="https://www.jd.com/"><script src="/static/ads/17.js"></script></a>
   <a href="https://www.jd.com/"><script src="/static/ads/18.js"></script></a>
   <a href="https://www.jd.com/"><script src="/static/ads/19.js"></script></a>
  </div>
 </div>
</section>
<!--case-->
<section class="wrap idexCase">
  <h2>
    <strong>最新商品</strong>
    <a href="#">more</a>
  </h2>
  <ul>
    @foreach($goodsInfo['goodsbest'] as $v)
    <li>
      <a href="{{url('goods/'.$v['goods_id'])}}">
        <img src="{{$v['goods_img']}}"/>
        <h3>{{$v['goods_name']}}</h3>
      </a>
    </li>
    @endforeach
  </ul>
</section>
<!--section:two->articleList-->
<section class="wrap idxArticle">
  <dl>
   <dt>
    <strong>招标资讯</strong>
    <a href="article_list.html">more</a>
   </dt>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
   <dd><a href="article_read.html">四川省老年大学教学用具及设备采购二标段公开招标采购公告</a></dd>
   <dd><a href="article_read.html">慢道峰山桥至仙境源风机路、曲径通幽至老虎洞至孙家至王沟服务区亮化工程公开招标公告</a></dd>
   <dd><a href="article_read.html">四川省资阳市安岳县民政局第二次全国地名普查外包服务采购项目公开招标采购公告</a></dd>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
  </dl>
  <dl style="margin:0 2.5%">
   <dt>
    <strong>最新询价信息</strong>
    <a href="article_list.html">more</a>
   </dt>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
   <dd><a href="article_read.html">四川省老年大学教学用具及设备采购二标段公开招标采购公告</a></dd>
   <dd><a href="article_read.html">慢道峰山桥至仙境源风机路、曲径通幽至老虎洞至孙家至王沟服务区亮化工程公开招标公告</a></dd>
   <dd><a href="article_read.html">四川省资阳市安岳县民政局第二次全国地名普查外包服务采购项目公开招标采购公告</a></dd>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
  </dl>
  <dl>
   <dt>
    <strong>行业资讯</strong>
    <a href="article_list.html">more</a>
   </dt>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
   <dd><a href="article_read.html">四川省老年大学教学用具及设备采购二标段公开招标采购公告</a></dd>
   <dd><a href="article_read.html">慢道峰山桥至仙境源风机路、曲径通幽至老虎洞至孙家至王沟服务区亮化工程公开招标公告</a></dd>
   <dd><a href="article_read.html">四川省资阳市安岳县民政局第二次全国地名普查外包服务采购项目公开招标采购公告</a></dd>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
  </dl>
</section>
<!--footer-->
  <!-- 尾部 -->
   @include('layout.foot')
    
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
   
 </script>
   @include('layout.search_type')

</body>
</html>
