<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\ImmeubleController;
use App\Admin\Controllers\StatisticController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('immeuble', ImmeubleController::class);
    $router->get('statistics', [StatisticController::class, 'index'])->name('statistics.index');


});
