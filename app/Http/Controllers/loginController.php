<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Personnel; 
use App\Models\Adopter; 
use App\Models\Animal; 
use App\Models\Rescuer; 
use App\Models\AdoptedAnimal;
use App\Models\Veterinarian; 
use DataTables;
use Auth;
use Redirect;

class loginController extends Controller
{
    public function postSignin(Request $request){
        // $this->validate($request, [
        //     'email' => 'email| required',
        //     'password' => 'required| min:4'
        // ]);

    if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            
            if(auth()->check() && (auth()->user()->status !='active')){
                    Auth::logout();

                    $request->session()->invalidate(); 
                    $request->session()->regenerateToken();

                    // return redirect()->route('user.login')->with('error', 'Your Account is suspended, please contact Admin.');
                   return response()->json(["error" => "Your Account is suspended or not active yet, please contact Admin", "status" => 500]);


            }
            // else if (auth()->user()->role == 'admin') {
            //     return redirect()->route('admin.profile');
            // }   
            else {
                // return redirect()->route('profile');
                $user = User::where('email',$request->email)->first();
                $token = $user->createToken('animalshelterTokenLogin')->plainTextToken;
                return response()->json(["success" => "user login successfully.","token" => $token,"status" => 200]);


                 } 
        }
        else{
            return response()->json(["error" => "'Email-Address And Password Are Wrong.", "status" => 500]);
 
        }
     }

     public function logout() {
        Auth::logout();
        // return Redirect::to('/');
        return redirect()->URL('/'); 

    }
    public function loginpage()
    {
        if(Auth::check())
        {
            return redirect()->URL('/'); 
         }
         else{
            return view('personnel\login_personnel');

         }
    } 
    public function getProfile(){

        $user=Auth::user();


        if(Auth::check() && auth()->user()->role =='veterinarian')
        {
            // return redirect()->route('vet.profile'); 
            return redirect()->URL(''); 

         }

        else if(Auth::check() && auth()->user()->role =='rescuer')
        {
            //  return redirect()->route('rescuer.profile');
        }
        else if(Auth::check() && auth()->user()->role =='adopter')
        {
            // $profile = Auth::user(); 
            // if($profile->email_verified_at ==null)
            // {
            //     return view('auth.verify');

            // }else
            // {
            //     return redirect()->route('adopter.profile');

            // }
            return redirect()->URL('/'); 


        }
        else if(Auth::check() && auth()->user()->role =='employee')
        {
            
            $profile = Personnel::where('user_id',Auth::id())->first(); 
            
            // return view('user.employee',compact('profile'));

        }
        else{
            // return redirect()->route('admin.profile');

        }

    }

}
