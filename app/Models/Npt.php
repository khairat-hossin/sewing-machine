<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Npt extends Model
{
    protected $table= "npt_times_count";
    public $timestamps= false;

    public static function getSingleNptDetails($id, $date){
        return Npt::where('machine_id', $id)
        			->whereDate('npt_date', $date)
        			->first();
    }
}
