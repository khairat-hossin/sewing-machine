<?php

namespace App\Http\Controllers\Admin\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Machine;
use App\Models\Setup\Operator;
use App\Models\Setup\Item;
use App\Models\Setup\Process;
use App\Models\Setup\Target;
use DB,Validator;

class TargetController extends Controller
{
    //index page
    public function index(){
    	$targets= Target::select([
    		'target.*',
    		'machine.machine_name',
    		'operator.operator_name',
    		'item.item_name',
    		'process.process_name'
    	])
        // ->where('target.target_date', today())
    	->leftJoin('machine', 'machine.id', 'target.machine_id')
    	->leftJoin('operator', 'operator.id', 'target.operator_id')
    	->leftJoin('item', 'item.id', 'target.item_id')
    	->leftJoin('process', 'process.id', 'target.process_id')
    	->get();

        // dd($targets);
    	return view('admin.setup.target.index', compact('targets'));
    }

    //create target
    public function createTarget(){
    	$machineList= Machine::get();
    	$operatorList= Operator::get();
    	$itemList= Item::get();
    	$processList= Process::get();
    	return view('admin.setup.target.create', compact('machineList','operatorList', 'itemList', 'processList'));
    }

    //store target
    public function storeTarget(Request $request){

    	$validator= Controller::validateTargetData($request->all());
    	if($validator->fails()){
    		return back()->withInput()->with('error', 'Invalid Input!');
    	}
    	else{

    		$target= new Target();
    		$target->target_date	= $request->target_date;
            $target->target_date_end    = $request->target_date_end;
            $target->machine_id     = $request->machine_id;
    		$target->operator_id	= $request->operator_id;
    		$target->item_id		= $request->item_id;
    		$target->process_id		= $request->process_id;
    		$target->target_value	= $request->target_value;
    		try {
    			$target->save();
    			return redirect('admin/setup/target')->with('success', 'Target Added Successfully!');
    		} catch (\Exception $e) {
    			return back()->withInput()->with('error','Something went wrong!');
    		}
    	}
    }

    //edit target
    public function editTarget($id){
        $target= Target::where('id', $id)->first();
        $machineList= Machine::get();
        $operatorList= Operator::get();
        $itemList= Item::get();
        $processList= Process::get();
        return view('admin.setup.target.edit', compact('target','machineList','operatorList', 'itemList', 'processList'));
    }

    //update target
    public function updateTarget(Request $request){
        $validator= Controller::validateTargetData($request->all());
        if($validator->fails()){
            return back()->withInput()->with('error', 'Incorrect Input!');
        }
        else{

            DB::beginTransaction();

            $target= new Target();
            $target->target_date    = $request->target_date;
            $target->target_date_end    = $request->target_date_end;
            $target->machine_id     = $request->machine_id;
            $target->operator_id    = $request->operator_id;
            $target->item_id        = $request->item_id;
            $target->process_id     = $request->process_id;
            $target->target_value   = $request->target_value;
            try {
                Target::where('id', $request->id)
                        ->update([
                            'target_date'    => $request->target_date,
                            'target_date_end'    => $request->target_date_end,
                            'machine_id'     => $request->machine_id,
                            'operator_id'    => $request->operator_id,
                            'item_id'        => $request->item_id,
                            'process_id'     => $request->process_id,
                            'target_value'   => $request->target_value
                        ]);

                DB::commit();
                return redirect('admin/setup/target')->with('success', 'Target updated successfully!');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->withInput()->with('error','Something went wrong!');
            }
        }
    }

    //target view
    public function viewTarget($id){
        $target= Target::where('target.id', $id)
                        ->select([
                            'target.*',
                            'machine.machine_name',
                            'operator.operator_name',
                            'item.item_name',
                            'process.process_name'
                        ])
                        // ->where('target.target_date', today())
                        ->leftJoin('machine', 'machine.id', 'target.machine_id')
                        ->leftJoin('operator', 'operator.id', 'target.operator_id')
                        ->leftJoin('item', 'item.id', 'target.item_id')
                        ->leftJoin('process', 'process.id', 'target.process_id')
                        ->first();
        return view('admin.setup.target.view', compact('target'));
    }

    //delete target
    public function deleteTarget($id){
        DB::beginTransaction();
        try {
            Target::where('id', $id)->delete();
            DB::commit();
            return back()->with('success', 'Target deleted successfully!');
            
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong!');
        }
    }

}
