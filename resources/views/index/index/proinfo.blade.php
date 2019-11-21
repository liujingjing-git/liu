@extends('layouts.shop')
@section('title', '全国最大珠宝商')
@section('content')

  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>商品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      <img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" width="636" height="822" />
      <img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_imgs}}" width="636" height="822" />
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">¥{{$goodsInfo->goods_price}}</strong></th>
       <td>
            <input type="hidden" id="goods_id" value="{{$goodsInfo->goods_id}}">
            <input type="hidden" id="add_price" value="{{$goodsInfo->goods_price}}">
            <input type="hidden" id="goods_num" value="{{$goodsInfo->goods_num}}">
            <input type="text" id="buy_number" class="spinnerExample" />
       </td>
       </tr>
      <tr>
       <td>
        <strong>{{$goodsInfo->goods_name}}</strong>
        <p class="hui">{{$goodsInfo->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">{{$goodsInfo->goods_desc}}</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:void(0)" id="car">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <!--焦点轮换-->
    <script src="js/jquery.excoloSlider.js"></script>
    <script>
      $(function () {
          $("#sliderA").excoloSlider();
      });
    </script>
     <!--jq加减-->
    <!-- <script src="js/jquery.spinner.js"></script> -->
    <script>
      $('.spinnerExample').spinner({});
    </script>
  <script src='/static/admin/js/jquery-3.1.1.min.js'></script>
      <script>
        $(function(){
            var buy_number=$("#buy_number").val();
            var goods_num=$("#goods_num").val();
           
            /*点击加号*/
            $(document).on("click",".increase",function(){
                var buy_number=$("#buy_number").val();
                if(buy_number>goods_num){
                    alert('超过最大库存');
                    var buy_number=$("#buy_number").val(goods_num);
                    return false;
                }
            })
            
            /*点击加入购物车*/
            $(document).on("click","#car",function(){
                var goods_id=$("#goods_id").val();
                var buy_number=$("#buy_number").val();
                if(buy_number<1){
                    alert('请至少选择一件');
                    return false;
                }
                $.post(
                      "{{url('index/car')}}",
                      {goods_id:goods_id,buy_number:buy_number,_token:"{{csrf_token()}}"},
                      function(res){ 
                        /*检测是否登录 未登录提示用户未登录*/    
                          if(res==2){
                              alert("请先去登录")
                              location.href="{{url('login')}}"
                          }else if(res==3){
                             alert('此商品已超过库存');
                          }else if(res==4){
                             alert('加入购物车失败');
                          }
                      }
                  )
              })
        })
      </script>
    @include('index.public.footer')
    @endsection