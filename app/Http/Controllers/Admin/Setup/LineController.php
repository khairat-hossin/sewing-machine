<?php

namespace App\Http\Controllers\Admin\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Line;
use App\Models\Setup\Location;
use App\Models\Setup\Machine;
use DB,Validator;
class LineController extends Controller
{
    //index
    public function index(){

    	$lines= Line::select([
    		"line.*",
    		"location.location_name"
    	])
    	->leftJoin('location', 'location.id', 'line.location_id')
    	->get();
    	return view('admin.setup.line.index', compact('lines'));
    }

    //create new line
    public function create(){
    	$locationList= Location::get();
        $machines= Machine::get();
    	return view('admin.setup.line.create', compact('locationList', 'machines'));
    }

    // line store
    public function storeLine(Request $request){

    	$data= $request->all();
    	$validator= $this->validateData($data);
    	if($validator->fails()){
    		return back()->with('error', 'Input Data Validation Failed!');
    	}
    	else{
    		$line= new Line();
    		$line->location_id        = $request->location_id;
    		$line->line_name          = $request->line_name;
    		$line->line_description   = $request->line_description;
            $line->belonging_devices  = serialize($request->duallistbox_demo1);

    		try {
    			if($line->save()){
    				return redirect('admin/setup/line')->with('success', 'Line saved sucessfully!');
    			}
    			else{
    				return back()->with('error', 'Something went wrong!');
    			}
    			
    		} catch (\Exception $e) {
    			$msg= $e->getMessage();
    			return back()->with('error', $msg);
    		}
    	}
    }

    //validation function
    public function validateData($data){
    	return Validator::make($data,[
    		'location_id'			=> 'required',
    		'line_name'			=> 'required'
    	]);
    }

    //edit line
    public function editLine($id){
        $locationList= Location::get();
        $machines= Machine::get();
        $line= Line::where('id', $id)->first();
        return view('admin.setup.line.edit', compact('locationList', 'machines', 'line'));
    }

    //update line
    public function updateLine(Request $request){

        $validator= $this->validateData($request->all());
        // dd($request->all());
        if($validator->fails()){
            return back()->with('error', 'Incorrect Input!');
        }
        else{
            DB::beginTransaction();
            try {
                Line::where('id', $request->id)
                        ->update([
                            'location_id'        => $request->location_id,
                            'line_name'          => $request->line_name,
                            'line_description'   => $request->line_description,
                            'belonging_devices'  => serialize($request->duallistbox_demo1)
                        ]);
                DB::commit();
                return redirect('admin/setup/line')->with('success', 'Line saved sucessfully!');
            } catch (Exception $e) {
                DB::rollback();
                return back()->with('error', 'something went wrong!');
            }
        }
    }

    //view line details
    public function viewLine($id){
        $line= Line::where('line.id', $id)
                    ->leftJoin('location', 'location.id', 'line.location_id')
                    ->select([
                        'line.*',
                        'location.location_name'
                    ])
                    ->first();
        $machine_names= [];
        $machine_ids= unserialize($line->belonging_devices);
        if($machine_ids){
            foreach ($machine_ids as $key => $value) {
                $name= Machine::where('id', $value)->pluck('machine_name')->first();

                $machine_names[]=$name;

            }
        }
        return view('admin.setup.line.view', compact('line', 'machine_names'));                       
    }

    //delete line
    public function deleteLine($id){
        DB::beginTransaction();
        try {
            Line::where('id', $id)->delete();
            DB::commit();
            return redirect('admin/setup/line')->with('success', 'Line deleted successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong!');
        }
    }
}
/*
location_id
line_name
line_description
belonging_devices
line_status
*/