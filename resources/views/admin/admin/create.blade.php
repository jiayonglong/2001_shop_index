@extends('admin.layout.header')
@section('title','商家资料')
@section('content')
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">商家资料</h4>
</blockquote>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="/static/admin/jquery.min.js"></script>
	<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">公司名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="firm_name"
                   placeholder="请输入公司名称">
        </div>   <span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">公司电话</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="firm_tel"
                   placeholder="请输入公司电话">
        </div><span style="color: darkred;"></span>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">公司地址</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="firm_address"
                   placeholder="请输入公司地址">
        </div><span style="color: darkred;"></span>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">联系人姓名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="seuser_name"
                   placeholder="请输入联系人姓名">
        </div><span style="color: darkred;"></span>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">联系人QQ</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="seuser_qq"
                   placeholder="请输入联系人QQ">
        </div><span style="color: darkred;"></span>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">联系人邮箱</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="seuser_email"
                   placeholder="请输入联系人邮箱">
        </div><span style="color: darkred;"></span>
    </div>




     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商家LOGO</label>
        <div class="layui-upload-drag" id="test10">
            <input type="hidden" id="fileview" name="firm_imgs" value="">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
                <hr>
                <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商家营业执照</label>
        <div class="layui-upload-drag" id="test1">
            <input type="hidden" id="fileview1" name="firm_img" value="">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView1">
                <hr>
                <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
        </div>
    </div>





   
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商家公司描述</label>
        <div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="firm_desc"
                    placeholder="请输入商家公司描述"></textarea>
        </div><span style="color:green"></span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
            <button type="reset" class="btn btn-default">重置</button>
            <a href="/brand/list" class="btn btn-default">前往列表</a>
        </div>
    </div>
</form>


@endsection
