<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cate;

class CateController extends Controller
{
    /*展示添加视图*/
    public function create(){
        $cateInfo=Cate::get();
        $data=$this->getcateInfo($cateInfo);
        return view('cate/create',['data'=>$data]);
    }
    /*执行添加*/
    public function store(){
        /*验证唯一性 非空*/
        request()->validate([
            'cate_name'=>'required|unique:cate',
        ],[
            'cate_name.required'=>'分类名称必填',
            'cate_name.unique'=>'分类名称不能重复添加'
        ]);


        $post=request()->except('_token');
        $cate=Cate::create($post);
        if($cate->cate_id){
            return redirect('/cate/index');
        }
    }
    /**无限极分类 */
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

    /*列表*/
    public function index(){
        $cate_name=request()->cate_name;
        $where=[];
        if($cate_name){
            $where[]=['cate_name','like',"%$cate_name%"];
        }
        $Cate=new Cate;
        $res=$Cate::where($where)->paginate(8);
        $query=request()->all();
        return view('cate/index',['res'=>$res,'query'=>$query]);
    }

    /*删除*/
    public function delete($id){
        if(!$id){
            abort(404);
        }
        $res=Cate::destroy($id);
        if($res){
            return redirect('cate/index');
        }
    }
    /*修改视图*/
    public function edit($id){
        $cateInfo=Cate::get();
        $data=Cate::where('cate_id',$id)->first();
        return view('cate/edit',['data'=>$data,'cateInfo'=>$cateInfo]);
    }

    /*执行修改*/
    public function update($id){
       $post=request()->except('_token');
       Cate::where('cate_id',$id)->update($post);
       return redirect('cate/index');
    }
}
