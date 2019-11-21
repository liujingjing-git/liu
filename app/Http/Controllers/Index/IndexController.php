<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;

class IndexController extends Controller
{
   /*查询列表页*/
   public function index(){
      $data=Goods::paginate(4);
      return view('index.index.index',['data'=>$data]);
   }
   /*查询出商品详情页的数据*/
   public function proinfo($goods_id){
      $goodsInfo=Goods::where('goods_id',$goods_id)->first();
      return view('index.index.proinfo',['goodsInfo'=>$goodsInfo]);
   }
   /*加入购物车*/
   public function car(){
      /*测试session是否有值*/
      if(session()->has('user_id')){
         $goods_id=request()->goods_id;
         $buy_number=request()->buy_number;
         $user_id=session('user_id');
         $add_price=Goods::where('goods_id',$goods_id)->value('goods_price');
         $where=[
            ['goods_id','=',$goods_id],
            ['user_id','=',$user_id],
            ['is_del','=',1]
         ];
         $cartInfo=Cart::where($where)->first(); 
         if(!empty($cartInfo)){
            $result=$this->checkGoodsNum($goods_id,$buy_number,$cartInfo['buy_number']);
            if(empty($result)){
               echo 3;exit;
            }
            //累加
            $res=$cartInfo->where($where)->update(['buy_number'=>$cartInfo['buy_number']+$buy_number,'add_time'=>time()]);
         }else{
            $result=$this->checkGoodsNum($goods_id,$buy_number,$cartInfo['buy_number']);
            if(empty($result)){
               echo 3;exit;
            }
            //添加
            $arr=['goods_id'=>$goods_id,'buy_number'=>$buy_number,'add_time'=>time(),'user_id'=>$user_id,'add_price'=>$add_price];
            $res=Cart::create($arr);
            if($res){
               echo 1;
            }else{
               echo 4;
            }
         }
      }else{
         echo 2;
      }
   }

   public function checkGoodsNum($goods_id,$buy_number,$already_number=0){
      /*根据商品id查询此商品的库存*/
      $goods_num=Goods::where('goods_id',$goods_id)->value('goods_num');
      if($buy_number+$already_number>$goods_num){
         return false;
      }else{
         return true;
      }
   }

   /*购物车列表*/
   public function cart(){
      $Info=Cart::Join('goods','cart.goods_id','=','goods.goods_id')->get();
      return view('index.index.cart',['Info'=>$Info]);
   }

   /*显示所有商品*/
   public function prolist(){
      $res=Goods::get();
      return view('index/index/prolist',['res'=>$res]);
   }

   /*确认结算*/
   public function pay(){
      return view('index/index/pay');
   }

   /*提交订单*/
   public function success(){
      return view('index/index/success');
   }

   /*重新获取小计*/
   public function xiaoji(){
      $goods_id=request()->goods_id;
      // dd($goods_id);
      $where=[
         ['goods_id','=',$goods_id]
      ];
      $goods_price=Cart::where($where)->first();
      $ser=$goods_price['add_price']*$goods_price['buy_number'];
      echo $ser;
   }
   
   /*重新获取总价*/
   public function count(){
      $user_id=session('user_id');
      $goods_id=request()->goods_id;
      $goods_id=explode(',',$goods_id);
      $where=[
          ['user_id','=',$user_id],
          ['is_del','=',1]
      ];
      $goodsInfo=Cart::where($where)->whereIn('goods_id',$goods_id)->get();
      $count=0;
      foreach($goodsInfo as $k=>$v){
          $count+=$v['add_price']*$v['buy_number'];
      }
      echo $count;
   }
   
   /*修改数据库购买数量*/
   public function change(){
         $goods_id=request()->goods_id;
         $buy_number=request()->buy_number;
         $user_id=session('user_id');
         $where=[
            ['user_id','=',$user_id],
            ['goods_id','=',$goods_id],
            ['is_del','=',1]
         ];
         $res=Cart::where($where)->update(['buy_number'=>$buy_number]);
         if($res){
            echo 1;
         }else{
            echo 2;
         }
   }

   /*删除*/
   public function cartdel(){
      $goods_id=request()->goods_id;
      $user_id=session('user_id');
      $where=[
         ['goods_id','=',$goods_id],
         ['user_id','=',$user_id],
      ];
      $res=Cart::where($where)->update(['is_del'=>2]);
      if($res){
         echo 1;
      }else{
         echo 2;
      }
   }
}
