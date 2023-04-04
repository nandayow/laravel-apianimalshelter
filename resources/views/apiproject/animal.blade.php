
<div align="center"   id="animalcontent">
  <div  class="table-responsive">
    <table id="animaltable" class="table yajra-dt tableko">
      <thead>
        <tr>
        <th><input name="active" value="1" id="active" type="checkbox" /></th>
          <th>Animal ID</th> 
          <th>AnimalName</th>
          <th>image</th>
          <th>HealthStatus</th> 
          <th>Gender</th> 
          <th>Category</th> 
          <th>Breed</th>
          <th>RescuedDate</th>
          <th>Deleted</th>
          <th   style="width:200px !important;">Action</th> 
          </tr>
      </thead>
      <tbody id="animalbody">
      </tbody>
      <tfoot> 
      <th></th>
                <th>Animal ID</th> 
          <th>AnimalName</th>
          <th>image</th>
          <th>HealthStatus</th> 
          <th>Gender</th> 
          <th>Category</th> 
          <th>Breed</th>
          <th>RescuedDate</th>
          <th>Deleted</th>
          <th>Action</th>  
      </tfoot>
    </table>
  </div>
</div> 
<!-- Modal Create content-->
  
<div class="modal fade" id="animalModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content" style="background-image:url('/storage/images/simplebackground-1638052824976-9118.jpg')">
        <div class="modal-header">
          <h4 class="modal-title">Create new Animal</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="animalform" method="#" action="#" enctype="multipart/form-data">
          
             <div class="row">     
             <div class="column">
                <label for="uploads" class="control-label">Image</label> 
                 <input type="file" class="form-control" id="image" name="uploads" required/>   

                </div>
             <div class="column">
                    
                <label for="animal_name" class="control-label required">Animal Name</label>
                <input type="text" class="form-control" id="animal_name" name="animal_name">  

                
                <label for="animalgender" class="control-label">Gender</label>
                <input type="text" class="form-control" id="animalgender" name="gender">  
 

                <!-- Breed Dropdown -->
                <label for="sel_breed" class="control-label">Breed Name</label> 
                <select id='sel_breed' class="form-control"  name='sel_breed'>
                            <option value='0'>-- Select Breed --</option>
                            </select>
                            
              </div>
              <div class="column"> 
              <label for="approximate_age" class="control-label">Approximate Age</label> 
              <input type="text" class="form-control" id="approximate_age" name="approximate_age">
              <span id="error"> </span>
              <!-- Rescuer Dropdown -->
            
              <label for="rescuer_animal" class="control-label">Rescuer</label> <span id = 'meron'> </span>
                <select id='rescuer_animal' class="form-control"  name='rescuer_animal'>
                      <option value='0'>-- Select Rescuer --</option>
                </select>  
               <!-- Javascript -->  
                                       <script>  
                                          $(function() {  
                                              $( "#datepick" ).datepicker({ dateFormat:'yy-mm-dd' });  
                                          });  
                                        </script> 
                    
                    <label for="rescued_date">Rescued Date</label>
			               <input type="text"  class="form-control" id="datepick" name="rescued_date">
                     <span id="error"> </span>
               </div>  
               </div> 
               <div class="row">
                               <div class="columnbox1 form-horizontal"  id="conditions"></div>
                              <div  class="columnbox2 form-horizontal"  id="conditions2"></div>
               </div>

               <!-- rescuer -->
               <div id='rescueraddform' class="row">
                 <h2>New Rescuer</h2>
                    <div class="columnbox6">  
                    <label for="fname" class="control-label required">Firstname</label>
                      <input type="text" class="form-control" id="rescuerfname" name="fname">  

                      <label for="rescuerlname" class="control-label required">Lastname</label>
                      <input type="text" class="form-control" id="rescuerlname" name="lname">  

                      
                      <label for="rescuertown" class="control-label required">Town</label>
                      <input type="text" class="form-control" id="rescuertown" name="town">  

                      </div>
                    <div class="columnbox7">
                          
                      <label for="rescuerphone" class="control-label required">Phone</label>
                      <input type="text" class="form-control" id="rescuerphone" name="phone">  

                      <label for="addressline" class="control-label required">Addressline</label>
                      <input type="text" class="form-control" id="rescueraddressline" name="addressline">   
                      
                      <label for="rescuerzipcode" class="control-label required">Zipcode</label>
                      <input type="text" class="form-control" id="rescuerzipcode" name="zipcode">  
                    </div>
               </div>
                <!-- contentend -->             
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
          <button id="animalsubmit" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>
 
<!-- animaleditModal -->

