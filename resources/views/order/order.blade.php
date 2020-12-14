<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>确认订单</title>
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
<section class="wrap" style="margin-top:20px;overflow:hidden;">
<!-- 收货人信息 -->
<a href="javascript:void(0)" class="addres">添加收货地址</a>
@if(count($addressinfo['addressinfo']))
 <table class="order_table address_tbl">
   <tr>
   <th width="200">选择收货地址</th>
    <th width="200">收件人</th>
    <th width="200">联系电话</th>
    <th width="200">收件地址</th>
    <th width="100">操作</th>
   </tr>
   @if($addressinfo)
   @foreach($addressinfo as $vv)
   @foreach($vv as $v)
   <tr @if($v['is_default']) selected @endif address_id="{{$v['address_id']}}">
    <td>
    @if($v['is_default'] == 1)
    <input type="radio" class="addre" name="address_a" value="{{$v['address_id']}}" checked>
    @else
    <input type="radio" class="addre" name="address_a" value="{{$v['address_id']}}">
    @endif
      
    </td>
    <td>{{$v['consignee']}}</td>
    <td>{{$v['tel']}}</td>
    <td>
     <address>
      {{$v['country_name']}},{{$v['province_name']}},{{$v['city_name']}},{{$v['district_name']}},{{$v['address']}}
     </address>
    </td>
    <td>
     <label>
       
        @if($v['is_default'] == 1)
        <input type="radio" name="moren" calss="mor" value="{{$v['address_id']}}" checked/>默认地址
        @else
        <input type="radio" name="moren" class="mor" value="{{$v['address_id']}}"/>设为默认地址
        @endif

     </label>
     <a href="javascript:void(0)" class="del"  address_id="{{$v['address_id']}}">删除</a>
    </td>
   </tr>
   @endforeach
   @endforeach
   @endif
</table>
@else
<center><table>
      <tr>
        <td><img src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=1875533656,2481290632&fm=26&gp=0.jpg" alt="" width="80px" height="100px"></td>
        <td> <div class="order_btm_btn">
              <h1 style="color:red">暂无收货地址，请前往添加哦~</h1>
              <a href="javascript:void(0)" class="link_btn_01 add_ress"/>去添加</a>
            </div>
       </td>
      </tr>
    </table>
</center>
@endif

<table class="order_table">
  <caption>
   <strong>订单商品</strong>
   <a href="/cart">返回购物车修改</a>
  </caption>
  <tbody>
@foreach($account['cart_data'] as $kk=>$vv)
  <tr>
   <td class="center" goods_id="{{$vv['goods_id']}}"><a href="/goods/{{$vv['goods_id']}}"><img src="{{$vv['goods_img']}}" style="width:50px;height:50px;"></a></td>
   <td><a href="/goods/{{$vv['goods_id']}}">{{$vv['goods_name']}}</a></td>
   <td>
   <input type="hidden" name="goods_attr_id" class="goods_attr_id" goods_attr_id="{{$vv['goods_attr_id']}}" value="{{$vv['goods_attr_id']}}">
   @if(isset($vv['attr']))
   @foreach($vv['attr'] as $vvv)
    <p>{{$vvv}}</p>
  @endforeach
    @endif
   </td>
   <td class="center">所属商家：{{$vv['seuser_plone']}}</td>
   <td class="center"><span class="rmb_icon">{{$vv['shop_price']}}</span></td>
   <td class="center"><span>{{$vv['buy_number']}}</span></td>
   <td class="center"><strong class="rmb_icon">{{$vv['buy_number']*$vv['shop_price']}}</strong></td>
  </tr>
@endforeach
 </tbody></table>
 <input type="hidden" name="goods_id" value="{{$goods_id}}" goods_id="{{$goods_id}}" id="goods_id">
 <input type="hidden" name="cart_id" value="{{$cart_id}}" id="cart_id">

 <!--支付与配送-->
 <ul class="order_choice">
  <li>
   <dl>
    <dt>支付方式</dt>
   <!-- istrue -->
    <dd class="payType">
      <label class="radio istrue" pay_type="1"><input type="radio" name="pay_name"/>支付宝</label>
      <label class="radio" pay_type="2" ><input type="radio" name="pay_name"/>微信支付</label>
      <label class="radio" pay_type="3"><input type="radio" name="pay_name"/>货到付款</label>
      <label class="radio" pay_type="4"><input type="radio" name="pay_name"/>余额支付</label>
    </dd>

   </dl>
  </li>
  <li>
   <dl>
    <dt>选择优惠券</dt>
   <!-- istrue -->

    <dd class="payType">
    @foreach($coupons as $key =>$val)
      <label class="coupons" coupons_id="{{$val['coupons_id']}}"><input type="radio" name="coupons" /><img src="{{$val['coupons_img']}}"  alt=""></label>
  @endforeach
    </dd>

   </dl>
  </li>
  <li>
   <dl>
    <dt>订单留言</dt>
    <dd>
     <textarea class="order_leave" name="order_leave"></textarea>
    </dd> 
   </dl>
  </li>
 </ul>
 <div class="order_btm_btn">
 共计金额{{$account['end_price'][0]['total']}}
  <a href="javascript:void(0)" class="link_btn_02 add_btn"/>应付金额<strong class="rmb_icon total">{{$account['end_price'][0]['total']}}</strong>提交订单</a>
 </div>
