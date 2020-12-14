<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>注册-联盟平台</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="static/images/icon/favicon.ico" type="static/image/x-icon">
<link rel="stylesheet" type="text/css" href="static/css/style.css" /><script src="static/js/html5.js"></script>
<script src="static/js/jquery.js"></script>
</head>
<body>
<div class="unionLoginTop">
 <div class="wrap">
  <h1>服装商城网上联盟平台</h1>
 </div>
</div>
<div class="unionLoginBg">
 <div class="wrap" style="background:url(static/images/unbg.jpg) center no-repeat;height:586px;">
  <dl class="loginForm">
   <dt>注册联盟平台</dt>   
   <dd>
    <span>账号：</span>
    <input type="text" name="seuser_plone" placeholder="输入账号" class="txtbox"/><span></span>
   </dd>
    <dd>
    <span>名称：</span>
    <input type="text" name="seuser_name" placeholder="输入账号" class="txtbox"/><span></span>
   </dd>
   <dd>
    <span>手机验证码：</span>
    <button type="button" id="aaa" value="获取手机校验码" class="get_num_btn"/>获取手机校验码</button>
   </dd>
    <dd>
    <span>手机校验码：</span>
     <input type="text" class="textbox" name="code" placeholder="手机校验码"/><span></span>
   </dd>
   <dd>
    <span>密码：</span>
    <input type="password" name="seuser_pwd" placeholder="输入密码" class="txtbox"/><span></span>
   </dd>
   <dd>
    <span>确认密码：</span>
    <input type="password" name="seuser_pwds" placeholder="输入密码" class="txtbox"/><span></span>
   </dd>
   <dd>
    <input type="button" value="提 交 审 核" class="loginBtn"/>
   </dd>
   <dd>
    <a href="{{url('/business')}}" title="登录账号" class="fl">已有账号，立即登录？</a>
    <a href="#" class="fr">忘记密码？</a>
   </dd>
  </dl>
 </div>
</div>
<!--footer-->
@include('layout.foot') 
</body>
</html>
<script src="static/js/jquery.js"></script>
<script>
  $('.loginBtn').on('click',function(){
    var falg = false;
      var seuser_plone = $('input[name="seuser_plone"]').val();
      if (seuser_plone == '') {
                $("input[name='seuser_plone']+span").html("<font color='red'>用户名不能为空</font>");
                falg = false;
            } else {
                $("input[name='seuser_plone']+span").html("<font color='green'>√</font>");
                falg = true;
        }
         var afalg = false;
      var seuser_name = $('input[name="seuser_name"]').val();
      if (seuser_name == '') {
                $("input[name='seuser_name']+span").html("<font color='red'>名称不能为空</font>");
                afalg = false;
            } else {
                $("input[name='seuser_name']+span").html("<font color='green'>√</font>");
                afalg = true;
        }
      var pfalg = false;
      var seuser_pwd = $('input[name="seuser_pwd"]').val();
      if (seuser_pwd == '') {
                $("input[name='seuser_pwd']+span").html("<font color='red'>密码不能为空</font>");
                pfalg = false;
            } else {
                $("input[name='seuser_pwd']+span").html("<font color='green'>√</font>");
                pfalg = true;
          }
      var ofalg = false;
      var seuser_pwds = $('input[name="seuser_pwds"]').val();
      if (seuser_pwds == '') {
                $("input[name='seuser_pwds']+span").html("<font color='red'>确认密码不能为空</font>");
                ofalg = false;
            } else {
                $("input[name='seuser_pwds']+span").html("<font color='green'>√</font>");
                ofalg = true;
          }
      var ifalg = false;
      var code = $('input[name="code"]').val();
      if (code == '') {
                $("input[name='code']+span").html("<font color='red'>验证码不能为空</font>");
                ifalg = false;
            } else {
                $("input[name='code']+span").html("<font color='green'>√</font>");
                ifalg = true;
            }
            // alert(code);
      if(falg === false || pfalg === false || ofalg === false || ifalg === false || afalg === false){
          return false;
      }
      if(seuser_pwd!=seuser_pwds){
          alert('密码不一致');
          return;
      }
        var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
    if(myreg.test(seuser_plone)){
        // alert(1111);
           $.get('/seregdo',{seuser_plone:seuser_plone,seuser_name:seuser_name,seuser_pwd:seuser_pwd,seuser_pwds:seuser_pwds,code:code},function (result) {
               console.log(result);
            if(result.code=='00001'){
                alert(result.message);
            }
            if(result.code=='00002'){
                alert(result.message);
            }
            if(result.code=='00003'){
                alert(result.message);
            }
            if(result.code=='00004'){
                alert(result.message);
            }
            if(result.code=='00005'){
                alert(result.message);
            }
            if(result.code=='00000'){
                location.href = "/business"
            }else{
                alert(result.message);
            }
        },'json')
    }else{
        alert('请输入正确的手机号');
    }
     
  })
    $('button').click(function () {
        var name = $('input[name="seuser_plone"]').val();
        // alert(name);
        var mobilereg = /^1[3|5|6|7|8|9]\d{9}$/;
        if(mobilereg.test(name)){
            //发送手机号验证码
            $.get('/sendSMS',{name:name},function (res) {
                if(res.code=='00001'){
                    alert(res.msg);
                }
                if(res.code=='00000'){
                    alert(res.msg);
                }
                if(res.code=='00002'){
                    alert(res.msg);
                }
            },'json');
            return;
        }
        alert('请输入正确的手机号');
        return;
    })





</script>
