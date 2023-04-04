<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use view;
use Redirect;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;
use ConsoleTVs\Profanity\Facades\Profanity;
use Response;
class CommentController extends Controller
{
    public function postComment(Request $req)
    {

        $validated = $req->validate
          ([ 
             'comment' => 'required', 
          ]); 
      
       $filter = Profanity::blocker($req->comment)->filter();
       
        $comment = new Comment(); 
        $comment->animal_id = $req->animal_id;
        $comment->body = $filter;
    //    dd($comment);
        $comment->save();
        return response()->json(["success" => "comment created successfully.","data" => $comment ]); 
    }
    public function show($id)
    {
        
         
         
      
         $comments = Comment::where("animal_id","=",$id)->get();  
 
         $commentCount = $comments->count();
    
         return response()->json(["success" => "comment created successfully.","data" => $comments ]); 

     }
    
}
