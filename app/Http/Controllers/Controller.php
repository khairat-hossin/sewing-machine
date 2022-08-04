<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //validation Item function
    public function validateItemData($data){
    	return Validator::make($data,[
    		'item_code'		=> 'required',
    		'item_name'		=> 'required'
    	]);
    }

    //validation Process function
    public function validateProcessData($data){
    	return Validator::make($data,[
    		'process_id'	=> 'required',
    		'process_name'	=> 'required'
    	]);
    }

    //validation Machine function
    public function validateMachineData($data){
        return Validator::make($data,[
            'location_id'    => 'required',
            'line_id'  => 'required',
            'model_no'  => 'required',
            'serial_no'  => 'required',
            'machine_name'  => 'required'
        ]);
    }


    public function validateTargetData($data){
        return Validator::make($data,[
            'machine_id'    => 'required',
            'operator_id'  => 'required',
            'item_id'  => 'required',
            'process_id'  => 'required',
            'target_value'  => 'required'
        ]);
    }

}
