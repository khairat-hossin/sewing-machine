<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    //
    protected $table= 'target';
    public $timestamps= false;

    //get date wise target
    public static function getTarget($id, $date){
    	return Target::where('machine_id', $id)
    				->where('target_date', '>=', $date)
    				->where('target_date', '<=', $date)
    				->first();
    }
}
