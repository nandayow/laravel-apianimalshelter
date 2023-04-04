  
<?php
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdopterController;

$total = 0;
$total1 = 0;

if(Auth::check() && auth()->user()->role !='rescuer' || Auth::check() && auth()->user()->role !='adopter' )
{
  $total = MailController::message();
  $total1 = AdopterController::request();

}
?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<div class="topnav" id="myTopnav">
<a href="/" id="home" class="logo"><i class="fas fa-paw"></i>Solleza's AniShelter</a>
  
@if(Auth::guard('sanctum')->user())
<input type="hidden"  id="currentuser" name="idmo" value="{{ auth()->user()->id}}">


         @if(auth()->user()->role == "admin")
         <a  class =" " style="color:white;cursor:pointer" onclick="openNav()">&#9776;{{ auth()->user()->name}}</a>
         <a href=" "><i class="far fa-envelope-open">({{$total}})</i></a> 
          <input type="hidden"  id="idmo" name="idmo" value="{{ auth()->user()->id}}">

         @elseif(auth()->user()->role =="veterinarian" )
         <a id="username" class =" " style="color:white;cursor:pointer" onclick="openNav()">&#9778;{{ auth('sanctum')->user()->name}}</a>
         <a href=" "><i class="far fa-envelope-open">({{$total}})</i></a> 
          <input type="hidden"  id="idmo" name="idmo" value="{{ auth()->user()->id}}">
         @elseif(auth()->user()->role =="adopter")
          <a  id ="adoptershowheader" class =" " style="color:white;cursor:pointer" onclick="openNav2()">Howdy,{{ auth()->user()->email}}</a>
          <input type="hidden"  id="adopter_idfromheader" name="adopter_idfromheader" value="{{ auth()->user()->id}}">
          @elseif(auth()->user()->role =="rescuer")
          <a  id ="rescuershowheader" class =" " style="color:white;cursor:pointer">Howdy,{{ auth()->user()->email}}</a>

         @endif 

 
@else
            <a id="loginformheader" href="#" class="btn headertitle" data-toggle="modal" data-target="#modalLogin">Login</a> 
            <a id="regformheader" href="#" class="btn headertitle" data-toggle="modal" data-target="#modalLoginAvatar">Register</a>
@endif
          
          <a id="adoptedformheader"  href="#" class="btn headertitle" data-toggle="modal" data-target="#adoptedmodal">View Adopted</a> 

         <form action=" ">
           <div class="search form-group" style="float:right">
                        <input type="search" id="search" class="form-control search  " name= "search" placeholder="&#61442; Search "  aria-label="Search"aria-describedby="search-addon"/>
                        <!-- <button type="submit" class=" btn btn-outline-primary">search</button>   -->
           </div>
          </form> 
 </div>



             <!-- sidenav -->
             <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a id="animalheader" href="">Animal</a>
                        <a  id="rescuerheader" href="#">Rescuer</a>
                        <a  id="personnelheader" href="#">Personnel</a>
                        <a  id="diseaseheader" href="">Heath</a>  
                        <a id="requestheader" href="#">Request({{$total1}})</a>
                        <a id="adoptionrequestheader" href="#">Adoption</a>
                        <a id="dashboradheader" href="">Dashboard</a>
                         <a  id="logout-form" href="">Logout<i class="fas fa-sign-out-alt  logot"></i></a>
              </div> 


              <div id="mySidenav2" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
                        <a id="adopterprofile" class="btn" data-toggle="modal" data-target="#myprofileModal">My Profile</a> 
                        <a  id="logout-adopter" href="">Logout<i class="fas fa-sign-out-alt  logot"></i></a>
              </div> 

              
<script>
function myFunction() {
  var x = document.getElementById("topnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
 
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


function openNav2() {
  document.getElementById("mySidenav2").style.width = "200px";
 
}
function closeNav2() {
  document.getElementById("mySidenav2").style.width = "0";
}
</script>

