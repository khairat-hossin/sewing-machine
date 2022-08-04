<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Setup\Line;
use App\Models\Setup\Machine;
use App\Models\Setup\Operator;
use App\Models\Setup\Target;
use App\Models\DailyTotalTarget;
use App\Http\Controllers\Admin\OperatingStatusController as OperatingStatusController;
use DB, Artisan;
class HomeController
{
    public function index(){

        $lineList= Line::get();
        $line_ids=[];
        $line_names=[];
        $targets=[];
        $achievements= [];
        $date= date("Y-m-d", strtotime("today"));

        foreach ($lineList as $line) {
            $line_ids[]   = $line->id;
            $line_names[] = $line->line_name;
            $targets[]= DB::table('target')
                        ->leftJoin('machine', 'machine.id', 'target.machine_id')
                        ->where('machine.line_id', $line->id)
                        ->whereDate('target.target_date', '<=', $date)
                        ->whereDate('target.target_date_end', ">=", $date)
                        ->sum('target.target_value');

            $achievements[]= DB::table('target')
                        ->leftJoin('machine', 'machine.id', 'target.machine_id')
                        ->where('machine.line_id', $line->id)
                        ->whereDate('target.target_date', '<=', $date)
                        ->whereDate('target.target_date_end', ">=", $date)
                        ->sum('target.achieved_value');
        }
        
    	$data['id']= $line_ids;
        $data['lines']= $line_names;
    	$data['targets']= $targets;
    	$data['achievements']= $achievements;

        return view('home', compact('lineList', 'data'));
    }

    //get Linewise Data
    public function getLinesMachineTarget(Request $request){

        $machines= Machine::where('line_id', $request->line_id)->get();

        $date= date("Y-m-d", strtotime("today"));
        
        foreach ($machines as $machine) {
            $target= Target::where('machine_id', $machine->id)
                        ->whereDate('target.target_date', '<=', $date)
                        ->whereDate('target.target_date_end', ">=", $date)
                            ->first();

            if($target){
                $targ= $target->target_value;
                $achv= $target->achieved_value;
                $ratio= number_format((float)(($achv/$targ)*100), 2, '.', '');
            }
            else{
                $targ   = 0;
                $achv   = 0;
                $ratio  = 0;
            }

            $data['machines'][]     = $machine->model_no;
            $data['targets'][]      = $targ;
            $data['achievements'][] = $achv;
            $data['ratio'][]        = $ratio;
        }
        return $data;
    }

    //get target, machine, line, operator number
    public function getLineMachineOperatorTarget(){
        $line       = Line::count();
        $machine    = Machine::count();
        $operator   = Operator::count();
        $target     = DailyTotalTarget::whereDate('target_date', today())
                                        ->pluck('target_value')
                                        ->first();

        $data['line']       = ($line)? $line : 0;
        $data['machine']    = ($machine)? $machine : 0;
        $data['operator']   = ($operator)? $operator : 0;
        $data['target']     = ($target)? $target : 0;

        return $data;
    }
    
    // passport package install command
    public  function runArtisanCommand(){
            \Artisan::call('passport:install');
            printf("Command run successfull");
            return redirect('/');
        }
}
