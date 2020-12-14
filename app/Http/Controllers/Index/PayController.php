<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order_InfoModel;
use App\Model\Order_GoodsModel;

class PayController extends Controller
{
    
    /**支付 */
    public function pay($order_id){
        if(!$order_id){
            return false;
        }
        $config = config('alipay');

        require_once app_path('Common/lib/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('Common/lib/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');

        $order_info = Order_InfoModel::find($order_id);
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $order_info->order_sn;
        $goods_name = Order_GoodsModel::where('order_id',$order_id)->pluck('goods_name')->toArray();

        //订单名称，必填
        $subject = implode("\r\n",$goods_name);

        //付款金额，必填
        $total_amount = $order_info->total_price;

        //商品描述，可空
        $body = '';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);
    }

    /**支付宝同步跳转 */
    public function return_url(){
        
        $config = config('alipay');
       
        
        require_once app_path('Common/lib/alipay/pagepay/service/AlipayTradeService.php');

        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config); 
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            //请在这里加上商户的业务逻辑程序代码
            $count = Order_InfoModel::where(['order_sn'=>$arr['out_trade_no'],'total_price'=>$arr['total_amount']])->count();
            //2.验证订单号和订单金额
            if(!$count){
            return '发送重大事故:订单号'.$arr['out_trade_no'].'和订单金额'.$arr['total_amount'].'不在当前系统中!请联系客服';
            }
            //3、校验通知中的商家seller_id     //登录沙箱  沙箱账号 里面有商家UID
            if($arr['seller_id']!=config('alipay.seller_id')){
                return '发生重大事故:商家UID'.$arr['seller_id'].'与系统商家不符!请联系客服';
            }
            //4、验证app_id是否为该商户本身。
            if($arr['app_id']!=config('alipay.app_id')){
                return '发生重大事故:应用UID'.$arr['app_id'].'与系统商家不符!请联系客服';
            }
            //5.更改订单状态和支付状态
            $data = [
                'is_paid'=>1,    //支付状态 0待支付 1已支付
            ];
            $res = Order_InfoModel::where(['order_sn'=>$arr['out_trade_no']])->update($data);
            if($res){
                return view('pay.success',['order_sn'=>$arr['out_trade_no'],'total_price'=>$arr['total_amount']]);
            }
            
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }

    /**支付宝异步通知 */
    // public function notify_url(){
    //     // Log::info('支付宝异步通知');
    //     // die;
    //     $config = config('alipay');
    //     require_once app_path('Common/lib/alipay/pagepay/service/AlipayTradeService.php');

    //     $arr=$_POST;
    //     $alipaySevice = new \AlipayTradeService($config); 
    //     $alipaySevice->writeLog(var_export($_POST,true));
    //     $result = $alipaySevice->check($arr);

    //     /* 实际验证过程建议商户添加以下校验。
    //     1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
    //     2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
    //     3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
    //     4、验证app_id是否为该商户本身。
    //     */
    //     if($result) {//验证成功
    //     /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //     //请在这里加上商户的业务逻辑程序代
    //     $count = Order_InfoModel::where(['order_sn'=>$arr['out_trade_no'],'order_price'=>$arr['total_amount']])->count();
    //     //2.验证订单号和订单金额
    //     $error = '';
    //     if(!$count){
    //         $error ='发送重大事故:订单号'.$arr['out_trade_no'].'和订单金额'.$arr['total_amount'].'不在当前系统中!请联系客服';
    //     }
    //     //3、校验通知中的商家seller_id     //登录沙箱  沙箱账号 里面有商家UID
    //     if($arr['seller_id']!=config('alipay.seller_id')){
    //         $error = '发生重大事故:商家UID'.$arr['seller_id'].'与系统商家不符!请联系客服';
    //     }
    //     //4、验证app_id是否为该商户本身。
    //     if($arr['app_id']!=config('alipay.app_id')){
    //         $error = '发生重大事故:应用UID'.$arr['app_id'].'与系统商家不符!请联系客服';
    //     }

    //     //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        
    //     //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
        
    //     //商户订单号

    //     $out_trade_no = $_POST['out_trade_no'];

    //     //支付宝交易号

    //     $trade_no = $_POST['trade_no'];

    //     //交易状态
    //     $trade_status = $_POST['trade_status'];


    //     if($_POST['trade_status'] == 'TRADE_FINISHED') {

    //         //判断该笔订单是否在商户网站中已经做过处理
    //         //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
    //         //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
    //         //如果有做过处理，不执行商户的业务程序
                    
    //         //注意：
    //         //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
    //             }
    //             else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
    //                 //判断该笔订单是否在商户网站中已经做过处理
    //                 $data = [
    //                     'pay_status'=>2,    //支付状态1 待支付 2 已支付
    //                     'order_status'=>1      //0未确认 1 确认 2已取消 3无效 4退货
    //                 ];
    //                 $res = Order_InfoModel::where(['order_sn'=>$arr['out_trade_no']])->update($data);
    //                 if($res){
    //                     $error = "此商户订单:".$out_trade_no."同步跳转没有更新状态,异步跳转处理成功";
    //                     return redirect('/user/myorder');
    //                 }

    //                 //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
    //                 //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
    //                 //如果有做过处理，不执行商户的业务程序			
    //                 //注意：
    //                 //付款完成后，支付宝系统发送该交易状态通知
    //             }
    //             //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
    //             echo "success";	//请不要修改或删除
    //         }else {
    //             //验证失败
    //             echo "fail";

    //         }
    //}
}
