<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cate;
use App\Brand;

class GoodsController extends Controller
{
    /*添加*/
    public function create(){
        $brandInfo=Brand::get();
        $cateInfo=Cate::get();
        $data=$this->getcateInfo($cateInfo);
        return view('goods/create',['data'=>$data,'brandInfo'=>$brandInfo]);
    }
    
    /*无限极分类*/
    public function getcateInfo($cateInfo,$parent_id=0,$level=1){
        static $info = [];
        foreach($cateInfo as $k=>$v){
            if($v['parent_id']==$parent_id){
                $v['level']=$level;
                $info[]=$v;
                $this->getcateInfo($cateInfo,$v['cate_id'],$level+1);
            }
        }
        return $info;
    }

    /*执行添加*/
    public function store(){
        $post=request()->except('_token');
        if (request()->hasFile('goods_img')) {
            $post['goods_img']=$this->upload('goods_img');
        }
        if (request()->hasFile('goods_imgs')) {
            $post['goods_imgs']=$this->upload('goods_imgs');
        }

        $goods=Goods::create($post);
        if($goods){
            return redirect('/goods/index');
        }
    }
//    /*文件上传*/
//     public function upload($file)
//     {
//         $file = request()->file($file);
//         $path = $file->store('public');
//         $path=strstr($path,'/');
//         return $path;
//     }

      /*文件上传*/
        public function upload($filename){
            if (request()->file($filename)->isValid()) {
                $photo = request()->file($filename);
                $store_result = $photo->store('upload');
                return $store_result;
            }
                exit('未获取到上传文件或上传过程出错');    
        }
      
    
    /*列表展示*/
    public function index(){
        $name=request()->name;
        $where=[];
        if($name){
            $where[]=['goods_name','like',"%$name%"];
        };
        $cate_id=request()->cate_id;
        $brand_id=request()->brand_id;

        $goods_all=Goods::where($where)->Join('brand','goods.brand_id','=','brand.brand_id')
                    ->Join('cate','goods.cate_id','=','cate.cate_id')
                    ->paginate(2);
        return view('goods/index',['goods_all'=>$goods_all]);
    }

    /*执行删除*/
    public function delete($goods_id){
        if(!$goods_id){
            abort(404);
        }
        $res=Goods::destroy($goods_id);
        if($res){
            return redirect('goods/index');
        }
    }
    /*修改的页面*/
    public function edit($goods_id){
        $brandInfo=Brand::get();
        $cateInfo=Cate::get();
        $data=Goods::where('goods_id',$goods_id)->first();
        return view('goods/edit',['data'=>$data,'brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo]);
    }

    /*执行修改的方法*/
    public function update($goods_id){
        $post=request()->except('_token');
        if (request()->hasFile('goods_img')) {
            $post['goods_img']=$this->upload('goods_img');
        }
        $data=Goods::where('goods_id',$goods_id)->update($post);
        if($data){
            return redirect('goods/index');
        }
    }
}
