@include('admin.layout.header')

<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">商家资料展示</h4>
</blockquote>

<div style="padding: 15px;">
    <div class="layui-form" >
    <table class="layui-table" style="margin-left:14%">

        <thead width="1000px">
            <tr>
                <th width="30px">商家ID</th>
                <th width="100px">公司名称</th>
                <th width="50px">公司电话</th>
                <th width="50px">公司地址</th>
                <th width="50px">联系人姓名</th>
                <th width="50px">联系人QQ</th>
                <th width="50px">联系人邮箱</th>
                <th width="50px">商家营业执照</th>
                <th width="50px">公司简绍</th>
            </tr>
        </thead>
        <tbody>
        @foreach($aes as $k=>$v)
                <td>{{$v->firm_id}}</td>
                <td>{{$v->firm_name}}</td>
                <td>{{$v->firm_tel}}</td>
                <td>{{$v->firm_address}}</td>
                <td>{{$v->seuser_name}}</td>
                <td>{{$v->seuser_qq}}</td>
                 <td>{{$v->seuser_email}}</td>
                <td>@if(!empty($v->firm_img)) <img src="{{$v->firm_img}}" width="50px"> @endif </td>
                <td>{{$v->firm_desc}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
    </div>
</div>