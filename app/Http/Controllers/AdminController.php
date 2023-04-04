<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Personnel;
use App\Models\User; 
use App\Models\Adopter; 
use App\Models\Animal; 
use App\Models\Rescuer; 
use Auth;  
use Illuminate\Support\facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');

    }  
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        // dd($rescuer);
        if($user->status !='active')
        {
            $user->status='active'; 
            $user->save();
        }else
        {
            $user->status='deactivated'; 
            $user->save();
        }
        return response()->json(["success" => "Adopter updated successfully.","data" => $user,"status" => 200]);  

        
        // return redirect()->back()->with('success','Successfully Updated!');
    }
    public function adopted(Request $request) { 
        $from= $request->input('from');
        $to= $request->input('to');
                    $adopted_animals = DB::table('adopted_animals') 
                    ->orderBy('created_at', 'ASC')
                    ->select(DB::raw('count(animal_id) as totalid,MONTHNAME(created_at) as month'))
                     ->whereBetween('created_at', [$from,$to]) 
                    ->groupBy('month')
                    ->get();
                    
        return response()->json([
            'data' => $adopted_animals
        ]);
     }

     
     public function adoptedupdate(Request $request) { 
        $from= $request->input('from');
        $to= $request->input('to');


        $rescued_animals = DB::table('animals')  
        ->orderBy('created_at', 'ASC')
         ->select(DB::raw('count(id) as totalid,MONTHNAME(created_at) as month'))
         ->whereBetween('created_at', [$from,$to]) 
         ->groupBy('month')
        ->get();
                     
                    
        return response()->json([
            'data' => $rescued_animals
        ]);
     }
}
