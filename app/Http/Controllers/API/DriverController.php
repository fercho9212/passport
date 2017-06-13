<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Validator;



class DriverController extends Controller
{
  public $successStatus=200;
  public function __construct()
  {
      $this->middleware('auth:apidriver',['only'=>['details']]);

  }

  public function login(){

    if (Auth::guard('apidriver')->attempt(['email'=>request('email'),'password'=>request('password')])) {
      $driver=Auth::guard('apidriver')->user();
      $success['token'] =  $driver->createToken('MyApp')->accessToken;
      return response()->json(['success Driver ;D' => $driver], $this->successStatus);
    }else{
      return response()->json(['errorrr'=>'Unauthorised'], 401);
      }
  }

  /**
   * Register api
   */
  public function register(Request $request){
    $validator = Validator::make($request->all(), [
         'name' => 'required',
         'email' => 'required|email',
         'password' => 'required',
         'password' => 'required',
         'last'=>'required',
         'cc'=>'required',
     ]);

     if ($validator->fails()) {
         return response()->json(['error'=>$validator->errors()], 401);
     }

     $input = $request->all();
     $input['password'] = bcrypt($input['password']);
     $driver = driver::create($input);
     $success['token'] =  $driver->createToken('MyApp')->accessToken;
     $success['name'] =  $driver->name;

     return response()->json(['success'=>$success], $this->successStatus);
  }
  public function details()
 {
     $driver = Auth::driver();
     return response()->json(['success' => $driver], $this->successStatus);
 }
}
