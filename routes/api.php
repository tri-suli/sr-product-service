<?php

use App\Http\Controllers\FullRestApi\Categories;
use App\Http\Controllers\FullRestApi\Products;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'as' => 'api'], function (Router $routerGroup) {
    $routerGroup->prefix('categories')->name('.category')->group(function (Router $router) {
        $router->get('/', Categories\ListController::class)->name('.list');
        $router->get('find/{id}', Categories\ShowController::class)->name('.show');
        $router->post('/', Categories\StoreController::class)->name('.store');
        $router->patch('{id}', Categories\UpdateController::class)->name('.update');
        $router->delete('/', Categories\DeleteController::class)->name('.delete');
    });
    
    $routerGroup->prefix('products')->name('.product')->group(function (Router $router) {
        $router->get('/', Products\ProductsController::class)->name('.all');
        $router->get('find/{id}', Products\ShowController::class)->name('.show');
        $router->post('/', Products\StoreController::class)->name('.store');
        $router->patch('{id}', Products\UpdateController::class)->name('.update');
        $router->delete('/', Products\DeleteController::class)->name('.delete');
    });
});
