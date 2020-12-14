<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartgoryModel extends Model
{
      protected $table = 'sh_category';
      protected $guarded = [];
      protected $primaryKey = "cat_id";

      public $timestamps = false;


      //获取分类下所有数据
      public function cart_data(){
        $data = self::where('is_show',1)->get();
        return $data;
      }

      public function cart_datas(){
        $data = self::where('is_show',1)->paginate(10);
        return $data;
      }

      //添加分类
      public function iscreate($data){
        $ret =  self::create($data);
        return $ret;
      }

      //单删查看此分类下是否存在分类
      public function is_del($cat_ids){
        $son_data = self::where('parent_id',$cat_ids)->get()->toArray();
        return $son_data;
      }

      //单删
      public function del($cat_ids){
          $del = self::where('cat_id',$cat_ids)->delete();
          return $del;
      }


      //修改
      public function cart_data_update($id){
        $update_data = self::where('cat_id',$id)->first();
        return $update_data;
      }

      //执行修改
      public function isupdate($data,$cat_id){
        $is_update = self::where('cat_id',$cat_id)->update($data);
        return $is_update;
      }

}
