<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Auth;
use App\Models\User; 
use App\Models\Personnel; 
use App\Models\Adopter; 
use App\Models\Rescuer; 
use App\Models\Veterinarian; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\facades\DB; 
use DataTables;
use Illuminate\Support\Facades\Storage;
use Response;
class PersonnelController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
     {
    //     $personnel = DB::table('personnels')
    //     ->whereNull('deleted_at')
    //     ->get(); 
    //     if ($request->ajax()) { 
    //         return Datatables::of($personnel) 
    //            ->addIndexColumn()
    //            ->addColumn('action', 'personnel.action') 
    //            ->rawColumns(['action'])
    //            ->make(true);
    //    } 
    //     return view('personnel.personnel_index');
 
    // }  public function indexTrash(Request $request)
    // {
    //     $personnel = DB::table('personnels')
    //     ->whereNotNull('deleted_at')
    //     ->get();  

    //     if ($request->ajax()) { 
    //         return Datatables::of($personnel) 
    //            ->addIndexColumn()
    //            ->addColumn('action', 'personnel.actiontrash') 
    //            ->rawColumns(['action'])
    //            ->make(true);
    //    }  
    //     return view('personnel.personnel_trash'); 

            $personnel = DB::table('personnels')
             ->where('role','!=','admin')
            ->get();   

        return response()->json(["data"=>$personnel]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('personnel/register_personnel');
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
        //    'role' => 'required',
        //    'fname' => 'required',
        //    'lname' => 'required',
        //    'phone' => 'required|unique:personnels|min:11',
        //    'addressline' => 'required',
        //    'town' => 'required',
        //    'zipcode' => 'required',
        //    'birth_date' => 'required',
        //    'gender' => 'required',
        //    'email' => 'required|email|unique:users',
        //    'password' => 'required|min:8',  
    
        // ]);
             $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
              'email' => $request->input('email'),
              'password' => bcrypt('password'),
              'role' => $request->input('role'),
              'status' => "active"
          ]); 
          $user->save();

            $personnel = new Personnel();
            $personnel -> role = $request->role;
            $personnel->user_id = $user->id;
            $personnel -> fname = $request->fname;
            $personnel -> lname = $request->lname;
            $personnel -> phone = $request->phone;
            $personnel -> addressline = $request->addressline;
            $personnel -> town = $request->town;
            $personnel -> zipcode = $request->zipcode;
            $personnel -> birth_date = $request->birth_date;
            $personnel -> gender = $request->gender;
            $personnel -> email = $request->email;
            $files = $request->file('uploads');
            $personnel->image = 'storage/images/'.$files->getClientOriginalName();
            $personnel->save(); 
            $data=array('status' => 'saved');
            Storage::put('public/images/'.$files->getClientOriginalName(),file_get_contents($files));  
            return response()->json(["success" => "animal created successfully.","data" => $personnel ]); 

 


    //       if ($request->role =='rescuer')
    //       {
    //         $rescuer = new Rescuer();
    //         $rescuer->user_id = $user->id;
    //         $rescuer -> fname = $request->fname;
    //         $rescuer -> lname = $request->lname;
    //         $rescuer -> phone = $request->phone;
    //         $rescuer -> addressline = $request->addressline;
    //         $rescuer -> town = $request->town;
    //         $rescuer -> zipcode = $request->zipcode;
    //         $rescuer->save();
    //       }
    //         else  if ($request->role =='adopter'){
    //             $adopter = new Adopter();
    //             $adopter->user_id = $user->id;
    //             $adopter -> fname = $request->fname;
    //             $adopter -> lname = $request->lname;
    //             $adopter -> phone = $request->phone;
    //             $adopter -> addressline = $request->addressline;
    //             $adopter -> town = $request->town;
    //             $adopter -> zipcode = $request->zipcode;
    //             $adopter -> birth_date = $request->birth_date;
    //             $adopter -> gender = $request->gender;
    //             $adopter -> email = $request->email;
    //              $adopter->save();
    //       } else  if ($request->role =='veterinarian'){
    //         $veterinarian = new veterinarian();
    //         $veterinarian->user_id = $user->id; 
    //         $veterinarian -> fname = $request->fname;
    //         $veterinarian -> lname = $request->lname;
    //         $veterinarian -> phone = $request->phone;
    //         $veterinarian -> addressline = $request->addressline;
    //         $veterinarian -> town = $request->town;
    //         $veterinarian -> zipcode = $request->zipcode;
    //         $veterinarian -> birth_date = $request->birth_date;
    //         $veterinarian -> gender = $request->gender;
    //         $veterinarian -> email = $request->email;
    //         $veterinarian->save();
    //   }else{  
    //         $personnel = new Personnel();
    //         $personnel -> role = $request->role;
    //         $personnel->user_id = $user->id;
    //         $personnel -> fname = $request->fname;
    //         $personnel -> lname = $request->lname;
    //         $personnel -> phone = $request->phone;
    //         $personnel -> addressline = $request->addressline;
    //         $personnel -> town = $request->town;
    //         $personnel -> zipcode = $request->zipcode;
    //         $personnel -> birth_date = $request->birth_date;
    //         $personnel -> gender = $request->gender;
    //         $personnel -> email = $request->email;
    //          $personnel->save(); 
    //     }
    
   
    //    dd($personnel);
        // return redirect('profile')->with('success','Successfully!!!');      
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        
        $user = Auth::user();
        $personnels = DB::table('personnels')
        ->where ('personnels.id', $id)
        ->first();  
        return response()->json(["success" => "rescuer selected successfully.","data" => $personnels]); 

        // dd($personnels);
    //    return view('personnel.personnel_show',['personnels'=>$personnels]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //     $personnel = DB::table('personnels')
    //     ->where('id',$id)
    //     ->get();  
    //    return view('personnel.personnel_edit',['personnels'=>$personnel]);

       $personnel = DB::table('personnels')
       ->where('id',$id)
       ->get();  
      return response()->json(["success" => "rescuer selected successfully.","data" => $personnel]); 

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
        // $personnel = Personnel::find($id);
        // $personnel -> role = $request->role;
        // $personnel -> fname = $request->fname;
        // $personnel -> lname = $request->lname;
        // $personnel -> phone = $request->phone;
        // $personnel -> addressline = $request->addressline;
        // $personnel -> town = $request->town;
        // $personnel -> zipcode = $request->zipcode;
        // $personnel -> birth_date = $request->birth_date;
        // $personnel -> gender = $request->gender;
        // $personnel -> email = $request->email;
        // $personnel->save(); 
        // return Redirect('personnel')->with('success','Personnel updated!');
        $user=$request->user_id;
        $newuser = User::find($user);
        $newuser->name = $request->fname.' '.$request->lname;
        $newuser -> email = $request->email; 
        $newuser -> role = $request->role; 
        $newuser->update();

        
        $personnel = Personnel::find($id);
        $personnel -> role = $request->role;
        $personnel -> fname = $request->fname;
        $personnel -> lname = $request->lname;
        $personnel -> phone = $request->phone;
        $personnel -> addressline = $request->addressline;
        $personnel -> town = $request->town;
        $personnel -> zipcode = $request->zipcode;
        $personnel -> birth_date = $request->birth_date;
        $personnel -> gender = $request->gender;
        $personnel -> email = $request->email; 
        $files = $request->file('uploads');
        $personnel->image = 'storage/images/'.$files->getClientOriginalName();
        $personnel->update(); 
        $data=array('status' => 'saved');
        Storage::put('public/images/'.$files->getClientOriginalName(),file_get_contents($files));  
        return response()->json(["success" => "personnel updated successfully.","data" => $personnel ]); 

    }public function destroy($id)
    { 

    $personnelidselect = Personnel::find($id);
    $personnelid =  $personnelidselect->user_id;

    $user = User::findOrFail($personnelid); 
    $user->delete();


     $personnel = Personnel::findOrFail($id);
     $personnel->delete();
    //  return Redirect()->route('personnel.index')->with('success','Personnel deleted!');  
   
    return response()->json(["success" => "Personnel deleted successfully.","data" => $personnel,"status" => 200]);

    } 
