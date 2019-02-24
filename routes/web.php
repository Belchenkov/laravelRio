<?php

Route::resource('/', 'IndexController', [
    'only' => ['index'],
    'names' => [
        'index' => 'home'
    ]
]);

Route::resource('portfolios', 'PortfolioController', [
    'parameters' => ['portfolios' => 'alias']
]);

Route::resource('articles', 'ArticlesController', [
    'parameters' => ['articles' => 'alias']
]);
Route::get('articles/cat/{cat_alias?}', [
    'uses' => 'ArticlesController@index',
    'as' => 'articlesCat'
]);

Route::resource('comment', 'CommentController', ['only' => ['store']]);

Auth::routes();

