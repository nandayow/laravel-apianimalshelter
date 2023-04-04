@extends('layouts.base')
@section('body')
 
<div id="homeid">  
  <!-- carousel start -->
   
<div id="myCarousel" class="carousel slide" data-ride="carousel">
       <!-- Indicators -->
       <ol class="carousel-indicators">
         <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
         <li data-target="#myCarousel" data-slide-to="1"></li>
         <li data-target="#myCarousel" data-slide-to="2"></li> 
       </ol>
     
       <!-- Wrapper for slides -->
    <div class="carousel-inner">

       <div class="item active">
       <img  class="slider-img img-circle ", src="{{asset('/storage/images/welcome1.png')}}"> 
            <div class="carousel-caption slide-text">
                <h3>Welcome</h3>
                <p>AnimalShelter</p>
                
          </div>
      </div> 

      <div class="item"> 
      <img  class="slider-img img-circle ", src="{{asset('/storage/images/d1.png')}}">  
            <div class="carousel-caption slide-text">
                    <h3>Welcome</h3>
                    <p>Your Pets Home</p>
            </div>
      </div> 

      <div class="item"> 
            <img  class="slider-img img-circle ", src="{{asset('/storage/images/welcomeimg.jpg')}}"> 
            <div class="carousel-caption slide-text">
                    <h3>Russel A Solleza</h3>
                    <p>Author-BSIT-NS-3A</p>
            </div>
      </div> 
 
    </div>
     
       <!-- Left and right controls -->
       <a class="left carousel-control" href="#myCarousel" data-slide="prev">
         <span class="glyphicon glyphicon-chevron-left"></span>
         <span class="sr-only">Previous</span>
       </a>
       <a class="right carousel-control" href="#myCarousel" data-slide="next">
         <span class="glyphicon glyphicon-chevron-right"></span>
         <span class="sr-only">Next</span>
       </a>

