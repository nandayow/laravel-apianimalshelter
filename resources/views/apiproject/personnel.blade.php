
<div align="center"   id="personnelcontent">
  <div  class="table-responsive">
    <table id="personneltable" class="table yajra-dt">
      <thead align="center">
        <tr>
          <th >ID</th>  
          <th>Image</th>  
         <th>Fullname</th>  
         <th>Email</th>  
          <th>Role</th> 
         <th>Phone</th>
         <th>Addressline</th>
         <th>Town</th>
         <th>Zipcode</th> 
         <th>Gender</th> 
         <th>Deleted</th>
         <th>Action</th>
         </tr>
      </thead>
      <tbody  align="center" style="background-image:url('/storage/images/simplebackground-1638052824976-9118.jpg')" id="personnelbody">
      </tbody>
      <tfoot> 
          <th >ID</th>  
          <th>Image</th> 
         <th>Fullname</th>  
         <th>Email</th>  
          <th>Role</th> 
         <th>Phone</th>
         <th>Addressline</th>
         <th>Town</th>
         <th>Zipcode</th> 
         <th>Gender</th> 
         <th>Deleted</th>
         <th>Action</th>
      </tfoot>
    </table>
  </div>
</div> 
 

<!-- Modal Create content--> 
<div class="modal fade" id="personnelModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create new personnel</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="personnelform" method="#" action="#" enctype="multipart/form-data">
          
             <div class="row">     
                    <div align="center" class="column">
                           <img  class="img-personnel", src="{{asset('/storage/images/babae.jpg')}}"> 
                            <input type="file" class="form-control" id="personnelimage" name="uploads" required/> 
                            
                            <input type="radio"  id="personnelmale" name="gender" value="Male" checked>
                            <label for="personnelmale" >Male</label>

                            <input type="radio"   id="personnelfemale" name="gender" value="Female" checked>
                            <label for="personnelfemale" >Female</label>

                           <select class="form-control" id="role" name="role">
                                <option value="Personnel">--Select Role--</option>
                                <option value="Employee">Employee</option>
                                <option value="Veterinarian">Veterinarian</option>
                                <option value="Volunteer">Volunteer</option>
                            </select>

                    </div>
                    <div class="column">
                            
                            <label for="personnelfname" class="control-label">Firstname</label>
                            <input type="text" class="form-control" id="personnelfname" name="fname"> 
                            
                            <label for="personneladdressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" id="personneladdressline" name="addressline"> 

                            <label for="personnelzipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" id="personnelzipcode" name="zipcode"> 
                        
                            <label for="personnelemail" class="control-label">Email(example@gmail.com)</label>
                            <input type="email" class="form-control" id="personnelemail" name="email">     
                    </div>
                    <div class="column"> 
                           <label for="personnellname" class="control-label">Lastname</label> 
                            <input type="text" class="form-control" id="personnellname" name="lname">

                            <label for="personneltown" class="control-label">Town</label> 
                            <input type="text" class="form-control" id="personneltown" name="town">

                            <label for="personnelphone" class="control-label">Phone</label> 
                            <input type="text" class="form-control" id="personnelphone" name="phone">

                            
                            <label for="personnel_birthday" class="control-label">Birth_Date</label> 
                            <input type="text" class="form-control" id="personnel_birthday" name="birth_date"> 

                              <!-- Javascript -->  
                                        <script>  
                                          $(function() {  
                                              $( "#personnel_birthday").datepicker({ dateFormat:'yy-mm-dd' });  
                                          });  
                                        </script>               
                    </div>  
               </div>  
                 <!-- endrow -->
                <!-- contentend -->             
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
          <button id="personnelsubmit" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>



