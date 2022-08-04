<?php

namespace App\Http\Controllers\Admin\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Process;
use DB,Validator;
class ProcessController extends Controller
{
    // process index
    public function index(){
    	$processes= Process::get();
    	return view('admin.setup.process.index', compact('processes'));
    }

    //create item
    public function createProcess(){
    	return view('admin.setup.process.create');
    }

    //store item
    public function storeProcess(Request $request){

    	$validator= Controller::validateProcessData($request->all());

    	if($validator->fails()){
    		return back()->withInput()->with('error', 'invalid input!');
    	}
    	else{
    		$process= new Process();
    		$process->process_id= $request->process_id;
    		$process->process_name= $request->process_name;
    		try {
                $process->save();
                return redirect('admin/setup/process')->with('success', 'Process added Successfully');
    			
    		} catch (\Exception $e) {
    			return back()->withInput()->with('error','Something went wrong!');
    		}
    	}
    }

    //edit process
    public function editProcess($id){
        $process= Process::where('id', $id)->first();
        return view('admin.setup.process.edit', compact('process'));
    }

    //update process
    public function updateProcess(Request $request){
        $validator= Controller::validateProcessData($request->all());

        if($validator->fails()){
            return back()->withInput()->with('error', 'Incorrect input!');
        }
        else{

            DB::beginTransaction();


            $process= new Process();
            $process->process_id= $request->process_id;
            $process->process_name= $request->process_name;
            try {
                Process::where('id', $request->id)
                        ->update([
                            'process_id' => $request->process_id,
                            'process_name' => $request->process_name
                        ]);
                DB::commit();
                return redirect('admin/setup/process')->with('success', 'Process updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                return back()->withInput()->with('error','Something went wrong!');
            }
        }
    }

    //view process details
    public function viewProcess($id){
        $process= Process::where('id', $id)->first();
        return view('admin.setup.process.view', compact('process'));
    }

    //delete process
    public function deleteProcess($id){
        DB::beginTransaction();
        try {
            Process::where('id', $id)->delete();
            DB::commit();
            return back()->with('success', 'Process deleted successfully!');
            
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong!');
        }
    }

}
