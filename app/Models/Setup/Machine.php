<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use DB;

class Machine extends Model
{
    //
    protected $table= 'machine';
    public $timestamps= false;

    public function operator(){
    	return $this->hasOne('App\Models\Setup\operator');
    }

    //get machine list
    public static function getMachineList($date){
        
    	return Machine::select([
    		'machine.id',
    		'machine.machine_name',
            'line.line_name',
            'operator.operator_name',
            'target.target_value',
            'target.achieved_value',
            'device.buyer_name',
            DB::raw("npt_times_count.machine_problem+ npt_times_count.needle_broken+npt_times_count.thread_broken+npt_times_count.refreshment+npt_times_count.others as npts")
    	])
        ->leftJoin('operator', 'operator.machine_id', 'machine.id')
        ->leftJoin('line', 'line.id', 'machine.line_id')
        ->leftJoin('target', function($join) use ($date)
                         {
                             $join->on('target.machine_id', '=', 'machine.id');
                             $join->whereDate('target.target_date','=',$date);
                         })
        ->leftJoin('device', 'device.id', 'machine.device_id')
       ->leftJoin('npt_times_count', function($join2) use ($date)
                        {
                           $join2->on('npt_times_count.machine_id', '=', 'machine.id');
                             $join2->whereDate('npt_times_count.npt_date','=', $date);
                       })
        ->orderby('machine.id', 'asc')
    	->get();
    }

    //get machine wise record of last three months
    public static function getMachineWiseRecord($id){
        return Machine::select([
            'machine.id',
            'machine.machine_name',
            'operator.operator_name',
            'target.target_value',
            'target.achieved_value',
            'device.buyer_name',
            DB::raw("npt_times_count.machine_problem+ npt_times_count.needle_broken+npt_times_count.thread_broken+npt_times_count.refreshment+npt_times_count.others as npts")
        ])
        ->leftJoin('operator', 'operator.machine_id', 'machine.id')
        ->Join('target', function($join)
                         {
                             $join->on('target.machine_id', '=', 'machine.id');
                             $join->whereDate('target.target_date','<=',date('Y-m-d', strtotime('today')));
                             $join->whereDate('target.target_date','>=',date('Y-m-d', strtotime('today -3 months')));
                         })
        ->leftJoin('device', 'device.id', 'machine.device_id')
       ->Join('npt_times_count', function($join2)
                        {
                           $join2->on('npt_times_count.machine_id', '=', 'machine.id');
                             $join2->whereDate('npt_times_count.npt_date','<=', date('Y-m-d', strtotime('today')));
                             $join2->whereDate('npt_times_count.npt_date','>=', date('Y-m-d', strtotime('today -3 months')));
                       })
        ->orderby('machine.id', 'asc')
        ->get();
    }
}
