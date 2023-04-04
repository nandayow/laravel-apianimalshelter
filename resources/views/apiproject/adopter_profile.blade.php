 
 <style>
#profileimage img ,.columnlarawan3 img ,#galleryimage img {
    width: 100%;
    height: 90.3%;
}

.bg-black {
    background: #000;
}

.skill-block {
    width: 50%;
  
 }
 

@media (min-width: 1200px) {
    .skill-block {
     }
}

body {

    background-color: black;

 }
.myprofileModal
{
    background-color:#10101096;
    padding:20px !important;
    border-radius:10px !important; 
    box-shadow: 3px 3px teal, -1em 0 .4em olive;
    color:white;
    margin:auto;
     }  
#myprofileModal
{
    top:67;
 }#adopterimageuploads
 {
    background-color:white !important;
    width: 100% !important;

 }#profilename
 {
    background-color: rgba(var(--bs-dark-rgb),var(--bs-bg-opacity))!important;
    border:none !important;
    color: white;
 }.infoprofile
 {
    width: 100% !important;
    margin-top:10px !important;
    text-align:center !important;
    border-radius:5px !important;
    color:black;
 }.infoprofilegender
 {
    color:white;
    border:none;
    padding-left:20px;
 }.profilesignout
 {
     color: white !important;
     float: right !important;
     position:absolute;top:10;right:30;
     font-size:15px !important;
 }.folder
 {
     color: red !important;
     font-size:30px !important;
 }.columnlarawan2
{
  overflow:scroll;
  height: 300px !important;
  width: 200px !important;
 }.columnlarawan3
{
   height: 300px !important;
  width: 70% !important;
  padding-top:20px !important;
  padding-left:20px !important;


}.columnlarawan3 img
{
    margin:auto !important;
}#galleryimage a
{
    color: white !important;

}
  
   
</style>  

</head>
 <div class="modal fade" id="myprofileModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content myprofileModal">
        <div class="modal-header">
          <h3   class="modal-title"></h3><span id="userspan"></span>                      
          <a id="profilesignout" href="#" class="profilesignout">Logout<i class="fas fa-sign-out-alt"></i></a> 
          <a id="mygallery" href="#" class=" "><i class="fa fa-folder folder" aria-hidden="true"></i></a> 
          <a id="sarado" href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
        </div>
          <div class="modal-body">
             <form id="myprofileModalform" method="#" action="Post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden"  id="profile_id" name="profile_id" value=""> 

                  <div id="infopart" class="row no-gutters">
                        <div id="profileimage" class="col-md-4 col-lg-4">
                        <input type="file"  id="adopterimageuploads" name="uploads" >

                        </div>
                        <div class="col-md-8 col-lg-8">
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row justify-content-between align-items-center p-5 bg-dark text-white">
                                     <input type="text"  id="profilename" class="display-5" name="profilename" value=" ">   
                                    <i class="fa fa-facebook"></i><i class="fa fa-google"></i><i class="fa fa-youtube-play"></i><i class="fa fa-dribbble"></i><i class="fa fa-linkedin"></i>
                                </div>
                                <div class="p-3 bg-black text-white">
                                 <input type="text"  id="profilegender" class="infoprofilegender  bg-black " name="gender" value="  " placeholder="Gender">   
                                </div>
                                <div  class="d-flex flex-row text-white">
                                
                                    <div class="p-3 text-center skill-block">
                                    <input type="text"  id="profilephone" class="infoprofile" name="phone" value=" " placeholder="Contant No.">   
                                    <input type="text"  id="profileaddressline" class="infoprofile" name="addressline" value="  "  placeholder="Adressline">   
                                    <input type="text"  id="profilezipcode" class="infoprofile" name="zipcode" value="  "  placeholder="Zipcode">   

                                   </div>
                                   <div class="p-3  text-center skill-block">
                                   <input type="email"  id="profileemail" class="infoprofile" name="email" value=" "  placeholder="Email">   
                                   <input type="text"  id="profiletown" class="infoprofile" name="town" value="  "  placeholder="Town">   
                                   <input type="text"  id="profilebirth_date" class="infoprofile" name="birth_date" value="  "  placeholder="Birthdate">   
                                        <!-- Javascript -->  
                                        <script>  
                                               $(function() {  
                                              $( "#profilebirth_date").datepicker({ dateFormat:'yy-mm-dd' });  
                                          });  
                                        </script>
                                   </div>
 
                                 </div>
                            </div>
                        </div>
                    </div>

                    <div id="gallerypart">
                                          <div class="row ">     
                            
                                                <div class="columnlarawan2">
                                                        
                                                <div align="center" id="galleryimage">
                                                    
                                                </div>

                                                </div>
                                                <div class="columnlarawan3"> 
                                                <div id="galleryphoto">
                                                <img src="{{asset('/storage/images/welcome1.png')}}"> 

                                                </div>

                                                </div>  

                                        </div>
                     </div>
            </form>
          </div>
          <div class="modal-footer">
          <button id="updateprofile" type="button" class="btn btn-warning">Update</button>
         </div>
      </div>
  </div>
</div>
