<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Machine;
use App\Models\Setup\Operator;
use App\Models\Setup\Target;
use App\Models\Setup\Device;
use App\Models\Npt;
use PDF;

class RecordController extends Controller
{
    //
    public function index(){
    	return view('admin/record/index');
    }

    public function getRecord(Request $request){
        
    	$machines= Machine::getMachineList($request->date);

    	return response()->json($machines);
	}

    //date wise record pdf
    public function dateWisePDF(Request $request){
        $date= $request->record_date;
        $data= Machine::getMachineList($date);
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'orientation' => 'L']); //pagev format
        $stylesheet = file_get_contents('public/css/custom.css'); // external css
        $mpdf->WriteHTML($stylesheet,1);
        $code = view('admin.record.table_part', compact('data', 'date'));
        $title= "datewiserecord.pdf";
        $mpdf->WriteHTML($code);
        $mpdf->Output($title, 'I');
    }
	
	public function getNptDetails(Request $request){
		$npt_details= Npt::getSingleNptDetails($request->machine_id, $request->date);
        
		return response()->json($npt_details);
	}

    //machine wise record index
    public function machineIndex(){
        $machineList= Machine::pluck('machine_name', 'id');
        return view('admin/record/machine/index', compact('machineList'));
    }

    //get machine wise record
    public function getMachineRecord(Request $request){
        // dd(date('Y-m-d', strtotime('today -3 months')));
        $data= $this->machineWiseRecordData($request->machine_id);

        return response()->json($data);
    }

    //machine wise record data
    public function machineWiseRecordData($machine_id){

        $machine= Machine::where('id', $machine_id)->first();

        
        $buyer_name= Device::where('id', $machine->device_id)->pluck('buyer_name')->first();
        $operator_name= Operator::where('machine_id', $machine_id)->pluck('operator_name')->first();
        $dates=[];
        $targets=[];
        $achievements= [];
        $npts= [];
        for ($i=0; $i <90 ; $i++) { 
            $date= date('Y-m-d', strtotime("today -$i day"));
            $dates[]= $date;
            $target= Target::getTarget($machine_id, $date);
            if($target){
                $targets[]= $target->target_value;
                $achievements[]= $target->achieved_value;
            }else{
                $targets[]= null;
                $achievements[]= null;
            }


            $npt= Npt::getSingleNptDetails($machine_id, $date);
            if($npt){
                $npt_count= $npt->machine_problem+ $npt->needle_broken + $npt->thread_broken+ $npt->refreshment + $npt->others;
            }
            else{
               $npt_count=0; 
            }
            $npts[]= $npt_count;

                
        }
        $data['machine_name']= $machine->machine_name;
        $data['buyer_name']= $buyer_name;
        $data['operator_name']= $operator_name;
        $data['dates']= $dates;
        $data['targets']= $targets;
        $data['achievements']= $achievements;
        $data['npts']= $npts;

        return $data;
    }

    //machine wise pdf
    public function machineWisePDF(Request $request){
        $machine_id= $request->machine_id;
        $data= $this->machineWiseRecordData($request->machine_id);
// dd($data);
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'orientation' => 'L']); //pagev format
        $stylesheet = file_get_contents('public/css/custom.css'); // external css
        $mpdf->WriteHTML($stylesheet,1);
        $code = view('admin.record..machine.table_part', compact('data'));
        $title= "datewiserecord.pdf";
        $mpdf->WriteHTML($code);
        $mpdf->Output($title, 'I');
    }
}
