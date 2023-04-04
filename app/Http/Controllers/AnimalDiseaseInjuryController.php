<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use Auth;
use Redirect;
use App\Models\Animal;
use App\Models\AnimalHealth;
use App\Models\AnimalMedicalCondition;
use DataTables; 
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Session;
use Response;

class AnimalDiseaseInjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//         $animalconditions = DB::table('animal_medical_conditions')  
//         ->where('condition_type','Disease')
//         ->orderBy('animal_medical_conditions.id', 'ASC')
//         ->get();
//     //    echo($animal); 
        
//     if ($request->ajax()) { 
//         return Datatables::of($animalconditions) 
//            ->addIndexColumn()
//            ->addColumn('action', 'animaldisease_injury.action') 
//            ->rawColumns(['action'])
//            ->make(true);


//    }
//    $animalconditions = AnimalMedicalCondition::orderBy('id', 'DESC')->get();
 
// //    dd($animalconditions);
//    return view('animaldisease_injury.animaldisease_index');

        // $animalconditions = AnimalMedicalCondition::orderBy('id', 'DESC')->get(); 
        $animalconditions = DB::table('animal_medical_conditions')  
                 ->select('animal_medical_conditions.*')
                ->orderBy('animal_medical_conditions.id', 'ASC')
                ->get();
            //    echo($animal); 

            // dd($animalconditions2);
         return response()->json(["data"=>$animalconditions]);

        
    } 
    
    public function getdiseaseAll(Request $request)
    {

        //    $animalconditions = AnimalMedicalCondition::orderBy('id', 'DESC')->get();

        //    return response()->json(["data"=>$animalconditions]);


    }  public function index2(Request $request)
    {
        $animalconditions = DB::table('animal_medical_conditions')  
        ->where('condition_type','Injury')
        ->orderBy('animal_medical_conditions.id', 'ASC')
        ->get();
        if ($request->ajax()) { 
            return Datatables::of($animalconditions) 
               ->addIndexColumn()
               ->addColumn('action', 'animaldisease_injury.action') 
               ->rawColumns(['action'])
               ->make(true);
       } 
    return view('animaldisease_injury.animalinjury_index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
             return view('animaldisease_injury/animaldisease_injury');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // $validated = $request->validate
        // ([
        //    'condition_name' => 'required|unique:animal_medical_conditions',
        //    'condition_type' => 'required', 
        // ]); 

        $name =$request->input('name');
        $type =$request->input('namo');

        $animalcondition = new AnimalMedicalCondition;
        $animalcondition -> condition_name = $type;
        $animalcondition -> condition_type = $name;
        $animalcondition->save();

        return response()->json(["success" => "Condition created successfully.","data" => $name]);  

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conditions= DB::table('animal_medical_conditions')
        ->select('animal_medical_conditions.*')
        ->where('id',$id)
        ->get();

         $animalcondition= DB::table('animal_healths')
        ->select('animal_healths.animal_id')
        ->where('condition_id',$id)
        ->groupBy('animal_healths.animal_id')
        ->get();
        

            return Response::json(array(
                "conditions"=>$conditions,
                "total"=>$animalcondition,
                 
            ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conditions= DB::table('animal_medical_conditions')
        ->select('animal_medical_conditions.*')
        ->where('id',$id)
        ->get();

         $animalcondition= DB::table('animal_healths')
        ->select('animal_healths.animal_id')
        ->where('condition_id',$id)
        ->groupBy('animal_healths.animal_id')
        ->get();
        

            return Response::json(array(
                "conditions"=>$conditions,
                "total"=>$animalcondition,
                 
            ));
    //    return view('animaldisease_injury.animaldisease_injury_edit',compact('conditions'));
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
        $name = $request->input('name');
        $type =$request->input('sakit');
        $animalcondition =  AnimalMedicalCondition::find($id);
        $animalcondition ->condition_name =  $name;
        $animalcondition ->condition_type = $type;
        $animalcondition->save();
        return response()->json(["success" => "Health problem update successfully.","data" => $type,"status" => 200]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animalMedicalCondition = AnimalMedicalCondition::findOrFail($id);
        $animalMedicalCondition->delete();
        return response()->json(["success" => "Health problem deleted successfully.","data" => $animalMedicalCondition,"status" => 200]);


    }  public function restore($id) 
    {
        AnimalMedicalCondition::withTrashed()->where('id',$id)->restore(); 
         return response()->json(["success" => "Restore successfully.","data" =>'panalo',"status" => 200]);  
    }
  
}
