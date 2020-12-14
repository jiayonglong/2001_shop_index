<header id="head">
  <!--topNavBg-->
  <div class="topNavBg">
   <div class="wrap">
   <!--topLeftNav-->
    <ul class="topLtNav">
                        @php  use Illuminate\Support\Facades\Redis; @endphp
                        @php  $user_id=Redis::hmget('reg','user_id','user_plone'); @endphp
                           @if($user_id[0]==false||$user_id[1]==false||empty($user_id))
                             <li  class="obviousText"><a href="{{url('/login')}}">亲，请登录</a></li>
                             <li class="obviousText"><a href="{{url('/reg')}}" >没有账号？注册</a></li>

                             @else 
                             <li><span>欢迎@php echo $user_id[1]@endphp登录</span></li>
                             <li><span><a href="/logout">切换账号</a></span></li>

                          @endif
    </ul>
   <!--topRightNav-->
    <ul class="topRtNav">
     <li><a href="{{url('/ser')}}">个人中心</a></li>


     @if($user_id[0]==false||$user_id[1]==false||empty($user_id))
     <li><a href="{{url('/cart')}}" class="cartIcon">购物车<i class="cou">请登录</i></a></li>
     @else
     <li><a href="{{url('/cart')}}" class="cartIcon">购物车<i class="cou">{{request()->count_cart['data']}}</i></a></li>
     @endif


     @if($user_id[0]==false||$user_id[1]==false||empty($user_id))
     <li><a href="{{url('/favorite')}}" class="cartIcon">收藏夹<i class="cou">请登录</i></a></li>
     @else
     <li><a href="{{url('/favorite')}}" class="favorIcon">收藏夹</a></li>
     @endif

     <li><a href="{{url('/business')}}">商家中心</a></li>
    </ul>
   </div>
  </div>
  <!--logoArea-->
  <div class="wrap logoSearch">
   <!--logo-->
   <div class="logo">
    <h1><img src="https://image.16pic.com/00/53/13/16pic_5313999_s.jpg?imageView2/0/format/png"/></h1>
   </div>
   <!--search-->
   <div class="search">
    <ul class="switchNav">
     <li class="active" id="chanpin">产品</li>
     <li id="shangjia">商家</li>
    </ul>
    <div class="searchBox">
     <form action="/search" method="post">
      <div class="inputWrap">
      <input type="hidden" value="1" name="search_type">
      <input type="text" name="search_val" placeholder="输入产品关键词或货号"/>
      </div>
      <div class="btnWrap">
      <input type="submit" value="搜索"/>
      </div>
     </form>
    </div>
   </div>
  </div>
  <!--nav-->
  <nav>
    <ul class="wrap navList">
      <li class="category">
        <a>全部产品分类</a>
        <dl class="asideNav indexAsideNav">
        @foreach(request()->cartgoryInfo as $v)
        <dt><a href="{{url('list/'.$v['cat_id'])}}">{{$v['cat_name']}}</a></dt>
          <dd>
            @foreach($v['child'] as $vv)
            <a href="{{url('list/'.$vv['cat_id'])}}">{{$vv['cat_name']}}</a>
            @endforeach
          </dd>
          @endforeach
        </dl>
      </li>

      <li>
          <a href="{{url('/')}}" class="active">首页</a>
      </li>

        @foreach(request()->cartgoryInfo as $v)
          <li>
          <a href="{{url('list/'.$v['cat_id'])}}">{{$v['cat_name']}}</a>
          </li>
          @endforeach
         
      </ul>
  </nav>

 </header>
