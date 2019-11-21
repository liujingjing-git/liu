<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Car;

class ArticleController extends Controller
{
    /*显示添加视图*/
    public function create(){
        $res=Car::get();
        return view('article/create',['res'=>$res]);
    }
    /*执行添加方法*/
    public function store(){
        request()->validate([
            'a_name'=>'required|unique:article',
            'a_pop'=>'required',
            'a_opp'=>'required',
            'c_id'=>'required',
        ],[
            'a_name.required'=>'文章标题必须填写',
            'a_name.unique'=>'文章标题已经存在了',
            'a_pop.required'=>'必须选一个',
            'a_opp.required'=>'必须选一个',
            'c_id.required'=>'请选择一个',
        ]);

        $post=request()->except('_token');
        if(request()->hasFile('a_file')) {
            $post['a_file']=$this->upload('a_file');
        }
        $data=Article::create($post);
        if($data){
            return redirect('article/index');
        }
    }

    /*展示列表*/
    public function index(){
        $res=Car::get();
        $a_name=request()->a_name;
        $where=[];
        if($a_name){
            $where[]=['a_name','like',"%$a_name%"];
        };
        $Article=new Article;
        $data=$Article::Join('Car','article.c_id','=','car.c_id')->where($where)->paginate(2);
        return view('article/index',['data'=>$data,'a_name'=>$a_name,'res'=>$res]);
    }
   
    /*上传文件*/
    public function upload($file)
    {
        $file = request()->file($file);
        $path = $file->store('public');
        $path=strstr($path,'/');
        return $path;
    }
    
    /*删除*/
    public function del($id){
       if(!$id){
           abort(404);
       }
       $res=Article::destroy($id);
       if($res){
           return redirect('article/index');
       }
    }
    
    /*展示修改视图*/
    public function edit($a_id){
        // dd($a_id);
        // if(!$id){
        //     return;
        // }
        $res=Car::get();
        $data=Article::where('a_id',$a_id)->first();
        return view('article/edit',['data'=>$data,'res'=>$res]);
    }

    /*执行修改*/
    public function update($a_id){
        // dd($a_id);
        $post=request()->except('_token');
        if(request()->hasFile('a_file')) {
            $post['a_file']=$this->upload('a_file');
        }
        $data=Article::where('a_id',$a_id)->update($post);
        // dd($data);
        if($data){
            return redirect('article/index');
        }
    }
}
