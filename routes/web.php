<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    Route::get('machine', 'MachineController@index')->name('machine');
    Route::get('machine/get_error_history', 'MachineController@getErrorHistory')->name('machine.error.history');
    Route::get('machine/download_pdf', 'MachineController@downloadMachinePdf')->name('machine.download.pdf');
    //mahcine status
    Route::get('machine_status', 'MachineController@status')->name('machine_status');

    //NPT
    Route::get('npt', 'NptController@index')->name('npt');
    Route::get('npt_by_date', 'NptController@nptByDate')->name('npt_by_date');
    Route::get('npt_by_date/pdf', 'NptController@nptByDatePDF')->name('npt_by_date.pdf');
    //Operating Status
    Route::get('operating_status', 'OperatingStatusController@index')->name('operating_status');

   /*
		* Setup Routes *
   */
    // Location Setup Routes
	Route::get('setup/location', 'Setup\LocationController@index')->name('setup.location');
	Route::get('setup/location/create', 'Setup\LocationController@addLocation')->name('setup.location.create');
	Route::post('setup/location/store', 'Setup\LocationController@storeLocation')->name('setup.location.store');
    Route::get('setup/location/edit/{id}', 'Setup\LocationController@editLocation')->name('setup.location.edit');
    Route::post('setup/location/update', 'Setup\LocationController@updateLocation')->name('setup.location.update');
    Route::get('setup/location/view/{id}', 'Setup\LocationController@viewLocation')->name('setup.location.view');
    Route::get('setup/location/delete/{id}', 'Setup\LocationController@deleteLocation')->name('setup.location.delete');

    // Line setup Routes
    Route::get('setup/line', 'Setup\LineController@index')->name('setup.line');
    Route::get('setup/line/create', 'Setup\LineController@create')->name('setup.line.create');
    Route::post('setup/line/store', 'Setup\LineController@storeLine')->name('setup.line.store');
    Route::get('setup/line/edit/{id}', 'Setup\LineController@editLine')->name('setup.line.edit');
    Route::post('setup/line/update', 'Setup\LineController@updateLine')->name('setup.line.update');
    Route::get('setup/line/view/{id}', 'Setup\LineController@viewLine')->name('setup.line.view');
    Route::get('setup/line/delete/{id}', 'Setup\LineController@deleteLine')->name('setup.line.delete');

    // Machine Management
    Route::get('setup/machine', 'Setup\MachineController@index')->name('setup.machine');
    Route::get('setup/machine/create', 'Setup\MachineController@createMachine')->name('setup.machine.create');
    Route::post('setup/machine/store', 'Setup\MachineController@storeMachine')->name('setup.machine.store');
    Route::get('setup/machine/edit/{id}', 'Setup\MachineController@editMachine')->name('setup.machine.edit');
    Route::post('setup/machine/update', 'Setup\MachineController@updateMachine')->name('setup.machine.update');
    Route::get('setup/machine/delete/{id}', 'Setup\MachineController@deleteMachine')->name('setup.machine.delete');
    Route::get('setup/machine/view/{id}', 'Setup\MachineController@viewMachine')->name('setup.machine.view');

    Route::get('setup/machine/assign_device/{machine_id}', 'Setup\MachineController@assignDevice');
    Route::post('setup/machine/store_device', 'Setup\MachineController@storeDevice')->name('setup.machine.store_device');

    

    //Operator Setup Routes
    Route::get('setup/operator', 'Setup\OperatorController@index')->name('setup.operator');
    Route::get('setup/operator/create', 'Setup\OperatorController@createOperator')->name('setup.operator.create');
    Route::post('setup/operator/store', 'Setup\OperatorController@storeOperator')->name('setup.operator.store');
    Route::get('setup/operator/edit/{id}', 'Setup\OperatorController@editOperator')->name('setup.operator.edit');
    Route::post('setup/operator/update', 'Setup\OperatorController@updateOperator')->name('setup.operator.update');
    Route::get('setup/operator/view/{id}', 'Setup\OperatorController@viewOperator')->name('setup.operator.view');
    Route::get('setup/operator/delete/{id}', 'Setup\OperatorController@deleteOperator')->name('setup.operator.delete');

    //Item Setup
    Route::get('setup/item', 'Setup\ItemController@index')->name('setup.item');
    Route::get('setup/item/create', 'Setup\ItemController@create')->name('setup.item.create');
    Route::post('setup/item/store', 'Setup\ItemController@storeItem')->name('setup.item.store');
    Route::get('setup/item/edit/{id}', 'Setup\ItemController@editItem')->name('setup.item.edit');
    Route::post('setup/item/update', 'Setup\ItemController@updateItem')->name('setup.item.update');
    Route::get('setup/item/view/{id}', 'Setup\ItemController@viewItem')->name('setup.item.view');
    Route::get('setup/item/delete/{id}', 'Setup\ItemController@deleteItem')->name('setup.item.delete');

    //Process Setup
    Route::get('setup/process', 'Setup\ProcessController@index')->name('setup.process');
    Route::get('setup/process/create', 'Setup\ProcessController@createProcess')->name('setup.process.create');
    Route::post('setup/process/store', 'Setup\ProcessController@storeProcess')->name('setup.process.store');
    Route::get('setup/process/edit/{id}', 'Setup\ProcessController@editProcess')->name('setup.process.edit');
    Route::post('setup/process/update', 'Setup\ProcessController@updateProcess')->name('setup.process.update');
    Route::get('setup/process/view/{id}', 'Setup\ProcessController@viewProcess')->name('setup.process.view');
    Route::get('setup/process/delete/{id}', 'Setup\ProcessController@deleteProcess')->name('setup.process.delete');

    //Target Routes
    Route::get('setup/target', 'Setup\TargetController@index')->name('setup.target');
    Route::get('setup/target/create', 'Setup\TargetController@createTarget')->name('setup.target.create');
    Route::post('setup/target/store', 'Setup\TargetController@storeTarget')->name('setup.target.store');
    Route::get('setup/target/edit/{id}', 'Setup\TargetController@editTarget')->name('setup.target.edit');
    Route::post('setup/target/update', 'Setup\TargetController@updateTarget')->name('setup.target.update');
    Route::get('setup/target/view/{id}', 'Setup\TargetController@viewTarget')->name('setup.target.view');
    Route::get('setup/target/delete/{id}', 'Setup\TargetController@deleteTarget')->name('setup.target.delete');

});
Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'Admin'], function(){
    Route::post('registration', 'MachineController@registerMachine');
});

