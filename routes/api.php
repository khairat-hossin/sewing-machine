<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');
});

#Register and Login theough API
Route::post('login', 'API\OperatorController@login');
Route::post('register', 'API\OperatorController@register');
// Route::group(['middleware' => 'auth:api'], function(){
// Route::post('details', 'API\OperatorController@details');
// });


#Process List, Location List, Set Achievement
Route::get('processList', 'API\OperatorController@getProcessList');
Route::get('locationList', 'API\OperatorController@getLocationList');
Route::post('setAchievement', 'API\ApiController@setAchievement');
Route::get('getTarget', 'API\ApiController@getTargetValue');

#update machine status
Route::get('update_machine_status', 'API\ApiController@updateMachineStatus');
