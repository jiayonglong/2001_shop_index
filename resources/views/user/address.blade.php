<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>我的地址-用户中心</title>
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
   });
   
 </script>
 
<section class="wrap user_center_wrap">
 @include('layout.myorder')
 <!--右侧：内容区域-->
 <div class="user_rt_cont">
  <div class="top_title">
   <strong>我的地址列表</strong>
  </div>

<form>
  <table class="order_table">
   <tr>
    <td width="100" align="right">收件人：</td>
    <td><input type="text" name="consignee" placeholder="输入收件人姓名" class="textbox"/><span></span></td>
   </tr>
   <tr>
    <td width="100" align="right">联系电话：</td>
    <td><input type="text" name="tel" placeholder="收件人手机号码" class="textbox"/><span></span></td>
   </tr>
   <tr>
    <td width="100" align="right">收件地址：</td>
    <td>
     <select name="country" class="select">
      <option>选择省份</option>
            @foreach($region as $v)
							<option value="{{$v->region_id}}">{{$v->region_name}}</option>
						@endforeach
     </select>
      <select name="province" class="select">
      <option>选择身份</option>
     </select>
     <select name="city" class="select">
      <option>选择城市</option>
     </select>
     <select name="district" class="select">
      <option>选择区县</option>
     </select>
    </td>
   </tr>
   <tr>
    <td width="100" align="right">详细地址：</td>
    <td><input type="text" name="address" placeholder="街道门牌号" class="textbox textbox_295"/><span></span></td>
   </tr>
   <tr>
    <td width="100" align="right"></td>
    <td><input type="button"  value="更新保存" class="group_btn addre"/></td>
   </tr>
  </table>
</form>
  <table class="order_table address_tbl add">

  </table>
 </div>
</section>
<!--footer-->
@include('layout.foot')
@include('layout.search_type')

</body>
</html>
<script src="/static/js/jquery.js"></script>
<script>
    $('select').change(function(){
        var _this = $(this);
        var region_id = _this.val();
      
        if(region_id<1){
          _this.nextAll().find('option:gt(0)').remove();
        }
        $.get('http://2001.shop.api.com/getsondata',{region_id:region_id},function(res){
          if(res.code=='0'){
            var address = res.data;
            // alert(address);
            var str = '<option value="0">--请选择--</option>';
            for (var i=0;i<address.length;i++) {
              str += '<option value="'+address[i].region_id+'">'+address[i].region_name+'</option>';
            }
            _this.next().html(str);
          }
          return;
        },'json');
      });
    $(function(){
      $('.addre').click(function(){
        var flag = false;
        var data=new Array();
         data.consignee = $('input[name="consignee"]').val();
        if (data.consignee  == '') {
                $("input[name='consignee']+span").html("<font color='red'>收件人不能为空</font>");
                flag = false;
            } else {
                $("input[name='consignee']+span").html("<font color='green'>√</font>");
                flag = true;
            }
        var aflag = false;
        data.tel = $('input[name="tel"]').val();
        if (data.tel == '') {
                $("input[name='tel']+span").html("<font color='red'>电话号不能为空</font>");
                aflag = false;
            } else {
                $("input[name='tel']+span").html("<font color='green'>√</font>");
                aflag = true;
            }
        
         data.country = $('select[name="country"]').val();
      
        data. province = $('select[name="province"]').val();
        data. city = $('select[name="city"]').val();
        data. district = $('select[name="district"]').val();
        var hflag = false;
        data.address = $('input[name="address"]').val();
        if (data.address == '') {
                $("input[name='address']+span").html("<font color='red'>收货地址不能为空</font>");
                hflag = false;
            } else {
                $("input[name='address']+span").html("<font color='green'>√</font>");
                hflag = true;
            }
            if(hflag === false || aflag === false || flag === false){
              return false;
            }
            // console.log(data);
            // return false;
        var data = $('form').serialize();
        //{consignee:consignee,tel:tel,country:country,province:province,city:city,district,address:address}
        $.getJSON('http://2001.shop.api.com/store?callback=?',data,function (obj) {
                //var result=obj.consignee,tel,country,province,city,district,address;
    
                 var result=obj.data;
                var hotgoods = '';

                $.each(result, function(i,item){
                  hotgoods +='  <tr class="ads">\n' +
                        '  <td>'+item.consignee+'</td>\n' +
                        '   <td>'+item.tel+'</td>\n' +
                        '  <td><address>'+item.country+'.'+item.province+'.'+item.city+'.'+item.district+'.'+item.address+'</address></td>\n' +
                        '    <td><label><input type="radio" name="moren"/>设为默认地址</label><input type="button" value="编辑" class="btn"/><input type="button" value="删除" class="btn"/></td>\n' +
                        '  </tr>';

                });
                $('.add').html(hotgoods);
                })
                 
                 if(window.location.href.indexOf('refer') > -1){
                   window.history.go(-1); //返回上一页
                 }
                 
                
               });
        });
</script>
