@extends('admin.layout.header')
@section('title','商家订单列表')
@section('content')
<!-- class="layui-form" -->
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">商家订单展示</h4>
</blockquote>

<div style="padding: 15px;">
    <!-- <form class="layui-form" action="/admin/goods" style="padding-bottom: 10px;padding-left: 10px;">
        订单名称：
        <div class="layui-input-inline">
            <input type="text" name="goods_name"  class="layui-input" value="{{$goods['goods_name']??''}}" placeholder="请输入商品名称......">
        </div>
        <button type="submit" class="layui-btn">搜索</button>
    </form> -->
    <div class="layui-form">
    <table class="layui-table">

        <thead width="1000px">
            <tr>
                <th width="30px">ID</th>
                <th width="30px">订单ID</th>
                <th width="30px">订单货号</th>
                <th width="30px">用户名</th>
                <th width="30px">收件人</th>
                <th width="30px">收件地址</th>
                <th width="30px">联系电话</th>
                <th width="30px">支付方式</th>
                <th width="30px">应付价格</th>
                <th width="30px">实付价格</th>
                <th width="30px">下单时间</th>
                <th width="30px">付款状态</th>
                <th width="30px">发货状态</th>
                <th width="30px">订单留言</th>
                <th width="30px">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orderInfo as $v)
            <tr se_order_id="{{$v->se_order_id}}">
                <td>{{$v->se_order_id}}</td>
                <td>{{$v->order_id}}</td>
                <td>{{$v->order_sn}}</td>
                <td>{{$v->user_plone}}</td>
                <td>{{$v->consignee}}</td>
                <td>
                {{$v->country_name}},{{$v->province_name}},{{$v->city_name}},{{$v->district_name}},{{$v->address}}
                </td>
                <td>{{$v->tel}}</td>
                <td>{{$v->pay_name}}</td>
                <td>{{$v->total_price}}</td>
                <td>{{$v->deal_price}}</td>
                <td>{{$v->addtime}}</td>
                <td>
                    @if($v->is_paid==0)未付款
                    @elseif($v->is_paid==1)已付款
                    @else($v->is_paid==2)已取消
                    @endif
                </td>
                <td>{{$v->is_deliver==0?'未发货':'已发货'}}</td>
                <td>{{$v->order_leave}}</td>
                <td>
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
<!-- <script>
    //删除
    $(document).on('click','.del',function(){
        var goods_id = $(this).parents('tr').attr('goods_id');
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
</script> -->

@endsection
