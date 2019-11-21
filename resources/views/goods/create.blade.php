<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
    <script src="{{asset('/static/admin/js/jquery-3.1.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>商品</title>
</head>
<body>
<center><h3>商品添加</h3></center>
<form action="{{url('goods/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品名称</label>
            <div class="col-sm-10">
                <input type="text" name="goods_name" class="form-control" id="firstname"  placeholder="请输入商品名称">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品价格</label>
            <div class="col-sm-10">
                <input type="text" name="goods_price" class="form-control" id="firstname"  placeholder="请输入商品价格">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品库存</label>
            <div class="col-sm-10">
                <input type="text" name="goods_num" class="form-control" id="firstname"  placeholder="请输入商品库存">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品详情</label>
            <div class="col-sm-10">
                <textarea name="goods_desc" cols="30px" rows="10px"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品图片</label>
            <div class="col-sm-10">
                <input type="file" name="goods_img" class="form-control" id="firstname">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品相册</label>
            <div class="col-sm-10">
                <input type="file" name="goods_imgs" class="form-control" id="firstname">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">新品</label>
            <div class="col-sm-10">
               <input type="radio" name="is_new" value="1" checked="checked">是
               <input type="radio" name="is_new" value="2">否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">精品</label>
            <div class="col-sm-10">
               <input type="radio" name="is_best" value="1" checked="checked">是
               <input type="radio" name="is_best" value="2">否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">热卖</label>
            <div class="col-sm-10">
               <input type="radio" name="is_hot" value="1" checked="checked">是
               <input type="radio" name="is_hot" value="2">否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">上架</label>
            <div class="col-sm-10">
               <input type="radio" name="is_up" value="1" checked="checked">是
               <input type="radio" name="is_up" value="2">否
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌</label>
            <div class="col-sm-10" >
                <select name="brand_id">
                    <option value="">--请选择--</option>
                    @foreach($brandInfo as $v)
                        <option value="{{$v->brand_id}}">{{str_repeat('--',$v['level'])}}{{$v->brand_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">分类</label>
            <div class="col-sm-10" >
            <select name="cate_id">
                <option value="">--请选择--</option>
                    @foreach($data as $v)
                        <option value="{{$v->cate_id}}">{{str_repeat('--',$v['level'])}}{{$v->cate_name}}</option>
                    @endforeach
            </select>            
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" id="submit" class="btn btn-default" value="提交">
            </div>
        </div>
</form>
</body>
</html>