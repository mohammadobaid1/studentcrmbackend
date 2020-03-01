<?php

namespace App\Http\Controllers;


use JWTAuth;
use App\User;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;



class APIController extends Controller
{
    //


    public $loginAfterSignUp = true;


    public function login(Request $request)
    {

        error_log($request);
        $input = $request->only('name', 'password');
        //error_log($input);
        $token = null;
        $customClaims = ['foo' => 'bar', 'baz' => 'bob'];
        $token = JWTAuth::attempt($input);
        error_log($token);
        $userroles = User::where('name','=',$request->name)->first();
        if (!$token) {
            error_log('here');
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'userroles'=> $userroles->role
        ]);


    }


    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }


    public function register(Request $request)
    {
        error_log($request);
        error_log($request->name);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();

        // if ($this->loginAfterSignUp) {
        //     return $this->login($request);
        // }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }


    public function deleteuser(Request $request){
        $user = User::find($request['id']);
        $user->delete();
        return response()->json([
            'success'   =>  true
        ], 200);


    }


    public function listuser(){
        $users = User::all();
        return $users;
    }


    public function updateuser(Request $request){
        $user = User::find($request->id);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->name = $request->name;
        $user->save();

        return response()->json([
            'success'   =>  true
        ], 200);


    }


    public function getuser($id){
        error_log($id);
        $user = User::find($id);
        return $user;

}

}