//get machine targets by line id
Route::get('lines/machine/target', 'Admin\HomeController@getLinesMachineTarget');
//get line, machine, operator and daily total target
Route::get('line/machine/operator/target', 'Admin\HomeController@getLineMachineOperatorTarget');

//daily total target
Route::get('daily/total/target', 'Admin\DailyTotalTargetController@index')->name('daily.total.target');
Route::get('daily/total/target/create', 'Admin\DailyTotalTargetController@create')->name('daily.total.target.create');
Route::post('daily/total/target/store', 'Admin\DailyTotalTargetController@store')->name('daily.total.target.store');


//get machine operating status and graph
Route::get('line/machine/operatingStatus', 'Admin\OperatingStatusController@getOperatingStatus');

Route::get('api_install', 'Admin\HomeController@runArtisanCommand')->name('api_install');

Route::group(['prefix' => 'record', 'as' => 'record.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('index', 'RecordController@index')->name('index');
    Route::get('get_record', 'RecordController@getRecord')->name('get_record');
    Route::get('get_error_history', 'MachineController@getErrorHistory')->name('get_error_history');
    Route::get('get_npt_details', 'RecordController@getNptDetails')->name('get_npt_details');

    //pdf
    Route::get('date_wise/pdf', 'RecordController@dateWisePDF')->name('date_wise.pdf');


    Route::get('machine/index', 'RecordController@machineIndex')->name('machine.index');
    Route::get('machine/get_record', 'RecordController@getMachineRecord')->name('machine.get_record');
    Route::get('machine/machine_wise/pdf', 'RecordController@machineWisePDF')->name('machine.machine_wise.pdf');
});