<?php 

/**无限极分类 */
function infinite($data,$parent_id=0){
    if(!$data){
        return;
    }
     $newArray = [];
    foreach($data as $k=>$v){
        if($v->parent_id==$parent_id){
            $newArray[]= $v;
            $child=infinite($data,$v->cat_id);
            $v['child']=$child;
        }
    }
    return $newArray;
}










