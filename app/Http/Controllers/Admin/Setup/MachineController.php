<?php

namespace App\Http\Controllers\Admin\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Location;
use App\Models\Setup\Line;
use App\Models\Setup\Machine;
use App\Models\Device;
use DB,Validator;

class MachineController extends Controller
{
    //index page
    public function index(){
    	
    	$machines= Machine::select([
    		'machine.*',
    		'location.location_name',
    		'line.line_name',
            'device.device_name'
    	])
    	->leftJoin('location', 'location.id', 'machine.location_id')
    	->leftJoin('line', 'line.id', 'machine.line_id')
        ->leftJoin('device', 'device.id', 'machine.device_id')
    	->get();
    	return view('admin.setup.machine.index', compact('machines'));
    }

    //create operator
    public function createMachine(){
    	$locationList= Location::get();
    	$lineList= Line::get();
    	return view('admin.setup.machine.create', compact('locationList','lineList'));
    }

    //store machine
    public function storeMachine(Request $request){

    	$validator= Controller::validateMachineData($request->all());
    	if($validator->fails()){
    		return back()->withInput()->with('error', 'Invalid Input!');
    	}
    	else{
    		$machine= new Machine();
    		$machine->location_id		= $request->location_id;
    		$machine->line_id		= $request->line_id;
    		$machine->model_no		= $request->model_no;
    		$machine->serial_no		= $request->serial_no;
    		$machine->machine_name	= $request->machine_name;
    		$machine->machine_description		= $request->machine_description;
    		try {
    			$machine->save();
    			return redirect('admin/setup/machine')->with('success', 'Machine Added Successfully!');
    		} catch (\Exception $e) {
    			return back()->withInput()->with('error','Something went wrong!');
    		}
    	}
    }

    //edit operator
    public function editMachine($id){
        $machine= Machine::where('id', $id)->first();
        $locationList= Location::get();
        $lineList= Line::get();
        return view('admin.setup.machine.edit', compact('machine', 'locationList','lineList'));
    }

    //update machine
    public function updateMachine(Request $request){

        $validator= Controller::validateMachineData($request->all());
        if($validator->fails()){
            return back()->withInput()->with('error', 'Incorrect input!');
        }
        else{
            DB::beginTransaction();

            try {
                Machine::where('id', $request->id)
                        ->update([
                            'location_id'   => $request->location_id,
                            'line_id'       => $request->line_id,
                            'model_no'      => $request->model_no,
                            'serial_no'     => $request->serial_no,
                            'machine_name'  => $request->machine_name,
                            'machine_description'  => $request->machine_description
                        ]);

                DB::commit();
                return redirect('admin/setup/machine')->with('success', 'Machine updated successfully!');
                
            } catch (Exception $e) {
                DB::rollback();
                return back()->withInput()->with('error','Something went wrong!');
                
            }
        }
    }

    //view machine
    public function viewMachine($id){
        $machine= Machine::where('machine.id', $id)
                        ->leftJoin('location', 'location.id', 'machine.location_id')
                        ->leftJoin('line', 'line.id', 'machine.line_id')
                        ->select([
                            'machine.*',
                            'location.location_name',
                            'line.line_name'
                        ])
                        ->first();
        return view('admin.setup.machine.view', compact('machine'));
    }

    //delete machine
    public function deleteMachine($id){
        DB::beginTransaction();
        try {
            $device_id= Machine::where('id', $id)->pluck('device_id')->first();
            
            $df= Device::where('id', $device_id)->get();
            //dd($df);
            Machine::where('id', $id)->delete();
            if($device_id){
               Device::where('id', $device_id)
                        ->update([
                            'machine_id' => null
                        ]); 
            }
           DB::commit();
            return back()->with('success', 'Machine updated successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong!');
       }
    }


    // assign device to machine
    public function assignDevice(){

        $machine= Machine::where('id', request('machine_id'))->first();
        if($machine->device_id){
            return back()
                ->with('error', "Machine has assigned Device already!");
        }

        // dd($machine);
        $deviceList= DB::table('device')->where('machine_id', null)->get();
        if(!$deviceList->count())
            return back()
                ->with('error', "There is no device to assign!");
        return view('admin.setup.machine.assign_device', compact('machine', 'deviceList'));
    }

    //store assigned device to machine
    public function storeDevice(Request $request){
        try {
            Machine::where('id', $request->machine_id)->update(['device_id' => $request->device_id]);
            Device::where('id', $request->device_id)->update(['machine_id' => $request->machine_id]);
            return redirect('admin/setup/machine')->with('success', 'Device Assigned Successfully!');
            
        } catch (\Exception $e) {
            return back()
                    ->withInput()
                    ->with('error', 'Something went wrong!');
        }
        
    }
 
}
