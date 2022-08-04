<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Setup\Machine;
Use App\Models\Setup\Location;
Use App\Models\Setup\Target;
Use App\Models\ErrorList;
Use App\Models\Device;
Use App\Models\Npt;
Use App\Product;
use DB, PDF;

use App\Http\Controllers\Admin\OperatingStatusController as OperatingStatusController;

class MachineController extends Controller
{
    public function index(){
        $machines = Machine::all();
        $machines= $this->subIndex($machines);
        return view('admin.machine.index', compact('machines'));
    }
    public function subIndex($machines){
        $operatingStatus= new OperatingStatusController();

        $operatingStatus->getStatusFunction($machines);
        $this->calCulateTargetAchievement($machines);
        foreach ($machines as $machine) {
            $machine->average_power_on_time=  ($machine->power_on_time && $machine->sweing_pcs)? ((int)($machine->power_on_time/$machine->sweing_pcs)) : 0;

            $machine->usage_rate= ($machine->power_on_time && $machine->actual_time) ? ((int)(($machine->power_on_time/$machine->actual_time)*100)): 0;
            $machine->operating_rate= ($machine->machine_running_time && $machine->power_on_time) ? ((int)(($machine->machine_running_time/$machine->power_on_time)*100)): 0;


            $target= Target::where('machine_id', $machine->id)
                            // ->whereDate('target_date', today())
                            ->pluck('target_value')
                            ->first();
            ($target) ? ($machine->target= $target) : ($machine->target= 0);
        }
        return $machines;
    }

    //calculate target and achievement
    public function calCulateTargetAchievement($machines){
        foreach ($machines as $machine) {
            $target= Target::where('machine_id', $machine->id)
                            ->select([
                                'target_value',
                                'achieved_value'
                            ])
                            ->first();
            if($target){
                $targ= (int)$target->target_value;
                $achv= (int)$target->achieved_value;
                $machine->achievement_ratio= number_format((float)(($achv/$targ)*100), 2, '.', '');
            }
            else{
                $machine->achievement_ratio= 0;
            }
        }
    }

    //machine status 
    public function status(){
    	$machines = Machine::all();
    	foreach ($machines as $machine) {
    		if($machine->machine_status==1){
    			$machine->class="bg-success";
    		}
    		else if($machine->machine_status>1){
    			$machine->class="bg-danger";
    		}
    		else{
    			$machine->class="bg-secondary";
    		}
    	}
    	return view('admin.machine.status', compact('machines'));
    }

    // Get Target value by machine id
    public function getTargetValue(Request $req){
        // return $req->device_id;
        $target_value=0;
        $machine_id= Device::where('device_id', $req->device_id)->pluck('machine_id')->first();
        if($machine_id){
            $target_value= Target::where('machine_id', $machine_id)
                                    // ->where('target_date', today())
                                    ->pluck('target_value')
                                    ->first();
                                    
            if($target_value) return $target_value;
        }
        return $target_value;
    }

    //get machine error history
    public function getErrorHistory(Request $request){

        if($request->has('date')){
            $date= $request->date;
        }
        else{
            $date= date('Y-m-d', strtotime('today'));
        }

        // dd($date);

        $location= Machine::where('machine.id',$request->machine_id)
                                ->select([
                                    'machine.*',
                                    'location.location_name',
                                    'line.line_name'
                                ])
                                ->leftJoin('location', 'location.id', 'machine.location_id')
                                ->leftJoin('line', 'line.id', 'machine.line_id')
                                ->first();
        $data['location_name']  = null;
        $data['line_name']      = null;
        $data['model_no']     = null;
        $data['error_no']     = null;
        $data['error_name']     = null;
        $data['error_time']     = null;
        if($location){

            $data['location_name']  = $location->location_name;
            $data['line_name']      = $location->line_name;
            $data['model_no']       = $location->model_no;
            
            $errors= ErrorList::where('machine_id', $request->machine_id)
                            ->whereDate('error_date', $date)
                            ->get();

            // dd($errors);
            foreach ($errors as $error) {


                $error_name= DB::table('error_names')
                                ->where('error_id', $error->error_no)
                                ->pluck('error_name')
                                ->first();

                $data['error_no'][] = $error->error_no;
                $data['error_name'][] = $error_name;
                $data['error_time'][] = $error->error_start_at;
            }

            return $data;
        }
        

       return $data;
    }

    //download pdf
    public function downloadMachinePdf(){
        $machines = Machine::all();
        $data= $this->subIndex($machines);
        $mpdf = new \Mpdf\Mpdf(['format' => 'Legal', 'orientation' => 'L']); //pagev format
        $stylesheet = file_get_contents('public/css/custom.css'); // external css
        $mpdf->WriteHTML($stylesheet,1);
        $code = view('admin.machine.table_part', compact('data'));
        $title= "Hellos.pdf";
        $mpdf->WriteHTML($code);
        $mpdf->Output($title, 'I');
    }
}
