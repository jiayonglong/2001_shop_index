<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>购物车</title>
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
 @php  use Illuminate\Support\Facades\Redis; @endphp
 @php  $user_id=Redis::hmget('reg','user_id','user_plone'); @endphp
  @if($user_id[0]==false||$user_id[1]==false||empty($user_id))
  <center><table>
      <tr>
        <td><img src="https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=1024102881,2497395939&fm=26&gp=0.jpg" alt="" width="300px" height="300px"></td>
        <td> <div class="order_btm_btn">
              <h1 style="color:red">您还没有登录哦~先去登录吧</h1>
              <a href="javascript:void(0)" class="link_btn_01 buy_btn login"/>去登录</a>
            </div>
       </td>
      </tr>
    </table>
</center>
  @else
 @if(count($cart['data']) > 0)
<section class="wrap" style="margin-top:20px;overflow:hidden;">
 <table class="order_table">
  <tr class="tr1">
   <th><input type="checkbox" class="check"/></th>
   <th>产品</th>
   <th>名称</th>
   <th>属性</th>
   <th>单价</th>
   <th>数量</th>
   <th>小计</th>
   <th>操作</th>
  </tr>
   @if(isset($cart['data']))
   @foreach($cart['data'] as $v)
  <tr>
   <td class="center"><input type="checkbox" cart_id="{{$v['cart_id']}}" goods_id="{{$v['goods_id']}}" class="check2"/></td>
   <td class="center"><a href="/goods/{{$v['goods_id']}}"><img src="{{$v['goods_img']}}" style="width:50px;height:50px;"/></a></td>
   <td><a href="/goods/{{$v['goods_id']}}">{{$v['goods_name']}}</a></td>
   <td>
    @if(isset($v['attr_nane']))
     @foreach($v['attr_nane'] as $vv)
      <p>{{$vv}}</p></br>
     @endforeach
     @endif
   </td>
   <td class="center"><span class="rmb_icon">{{$v['shop_price']}}</span></td>
   <td class="center">
     <input type="hidden" value="{{$v['cart_id']}}">
    <input type="button" value="-" class="jj_btn jian"/>
    <input type="text" value="{{$v['buy_number']}}" class="number" readonly/>
    <input type="button" value="+" class="jj_btn jia"/>
   </td>
   <td class="center">
      <strong class="rmb_icon">
          <span class="price">{{$v['shop_price']*$v['buy_number']}}</span>
      </strong>
      </td>
      <td class="center">
      <a href="javascript:void(0)" class="del" cart_id = "{{$v['cart_id']}}">删除</a>
      </td>
  </tr>
   @endforeach
   @endif
 </table>
 <div class="order_btm_btn">
  <a href="/" class="link_btn_01 buy_btn"/>继续购买</a>
  <a href="javascript:void(0)" class="link_btn_02 add_btn"/>共计金额<strong class="rmb_icon zprice">0.00</strong>立即结算</a>
 </div>
</section>
@else
<center><table>
      <tr>
        <td><img src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=2601129021,2880906803&fm=26&gp=0.jpg" alt=""></td>
        <td> <div class="order_btm_btn">
              <h1 style="color:red">购物车空空的哦~，去看看心仪的商品吧~</h1>
              <a href="/" class="link_btn_01 buy_btn"/>去购物</a>
            </div>
       </td>
      </tr>
    </table>
</center>
@endif
@endif

<!--footer-->
@include('layout.foot');
</body>
</html>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>>
<script>
//全选反选
    $(document).on('click','.check',function(){
     var _this = $(this);
    if(_this.prop('checked') == true){
        $('.check2').prop('checked',true);
        //获取总价
        var cart_ids = getcart();
        getxiaoji(cart_ids);
    }else{
      $('.check2').prop('checked',false);
      $('.zprice').html('0.00');
    }
    });

    //获取选中的id
    function getcart(){
      var cart_ids = new Array();
      $('.check2:checked').each(function(){
            var cart_id = $(this).attr('cart_id');
            cart_ids.push(cart_id);
        });
        return cart_ids;
    }
   
    $(document).on('click','.check2',function(){
      var cart_ids = getcart();
      if(cart_ids.length==0){
        $('.zprice').html('0.00');
      }else{
        getxiaoji(cart_ids);
      }
       
    });

    //计算小计
    function getxiaoji(cart_ids){
      
        if(!cart_ids){
          return;
        }
      $.ajax({
        url:'/cart_zprice',
        dataType :'json',
        type : 'post',
        data : {'cart_ids':cart_ids},
        success:function(reg){
          if(reg.code==0){
            $('.zprice').html(reg.zprice);
          }else{
              alert(reg.msg);
          }
        }
      });
    

    }

   //删除
    $(document).on('click','.del',function(){
        var _this = $(this);
        var cart_id = _this.attr('cart_id');
        if(!cart_id){
            return;
        }
        if(confirm('删除将不再购物车中展示')){
            $.post('/cart_del',{cart_id:cart_id},function(resler){
                if(resler.code==0){
                  _this.parent().parent().remove();
                  var cart_ids = getcart();
                  if(cart_ids==''){
                    $('.zprice').text('0.00');
                  }else{
                    getxiaoji(cart_ids);
                  }
                  $("#head").load(location.href+" #head");
                  if($('.cou').text() ==1){
                    location.reload();
                  }
                }else{
                  alert(resler.msg);
                }
            },'json');
        }
        return false;
    });


    //购买数量减号
    $(document).on('click','.jian',function(){
      
      var _this = $(this);
      _this.parent().siblings().find('.check2').prop('checked',true);
      var cart_id = _this.prev().val();
      //最初的购买数量
      var one_buy = parseInt(_this.next().val());
      if(one_buy > 1){
       var two_buy = one_buy-1;
       _this.next().val(two_buy);
        $.post('/buy_jian',{cart_id:cart_id},function(resler){
            if(resler.code==0){
              _this.parent().next().find('.price').text(resler.price.price);
              var cart_ids = getcart();
            getxiaoji(cart_ids);
            }else{
              _this.next().val(one_buy);
            }
          },'json');
      }else{
        return false;
      }

    });


    //购买数量加号
    $(document).on('click','.jia',function(){
        var _this = $(this);
      _this.parent().siblings().find('.check2').prop('checked',true);

        var cart_id = _this.prev().prev().prev().val();
        var one_buy = _this.prev().val();
        if(!one_buy){
          return;
        }
        $.post('buy_jia',{cart_id:cart_id},function(ret){
          if(ret.code==0){
            // console.log(ret);
            _this.prev().val(parseInt(one_buy)+1);
            _this.parent().next().find('.price').text(ret.price.price);
            var cart_ids = getcart();
        getxiaoji(cart_ids);
          }else{
            alert(ret.msg);
          }
        },'json');
    });

  //跳转结算
    $(document).on('click','.add_btn',function(){
      var cart_id = new Array();
      var goods_id = new Array();

      $('.check2:checked').each(function(){
        cart_id.push($(this).attr('cart_id'));
      });
      $('.check2:checked').each(function(){
        goods_id.push($(this).attr('goods_id'));
      });
      if (cart_id.length <= 0) {
      alert('最少选择一件商品哦！');
      return;
     }
    if(cart_id){
        location.href="/addorder?cart_id="+cart_id+"&"+"goods_id="+goods_id;
    }else{
      return false;
    }
   

    })

  //登录
  $('.login').click(function(){
    location.href="/login?refer="+location.href;
  });


</script>
@include('layout.search_type')