</section>
<!--footer-->
@include('layout.foot')
</body>
<script scr="/static/jyl/js/jquery.js"></script>
<script>
//使用优惠券
$(document).on("click",".coupons",function(){
        $(this).addClass("selected");
        $(this).prev().removeClass("selected");
        $(this).next().removeClass("selected");
        var coupons_id=$('.selected').attr("coupons_id");
        var goods_id = new Array();
         goods_id.push($('#goods_id').attr('goods_id'));
        //  alert(goods_id);
        var goods_attr_id=$('.goods_attr_id').attr('goods_attr_id');
        // alert(goods_attr_id);
        //点击优惠券改变价格
        $.post('http://2001.shop.api.com/couponsprice',{coupons_id:coupons_id,goods_id:goods_id,goods_attr_id:goods_attr_id},function(res){
                        // alert(res);
                        $('.rmb_icon').text(res.data);
                      },'json');
              
})


 $(document).on('click','.addres',function(){
  alert('添加完成后请刷新本页面');
  location.href="/address?refer="+location.href;
 })
  //默认地址
   $(document).on('click','.mor',function(){
        var address_id = $(this).val();
        // alert(address_id);
        if(address_id){
          $.post('/mor',{address_id:address_id},function(rets){
              if(rets.code==0){
                location.reload();
              }else{
                alert(ret.msg);
              }
          },'json');
        }else{
          return false;
        }
   });

  //添加收货地址
  $('.add_ress').click(function(){
    alert('添加完成后请刷新本页面');
    location.href="/address?refer="+location.href;
  });


  //ajax删除
  $(document).on('click','.del',function(){
    var _this = $(this);
    // var address_id = [];
    var address_id = _this.attr('address_id');
    if(!address_id){
      return;
    }

    if(confirm("您确定要删除吗?")){
      $.post('/address_del',{address_id:address_id},function(res){
        if(res.code==0){
          _this.parent().parent().remove();
        }else{
          if(res.code==2){
            location.reload();
          }else{
            alert(res.msg);

          }
        }
      },'json')

    }
    return false;


  })

  //支付方式默认选中和配送方式默认选中 和 特效
  $(document).on('click','.radio',function(){
    var _this = $(this);
    _this.siblings().removeClass('istrue');
    _this.addClass('istrue');
  })


    //结算
    $('.rmb_icon').click(function(){
      //收货地址
        var address_id = $(".addre:checked").val();
        if(!address_id){
            alert('请选择收货地址');
            return false;     
        }
      //支付方式
       var pay_type = $('.istrue').attr('pay_type');
       if(!pay_type){
            alert('请选择支付方式');
            return false;
        }
       //订单留言
       var order_leave = $('.order_leave').val();
       //商品
       var cart_id = $("#cart_id").val();
       if(!cart_id){
        alert('参数丢失');
            return false;
       }
       var total_price = $('.total').text();
       if(!total_price){
        alert('参数丢失');
            return false;
       }
       //优惠券id
       var coupons_id=$('.selected').attr("coupons_id");
       //商品id
       var goods_id = new Array();
         goods_id.push($('#goods_id').attr('goods_id'));
         //规格id
         var goods_attr_id=$('.goods_attr_id').attr('goods_attr_id');
       $.post('/orderinfo',{address_id:address_id,pay_type:pay_type,order_leave:order_leave,cart_id:cart_id,total_price:total_price,goods_id:goods_id,goods_attr_id:goods_attr_id,coupons_id:coupons_id},function(ret){
            // console.log(ret);
            if(ret.code == 1){
             location.href="/login?refer="+location.href;
            }
            if(ret.code == 0){
              var order_id =ret.data;
             location.href="/pay/"+order_id;
            }else{
              window.history.go(-1); //返回上一页
              window.location.href=document.referrer;
              alert(ret.msg);
            }
       },'json');
       
    });




  		

  
  

</script>
@include('layout.search_type')

</html>