<div class="modal fade" id="animaleditModal" role="dialog" style="display:none"> 
  <div class="modal-dialog modal-lg" > 
    <div class="modal-content"> 


      <div class="modal-header"> 
                <h4 class="modal-title">Update Animal</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
      </div>

          <div class="modal-body">

                  <form id="updateform" method="#" action="Post"   enctype="multipart/form-data">
                   {{ method_field('PUT') }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden"  id="animal_id" name="id" value="">

                  <div class="row">
                        <div class="column">
                                      
                            <div id="animage">  </div>

                            <input type="file" class="form-control" id="eimage" name="uploads"/> 
                            <input type="hidden"  id="eimagename" name="larawan" value="">

                        </div>
                        <div class="column">

                          <label for="eanimal_name" class="control-label">Animal Name</label>
                            <input type="text" class="form-control" id="eanimal_name" name="animal_name"> 

                            
                          <label for="egender" class="control-label">Gender</label>
                          <input type="text" class="form-control" id="egender" name="gender">

                            <!-- Breed Dropdown -->
                          
                            <label for="esel_breed" class="control-label"> Breed Name</label> 
                              <select id='esel_breed' class="form-control"  name='sel_breed'> <option value='0'>-- Select Breed --</option></select>

                            <!-- Rescuer Dropdown -->
                                   <label for="erescuer_animal" class="control-label">Rescuer</label> 
                                   <span id="myrescuer">  </span>
                                      <select id='erescuer_animal' class="form-control"  name='rescuer_animal'>
                                            <option value='0'>-- Select Rescuer --</option>
                                      </select>  

                        </div>
                        <div class="column"> 
                            <label for="ehealthstatus" class="control-label">Health HealthStatus</label>
                            <input type="text" class="form-control" id="ehealthstatus" name="healthstatus">

                            <label for="eapproximate_age" class="control-label">Approximate Age</label>
                            <input type="text" class="form-control" id="eapproximate_age" name="approximate_age">

                            <label for="ecategory" class="control-label">Selected Breed</label> 
                            <input type="text" class="form-control" id="ecategory" name="category">

                            <label for="erescued_date" class="control-label">RescuedDate</label> 
                            <input type="text" class="form-control" id="erescued_date" name="rescued_date"> 

                              <!-- Javascript -->  
                                        <script>  
                                          $(function() {  
                                              $( "#erescued_date").datepicker({ dateFormat:'yy-mm-dd' });  
                                          });  
                                        </script>  
                        </div>

                        <div class="row">
                               <div class="columnbox3 form-horizontal"  id="econditions"> 
                               </div>

                               <div  class="columnbox4 form-horizontal"  id="econditions2"> 
                               </div>
                        </div>
                 </div>

                <form>
        </div>  
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                <button id="animalupdatebtn" type="submit" class="btn btn-primary">Update</button> 
           </div>  
     </div>
  </div>
  
                                        </div>

 
<!-- createmodal -->

<div class="modal fade " id="animalshowModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Animal Information</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body newclass">

        <form id="showform" method="#" action="#"   enctype="multipart/form-data"> 

<div class="row">
      <div class="column">
                    
          <div id="showanimage">  </div>  
      </div>
      <div class="column">

        <label for="showanimal_name" class="control-label">Animal Name</label>
          <input type="text" class="form-control" id="showanimal_name" name="animal_name"> 

          
        <label for="egender" class="control-label">Gender</label>
        <input type="text" class="form-control" id="showgender" name="gender">

          <!-- Breed Dropdown -->
        
          <label for="showstype" class="control-label">Type</label> 
           <input type="text" class="form-control" id="showstype" name="showstype"> 

          <!-- Rescuer Dropdown -->
                 <label for="showcreated" class="control-label">Crested</label> 
                 <input type="text" class="form-control" id="showcreated" name="sel_breed"> 

      </div>
      <div class="column"> 
          <label for="showhealthstatus" class="control-label">Health HealthStatus</label>
          <input type="text" class="form-control" id="showhealthstatus" name="healthstatus">

          <label for="showapproximate_age" class="control-label">Approximate Age</label>
          <input type="text" class="form-control" id="showapproximate_age" name="approximate_age">

          <label for="showcategory" class="control-label">Breed</label> 
          <input type="text" class="form-control" id="showcategory" name="category">

          <label for="showrescued_date" class="control-label">RescuedDate</label> 
          <input type="text" class="form-control" id="showrescued_date" name="rescued_date">  
      </div>
      
      <div class="rescuer">
          <div class="column"> 
              <label for="fname" class="control-label">Rescuer name</label>
              <input type="text" class="form-control" id="fname" name="fname">

              <label for="addressline" class="control-label">Address</label>
              <input type="text" class="form-control" id="addressline" name="addressline"> 
          </div>
       
          <div class="column"> 
              <label for="phone" class="control-label">Contact Info</label>
              <input type="text" class="form-control" id="phone" name="phone">

              <label for="town" class="control-label">Town</label>
              <input type="text" class="form-control" id="town" name="town"> 
          </div>
      
          <div class="column"> 
              <label for="zipcode" class="control-label">Zipcode</label>
              <input type="text" class="form-control" id="zipcode" name="zipcode">

              <label for="created_at" class="control-label">Created</label>
              <input type="text" class="form-control" id="created_at" name="created_at"> 

              
          </div>
    </div>
</div>

<form>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
  </div>
</div>
 </div>
 
<style>

#animalform label.error {
  font-size: 0.8em;
  color: #F00;
  font-weight: bold;
  display: block;
  margin-left: 53px;
}
#animalform  input.error, #animalform select.error  {
  background: #FFA9B8;
  border: 1px solid red;
}
</style>