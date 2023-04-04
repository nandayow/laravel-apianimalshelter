<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Animal;
use App\Models\AnimalMedicalCondition;
use App\Models\AdoptedAnimal;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Adopter;

use Response;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function index(Request $request)
    {
        $animals = DB::table('animals')
            ->leftjoin('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
            ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->where('animals.healthstatus', '=' ,'Cured') 
            ->whereNull('adopted_animals.animal_id')
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type') 
             ->get();
            //  $token = PersonalAccessToken::where('token', $hashedToken)->first();
    
            // echo($token);
             $adoptedAnimal= AdoptedAnimal::pluck('animal_id'); 

 

             $adopted= DB::table('adopters')
             ->join('adopted_animals','adopted_animals.adopter_id','=', 'adopters.id')
             ->join('animals','animals.id','=', 'adopted_animals.animal_id')
             ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
             ->where('adopted_animals.status', '=' ,'Approved') 
             ->Select('animals.*' ,'animal_categories.*' ,'adopters.*','animals.id as animalid','animals.id as animalid','animals.image as animalimage') 
            ->get();  

            //  dd($adopted);


            return view('animalshelter/index',compact('animals','adopted')); 
            
            $animaldisease = DB::table('animal_diseases')
            ->Select('animal_diseases.*')
            ->get();
        //    echo($animal);
            return view('animalshelter/index',['animal_diseases'=>$animal]);
 
    } 
      public function search(Request $req)
    { 
        // $animals = DB::table('animals')
        // ->leftjoin('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
        // ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
        // ->where('animals.healthstatus', '=' ,'Cured') 
        // ->whereNull('adopted_animals.animal_id')
        // ->where('animal_categories.breed_name','like' ,'%'.$req
        // ->input('query').'%') 
        // ->select('animals.*','animals.id as animalid','animal_categories.*','adopted_animals.*')
        // ->get();

        // $animals1 = DB::table('animals')
        // ->leftjoin('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
        // ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
        // ->where('animals.healthstatus', '=' ,'Cured') 
        // ->whereNull('adopted_animals.animal_id')
        // ->where('animal_categories.animal_type','like' ,'%'.$req
        // ->input('query').'%') 
        // ->select('animals.*','animals.id as animalid','animal_categories.*','adopted_animals.*')
        // ->get();
 
        // return view('animalshelter.search',compact('animals1','animals'));

    }  public function store(Request $request)
    {
        $user = Auth::user(); 
        $profile = Adopter::where('user_id',Auth::id())->first();

        $input = $request->input('animal_id');
 
 
        if($user->role =='adopter')
        {
            $adopted_animals = new Adopter();

            $userId =  $profile->id;
            $animal_id = $input; 

            $adopted_animals->animals()->attach($userId,['animal_id'=> $animal_id,'status'=>'Pending']);
            
             return response()->json(["success" => "Wait for the admin to accept your request.","data" => $adopted_animals,"status" => 200]);


        }else 
        {   
            return response()->json(["error" => "You need to login your adopter account","status" => 500]);
        }
      
    }
}
 