<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthenticationController extends Controller
{
  public function login(Request $request){

    $user = User::where('mobile',$request->mobile)->firstOrFail();
    if($user){
        if(Auth::attempt(['email'=> $user->email ,'password'=> $request->password])){
            $user = Auth::user();
            $token = $user->createToken('login')->accessToken;
            return response()->json(['user' => $user ,'token' => $token ] , 201);
        }
        else{
            return response()->json(['message'=>'password is wrong'] , 403);
        }
    }
    else{
        return response()->json(['message'=>'mobile is wrong'] , 404);
    }

   }

   public function register(Request $request){
//         $request->validate([
//            'mobile' => ['required' , 'string' , 'max:11' , 'unique:user,mobile'],
//            'password' => ['required' , 'string' , 'min:5'],
//        ]);
        $user = new User();
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return response()->json(['user'=>$user,201]);
    }

    public function logout(){
        if(Auth::check()){
            Auth::user()->token()->delete();
            return response()->json(['message'=>'you logout'] , 201);
        }
        else{
            return response()->json(['message'=>'error'] , 404);
        }
    }

    public function resetPassword (Request $request){

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();
           return response()->json(['user'=>$user] , 201);
        }
       else{
            return response()->json(['message'=>'old password is wrong'] , 404);
        }
    }
}
