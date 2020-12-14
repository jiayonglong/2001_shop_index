<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsAttrModel;
use App\Model\CartgoryModel;
use App\Model\BrandModel;
use App\Model\GoodsTypeModel;
use App\Model\GoodsModel;
use App\Model\UserModel;
use App\Model\Goods_AttrModel;
use App\Model\Goods_GalleryModel;
use App\Model\ProductModel;
use App\Model\Se_Order_InfoModel;
use App\Model\UseraddressModel;
use Illuminate\Support\Facades\DB;
use Carbon\Traits\Timestamp;
class GoodsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $user=session('seuser_id');
        $goods=GoodsModel::where(["is_static"=>1,'seuser_id'=>$user])->get();
        return view('admin.goods.list',['goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function goods()
    {
        $data = CartgoryModel::all();
        $Ecsbrand = BrandModel::all();
        $type = GoodsTypeModel::all();
        // dd($data);
        $weight_list =  $this->weightTrees($data);
        // dd($weight_list);
        return view('admin.goods.create',['weight_list'=>$weight_list,'Ecsbrand'=>$Ecsbrand,'type'=>$type]);
    }

    public function weightTrees($data,$parent_id=0,$level=0){
        if(!$data){
            return;
        }
       static  $res = [];
        foreach ($data as $key => $value) {
          if($value['parent_id'] == $parent_id){
              $value['level'] = $level;
              $res[] = $value;
              $this->weightTrees($data,$value['cat_id'],$level+1);
          }
        }
        return $res;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                $attr_id_list = $request->input('attr_id_list')??[];
                $attr_value_list = $request->input('attr_value_list')??[];
                $attr_price_list = $request->input('attr_price_list')??[];
                $goods_imgs = $request->input('goods_imgs')??[];
                $promote_start_date = $request->input('promote_start_date');
                $promote_end_date = $request->input('promote_end_date');
                $data = $request->except(['attr_id_list','attr_value_list','attr_price_list','goods_imgs']);
                $seuser_id=session('seuser_id');
                    //  print_r($data);
                    $goods = [
                        "goods_name" => $data['goods_name'],
                        "cat_id" => $data['cat_id'],
                        "brand_id" => $data['brand_id'],
                        "shop_price" => $data['shop_price'],
                        "goods_img"=> $data['goods_img'],
                        "goods_thumb" => $data['goods_thumb'],
                        "goods_desc" => $data['goods_desc'],
                        "goods_sn" => $data['goods_sn']?$data['goods_sn']:$this->addProduct(),
                        "goods_number" => $data['goods_number'],
                        "warn_number" => $data['warn_number'],
                        "is_best" => $data['is_best'],
                        "is_new" => $data['is_new'],
                        "promote_start_date" => strtotime($promote_start_date),
                        "promote_end_date" => strtotime($promote_end_date),
                        'seuser_id' => $seuser_id?$seuser_id:''
                    ];
                $goods_id = GoodsModel::insertGetId($goods);
                // print_r($goods_id);
                if(!$goods_id){
                    return false;
                }
                if(count($attr_id_list) && count($attr_value_list)){
                    // echo 1111;
                         $data = [];
                        for($i=0; $i< count($attr_id_list); $i++){
                            $data[] = [
                                'goods_id' => $goods_id,
                                'attr_id' => $attr_id_list[$i],
                                'attr_value' => $attr_value_list[$i],
                                'attr_price' => $attr_price_list[$i],
                            ];
                        }
                      Goods_AttrModel::insert($data);
                }
                $arr = [];
                foreach($goods_imgs as $v){
                    $arr[] = [
                        'goods_id' => $goods_id,
                        'img_url' => $v,
                    ];
                }
                Goods_GalleryModel::insert($arr);
                //判断是否有规格
                $goods_sper= $this->Attrnum($goods_id);
                // print_r($goods_sper);
                if(count($goods_sper)){
                    $new_goods_sper = [];
                    foreach($goods_sper as $k=>$v){
                        $new_goods_sper['attr_name'][$v['attr_id']] = $v['attr_name'];
                        $new_goods_sper['attr_value'][$v['attr_id']][$v['goods_attr_id']] = $v['attr_value'];
                    }
                    //  dd($new_goods_sper);
                        $goods = GoodsModel::select('goods_id','goods_name','goods_sn')
                                 ->where('goods_id',$goods_id)
                                 ->first();
                        return view('admin.goods.product',['goods_sper'=>$new_goods_sper,'goods_id'=>$goods_id,'goods'=>$goods]);
                }
    }

        public function pruct(){
            $post = request()->all();
            if(count($post['attr'])){
                $attr = $post['attr'];
                // dump($post);
                $firstkey = array_key_first($attr);
                $count = count($attr[$firstkey]);
                for($i = 0; $i<$count; $i++){
                    $new_attr[] = array_column($attr,$i);
                }

                $product = [];
                foreach($new_attr as $k=>$v){
                    $product[] = [
                        'goods_id' => $post['goods_id'],
                        'goods_attr' => implode('|',$v),
                        'product_sn' => $post['product_sn'][$k]?:$this->addProduct(),
                        'product_number' => $post['product_number'][$k]?:'1',
                    ];
                }
                $srt = SeproductModel::insert($product);
                //dd($srt);
                if($srt){
                    return redirect('/list');
                }else{
                    echo "<script>alert('操作繁忙请稍后重试');location.href='/goods/create'</script>";

                }
            }
        }

        public function addProduct(){
            return 'ECS'.time().rand(1000,9999);
        }

     //文件上传
     public function upload(Request $request)
     {
         //接收文件上传的值
         $photo = $request->file();
         //判断文件上传是否有文件或者有没有出错
         if ($request->hasFile('file') && $request->file('file')->isValid()) {
         $photo = $request->file('file');
 //        dd($photo);
         //文件上传
         $store_result = $photo->store("upload");
             $store_results = '/'.$store_result;
         //返回json
         if($request->ajax()){
            return json_encode(['code'=>0,'msg'=>'上传成功','data'=>['src'=>$store_results,'title'=>'']]);
         }
         return $store_results;
 //            dd($store_result);die;
             // return $this->JsonResponse('0','上传成功',$store_results);

         }
         return json_encode(['code'=>1,'msg'=>'文件上传失败']);

     }
      //文件上传

    public function uploads(Request $request)
    {
        //接收文件上传的值
        $photo = $request->file();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $photo = $request->file('file');
        //文件上传
        $store_result = $photo->store("upload");
            $store_results = '/'.$store_result;
            return json_encode(['code'=>0,'msg'=>'上传成功','data'=>$store_results]);
        }
        return json_encode(['code'=>1,'msg'=>'文件上传失败']);

    }
    

    public function getattr(Request $request){
        $cat_id = $request->all();
        $attr = GoodsAttrModel::where('cat_id',$cat_id)->get();
        // dd($attr);
        return view('admin.goods.typeattr',['attr'=>$attr]);
    }


    public function Attrnum($goods_id){
            $res =  Goods_AttrModel::select('goods_attr_id','sh_goods_attr.attr_id','sh_attribute.attr_name','sh_goods_attr.attr_value')
                    ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
                    ->where(['goods_id'=>$goods_id,'attr_type'=>1])
                    ->get();
            return $res ? $res->toArray() : [];

    }
    public function item($id){
        //$goods = GoodsModel::find($id);
        return view('admin.goods.jyl');
    }

    /**商家订单列表展示 */
    public function mercharordertlist(){

        $orderInfo = Se_Order_InfoModel::leftjoin('sh_user','sh_se_order_info.user_id','=','sh_user.user_id')->orderBy('se_order_id','desc')->paginate(3);
        // print_r($orderInfo);die;
        
        return view('admin.goods.mercharordertlist',['orderInfo'=>$orderInfo]);
    }
}