<!-- Modal Edit content--> 
<div class="modal fade" id="personneleditModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update personnel</h4><span id="userspan"></span>                      

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="personnelupdateform" method="#" action="Post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden"  id="personnel_id" name="id" value="">
                  <input type="hidden"  id="user_id" name="user_id" value="">
             <div class="row">     
                    <div align="center" class="column">

                             <div id="img-personnel"></div>
                             <input type="file" class="form-control" id="epersonnelimage" name="uploads"/> 
                            
                            <input type="radio"  id="epersonnelmale" name="gender" value="Male"  >
                            <label for="epersonnelmale" >Male</label>

                            <input type="radio"  id="epersonnelfemale" name="gender" value="Female"  >
                            <label for="epersonnelfemale" >Female</label>

                           <select class="form-control" id="erole" name="role">
                                <option value=0>--Select Role--</option>
                                <option value="Employee">Employee</option>
                                <option value="Veterinarian">Veterinarian</option>
                                <option value="Volunteer">Volunteer</option>
                            </select>

                    </div>
                    <div class="column">
                            
                            <label for="epersonnelfname" class="control-label">Firstname</label>
                            <input type="text" class="form-control" id="epersonnelfname" name="fname"> 
                            
                            <label for="epersonneladdressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" id="epersonneladdressline" name="addressline"> 

                            <label for="epersonnelzipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" id="epersonnelzipcode" name="zipcode"> 
                        
                            <label for="epersonnelemail" class="control-label">Email(example@gmail.com)</label>
                            <input type="email" class="form-control" id="epersonnelemail" name="email">     
                    </div>
                    <div class="column"> 
                           <label for="epersonnellname" class="control-label">Lastname</label> 
                            <input type="text" class="form-control" id="epersonnellname" name="lname">

                            <label for="epersonneltown" class="control-label">Town</label> 
                            <input type="text" class="form-control" id="epersonneltown" name="town">

                            <label for="epersonnelphone" class="control-label">Phone</label> 
                            <input type="text" class="form-control" id="epersonnelphone" name="phone">

                            
                            <label for="epersonnel_birthday" class="control-label">Birth_Date</label> 
                            <input type="text" class="form-control" id="epersonnel_birthday" name="birth_date"> 

                              <!-- Javascript -->  
                                        <script>  
                                          $(function() {  
                                              $( "#epersonnel_birthday").datepicker({ dateFormat:'yy-mm-dd' });  
                                          });  
                                        </script>               
                    </div>  
               </div>  
                 <!-- endrow -->
                <!-- contentend -->             
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
          <button id="personnelupdate" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>


<!-- Modal Show content--> 
<div class="modal fade" id="personnelshowModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update personnel</h4><span id="suserspan"></span>                      

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="personnelshowform" method="#" action="#" enctype="multipart/form-data">
              <div class="row">     
                    <div align="center" class="column">

                             <div id="simg-personnel"></div>
                             
                            <input type="radio"  id="spersonnelmale" name="gender" value="Male"  >
                            <label for="spersonnelmale" >Male</label>

                            <input type="radio"  id="spersonnelfemale" name="gender" value="Female"  >
                            <label for="spersonnelfemale" >Female</label>
 
                            <input type="text" class="form-control" id="srole" name="role"> 

                    </div>
                    <div class="column">
                            
                            <label for="spersonnelfname" class="control-label">Firstname</label>
                            <input type="text" class="form-control" id="spersonnelfname" name="fname"> 
                            
                            <label for="spersonneladdressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" id="spersonneladdressline" name="addressline"> 

                            <label for="spersonnelzipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" id="spersonnelzipcode" name="zipcode"> 
                        
                            <label for="spersonnelemail" class="control-label">Email(example@gmail.com)</label>
                            <input type="email" class="form-control" id="spersonnelemail" name="email">     
                    </div>
                    <div class="column"> 
                           <label for="spersonnellname" class="control-label">Lastname</label> 
                            <input type="text" class="form-control" id="spersonnellname" name="lname">

                            <label for="spersonneltown" class="control-label">Town</label> 
                            <input type="text" class="form-control" id="spersonneltown" name="town">

                            <label for="spersonnelphone" class="control-label">Phone</label> 
                            <input type="text" class="form-control" id="spersonnelphone" name="phone">

                            
                            <label for="spersonnel_birthday" class="control-label">Birth_Date</label> 
                            <input type="text" class="form-control" id="spersonnel_birthday" name="birth_date"> 

                                      
                    </div>  
               </div>  
                 <!-- endrow -->
                <!-- contentend -->             
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
  </div>
</div>

<style>

#personnelform label.error {
  font-size: 0.8em;
  color: #F00;
  font-weight: bold;
  display: block;
 }
#personnelform  input.error, #personnelform select.error  {
  background: #FFA9B8;
  border: 1px solid red;
}
</style>