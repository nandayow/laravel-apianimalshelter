<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Animal;
use App\Models\Rescuer;
use Illuminate\Support\Facades\Hash;
use App\Models\Adopter; 
use App\Models\User; 
use Auth;
use Illuminate\Support\Facades\Storage;
use Response;
 
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
              'email' => $request->input('email'),
              'password' => bcrypt('password'),
              'role' => 'adopter',
           ]); 
           $user->save();

        //    $token = $user->createToken('animalshelterToken')->plainTextToken;


                    
                $adopter = new Adopter();
                $adopter -> fname = $request->fname;
                $adopter -> lname = $request->lname;
                $adopter -> phone = $request->phone;
                $adopter -> user_id =  $user->id; 
                $adopter -> birth_date = $request->birth_date;
                 $adopter -> email = $request->email;
                 $adopter->save(); 
        

                return Response::json(array(
                    'data' => $adopter, 
                ));

    }

    public function logout(Request $request)
    {

        $user = $request->user();
        $user->tokens()->delete();
        Auth::guard('web')->logout();   

         return response()->json([
            'status_code' => '200',
            'message' => 'logged out successfully'
        ]);
 
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);


            $user = User::where('email',$request->email)->first();
            if(!$user || !Hash::check($request->password, $user->password))
            {
                return response(['message' => 'Invalid Crednentials'],401);
            }else{

                $token = $user->createToken('animalshelterTokenLogin')->plainTextToken;

            return Response::json(array(
                        'data' => $user,
                        'token' => $token, 
                    ));

            }

    }
}
