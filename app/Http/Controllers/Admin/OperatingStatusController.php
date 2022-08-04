<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Line;
use App\Models\Setup\Machine;
use App\Models\Setup\Location;
Use App\Models\ErrorList;
use Input;
use DB;

class OperatingStatusController extends Controller
{
    //index function
    public function index(){
        $lineList= Line::get();
        return view('admin.operating_status.index', compact('lineList'));
    }

    public function getOperatingStatus(Request $request){
        $line_id = $request->line_id;

        // dd($line_id);

        $operatingStatus['machine_model']=[];
        $operatingStatus['average_power_on_time']=[];
        $operatingStatus['usage_rate']=[];
        $operatingStatus['operating_rate']=[];
    	$machines= Machine::where('line_id', $line_id)
					    	->select([
					    		'id',
					    		'line_id',
					    		'location_id',
                                'model_no'
					    	])
    						->get();

        if($machines->count()){

            $this->getStatusFunction($machines);
            // dd($machines);
            foreach ($machines as $machine) {
                $operatingStatus['machine_model'][]= $machine->model_no;

                $operatingStatus['average_power_on_time'][]=  ($machine->power_on_time && $machine->sweing_pcs)? ((int)(($machine->power_on_time/$machine->sweing_pcs)/60)) : 0;
                // $operatingStatus['usage_rate'][]= 0;
                $operatingStatus['usage_rate'][]= ($machine->power_on_time && $machine->actual_time) ? ((int)(($machine->power_on_time/$machine->actual_time)*100)): 0;
                // $operatingStatus['operating_rate'][]= 0;
                $operatingStatus['operating_rate'][]= ($machine->machine_running_time && $machine->power_on_time) ? ((int)(($machine->machine_running_time/$machine->power_on_time)*100)): 0;
            }

        }
        else{
            $operatingStatus['machine_model']=[];
            $operatingStatus['average_power_on_time']=[];
            $operatingStatus['usage_rate']=[];
            $operatingStatus['operating_rate']=[];
        }

        return $operatingStatus;
    }

    //get status function, this function will be called from different controller
    public function getStatusFunction($machines){


            $this->getWorkingHour($machines);
            $this->calculateNonProductiveTime($machines);
            $this->getRestTime($machines);
            $this->getPowerOnTime($machines);
            
            $this->getRunningTime($machines);
            $this->getActualTime($machines);
    }

    //get Working Hour
    public function getWorkingHour($machines){

        foreach ($machines as $machine) {

            $location= Location::where('id', $machine->location_id)
                                ->select([
                                    'operating_time_start',
                                    'operating_time_end'
                                ])
                                ->first();
                $machine->operating_time_start= $location->operating_time_start;
                $machine->operating_time_end= $location->operating_time_end;

        }
    }

    //get Rest Time
    public function getRestTime($machines){
        foreach ($machines as $machine) {
            // dd($machine);  
            $machine->rest_time= ($this->calculateRestTime($machine->location_id)+$machine->npt_time);
        }
    }

    //calculate Rest Times
    public function calculateRestTime($location_id){
        $rests= Location::where('id', $location_id)->first();

        //if there is rest time then calculate it or return 0 in minutes
        if($rests){

            $total_rest_time=0;

            //rest time 1
            $rest_1_start= (($rests->rest_1_start)? strtotime($rests->rest_1_start): 0);

            $rest_1_end= (($rests->rest_1_end)? strtotime($rests->rest_1_end): 0);

            $rest_time_1= (($rest_1_end - $rest_1_start)? ($rest_1_end - $rest_1_start): 0);

            //rest time 2
            $rest_2_start= (($rests->rest_2_start)? strtotime($rests->rest_2_start): 0);

            $rest_2_end= (($rests->rest_2_end)? strtotime($rests->rest_2_end): 0);

            $rest_time_2= (($rest_2_end - $rest_2_start)? ($rest_2_end - $rest_2_start): 0);


            //rest time 3
            $rest_3_start= (($rests->rest_3_start)? strtotime($rests->rest_3_start): 0);

            $rest_3_end= (($rests->rest_3_end)? strtotime($rests->rest_3_end): 0);

            $rest_time_3= (($rest_3_end - $rest_3_start)? ($rest_3_end - $rest_3_start): 0);

            // dd($rest_time_3);

            //rest time 4
            $rest_4_start= (($rests->rest_4_start)? strtotime($rests->rest_4_start): 0);

            $rest_4_end= (($rests->rest_4_end)? strtotime($rests->rest_4_end): 0);

            $rest_time_4= (($rest_4_end - $rest_4_start)? ($rest_4_end - $rest_4_start): 0);

            // dd($rest_time_4);

            //rest time 5
            $rest_5_start= (($rests->rest_5_start)? strtotime($rests->rest_5_start): 0);

            $rest_5_end= (($rests->rest_5_end)? strtotime($rests->rest_5_end): 0);

            $rest_time_5= (($rest_5_end - $rest_5_start)? ($rest_5_end - $rest_5_start): 0);

            //total rest time
            $total_rest_time= ($rest_time_1+$rest_time_2+$rest_time_3+ $rest_time_4 + $rest_time_5);

            return $total_rest_time;
        }
        else{
            return 0;
        }
    }

