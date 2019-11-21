<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
//->middleware('auth')
    /*后台路由*/
    // Route::domain('lava.com')->group(function(){
        /*品牌  路由*/
        Route::prefix('/brand')->group(function(){
            Route::get('create','Admin\BrandController@create');
            Route::post('store','Admin\BrandController@store');
            Route::get('index','Admin\BrandController@index');
            Route::get('delete/{id}','Admin\BrandController@destroy');
            Route::get('edit/{id}','Admin\BrandController@edit');
            Route::post('update/{id}','Admin\BrandController@update');
            Route::post('checkOnly','Admin\BrandController@checkOnly');
        });

        /*管理员路由*/
        Route::prefix('/admin')->group(function(){
            Route::any('create','Admin\AdminController@create');
            Route::any('store','Admin\AdminController@store');
            Route::any('index','Admin\AdminController@index');
            Route::any('delete/{id}','Admin\AdminController@delete');
            Route::any('edit/{id}','Admin\AdminController@edit');
            Route::any('update/{id}','Admin\AdminController@update');
        });

        /*分类路由*/
        Route::prefix('/cate')->group(function(){
            Route::any('create','Admin\CateController@create');
            Route::any('store','Admin\CateController@store');
            Route::any('index','Admin\CateController@index');
            Route::any('delete/{id}','Admin\CateController@delete');
            Route::any('edit/{id}','Admin\CateController@edit');
            Route::any('update/{id}','Admin\CateController@update');
        });

        /*商品路由*/
        Route::prefix('/goods')->group(function(){
            Route::any('create','Admin\GoodsController@create');
            Route::any('store','Admin\GoodsController@store');
            Route::any('index','Admin\GoodsController@index');
            Route::any('delete/{goods_id}','Admin\GoodsController@delete');
            Route::any('edit/{goods_id}','Admin\GoodsController@edit');
            Route::any('update/{goods_id}','Admin\GoodsController@update');
        });

        /*周考路由*/
        Route::prefix('/article')->group(function(){
            Route::any('create','Admin\ArticleController@create');
            Route::any('store','Admin\ArticleController@store');
            Route::any('index','Admin\ArticleController@index');
            Route::any('del/{id}','Admin\ArticleController@del');
            Route::any('edit/{id}','Admin\ArticleController@edit');
            Route::any('update/{id}','Admin\ArticleController@update');
        });
    // });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

/*登陆注册*/
// Route::view('/login','add')->name('login');
// Route::post('/dologin','Admin\RegController@dologin');
// Route::view('/reg','reg');
// Route::post('/doReg','Admin\RegController@doReg');




 /*前台*/
  Route::get('/index','Index\IndexController@index');//首页
  Route::view('/login','index.login.login');//登陆
  Route::view('/reg','index.login.reg');//注册

  Route::post('/send','Index\LoginController@send');
  Route::post('/regdo','Index\LoginController@regdo');
  Route::post('/logindo','Index\LoginController@logindo');

  Route::prefix('/index')->group(function(){
        Route::any('proinfo/{goods_id}','Index\IndexController@proinfo');
        Route::any('car','Index\IndexController@car');//执行添加
        Route::any('cart','Index\IndexController@cart');//购物车列表
        Route::any('prolist','Index\IndexController@prolist');//所有商品
        Route::any('pay','Index\IndexController@pay');//提交订单
        Route::any('success','Index\IndexController@success');//结算页
        Route::any('count','Index\IndexController@count');//获取总价
        Route::any('xiaoji','Index\IndexController@xiaoji');//获取小计
        Route::any('change','Index\IndexController@change');//修改数据库购买数量
        Route::any('cartdel','Index\IndexController@cartdel');//执行添加
  });
