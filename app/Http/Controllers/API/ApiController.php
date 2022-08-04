<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Machine;
use App\Models\Setup\Target;
use App\Models\Setup\Process;
Use App\Models\ErrorList;
use App\Models\Device;
use App\Models\Npt;
use DB,Auth;

/*
	* This Controller is for all types of api's
*/

class ApiController extends Controller
{

    //     public function login(){ 
    //     if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 


    //         $user = Auth::user(); 
    //         $success['token'] =  $user->createToken('MyApp')-> accessToken; 

            
    //         $success['style_name']   ="";
    //         $success['process_name'] ="";
    //         $success['buyer_name'] ="";
            

    //         //process name for showing in app display
    //         $user_id= $user->id;

    //         $device= Device::where('user_id', $user_id)->first();

    //         if($device){
    //             $success['style_name']= $device->style_name;
    //             $success['buyer_name']= $device->buyer_name;
    //             $success['userid']= $device->userid;
    //             $process= Process::where('id', $device->process_id)->first();
                
    //             if(!empty($process)){
    //                 $success['process_name']= $process->process_name;
    //             }  
                
    //         }
            
    //         return response()->json(['success' => $success], $this->successStatus); 
    //     } 
    //     else{ 
    //         return response()->json(['error'=>'Unauthorised'], 401); 
    //     } 
    // }
    // /** 
    //  * Register api 
    //  * 
    //  * @return \Illuminate\Http\Response 
    //  */ 
    // public function register(Request $request) { 
    //     $validator = Validator::make($request->all(), [ 
    //         'name'              => 'required',
    //         'email'             => 'required|email',
    //         'password'          => 'required', 
    //         'c_password'        => 'required|same:password',  

    //         'device_name'       => 'nullable', 
    //         'device_model_no'   => 'nullable', 
    //         'device_id'         => 'nullable', 
    //         'process_id'       => 'required', 
    //         'location_id'       => 'required', 
    //         'style_name'        => 'nullable',   
    //         'buyer_name'        => 'nullable'   
    //     ]);

    //     if ($validator->fails()) { 
    //         return response()->json(['error'=>$validator->errors()], 401);            
    //     }
    //     $input = $request->all(); 
    //     $input['password'] = bcrypt($input['password']); 
    //     $reg['name']= $request->name;
    //     $reg['email']= $request->email;
    //     $reg['password']= bcrypt($request->password);

    //     return $request->all();

    //     DB::beginTransaction();



    //     try {
    //         $user = User::create($reg);
    //         $success['token'] =  $user->createToken('MyApp')->accessToken; 
    //         $success['name'] =  $user->name;
    //         $user_id= $user->id;

    //         $device= new Device();

    //         $userid="";
    //         $userid= substr($request->name, 0,2).substr($request->device_name, 0,2).rand(10,99);

    //         $device->user_id        = $user_id;
    //         $device->userid        = $userid;
    //         $device->device_name    = $request->device_name;
    //         $device->device_model_no= $request->device_model_no;
    //         $device->device_id      = $request->device_id;
    //         $device->process_id     = $request->process_id;
    //         $device->location_id    = $request->location_id;
    //         $device->style_name     = $request->style_name;
    //         $device->buyer_name     = $request->buyer_name;
    //         $device->save();
    //         DB::commit();



    //         return response()->json(['success'=>$success], $this-> successStatus); 
            
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return $e->getMessage();

    //         return response()->json(['error'=>"Wrong Input!"], 401); 
    //     }

        
    // }
    //Set Achievement of Target
    public function setAchievement(Request $request){
        $requet_response['status']=false;
        $requet_response['message']=null;
    	# check device id sent or not
    	if($request->has('device_id')){

    		# If device id found then find the assigned machine

    		$machine_id= Device::where('device_id', $request->device_id)->pluck('machine_id')->first();

    		# if machine is assigned then find whether target is assigned or not for   # that date
    		# otherwise return response as no machine is assigned 

    		if($machine_id){
    			$target= Target::where('machine_id', $machine_id)
                                // ->whereDate('target_date', today())
                                ->first();
    			
    			if($target){
    				$achieved_value= (int) $target->achieved_value;
                    DB::beginTransaction();
    				try {
                        //update achievement
                        Target::where('id', $target->id)
                            ->update(['achieved_value'=> ($achieved_value+1)]);

                        //achievement count
                        DB::table('achievement_count_times')
                            ->insert([
                                'machine_id' => $machine_id,
                                'counter_time' => now()
                            ]);

                        DB::commit();
                        $requet_response['status']=true;
                        $requet_response['message']="1 Target Achieved";
                        return $requet_response;
                        
                    } catch (Exception $e) {
                        DB::rollback();
                        $requet_response['message']="Something went wrong";
                        return $requet_response;
                        
                    }
    			}
    			else{
                    $requet_response['message']="No target assigned";
                    return $requet_response;
    			}
    		}
    		else{
                $requet_response['message']="No machine assigned";
    			return $requet_response;
    		}
    	}
    	else{

            $requet_response['message']="No device delected";
    		return $requet_response;
    	}
    }

    //get Target List by device id
    public function getTargetValue(Request $req){
        $requet_response['status']=false;
        $requet_response['target_value']=null;

        $target_value=0;
        $machine_id= Device::where('device_id', $req->device_id)->pluck('machine_id')->first();
        if($machine_id){
            $target_value= Target::where('machine_id', $machine_id)
                                    // ->where('target_date', today())
                                    ->pluck('target_value')
                                    ->first();
                                    
            if($target_value){
                $requet_response['status']=true;
                $requet_response['target_value']=$target_value;
            }
            else{
                $requet_response['target_value']=0;
            }
        }
        return $requet_response;
    }

