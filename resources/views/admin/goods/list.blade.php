@extends('admin.layout.header')
@section('title','商品列表')
@section('content')
<!-- class="layui-form" -->
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">商品展示</h4>
</blockquote>

<div style="padding: 15px;">
    <form class="layui-form" action="/admin/goods" style="padding-bottom: 10px;padding-left: 10px;">
        商品名称：
        <div class="layui-input-inline">
            <input type="text" name="goods_name"  class="layui-input" value="{{$goods['goods_name']??''}}" placeholder="请输入商品名称......">
        </div>
        <button type="submit" class="layui-btn">搜索</button>
    </form>
    <div class="layui-form">
    <table class="layui-table">

        <thead width="1000px">
            <tr>
                <th width="30px">商品ID</th>
                <th width="100px">商品名称</th>
                <th width="50px">商品货号</th>
                <th width="50px">商品价格</th>
                <th width="50px">所属分类</th>
                <th width="50px">所属品牌</th>
                <th width="50px">商品图片</th>
                <th width="50px">商品重量</th>
                <th width="50px">商品存库</th>
                <th width="50px">库存警告数量</th>
                <th width="200px">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($goods as $v)
            <tr goods_id="{{$v->goods_id}}">
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_sn}}</td>
                <td>{{$v->shop_price}}</td>
                <td>{{$v->cat_id}}</td>
                <td>{{$v->brand_id}}</td>
                <td>@if(!empty($v->goods_img)) <img src="{{$v->goods_img}}" width="50px"> @endif </td>
                <td>{{$v->goods_weight}}</td>
                <td>{{$v->goods_number}}</td>
                <td>{{$v->warn_number}}</td>
                <td>
                <a href="/goods/jyl/{{$v->goods_id}}"><button type="button" class="layui-btn layui-btn-normal">查看</button></a>
                    <a href="/admin/goods/edit/{{$v->goods_id}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
                    <button type="button" class="layui-btn layui-btn-danger del">删除</button>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    </div>
</div>
<!-- <script src="/jquery.js"></script> -->
<script src="/static/js/jquery.min.js"></script>
<script>
    //删除
    $(document).on('click','.del',function(){
        var goods_id=$(this).parents('tr').attr('goods_id');
        if(window.confirm("确认删除吗？")){
            $.ajax({
                url:'/admin/goods/destroy',
                data:{goods_id:goods_id},
                type:'post',
                dataType:'json',
                success:function(result){
                    if(result['code']==00000){
                        alert(result['msg']);
                        location.href=result['url'];
                    }else{
                        alert(result['msg']);
                        location.href=result['url'];
                    }
                }
            })
        }
    });
    //无刷新分页
    $(document).on("click",".layui-laypage a",function(){
        var url=$(this).attr("href");
        $.get(url,function(res){
            $("tbody").html(res);
        });
        return false;
    })
</script>

@endsection