    //Get Power on Time
    public function getPowerOnTime($machines){
        foreach ($machines as $machine){

            $start_time= $machine->operating_time_start;
            $off_time= $machine->operating_time_end;

            $device_start= ErrorList::whereDate('error_date', today())
                                ->where('machine_id', $machine->id)
                                ->where('error_no', 1)
                                ->orderBy('id', 'asc')
                                ->first();

            if($device_start){

                $device_off= ErrorList::whereDate('error_date', today())
                                    ->where('machine_id', $machine->id)
                                    ->where('error_no', 0)
                                    ->orderBy('id', 'desc')
                                    ->first();
                    
                $start_time= $device_start->error_start_at;

                if($device_off){
                    $off_time= $device_off->error_start_at;
                }
                else{
                    $off_time= $machine->operating_time_end;
                }

                $app_running_time= (strtotime($off_time) - strtotime($start_time));
                if($app_running_time<=0){
                    $machine->app_running_time= 0;
                    $machine->power_on_time= 0;
                }
                else{
                    $machine->app_running_time= $app_running_time;

                    $power_on_time= ($app_running_time-$machine->rest_time);
                    if($power_on_time<=0){
                        $machine->power_on_time= 0;
                    }
                    else{
                        $machine->power_on_time= $power_on_time;
                    }
                    
                }
            }
            else{
                $machine->app_running_time=0;
                $machine->power_on_time=0;
            }
        }
    }

    //calculate Non Productive Time
    public function calculateNonProductiveTime($machines){
        foreach ($machines as $machine) {
            $npt_time= 0;

            $errors= ErrorList::whereDate('error_date', date('Y-m-d', strtotime('Today')))
                                ->where('machine_id', $machine->id)
                                ->get();

            if($machine->id==1){
                $error_start_time=null;
                foreach ($errors as $error) {
                    if($error->error_no>1 && $error->error_no<=8){
                        $error_start_time= strtotime($error->error_start_at);
                    }

                    if($error->error_no==100 && $error_start_time){
                        $error_end_time= strtotime($error->error_start_at);
                        if($error_end_time && ($error_end_time> $error_start_time)){
                            $error_time= ($error_end_time-$error_start_time);
                            $npt_time+= $error_time;
                        }
                        $error_start_time=null;
                    }
                }
            }
            $machine->npt_time= $npt_time;
        }

    }

    //get running time
    public function getRunningTime($machines){                                      
        foreach ($machines as $machine) {

            $count_start= ErrorList::whereDate('error_date', today())
                                ->where('machine_id', $machine->id)
                                ->where('error_no', 1)
                                ->orderBy('id', 'asc')
                                ->pluck('error_start_at')
                                ->first();
            
            if($count_start){

                $count_stop_time= DB::table('achievement_count_times')
                                ->where('machine_id', $machine->id)
                                ->whereDate('counter_time', today())
                                ->orderBy('id', 'desc')
                                ->pluck('counter_time')
                                ->first();
                // dd($count_stop_time);
                if($count_stop_time){
                    $machine_running_time= (strtotime($count_stop_time) -strtotime($count_start));
                    if($machine_running_time<=0){
                        $machine->machine_running_time= 0;
                    }
                    else{
                        $machine->machine_running_time= $machine_running_time - $machine->rest_time;
                    }
                }
                else{
                    $machine->machine_running_time=0;
                }
            }
            else{
                $machine->machine_running_time=0;
            }     
        }
    }

    //get machine running time
    public function getActualTime($machines){
        foreach ($machines as $machine) {
            $machine->actual_time= $this->calculateActualTime($machine);
            $machine->sweing_pcs= DB::table('achievement_count_times')
                                    ->where('machine_id', $machine->id)
                                    ->whereDate('counter_time', today())
                                    ->count();
        }
    }

    //calculate Actual time
    public function calculateActualTime($machine){
        $achievements= DB::table('achievement_count_times')
                            ->where('machine_id', $machine->id)
                            ->whereDate('counter_time', today())
                            ->get();

        $counts= $achievements->count();
        if($counts && $counts>1){
            $achievement= $achievements->take(2)->toArray();
            $time_for_first_count= (strtotime($achievement[1]->counter_time) -strtotime($achievement[0]->counter_time));
            $time=(($time_for_first_count)? $time_for_first_count: 0);
            return ($time*$counts);
        }
        elseif($counts && $counts==1){

            $device_start= ErrorList::whereDate('error_date', today())
                                ->where('machine_id', $machine->id)
                                ->where('error_no', 1)
                                ->orderBy('id', 'asc')
                                ->first();
            if($device_start){
                $start_time= $machine->error_start_at;
            }
            else{
                $start_time= $machine->operating_time_start;
            }

           
            $achievement= $achievements->take(1)->toArray();
            
            $time_for_first_count= (strtotime($achievement[0]->counter_time) -strtotime($start_time));
            $time=(($time_for_first_count)? $time_for_first_count: 0);

            return ($time*$counts);
        }
        else{
            return 0;
        }
            
    }
}
