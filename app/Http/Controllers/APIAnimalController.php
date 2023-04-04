<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;  
use View;
use App\Models\Animal; 
class APIAnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
          {
            $animal = DB::table('animals') 
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
            ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
            ->WhereNull('deleted_at')
            ->whereNull('adopted_animals.animal_id')
            ->orderBy('animals.id', 'ASC')
            ->get();  
             return response()->json($animal);
          }
        
        }
    public function getAnimalAll(Request $request)
    {
        // if ($request->ajax()){
        //     $customers = Customer::orderBy('customer_id', 'DESC')->get();
         
        //     return response()->json($customers);
        // }

        $animal = DB::table('animals') 
        ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
        ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
        ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
        ->WhereNull('deleted_at')
        ->whereNull('adopted_animals.animal_id')
        ->orderBy('animals.id', 'ASC')
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::find($id);
        return response()->json($animal);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
