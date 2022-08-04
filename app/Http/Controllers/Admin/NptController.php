<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Line;
use App\Models\Setup\Machine;
use App\Models\Setup\Location;
Use App\Models\ErrorList;
Use App\Models\Npt;
use Input;
use DB, PDF;
class NptController extends Controller
{
    //index page
    public function index(){
            $date= date("Y-m-d", strtotime("today"));
    		$npts= $this->getNpt($date);
    	return view('admin.npt.index', compact('npts'));
    }


    public function getNpt($date){
        
        return DB::table('npt_times_count')
                    ->select([
                        'npt_times_count.*',
                        'machine.machine_name'
                    ])
                    ->whereDate('npt_date', $date)
                    ->leftJoin('machine', 'machine.id', 'npt_times_count.machine_id')
                    ->get();
    }

    //get NPT by date
    public function nptByDate(Request $request){
        $date= $request->date;
        $npts= $this->getNpt($date)->toArray();
        return $npts;
    }

    //Date wise NPT PDF download
    public function nptByDatePDF(Request $request){
        $data= $this->getNpt($request->npt_date)->toArray();
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'orientation' => 'L']); //pagev format
        $stylesheet = file_get_contents('public/css/custom.css'); // external css
        $mpdf->WriteHTML($stylesheet,1);
        $code = view('admin.npt.table_part', compact('data'));
        $title= "npt.pdf";
        $mpdf->WriteHTML($code);
        $mpdf->Output($title, 'I');
    }
}