//Restore method
    public function restore($id) 
    {
        Personnel::withTrashed()->where('id',$id)->restore();

        $personnelidselect = Personnel::find($id);
        $personnelid =  $personnelidselect->user_id;
        User::withTrashed()->where('id',$personnelid)->restore();

        return response()->json(["success" => "personnel restored successfully.","data" => $id,"status" => 200]);


        // return  Redirect('personnel')->with('success','Personnel restored successfully!');
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    // public function login(Request $req)
    // {
    //     $user = User::where(['email' => $req->email])->first(); 
    //     $user1 = Adopter::where(['email' => $req->email])->first(); 
    //      if($user && Hash::check($req->password ,$user->password))
    //      {
    //             $req->session()->put('personnel',$user);
            
    //             return  Redirect('home')->with('success',Session::get('personnel')['email'] );
            
    //      }
    //     else if($user1 && Hash::check($req->password ,$user1->password))
    //      {
    //          $req->session()->put('adopter',$user1);
       
    //          return  Redirect('home')->with('success',Session::get('adopter')['email'] );
    //      } 
    //      else if($req->email == null)
    //     {
    //            return redirect()->back()->with('error','The email or mobile number you entered isn’t connected to an account.');
    //      }else
    //      {
    //            return redirect()->back()->with('error','The password you’ve entered is incorrect.');
    //      }
         
      
    // }
}