</div>
   
    <!-- carousel end --> 
 
           <div id="availableanimals" class=" ">
           <div  class="col-sm-12 left-col">
                        @foreach($animals as $animal) 
                                    <div class="card trending-item">
                                         <div  class="trending-card">
                                       
                                             <img  class="display-dog" src="{{asset($animal->image)}}"   >
                                                
                                                 <h1>{{$animal->animal_name}}</h1>
                                                    <p class="title">{{$animal->breed_name}}</p>
                                                        <p>{{$animal->animal_type}}</p> 
                                                        <p>Adoptable</p> 
                                                       <!-- <p><button id="viewanimal" class="class-button"> <a href= "#"> View Profile  </a></button></p> -->
                                                       
                                                       <a href='#' data-toggle='modal' data-target='#commentmodal'  class="btn" id='viewanimal' data-id="{{$animal->id}}">View</a>
                                                      
                                                       <div id="trial">
                                                         <form id="adoptfromhomeform" method="#" action="#" enctype="multipart/form-data">
                                                             <button type="submit" id="adoptfromhome"  data-id="{{$animal->id}}" class="class-button mybutton"> Adopt</button> 
                                                        </form>  
 
                                                       </div > 
  
                                              

                                                       <!--  -->
                                                          <div class="modal fade" id="commentmodal" role="dialog" style="display:none">
                                                            <div class="modal-dialog modal-lg  commentmodal" >
                                                                <div class="modal-content commentmodal" >
                                                                <form id="commentform" method="#" action="#"   enctype="multipart/form-data">

                                                                  <div class="modal-header">

                                                                       <span id="userimage" class="userimage"><img src="https://image.flaticon.com/icons/png/512/12/12638.png" alt=""></span>
                                                                       
                                                                       <span id="petusername" class="username"> </span>

                                                                       <span class="pet_id" id="pet_id"> </span>  
                                                                      <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                                  </div>
                                                                     <div class="modal-body"> 
                                                                     <div class="profilepetinfo">

                                                                            <span id="petprofilegender" class="petprofilepetko"></span>
                                                                            <span id="petprofilebreed" class="petprofilepetko"></span>
                                                                            <span id="petprofilestatus" class="petprofilepetko"></span>
                                                                            
                                                                      </div>
                                                                    <div id="viewanimalimage">
                                                                    </div>

                                                                    <div class="timeline-likes">
                                                                      <div class="stats-right">
                                                                          <span class="stats-text">259 Shares</span>
                                                                          <span id="commenttotal" class="stats-text">Comments</span>
                                                                      </div>
                                                                      <div class="stats">
                                                                          <span class="fa-stack fa-fw stats-icon">
                                                                          <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                                                          <i class="fa fa-heart fa-stack-1x fa-inverse t-plus-1"></i>
                                                                          </span>
                                                                          <span class="fa-stack fa-fw stats-icon">
                                                                          <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                                                          <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                                                          </span>
                                                                          <span class="stats-total">1k</span>
 
                                                                      </div>
                                                                    </div>
                                                                     <input type="hidden" id="animal_idhidden" name="animal_id" value=" ">

                                                                       <div id="commentareapart" class="form-group commentsarea">
                                                                                    
                                                                        <input type="input" id="commentbox" class="form-group" name= "comment" placeholder="Type your comment here"/>          
                                                                        <button id="commentsubmit" type="submit" class=" btn btn-outline-primary">Post</button> 
      
                                                                      </div>

                                                                    </div>

                                                                    <div id="themessage" class="themessage">  
                                                                    </form>

                                                                       
                                                                    </div>
                                                           
                                                                </div>
                                                            </div>
                                                          </div>
                                                          <!--  -->

                                                          <style>

                                                          #commentform label.error {
                                                            font-size: 0.8em;
                                                            color: #F00;
                                                            font-weight: bold;
                                                            display: block;
                                                           }
                                                          #commentform  input.error, #commentform select.error  {
                                                            background: #FFA9B8;
                                                            border: 1px solid red;
                                                          }
                                                          </style>
 
                                                         
                                        </div>
                                     </div>                   
                        @endforeach      
                   </div>    
            </div>

            <!-- <div id="adoptedanimalshome" class=" ">
           <div  class="col-sm-12 left-col">
                        @foreach($adopted as $adopt) 
                                    <div class="card trending-item">
                                         <div  class="trending-card">
                                       
                                             <img  class="display-dog" src="{{asset($adopt->animalimage)}}"   >
                                                
                                                 <h1>{{$adopt->animal_name}}</h1>
                                                    <p class="title">{{$adopt->breed_name}}</p>
                                                        <p>{{$adopt->animal_type}}</p> 
                                                        <p>Adopted</p> 
                                                        
                                                       <a href='#' class="btn" id='viewanimal' data-id="{{$adopt->animalid}}">View</a>                     
                                        </div>
                                     </div>                   
                        @endforeach      
                   </div>    
            </div> -->

                                                         <!--  -->
                                                         <div class="modal fade" id="adoptedmodal" role="dialog" style="display:none">
                                                            <div class="modal-dialog modal-lg" >
                                                                <div class="modal-content adoptedmodal " >
                                                                  

                                                                <div class="modal-header">
                                                                  <h2> Adopted Animals </h2>
                                                                       <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                                 </div>
                                                                 
                                                                        <div class="modal-body"> 
                                                                                    
                                                                              <div id="gallerypartadopted">
                                                                                                    <div class="row ">     
                                                                                      
                                                                                                          <div class="columnlarawan4">
                                                                                                                  
                                                                                                          <div align="center" id="galleryimageadopted">
                                                                                                              
                                                                                                          </div>

                                                                                                          </div>
                                                                                                          <div class="columnlarawan5"> 
                                                                                                          <div id="galleryphotoadopted">
                                                                                                          <img src="{{asset('/storage/images/welcome1.png')}}"> 
                                                                                                          </div>
                                                                                                          </div>  
                                                                                                  </div>
                                                                              </div>
                                                                         </div>
                                                                         
                                                                  <div class="modal-footer">
                                                                   
                                                                  </div>
                                                               
                                                                </div> 
                                                             </div>
                                                          </div>
                                                          <!--  -->
            <div id="availableanimalsearch" class=" ">
                  <div  class="col-sm-12 left-col">
                                     <div class="card trending-item">

                                             <form id="adoptebledivform" method="#" action="#"   enctype="multipart/form-data">
                                             <input type="hidden" id="adopter_adopt_id" name="adopter_id" value=" ">
                                             <input type="hidden" id="adopter_animal_id" name="animal_id" value=" ">
                                             <div id="adopteblediv" class="trending-card">
                                         
                                             </form>
                                                 
                                                      
                                        </div>
                                    </div>                   
                   </div>    
            </div>
         
 </div> 
@endsection
