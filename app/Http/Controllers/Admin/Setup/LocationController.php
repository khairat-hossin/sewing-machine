<?php

namespace App\Http\Controllers\Admin\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Location;
use App\Models\Setup\Line;
use App\Models\Setup\Machine;
use DB,Validator;

class LocationController extends Controller
{
    //index page
    public function index(){
    	$locations= Location::get();
    	return view('admin/setup/location/index', compact('locations'));
    }

    //create location
    public function addLocation(){

        $lines= Line::get();
        $machines= Machine::get();
    	return view('admin.setup.location.create', compact('lines', 'machines'));
    }

    //store location
    public function storeLocation(Request $request){
    	// dd($request->all());
    	$data= $request->all();
    	$validator= $this->validateData($data);
    	if($validator){
    		$location= new Location();
    		$location->location_name = $request->location_name;
    		$location->operating_time_start = $request->operating_time_start;
    		$location->operating_time_end = $request->operating_time_end;
    		$location->rest_1_start = $request->rest_1_start;
    		$location->rest_1_end = $request->rest_1_end;
    		$location->rest_2_start = $request->rest_2_start;
    		$location->rest_2_end = $request->rest_2_end;
    		$location->rest_3_start = $request->rest_3_start;
    		$location->rest_3_end = $request->rest_3_end;
    		$location->rest_4_start = $request->rest_4_start;
    		$location->rest_4_end = $request->rest_4_end;
            $location->location_description = $request->location_description;
            $location->belonging_lines = serialize($request->duallistbox_demo1);
    		try {
    			if($location->save()){
    				return redirect('admin/setup/location')->with('success', 'Location Stored successfully!');
    			}
    		} catch (\Exception $e) {
    			$msg= $e->getMessage();
    			return back()->with('error', $msg);
    		}
    	}
    	else{
    		return back()->with('error', 'Invalid Input');
    	}
    }

    //validation function
    public function validateData($data){
    	return Validator::make($data,[
    		'location_name'			=> 'required',
    		'operating_time_start'	=> 'required',
    		'operating_time_end'	=> 'required'
    	]);
    }

    //edit location
    public function editLocation($id){
        $location= Location::where('id', $id)->first();
        $lines= Line::get();
        $machines= Machine::get();
        return view('admin.setup.location.edit', compact('location', 'lines', 'machines'));
    }

    //update location
    public function updateLocation(Request $request){

        $data= $request->all();
        $validator= $this->validateData($data);

        if($validator){

            DB::beginTransaction();

            try {
                Location::where('id', $request->id)
                        ->update([
                            'location_name'         => $request->location_name,
                            'operating_time_start'  => $request->operating_time_start,
                            'operating_time_end'    => $request->operating_time_end,
                            'rest_1_start'          => $request->rest_1_start,
                            'rest_1_end'            => $request->rest_1_end,
                            'rest_2_start'          => $request->rest_2_start,
                            'rest_2_end'            => $request->rest_2_end,
                            'rest_3_start'          => $request->rest_3_start,
                            'rest_3_end'            => $request->rest_3_end,
                            'rest_4_start'          => $request->rest_4_start,
                            'rest_4_end'            => $request->rest_4_end,
                            'location_description'  => $request->location_description,
                            'belonging_lines'       => serialize($request->duallistbox_demo1)
                        ]);
                DB::commit();
                return redirect('admin/setup/location')->with('success', 'Location updated successfully!');
            } catch (Exception $e) {
                DB::rollback();
                return back()->with('error', 'Something went wrong!');
            }
        }
        else{
            return back()->with('error', 'Incorrect Input!');
        }
    }

    //view location
    public function viewLocation($id){
        $location= Location::where('id', $id)->first();

        $line_names= [];
        $line_ids= unserialize($location->belonging_lines);
    
        if($line_ids){
            foreach ($line_ids as $key => $value) {
               $line_names[]= Line::where('id', $value)->pluck('line_name')->first();
            }
        }
        return view('admin.setup.location.view', compact('location', 'line_names'));
    }

    //delete location
    public function deleteLocation($id){

        DB::beginTransaction();

        try {
            Location::where('id', $id)->delete();
            DB::commit();
            return back()->with('success', 'Location deleted successfully!');
            
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong!');
        }
    }

}
