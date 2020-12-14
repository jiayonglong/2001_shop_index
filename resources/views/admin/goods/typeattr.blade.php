    <tbody> 



    @foreach($attr as $k=>$v)
    @if($v->attr_type == 0 && $v->attr_input_type == 0)
               
            <tr>
            <td class="label">{{$v->attr_name}}</td>
            <td>
                <input type="hidden" name="attr_id_list[]" value="{{$v->attr_id}}">
                <input  name="attr_value_list[]" type="text" value="" size="40">
                <input type="hidden" name="attr_price_list[]" value="0">
            </td>
        </tr>
    @endif
    @if($v->attr_type == 0 && $v->attr_input_type == 1)
    @php
        $attr_values = explode("\r\n",$v->attr_values);
    @endphp
        <tr>
            <td class="label">{{$v->attr_name}}</td>
            <td><input type="hidden" name="attr_id_list[]" value="{{$v->attr_id}}">
                <select name="attr_value_list[]">
                    <option value="">请选择...</option>
                    @foreach($attr_values as $vv)
                    <option value="{{$vv}}">{{$vv}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="attr_price_list[]" value="0">
            </td>
        </tr>
    @endif
    @if($v->attr_type == 1 && $v->attr_input_type == 0)
        <tr>
            <td class="label"><a href="javascript:;" onclick="addSpec(this)">[+]</a>{{$v->attr_name}}</td>
            <td>
                <input type="hidden" name="attr_id_list[]" value="{{$v->attr_id}}">
                <input name="attr_value_list[]" type="text" value="" size="40">
                属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">
            </td>
        </tr>
    @endif
    @if($v->attr_type == 1 && $v->attr_input_type == 1)
    @php
        $attr_values = explode("\r\n",$v->attr_values);
    @endphp
        <tr>
            <td class="label"><a href="javascript:;" onclick="addSpec(this)">[+]</a>{{$v->attr_name}}</td>
            <td>
                <input type="hidden" name="attr_id_list[]" value="{{$v->attr_id}}">
                <select name="attr_value_list[]">
                    <option value="">请选择...</option>
                    @foreach($attr_values as $vv)
                    <option value="{{$vv}}">{{$vv}}</option>
                    @endforeach
                </select>
                属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">
            </td>
        </tr>
        @endif
        @endforeach

    </tbody>
