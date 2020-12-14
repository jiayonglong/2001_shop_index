<link rel="icon" href="/jyl/images/icon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/jyl/css/style.css" /><script src="/jyl/js/html5.js"></script>
<script src="/jyl/js/jquery.js"></script>
<script src="/jyl/js/jquery.jqzoom.js"></script>
<script src="/jyl/js/base.js"></script>
@include('layout.header')
<center>
<table>  
<h1>点击领取优惠券</h1>
@foreach($data as $v)
<span coupons_id="{{$v['coupons_id']}}"  class="add"><img src="{{$v['coupons_img']}}"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

@endforeach
</table>
</center>

<footer>
 <!--help-->
 <ul class="wrap help">
  <li>
   <dl>
    <dt>消费者保障</dt>
    <dd><a href="article_read.html">保障范围</a></dd>
    <dd><a href="article_read.html">退换货流程</a></dd>
    <dd><a href="article_read.html">服务中心</a></dd>
    <dd><a href="article_read.html">更多服务特色</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>新手上路</dt>
    <dd><a href="article_read.html">保障范围</a></dd>
    <dd><a href="article_read.html">退换货流程</a></dd>
    <dd><a href="article_read.html">服务中心</a></dd>
    <dd><a href="article_read.html">更多服务特色</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>付款方式</dt>
    <dd><a href="article_read.html">保障范围</a></dd>
    <dd><a href="article_read.html">退换货流程</a></dd>
    <dd><a href="article_read.html">服务中心</a></dd>
    <dd><a href="article_read.html">更多服务特色</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>服务保障</dt>
    <dd><a href="article_read.html">保障范围</a></dd>
    <dd><a href="article_read.html">退换货流程</a></dd>
    <dd><a href="article_read.html">服务中心</a></dd>
    <dd><a href="article_read.html">更多服务特色</a></dd>
   </dl>
  </li>
 </ul>
 <dl class="wrap otherLink">
  <dt>友情链接</dt>
  <dd><a href="#" target="_blank">素材网站</a></dd>
  <dd><a href="#/pins/24448.html">HTML5模块化后台管理模板</a></dd>
  <dd><a href="#/pins/15966.html">绿色清爽后台管理系统模板</a></dd>
  <dd><a href="#/pins/14931.html">黑色的cms商城网站后台管理模板</a></dd>
  <dd><a href="http://www.bootstrapmb.com" target="_blank">前端博客</a></dd>
  <dd><a href="http://www.bootstrapmb.com" target="_blank">博客</a></dd>
  <dd><a href="http://www.bootstrapmb.com" target="_blank">新码笔记</a></dd>
  <dd><a href="http://www.bootstrapmb.com" target="_blank">DethGhost</a></dd>
  <dd><a href="#">当当</a></dd>
  <dd><a href="#">优酷</a></dd>
  <dd><a href="#">土豆</a></dd>
  <dd><a href="#">新浪</a></dd>
  <dd><a href="#">钉钉</a></dd>
  <dd><a href="#">支付宝</a></dd>
 </dl>
 <div class="wrap btmInfor">
  <p>© 2013 DeathGhost.cn 版权所有 网络文化经营许可证：浙网文[2013]***-027号 增值电信业务经营许可证：浙B2-200***24-1 信息网络传播视听节目许可证：1109***4号</p>
  <address>联系地址：陕西省西安市雁塔区XXX号</address>
 </div>
</footer>
<script>
 $('.add').click(function(){

       var coupons_id=$(this).attr('coupons_id');
       $.post('http://2001.shop.api.com/couponsdo',{coupons_id:coupons_id},function(res){
            // console.log(res);
			// 未登录
            if(res.code=='1001'){
                alert(res.msg);
                location.href="/login?refer="+location.href;
            }
			//领取成功
            if(res.code=='0'){
                alert(res.msg);
               
            }else{
               alert(res.msg);
            }

        },'json');
   })
</script>
@include('layout.search_type')
