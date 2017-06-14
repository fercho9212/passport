<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus=200;

    public function __construct()
    {
        $this->middleware('auth:api',['only'=>['details','saludo']]);
    }

    protected function guard()
{
    return Auth::guard('auth');
}

    public function login(){
      if (Auth::attempt(['email'=>request('email'),'password'=>request('password')])) {
        $user=Auth::user();
        $success['token'] =  $user->createToken('MyApp sd')->accessToken;
        return response()->json(['result' => $success,'rpt'=>'success'],$this->successStatus);
      }else{
        return response()->json(['result'=>'Unauthorised','rpt'=>'error'], 200);
        }
    }

    /**
     * Register api
**/
    public function register(Request $request){
      $validator = Validator::make($request->all(), [
           'name' => 'required',
           'email' => 'required|email',
           'password' => 'required',
           'c_password' => 'required|same:password',
       ]);

       if ($validator->fails()) {
           return response()->json(['error'=>$validator->errors()], 200);
       }

       $input = $request->all();
       $input['password'] = bcrypt($input['password']);
       $user = User::create($input);
       $success['token'] =  $user->createToken('MyApp')->accessToken;
       $success['name'] =  $user->name;

       return response()->json(['success'=>$success,'rpt'=>'success'], $this->successStatus);
    }
    public function details()
   {
     return response()->json(['user' => Auth::guard('api')->user()]);
   }
   public function saludo(){
     return 'Esta es una funcion';
   }

}
