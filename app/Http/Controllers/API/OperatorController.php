<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Models\Setup\Process;
use App\Models\Setup\Location;
use App\Models\Setup\Operator;
use App\Models\Device;
use DB;
class OperatorController extends Controller 
{
	public $successStatus = 200;
	/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 

            
            $success['style_name']   ="";
            $success['process_name'] ="";
            $success['buyer_name'] ="";
            $success['user_name'] ="";

            //process name for showing in app display
			$user_id= $user->id;

			$device= Device::where('user_id', $user_id)->first();
			if($device){
				$success['style_name']  = $device->style_name;
                $success['buyer_name']  = $device->buyer_name;
                $success['userid']      = $device->userid;
                $success['user_name'] =$user->name;
				$process= Process::where('id', $device->process_id)->first();
				if(!empty($process)){
					$success['process_name']= $process->process_name;
				}  
				
			}

            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
	/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required', 
            'c_password'        => 'required|same:password',  

            'device_name' 	    => 'required', 
            'device_model_no' 	=> 'required', 
            'device_id'         => 'required|unique:device', 
            'process_id'       => 'required', 
            'location_id'       => 'required', 
            'style_name'        => 'nullable',   
            'buyer_name'        => 'nullable'    
        ]);

		if ($validator->fails()) { 
            return response()->json(['error'=>"Incorrect input data!"]);            
        }
	    $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $reg['name']= $request->name;
        $reg['email']= $request->email;
        $reg['password']= bcrypt($request->password);

        DB::beginTransaction();

        try {
            $user = User::create($reg);
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['name'] =  $user->name;
            $user_id= $user->id;

            $device= new Device();


            $userid="";
            $userid= substr($request->name, 0,2).substr($request->device_name, 0,2).rand(10,99);

            $device->user_id        = $user_id;
            $device->userid        = strtoupper($userid);
            $device->device_name    = $request->device_name;
            $device->device_model_no= $request->device_model_no;
            $device->device_id      = $request->device_id;
            $device->process_id     = $request->process_id;
            $device->location_id    = $request->location_id;
            $device->style_name     = $request->style_name;
            $device->buyer_name     = $request->buyer_name;
            $device->save();

            DB::commit();
            return response()->json(['success'=>$success], $this-> successStatus); 
            
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();

            return response()->json(['error'=>"Wrong Input!"], 401); 
        }

        
    }
	/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 

    //get process list for register page
    public function getProcessList(){
    	$processList= Process::select([
    					'id',
    					'process_id',
    					'process_name'
    				])
    				->get();
    	return $processList;
    }


    //get Location List for register page
    public function getLocationList(){
    	$locationList= Location::select([
    					'id',
    					'location_name'
    				])
    				->get();
   		return $locationList;
    }
}