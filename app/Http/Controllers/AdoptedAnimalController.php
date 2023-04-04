<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Animal;
use App\Models\User;
use App\Models\Rescuer;
use Illuminate\Support\Facades\Hash;
use App\Models\Adopter; 
use Illuminate\Support\facades\DB;
use App\Models\AdoptedAnimal;
use Illuminate\Support\Facades\Session;
use Auth;  
class AdoptedAnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animal = DB::table('adopted_animals')  
       ->join('animals','animals.id','=','adopted_animals.animal_id') 
       ->leftjoin('adopters','adopters.id','=','adopted_animals.adopter_id')  
       ->Select('animals.*','adopters.*','adopters.id as adopters_myid' ,'adopted_animals.status','adopted_animals.animal_id','animals.id as animal_origid')  
         ->get();

       
       return response()->json(["data"=>$animal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user(); 
        $profile = Adopter::where('user_id',Auth::id())->first();

        // return response()->json(["success" => "adopter successfully selected.","data" => $profile,"status" => 200]);

        if($user->role =='adopter')
        {
            $adopted_animals = new Adopter();

            $userId =  $profile->id;
            $animal_id = $request ->animal_id; 

            $adopted_animals->animals()->attach($userId,['animal_id'=> $animal_id,'status'=>'Pending']);
            
            //  return redirect()->back()->with('success','Wait for the admin to accept your request');
            return response()->json(["success" => "Wait for the admin to accept your request.","data" => $adopted_animals,"status" => 200]);


        }else 
        {   
            return redirect()->back()->with('success','Login Your adopter account!');
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
      
           
    
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         
        // $adopted_animals = new Adopter();
        // $animalid=$request->animal_id;
        // $adopter_id=$request->adopter_id;
          $messages  = AdoptedAnimal::where('animal_id', $id)->first(); 
          $messages->status ="Approved";  
          $messages->save();
          return response()->json(["success" => "Adoption accepted.","data" => $messages,"status" => 200]);

        //  $adopted_animals->animals()->updateExistingPivot($adopter_id,['animal_id'=> $animalid,'status'=>'approved']);

        // return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          
            $animals =AdoptedAnimal::where('animal_id',$id)->delete(); 
           return response()->json(["success" => "adoption deleted successfully.","data" => $animals,"status" => 200]);

        // return redirect()->back();
    }
    public function adoptedindex()
    {
    $adopted= DB::table('adopters')
    ->join('adopted_animals','adopted_animals.adopter_id','=', 'adopters.id')
    ->join('animals','animals.id','=', 'adopted_animals.animal_id')
    ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
    ->where('adopted_animals.status', '=' ,'Approved') 
    ->Select('animals.*' ,'animal_categories.*' ,'adopters.*','animals.id as animalid','animals.id as animalid','animals.image as animalimage') 
   ->get();
   
   return response()->json(["success" => "adopted  selected successfully.","data" => $adopted,"status" => 200]);


    }
}
