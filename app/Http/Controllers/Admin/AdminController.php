<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /*展示添加页面*/
    public function create(){
        return view('admin/create');
    }

    /*执行添加*/
    public function store(){

        request()->validate([
            'admin_name' => 'required|unique:admin',
            'admin_pwd' => 'required',
        ],[
            'admin_name.required'=>'管理员姓名',
            'admin_name.unique'=>'管理员姓名已经存在',
            'admin_pwd.required'=>'管理员密码必填'
        ]);
    
        $post=request()->except('_token');
        $admin=Admin::create($post);
        if($admin->admin_id){
            return redirect('/admin/index');
        }
    }

    /*列表展示*/
    public function index(){
        $admin_name=request()->admin_name;
        // dump($admin_name);
        $where=[];
        if($admin_name){
             $where[]=['admin_name','like',"%$admin_name%"];
        }
        $admin=new Admin;
        $res=$admin->where($where)->paginate(3);
        $query=request()->all();
        return view('admin/index',['res'=>$res,'query'=>$query]);
    }

    /*删除*/
    public function delete($id){
        if(!$id){
            abort(404);
        }
        $res=Admin::destroy($id);
        if($res){
            return redirect('admin/index');
        }
    }

    /*修改视图*/
    public function edit($id){
        $data=Admin::where('admin_id',$id)->first();

        return view('admin/edit',['data'=>$data]);
    }

    /*执行修改*/
    public function update($id){
        request()->validate([
            'admin_name' => 'required',
            'admin_pwd' => 'required',
        ],[
            'admin_name.required'=>'管理员名称',
            'admin_pwd.required'=>'管理员密码必填'
        ]);
        
        $post=request()->except('_token');
        Admin::where('admin_id',$id)->update($post);
        return redirect('/admin/index');
    }
}