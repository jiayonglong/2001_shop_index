@extends('admin.layout.header')
@section('title','货品列表')
@section('content')
<div class="list-div" style="margin-bottom: 5px; margin-top: 10px;" id="listDiv">
<form method="post" action="{{url('/goods/pruct')}}" name="addForm" id="addForm">
<input type="hidden" name="goods_id" value="{{$goods->goods_id}}">
  <table width="100%" cellpadding="3" cellspacing="1" id="table_list">
    <tbody><tr>
      <th colspan="20" scope="col">商品名称：{{$goods->goods_name}}&nbsp;&nbsp;&nbsp;&nbsp;货号：{{$goods->goods_sn}}</th>
    </tr>
    <tr>
      <!-- start for specifications -->
      @if($goods_sper['attr_name'])
      @foreach($goods_sper['attr_name'] as $k=>$v)
            <td scope="col" style="background-color: rgb(255, 255, 255);"><div align="center"><strong>{{$v}}</strong></div></td>
      @endforeach
      @endif
            <!-- end for specifications -->
      <td class="label_2" style="background-color: rgb(255, 255, 255);">货号</td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);">库存</td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);">&nbsp;</td>
    </tr>

    
    <tr id="attr_row">
    <!-- start for specifications_value -->
      @if($goods_sper['attr_value'])
      @foreach($goods_sper['attr_value'] as $k=>$v)
        <td align="center" style="background-color: rgb(255, 255, 255);">
        <select name="attr[{{$k}}][]">
        <option value="" selected="">请选择...</option>
        @foreach($v as $kk=>$vv)
            <option value="{{$kk}}">{{$vv}}</option>
        @endforeach
        </select>
      </td>
      @endforeach
      @endif
        <!-- end for specifications_value -->

      <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="" size="20"></td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
      <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button" value=" + " onclick="javascript:add_attr_product(this);"></td>
    </tr>

    <tr>
      <td align="center" colspan="4" style="background-color: rgb(255, 255, 255);">
        <input type="submit" class="button" value=" 保存 " onclick="checkgood_sn()">
      </td>
    </tr>
  </tbody></table>
</form>
</div>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script>
function add_attr_product(obj){
    var newobj = $(obj).parent().parent().clone();
    newobj.find('.button').val(' - ');
    newobj.find('.button').attr('onclick','descSpec(this)');
    $(obj).parent().parent().after(newobj);
    layui.use(['form'], function() {
            var element = layui.element;
            var form = layui.form;
            form.render('select');
                });
}

function descSpec(obj){
    $(obj).parent().parent().remove();
}
</script>

@endsection
