<?php

namespace App\Http\Controllers\Admin\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Location;
use App\Models\Setup\Operator;
use DB,Validator;

class OperatorController extends Controller
{
    //iindex page
    public function index(){
    	$operators= Operator::select([
    		'operator.*',
    		'location.location_name'
    	])
    	->leftJoin('location', 'location.id', 'operator.location_id')
    	->get();
    	return view('admin.setup.operator.index', compact('operators'));
    }

    //create operator
    public function createOperator(){
    	$locationList= Location::get();
    	return view('admin.setup.operator.create', compact('locationList'));
    }

    //store operation
    public function storeOperator(Request $request){
    	
    	$validator= $this->validateData($request->all());
    	if($validator->fails()){
    		return back()->withInput()->with('error', 'Invalid Input!');
    	}
    	else{
    		$operator= new Operator();
    		$operator->location_id		= $request->location_id;
    		$operator->operator_id		= $request->operator_id;
    		$operator->operator_name	= $request->operator_name;
    		try {
    			if($operator->save()){
    				return redirect('admin/setup/operator')->with('success', 'Operator Added Successfully!');
    			}
    			else{
    				return back()->withInput()->with('error', 'Something went wrong!');
    			}
    			
    		} catch (\Exception $e) {
    			$msg= $e->getMessage();
    			return back()->withInput()->with('error', $msg);
    		}
    	}
    }

    //operator edit
    public function editOperator($id){
        $operator= Operator::where('id', $id)->first();
        $locationList= Location::get();
        return view('admin.setup.operator.edit', compact('operator', 'locationList'));
    }

    //update Operator
    public function updateOperator(Request $request){
        
        $validator= $this->validateData($request->all());
        if($validator->fails()){
            return back()->withInput()->with('error', 'Incorrect Input!');
        }
        else{
          DB::beginTransaction();
           try {

                Operator::where('id', $request->id)
                        ->update([
                            'location_id'   => $request->location_id,
                            'operator_id'   => $request->operator_id,
                            'operator_name' => $request->operator_name
                        ]);
               DB::commit();
                return redirect('admin/setup/operator')->with('success', 'Operator updated successfully!');
                
           } catch (\Exception $e) {
               DB::rollback();
                return back()->withInput()->with('error', "Something went wrong!");
           }
        }
    }

    //view operator
    public function viewOperator($id){
        $operator= Operator::where('operator.id', $id)
                            ->leftJoin('location', 'location.id', 'operator.location_id')
                            ->select([
                                'operator.*',
                                'location.location_name'
                            ])
                            ->first();
        return view('admin.setup.operator.view', compact('operator'));
    }


    //delete Operator
    public function deleteOperator($id){
        DB::beginTransaction();

        try {

            Operator::where('id', $id)->delete();
            DB::commit();
            return back()->with('success', 'Operator deleted successfully!');
            
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong!');
        }
    }

    //validation function
    public function validateData($data){
    	return Validator::make($data,[
    		'location_id'	=> 'required',
    		'operator_id'	=> 'required',
    		'operator_name'	=> 'required'
    	]);
    }
}