    //machine status update from api
    public function updateMachineStatus(Request $req){

        $status="No machine is assigned for this device";
        $is_machine_id= Device::where('device_id', $req->device_id)->pluck('machine_id')->first();

        $requet_response['request_status']=null;
        $requet_response['response_message']="";
        if($is_machine_id>0){
        //  try {

                $existing_status= Machine::where('id', $is_machine_id)
                                    ->pluck('machine_status')
                                    ->first();
                /*
                    *Turn off machine
                    *if machine status is on/error then machine off is possible otherwise return "machine is already turned off"
                */
                if($req->status==0){
                    if($existing_status==0){

                        $requet_response['request_status']=false;
                        $requet_response['response_message']="Can not update, Machine already turned off";
                        return $requet_response;
                    }
                    else{
                        //update machine table
                        Machine::where('id', $is_machine_id)
                                ->update(['machine_status'=> $req->status]);

                        //update error list table
                        $this->solveError($is_machine_id, $req->status);

                        $requet_response['request_status']=true;
                        $requet_response['response_message']="Machine turned off";
                        return $requet_response;
                    }
                }

                /*
                    *Turn on machine
                    *if machine status is off then machine on is possible otherwise return "machine is already turned on"
                */

                else if($req->status==1){
                    if($existing_status==0){
                        //update machine table
                        Machine::where('id', $is_machine_id)
                                ->update(['machine_status'=> $req->status]);

                         //update error list table
                        $this->solveError($is_machine_id, $req->status);
                               
                        $requet_response['request_status']=true;
                        $requet_response['response_message']="Machine turned on";
                        return $requet_response;
                    }
                    else{
                        $requet_response['request_status']=false;
                        $requet_response['response_message']="Can not update, Machine already turned on";
                        return $requet_response;
                    }
                }

                /*
                    *Machine Errors Update
                    *if machine status is on(not in error state) then machine status change is possible otherwise return specific message
                */

                else if($req->status>1  && $req->status<=8){
                    if($existing_status==1){

                        //update machine table
                        Machine::where('id', $is_machine_id)
                                ->update(['machine_status'=> $req->status]);

                        //update error list table
                        $this->solveError($is_machine_id, $req->status);

                        
                        /*
                            ====== NPT Update ===============
                            if there npt(by machine id) exists then update  otherwise insert
                        */
                        $npt_type="";
                        if($req->status==2) $npt_type="machine_problem";
                        if($req->status==3) $npt_type="needle_broken";
                        if($req->status==4) $npt_type="thread_broken";
                        if($req->status==7) $npt_type="refreshment";
                        if($req->status==8) $npt_type="others";

                        $npt= Npt::where('machine_id', $is_machine_id)
                                    ->whereDate('npt_date', date('Y-m-d', strtotime('Today')))
                                    ->exists();
                        if($npt){
                            $npt_existing_value= Npt::where('machine_id', $is_machine_id)
                                                    ->whereDate('npt_date', date('Y-m-d', strtotime('Today')))
                                                    ->pluck($npt_type)
                                                    ->first();

                            $npt_new= Npt::where('machine_id', $is_machine_id)
                                            ->whereDate('npt_date', date('Y-m-d', strtotime('Today')))
                                            ->update([
                                                $npt_type => ($npt_existing_value+1)
                                            ]);
                        }
                        else{
                            Npt::insert([
                                            'machine_id'=> $is_machine_id,
                                            'npt_date' => date('Y-m-d', strtotime('Today')),
                                            $npt_type=> 1
                                        ]);
                        }

                        /*
                            ====== NPT END ===============
                        */



                        $requet_response['request_status']=true;
                        $requet_response['response_message']="Machine error status updated";
                        return $requet_response;
                        
                    }
                    else if($existing_status==0){
                        $requet_response['request_status']=false;
                        $requet_response['response_message']="Can not update, Machine is turned off";
                        return $requet_response;
                    }
                    else{
                        $requet_response['request_status']=false;
                        $requet_response['response_message']="Can not update, Machine is already in error";
                        return $requet_response;
                    }
                }


                /*
                    *Error Solve
                    *if machine status is off then machine on is possible otherwise return "machine is already turned on"
                */

                else if($req->status==100){
                    if($existing_status>1 && $existing_status<=8){
                        //update machine table
                        Machine::where('id', $is_machine_id)
                                ->update(['machine_status'=> 1]);

                         //update error list table
                        $this->solveError($is_machine_id, 100);
                               
                        $requet_response['request_status']=true;
                        $requet_response['response_message']="Machine Error solved";
                        return $requet_response;
                    }
                    else{
                        $requet_response['request_status']=false;
                        $requet_response['response_message']="Can not update, Machine in not in error state!";
                        return $requet_response;
                    }
                }
                else{
                    $requet_response['request_status']=false;
                    $requet_response['response_message']="Can not update, Incorrect status code";
                    return $requet_response;

                }
            $requet_response['request_status']=false;
            $requet_response['response_message']="No machine is assigned for this device";
           return response()->json($requet_response);  
        }
        $requet_response['request_status']=false;
        $requet_response['response_message']="No machine is assigned for this device";
        return response()->json($requet_response);
    }

    //solve error
    public function solveError($machine_id, $status){
        
        // return "hello";
        ErrorList::insert([
                'error_no'          => $status,
                'machine_id'        => $machine_id,
                'error_date'        => date('Y-m-d', strtotime('Today')),
                'error_start_at'    => now(),
            ]);
    }

}
