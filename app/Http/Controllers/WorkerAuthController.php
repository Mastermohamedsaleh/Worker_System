<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Worker;
use Validator;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\WorkerRegisterRequest;
use App\Services\WorkerService\WorkerLoginService\WorkerLoginService;
use App\Services\WorkerService\WorkerRegisterService\WorkerRegisterService;




class WorkerAuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:worker', ['except' => ['login', 'register']]);
    }
 
    public function login(LoginRequest $request){
    	// $validator = Validator::make($request->all(), [
        //     'email' => 'required|email',
        //     'password' => 'required|string|min:6',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        // if (! $token = auth()->guard('worker')->attempt($validator->validated())) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        // return $this->createNewToken($token);
    
  
         
        // return (new WorkerLoginService())->login($request);
            return (new WorkerLoginService())->login($request);
    }
 

    public function register(WorkerRegisterRequest $request) {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|between:2,100',
        //     'email' => 'required|string|email|max:100|unique:workers',
        //     'password' => 'required|string|min:6',
        //     'phone' => 'required',
        //     'photo' => 'required|image',
        //     'location' => 'required|string',
        // ]);
        // if($validator->fails()){
        //     return response()->json($validator->errors()->toJson(), 400);
        // }
        // $worker = Worker::create(array_merge(
        //             $validator->validated(),
        //             [
        //                 'password' => bcrypt($request->password),
        //                 'photo' => $request->file('photo')->store('workers')
        //             ]
        //         ));
        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'user' => $worker
        // ], 201);
        return (new WorkerRegisterService())->register($request);
    }

 
    public function logout() {
        auth()->guard('worker')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
  
    

    public function refresh() {
        return $this->createNewToken(auth()->guard('worker')->refresh());
    }

 
    public function userProfile() {
        return response()->json(auth()->guard('worker')->user());
    }


    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->guard('worker')->user()
        ]);
    }
}