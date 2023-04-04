<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Animal;
use App\Models\Rescuer;
use Illuminate\Support\Facades\Hash;
use App\Models\Adopter; 
use App\Models\User; 
use Illuminate\Support\facades\DB;
use App\Models\AdoptedAnimal;
use Illuminate\Support\Facades\Session;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Storage;
use Response;
class AdopterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
 
     $users = DB::table('users')
     ->join('adopters','adopters.user_id','=','users.id')
     ->select('users.*')
        ->get(); 
     

        return response()->json(["success" => "requesting   successfully.","data" => $users,"status" => 200]);

           
    }  public function indexTrash(Request $request)
    { 
        $adopters= DB::table('adopters') 
        ->whereNotNull('deleted_at')
       ->get();   
       if ($request->ajax()) { 
        return Datatables::of($adopters) 
           ->addIndexColumn()
           ->addColumn('action', 'adopter.actiontrash') 
           ->rawColumns(['action'])
           ->make(true);
   }
       return view('adopter.adopter_trash');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('adopter.adopter_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
              'email' => $request->input('email'),
              'password' => bcrypt('password'),
              'role' => 'adopter',
           ]); 
          $user->save();
          $token = $user->createToken('animalshelterToken')->plainTextToken;

        
        $adopter = new Adopter();
        $adopter -> fname = $request->fname;
        $adopter -> lname = $request->lname;
        $adopter -> phone = $request->phone;
        $adopter -> user_id =  $user->user_id;

        // $adopter -> addressline = $request->addressline;
        // $adopter -> town = $request->town;
        // $adopter -> zipcode = $request->zipcode;
        $adopter -> birth_date = $request->birth_date;
        // $adopter -> gender = $request->gender;
        $adopter -> email = $request->email;
        // $adopter -> password =  Hash::make($request->password);
        $adopter->save(); 
        return response()->json(["success" => "adopted selected successfully.","data" => $adopter]); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $adopted= DB::table('adopters')
        ->join('adopted_animals','adopted_animals.adopter_id','=', 'adopters.id')
        ->join('animals','animals.id','=', 'adopted_animals.animal_id')
        ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
       ->where( 'adopters.user_id',$id) 
       ->Select('animals.*' ,'animal_categories.*') 
       ->get();  
            $adopters= DB::table('adopters')
            ->where( 'user_id',$id) 
            ->Select('adopters.*')
           ->get();
 
           return Response::json(array(
            'data' => $adopters,
            'animal' => $adopted, 
        ));
 

    //    return view('adopter.adopter_show',compact('adopter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adopters= DB::table('adopters')
        ->where('id',$id)
        ->get();
 
       return view('adopter.adopter_edit',compact('adopters'));
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
        $adopter = Adopter::find($id);  
        $user =  $adopter->user_id; 
        $fullname = explode(" ", $request->profilename); 

        $newuser = User::find($user);
        $newuser->name = $request->profilename;
        $newuser->email = $request->email;

        $newuser->update();

        $adopter -> fname = $fullname[0];
        $adopter -> lname = $fullname[1];
        $adopter -> phone = $request->phone;
        $adopter -> addressline = $request->addressline;
        $adopter -> town = $request->town;
        $adopter -> zipcode = $request->zipcode;
        $adopter -> birth_date = $request->birth_date;
        $adopter -> gender = $request->gender;
        $adopter -> email = $request->email;   
        
        $files = $request->file('uploads');
        $adopter->image = 'storage/images/'.$files->getClientOriginalName();
        $adopter->update(); 
         $data=array('status' => 'saved');
        Storage::put('public/images/'.$files->getClientOriginalName(),file_get_contents($files));  

        return response()->json(["success" => "User updated successfully.","data" => $adopter]); 

        //  $adopter->save();
        // return Redirect('adopter')->with('success','Adopter updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $adopter = Adopter::findOrFail($id);
         $adopter->delete();
        return Redirect('adopter')->with('success','Adopter deleted!'); 


    }public function myaccount()
    {
        if(Auth::check() && auth()->user()->role =='adopter')
        {
            $userId=Auth::user();  
            // dd($userId->id);
            $adopters= DB::table('adopters')

            ->join('adopted_animals','adopted_animals.adopter_id','=', 'adopters.id')
            ->join('animals','animals.id','=', 'adopted_animals.animal_id')
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
           ->where( 'adopters.email','8') 
           ->Select('adopters.*','animals.*' ,'animal_categories.*')
           ->get();   
           dd($adopters);
           return view('adopter.adopter_account',compact('adopters'));
        }  
    } public function restore($id) 
    {
        Adopter::withTrashed()->where('id',$id)->restore();
        return  Redirect('adopter')->with('success','Adopter restored successfully!');
    }
    static function request()
    { 

        $users = DB::table('users')
        ->join('adopters','adopters.user_id','=','users.id')
        ->select('users.*')
        ->where('status' ,'!=','active')
        ->orWhere('status',"=" , null)
         ->get(); 
 
 
         $total = count($users);
         return ($total); 
 
     }
}
