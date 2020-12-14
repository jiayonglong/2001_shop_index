<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台布局</title>

  <link rel="stylesheet" href="/static/admin/css/layui.css">

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img src="/static/admin/images/111.png" height="60px" width="200px"></div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="/index">控制台</a></li>
      <li class="layui-nav-item"><a href="/list">商品管理</a></li>
      <li class="layui-nav-item"><a href="/addindex">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
          
          {{session('seuser_plone')}}
          <!-- session(['seuser_plone'=>$admin->seuser_plone]); -->
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/loginout">退出</a></li>
    </ul>
  </div>

  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item">
          <a class="" href="javascript:;">商户商品管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/goods">添加商品</a></dd>
            <dd><a href="/list">商品列表</a></dd>
          </dl>
        </li>
         <li class="layui-nav-item">
          <a class="" href="javascript:;">订单管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/mercharordertlist">订单列表</a></dd>
          </dl>
        </li>
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">@yield('content')</div>
  </div>

  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<!-- <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script> -->
<script src="/static/admin/layui.js"></script>
<script src="/static/admin/jquery.min.js"></script>
<script>

//JavaScript代码区域
layui.use(['element','form','layedit'], function(){
  var element = layui.element,
      form = layui.form;
      var layedit = layui.layedit;
       //日期
      layedit.set({
      uploadImage: {
        url: '/upload' //接口url
        ,type: 'post' //默认post
        ,height: 800 //设置编辑器高度
        ,width : 1000
      }
    });
      layedit.build('demo'); //建立编辑器

});

layui.use(['laydate'], function(){
   var laydate = layui.laydate;

  //日期
  laydate.render({
    elem: '#date1'
  });
  laydate.render({
    elem: '#date'
  });

});




layui.use(['layer', 'jquery', 'form'], function () {
			var layer = layui.layer,
					$ = layui.jquery,
					form = layui.form;
          form.on('select(demo)', function(data){
            var cat_id = data.value;
            if(!cat_id){
              return;
            }
            $.get('/getattr',{cat_id:cat_id},function(ret){
                  $('#attrTable').html(ret);
                  layui.use(['element','form'], function() {
            var element = layui.element;
            var form = layui.form;
            form.render();
        });
      });
});

});
layui.use('upload', function(){
    var $ = layui.jquery,upload = layui.upload;

    //拖拽上传
    upload.render({
        elem: '#test10'
        ,url: 'http://2001.shop.index.com/uploads' //改成您自己的上传接口
        ,done: function(res){
            layer.msg(res.msg);
            layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.data);
            layui.$('#fileview').attr('value',res.data);
        }
    });


    upload.render({
        elem: '#test1'
        ,url: 'http://2001.shop.index.com/uploads' //改成您自己的上传接口
        ,done: function(res){
            layer.msg(res.msg);
            layui.$('#uploadDemoView1').removeClass('layui-hide').find('img').attr('src', res.data);
            layui.$('#fileview1').attr('value',res.data);
        }
    });


     //多图片上传
   upload.render({
    elem: '#test2'
    ,url: 'http://2001.shop.index.com/uploads' //改成您自己的上传接口
    ,multiple: true
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
       // $('#demo2').append('<img src="'+ res.data +'" alt="'+ res.data +'" class="layui-upload-img">')
      });
    }
    ,done: function(res){
      //上传完毕
       // console.log(res);
       layer.msg(res.msg);
      //  console.log(res.data)
        $('#demo2').append('<img src="'+ res['data'] +'" alt="'+ res['data'] +'"  class="layui-upload-img" id="goods_imgs" Width="100px" hight="100px">')
        $('#demo2').append('<input type="hidden"  name="goods_imgs[]" value="'+res['data']+'">')
    }
  });
});








</script>
</body>
</html>
