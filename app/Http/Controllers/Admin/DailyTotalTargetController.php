<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyTotalTarget;
use DB, Validator;
class DailyTotalTargetController extends Controller
{
    //index page
    public function index(){

    	$dailyTotalTargetList= DailyTotalTarget::get();

    	return view('admin.dailyTotalTarget.index', compact('dailyTotalTargetList'));
    }

    //create page
    public function create(){
    	return view('admin.dailyTotalTarget.create');
    }

    //store daywise total target
    public function store(Request $request){
    	// dd($request->all());
    	$date= $request->target_date;
    	$value= $request->target_value;

    	// check if previous target of this date exists
    	$prevTarget= DailyTotalTarget::whereDate('target_date', date($date))->exists();
    	if($prevTarget){
    		return back()
    			->withInput()
    			->with('error', 'Target Already Exists');
    	}
    	else{
    		$target= new DailyTotalTarget();
    		$target->target_date  = $date;
    		$target->target_value = $value;
    		try {
    			$target->save();

    			return redirect('daily/total/target')
    					->with('success', "Target saved successfully!");
    			
    		} catch (\Exception $e) {
    			return back()
    				->withInput()
    				->with('error', 'Something went wrong!');
    		}
    	}
    }
}
