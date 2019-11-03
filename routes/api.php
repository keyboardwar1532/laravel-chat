<?php
Route::group([
    'middleware' => ['cors'],
], function () {
    Route::apiResource('/question', 'QuestionController');
    Route::apiResource('/category', 'CategoryController');
    Route::apiResource('/question/{question}/reply', 'ReplyController');
    Route::post('/like/{reply}','LikeController@LikeIt');
    Route::delete('/like/{reply}','LikeController@unLikeIt');
});

//jwt
Route::group(['middleware' => ['cors'],'prefix' => 'auth',], function () {
    Route::get('/me', 'AuthController@me');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('signup', 'AuthController@signup');
});

Route::get(('jwterror'), function (){
    return response()->json(['error' => 'unauthenticated']);
    })->name('jwterror');