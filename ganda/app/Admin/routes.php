<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/category', CategoryController::class);
    $router->resource('/subCategory', SubCategoryController::class);
    $router->resource('/product', ProductController::class);
    $router->resource('/prodDesc', ProdDescController::class);
    $router->resource('/user', UserController::class);
    $router->resource('/item', ItemController::class);
    $router->resource('/cart', CartController::class);
    $router->resource('/orderDetail', OrderDetailController::class);
    $router->resource('/itemDesc', ItemDescController::class);
    $router->resource('/order', OrderController::class);
    $router->resource('/history', HistoryController::class);

});
