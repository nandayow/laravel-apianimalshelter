<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use view;
use redirect;
use App\Models\AnimalCategory;
use App\Models\Animal;
use App\Models\AnimalHealth; 
use App\Models\Adopter;
use App\Models\Comment;
use App\Models\AnimalMedicalCondition;
use Illuminate\Support\facades\DB;
use App\Models\AdoptedAnimal;
use Illuminate\Support\Facades\Session;
use DataTables;
use Auth;
use App\Models\Veterinarian;  
use Illuminate\Support\Facades\Event;
use App\Events\SendMail; 
use Carbon\Carbon;
use Response;
use App\Models\Rescuer;    
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // $user = Auth::user(); 
        // $profile = Veterinarian::where('user_id',Auth::id())->first();
        // dd($profile);
        
        $animal = DB::table('animals') 
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
            ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
            ->WhereNull('deleted_at')
            ->whereNull('adopted_animals.animal_id')
            ->orderBy('animals.id', 'ASC')
            ->get();
        //    echo($animal); 

        if ($request->ajax()) { 
            return Datatables::of($animal) 
               ->addIndexColumn()
               ->addColumn('action', 'animal.action') 
               ->rawColumns(['action'])
               ->make(true);
       }
      
       //  $profile = Veterinarian::where('user_id',Auth::id())->first();

       return view('animal.animal_index');

       $animal = Animal::all();
       dd($animal);
   }public function getAnimalAll(Request $request)
   {
       // if ($request->ajax()){
       //     $customers = Customer::orderBy('customer_id', 'DESC')->get();
        
       //     return response()->json($customers);
       // }

       $animal = DB::table('animals') 
       ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
       ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
       ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
    //    ->WhereNull('deleted_at')
       ->whereNull('adopted_animals.animal_id')
       ->orderBy('animals.id','DESC')
       ->get();

       
       return response()->json(["data"=>$animal]);
   }

   public function indexadopted(Request $request)
    {
        $animal = DB::table('animals') 
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
            ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
            ->WhereNull('deleted_at')
            ->whereNotNull('adopted_animals.animal_id')
            ->get();
            
            return response()->json(["data"=>$animal]);

        //     if ($request->ajax()) { 
        //         return Datatables::of($animal) 
        //            ->addIndexColumn()
        //            ->addColumn('action', 'animal.action') 
        //            ->rawColumns(['action'])
        //            ->make(true);
        //    }
        // return view('animal.animal_adopted');
    }  
    public function indexTrash(Request $request)
    {
        $animal = DB::table('animals') 
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
            ->WhereNotNull('deleted_at')
            ->get();
        //    echo($animal); 
        if ($request->ajax()) { 
            return Datatables::of($animal) 
               ->addIndexColumn()
               ->addColumn('action', 'animal.actiontrash') 
               ->rawColumns(['action'])
               ->make(true);
       }
        return view('animal.animal_trash');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = Auth::user();
        if( $profile->role =='employee')
        {
            $animal_breed = AnimalCategory::pluck('breed_name' ,'id');
            return view('animal/animal_create', compact( 'animal_breed')); 
        
        }
        else
        {
            return redirect('animal')->with('error' ,'You must login!');
        }      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        //   $validated = $request->validate
        //   ([
            
        //      'animal_name' => 'required',
        //      'gender' => 'required|min:1',
        //      'approximate_age' => 'required|min:1', 
        //      'image' => 'required|mimes:jpg,png,jpeg',
        //      'rescued_date' => 'required',
              
        //   ]); 
        // $name = $request->file('image')->getClientOriginalName();
        // $path= $request->file('image')->storeAs('public/images/',$name);
        // $animal = new Animal();
      
        // $animal ->animal_name = $request->animal_name;
        // $animal ->gender = $request->gender;
        // $animal ->approximate_age = $request->approximate_age;
        // $animal ->category_id = $request->get('animal_breed');
        // $animal ->rescuer_id = $request->rescuer_id;
        // $animal ->healthstatus = 'Not Cured';
        // $animal ->image = $name;
        // $animal ->rescued_date= $request->rescued_date;
        //  $animal->save();
     
        // foreach ($request->$injury as $condition)
        //   {
        //     $animal_condition = new AnimalHealth;
        //     $animal_condition->condition_id= $condition;
        //     $animal_condition->animal_id= $animal->id;
        //     $animal_condition->save();
        //   } 

        //    Event::dispatch(new SendMail(2));

        // return redirect()->route('rescuer.show',$request->rescuer_id)->with('success','New Animal  added!');

            if ($request->fname =="")
            {


                $animal = new Animal; 
                $animal->animal_name =$request->animal_name; 
                $animal->approximate_age =$request->approximate_age; 
                $animal->category_id = $request->sel_breed;
                $animal->gender =$request->gender;
                $animal->healthstatus = "Not Cured"; 
                $animal->rescuer_id =$request->rescuer_animal;
                $animal->rescued_date =$request->rescued_date;
                $files = $request->file('uploads');
                $animal->image = 'storage/images/'.$files->getClientOriginalName();
                $animal->save();
                $last = $animal->id;
                
            }else
            {

       
        $rescuer = new Rescuer(); 
        $rescuer -> fname = $request->fname;
        $rescuer -> lname = $request->lname;
        $rescuer -> phone = $request->phone;
        $rescuer -> addressline = $request->addressline;
        $rescuer -> town = $request->town;
        $rescuer -> zipcode = $request->zipcode;
        $rescuer->save();
        $rescuerid=$rescuer->id;

        $animal = new Animal; 
        $animal->animal_name =$request->animal_name; 
        $animal->approximate_age =$request->approximate_age; 
        $animal->category_id = $request->sel_breed;
        $animal->gender =$request->gender;
        $animal->healthstatus = "Not Cured"; 
        $animal->rescuer_id =$rescuerid;
        $animal->rescued_date =$request->rescued_date;
        $files = $request->file('uploads');
        $animal->image = 'storage/images/'.$files->getClientOriginalName();
        $animal->save();
        $last = $animal->id;
    }
         $data=array('status' => 'saved');
        Storage::put('public/images/'.$files->getClientOriginalName(),file_get_contents($files));  
        return response()->json(["success" => "animal created successfully.","data" => $last]); 
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
        return Response::json(Animal::with('category','rescuer')->find($id));
    }

    public function animnalshow($id)
    {
        $animalid = Animal::find($id);
        $animal = DB::table('animals') 
        ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
        ->join('rescuers' ,'rescuers.id' ,'=' ,'animals.rescuer_id')
        ->where('animals.id','=', $id)
        ->Select('animals.*','rescuers.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
        ->first();
        
        $animalhealth= DB::table('animal_healths')
        ->join('animal_medical_conditions' , 'animal_medical_conditions.id', '=' ,'animal_healths.condition_id')
        ->where( 'animal_id',$id) 
        ->Select('animal_medical_conditions.*' ,'animal_healths.*')
        ->get();
         
        $adopters= DB::table('adopters')
        ->join('adopted_animals' , 'adopters.id', '=' ,'adopted_animals.adopter_id')
        ->join('animals' , 'animals.id', '=' ,'adopted_animals.animal_id')
        ->where( 'animal_id',$id) 
        ->Select('animals.*' ,'adopters.*')
        ->get();
         $comments = Comment::where("animal_id","=",$id)->get();  

        // dd($comments);
         $date = Carbon::parse($animal->created_at)->format('Y-m-d');
         $time = Carbon::parse($animal->created_at)->format('H:i');      
         $commentCount = $comments->count();
         // dd($animalcondition);
        // dd($animalhealth);

        return view('guest.show',compact('animalid' ,'animal' ,'animalhealth' ,'adopters','date','time','comments','commentCount')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $animalid = Animal::find($id);
         $animal = DB::table('animals') 
        ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
        ->join('rescuers' ,'rescuers.id' ,'=' ,'animals.rescuer_id')
        ->where('animals.id','=', $id)
        ->Select('animals.*','rescuers.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
        ->get();
        
        $animalhealth= DB::table('animal_healths')
        ->where( 'animal_id',$id) 
        ->pluck('condition_id')->toArray();
        
        // $animal_breed = AnimalCategory::pluck('breed_name' ,'id');

        $animalcondition= AnimalMedicalCondition::all();

        // // dd($animalcondition);

        
        $animalconditionnew= DB::table('animal_medical_conditions')
        ->join('animal_healths','animal_healths.condition_id','=','animal_medical_conditions.id')
         ->select('animal_medical_conditions.condition_name','animal_medical_conditions.id')
         ->where('animal_healths.animal_id','=',$id)  
          ->groupby('animal_medical_conditions.condition_name','animal_medical_conditions.id')
        ->get();

        //  $animalhealths=(Animal::with('animalhealth')->get());

        // dd($animalhealths);
         $animalid = Animal::find($id);
        return Response::json(array(
            'animalimage' => $animalid,
            'animal' => $animal,
            'animalhealth' => $animalhealth,
            'animalcondition' => $animalcondition,
            'animalconditionnew'=>$animalconditionnew,
        ));
        // return Response::json(Animal::with('category')->find($id));
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
  
     
        // if(empty($request->file('image')))
        // {
        //     //  $animalid->update($request->all());
        //     $animalid ->animal_name = $request->animal_name;
        //     $animalid ->vet_id=$profile->id;
        //     $animalid ->gender = $request->gender;
        //     $animalid ->approximate_age = $request->approximate_age;
        //     $animalid ->category_id = $request->category_id;
        //     $animalid ->rescuer_id = $request->rescuer_id; 
        //     $animalid ->healthstatus = $request->healthstatus;
        //      $animalid ->rescued_date= $request->rescued_date;
        //     $animalid->save();
        // }else{
            $user =  $request->input('vet_id');
            $profile = Veterinarian::where('user_id',$user)->first();
            $animalconditionid=$request->input('try');
            $myrescuer = $request->input('rescuer_animal');   
            $category = $request->input('category');

       
            if(empty($myrescuer))
            {
                $animal = Animal::find($id);  
                $animal->animal_name = $request->input('animal_name');
                $animal->gender = $request->input('gender');
                $animal->healthstatus ='Cured';
                $animal->approximate_age = $request->input('approximate_age'); 
                $animal->rescued_date = $request->input('rescued_date'); 
                $animal->category_id = $request->input('category');  
                $animal->vet_id = $profile->id;
                $larawan= $request->input('image');
                $animal->image = 'storage/images/'.$larawan;     
                $animal->update(); 

            } else if(empty($request->input('larawan')))
            {
                $animal = Animal::find($id);  
                $animal->animal_name = $request->input('animal_name');
                $animal->gender = $request->input('gender');
                $animal->healthstatus = $request->input('healthstatus');
                $animal->approximate_age = $request->input('approximate_age'); 
                $animal->rescued_date = $request->input('rescued_date'); 
                $animal->category_id = $request->input('category');  
                $animal->vet_id = $profile->id;
                $animal->rescuer_id = $request->input('rescuer_animal');     
                $animal->update(); 
            }
            else
            {
                $animal = Animal::find($id);  
                $animal->animal_name = $request->input('animal_name');
                $animal->gender = $request->input('gender');
                $animal->healthstatus = $request->input('healthstatus');
                $animal->approximate_age = $request->input('approximate_age'); 
                $animal->rescued_date = $request->input('rescued_date'); 
                $animal->category_id = $request->input('category');  
                $animal->vet_id = $profile->id;
                $animal->rescuer_id = $request->input('rescuer_animal');   
                 $larawan= $request->input('image');
                $animal->image = 'storage/images/'.$larawan;     
                $animal->update(); 
            } 
     
       
        if(empty($animalconditionid))
        {
            DB::table('animal_healths')->where('animal_id', $id)->delete();
        }
        else
        {
            foreach($animalconditionid as $conditionid)
            {
                DB::table('animal_healths')->where('animal_id', $id)->delete();
    
            }
            foreach($animalconditionid as $conditionid)
            {
                DB::table('animal_healths')->insert(['condition_id'=>$conditionid,'animal_id'=>$id]);
    
            }
        }  
        
        return response()->json(["success" => "larawan created successfully.","item" => $animal,"status" => 200]);  

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
    //  $animals = Animal::findOrFail($id);
    //  $animals->delete();

    //  return Redirect('animal')->with('success','Animal deleted!');  
  
    $animals = Animal::findOrFail($id);
    $animals->delete();  
    return response()->json(["success" => "animal deleted successfully.","data" => $animals,"status" => 200]);


    } 
//Restore method
    // public function restore($id) 
    // {
    //     Animal::withTrashed()->where('id',$id)->restore();
    //     return  Redirect('animal')->with('success','Animal restored successfully!');
    // } 

    public function selectbreed()
    { 
        return Response::json(AnimalCategory::with('animal')->get());
       
    }
    public function selectRescuer()
    {  
       return Response::json(Rescuer::with('animal')->get());
       
    }
    public function selectDisease()
    {  
       return Response::json(AnimalMedicalCondition::get());
       
    } public function storeDisease(Request $request)
    {
             
         
    $animal_condition = new AnimalHealth; 
           $kon = $request->input('id'); 
           $id =$request->input('last');
           $animal_condition->condition_id=$kon;
           $animal_condition->animal_id=$id; 
            $animal_condition->save();   
         return response()->json(["success" => "Disease created successfully.","data" =>$animal_condition,"status" => 200]);
              

    }    public function restore($id) 
      {
        Animal::withTrashed()->where('id',$id)->restore();
        return response()->json(["success" => "Restore successfully.","data" =>$id,"status" => 200]);
       }

       public function search(Request $request){

        $search = $request->search;
        if($search == ''){
           $animals = Animal::orderBy('id','DESC')->get();
        }else{
            $animals = DB::table('animals')
            ->leftjoin('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
            ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->where('animals.healthstatus', '=' ,'Cured') 
            ->whereNull('adopted_animals.animal_id')
            ->where('animal_name', 'like', '%' .$search . '%')
            ->select('animals.id','animals.animal_name')
            ->limit(10)->get();
    
        //    $animals = Animal::orderby('animal_name','asc')->select('id','animal_name')->where('animal_name', 'like', '%' .$search . '%')->limit(10)->get();
        }
        // return Response::json(array(
        //     'value' => $animals->id,
        //     'label' => $animals->animal_name, 
        // ));
        // return response()->json(["value" => $animals->id,"label"=>$animals->animal_name]);

            $response = array();
        foreach($animals as $animal){
 
            $response[] = array("value"=>$animal->id,"label"=>$animal->animal_name);

        }
        $response['animals']= $animals;

        return response()->json($response);

    }
  
}


