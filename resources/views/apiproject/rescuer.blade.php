
<div align="center"   id="rescuercontent">
  <div  class="table-responsive">
    <table id="rescuertable" class="table yajra-dt tableko">
      <thead>
        <tr>
          <th >ID</th>  
         <th>Fname</th>  
         <th>Lname</th>  
         <th>Phone</th>
         <th>Addressline</th>
         <th>Image</th>  
         <th>Town</th>
         <th>Zipcode</th> 
         <th>Deleted</th>
         <th>Action</th>
         </tr>
      </thead>
      <tbody id="rescuerbody">
      </tbody>
      <tfoot> 
          <th >ID</th>  
         <th>Fname</th>  
         <th>Lname</th>  
         <th>Phone</th>
         <th>Addressline</th>
         <th>Image</th> 
         <th>Town</th>
         <th>Zipcode</th> 
         <th>Deleted</th>
         <th>Action</th>
      </tfoot>
    </table>
  </div>
</div> 


<!-- Modal Create content--> 
<div class="modal fade" id="rescuerModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create new Rescuer</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="rescuerform" method="#" action="#" enctype="multipart/form-data">
          
             <div class="row">     
                    <div align="center" class="column">
                           <img  class="img-rescuer", src="{{asset('/storage/images/babae.jpg')}}"> 
                            <input type="file" class="form-control" id="rescuerimage" name="uploads" required/>   

                    </div>
                    <div class="column">
                            
                            <label for="rescuerfname" class="control-label">Firstname</label>
                            <input type="text" class="form-control" id="rescuerfname" name="fname"> 
                            
                            <label for="rescueraddressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" id="rescueraddressline" name="addressline"> 

                            <label for="rescuerzipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" id="rescuerzipcode" name="zipcode"> 
                                               
                    </div>
                    <div class="column"> 
                           <label for="rescuerlname" class="control-label">Lastname</label> 
                            <input type="text" class="form-control" id="rescuerlname" name="lname">

                            <label for="rescuertown" class="control-label">Town</label> 
                            <input type="text" class="form-control" id="rescuertown" name="town">

                            <label for="rescuerphone" class="control-label">Phone</label> 
                            <input type="text" class="form-control" id="rescuerphone" name="phone">
                
                
                    </div>  
               </div>  
                 <!-- endrow -->
                <!-- contentend -->             
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
          <button id="rescuersubmit" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>




<!-- Rescueredit -->
 
<div class="modal fade" id="rescuereditModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Rescuer Information</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="rescuerupdateform" method="#" action="POST" enctype="multipart/form-data">
                          {{ method_field('PUT') }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden"  id="rescuer_id" name="id" value="">
          
             <div class="row">     
                    <div align="center" class="column">
                            <div id='img-rescuer'></div>
                             <input type="file" class="form-control" id="erescuerimage" name="uploads"/>   

                    </div>
                    <div class="column">
                            
                            <label for="erescuerfname" class="control-label">Firstname</label>
                            <input type="text" class="form-control" id="erescuerfname" name="fname"> 
                            
                            <label for="erescueraddressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" id="erescueraddressline" name="addressline"> 

                            <label for="erescuerzipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" id="erescuerzipcode" name="zipcode"> 
                                               
                    </div>
                    <div class="column"> 
                           <label for="erescuerlname" class="control-label">Lastname</label> 
                            <input type="text" class="form-control" id="erescuerlname" name="lname">

                            <label for="erescuertown" class="control-label">Town</label> 
                            <input type="text" class="form-control" id="erescuertown" name="town">

                            <label for="erescuerphone" class="control-label">Phone</label> 
                            <input type="text" class="form-control" id="erescuerphone" name="phone">
                
                
                    </div>  
               </div>  
                 <!-- endrow -->
                <!-- contentend -->             
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
          <button id="rescuerupdate" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>
<!-- show -->
 
<div class="modal fade" id="rescuershowModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Rescuer Information</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="rescuershowform" method="#" action="" enctype="multipart/form-data">
                  
             <div class="row">     
                    <div align="center" class="column">
                            <div id='simg-rescuer'></div>
                    </div>
                    <div class="column">
                            
                            <label for="srescuerfname" class="control-label">Firstname</label>
                            <input type="text" class="form-control" id="srescuerfname" name="fname"> 
                            
                            <label for="srescueraddressline" class="control-label">Addressline</label>
                            <input type="text" class="form-control" id="srescueraddressline" name="addressline"> 

                            <label for="srescuerzipcode" class="control-label">Zipcode</label>
                            <input type="text" class="form-control" id="srescuerzipcode" name="zipcode"> 
                            <br>
                            <label id="tottalrescue" class=" form-contro redomoko2"></label>

                    </div>
                    <div class="column"> 
                           <label for="srescuerlname" class="control-label">Lastname</label> 
                            <input type="text" class="form-control" id="srescuerlname" name="lname">

                            <label for="srescuertown" class="control-label">Town</label> 
                            <input type="text" class="form-control" id="srescuertown" name="town">

                            <label for="srescuerphone" class="control-label">Phone</label> 
                            <input type="text" class="form-control" id="srescuerphone" name="phone"> 
                            <br>
                            <label id="labasimage" class="redomoko2">Show Gallery?</label><br>
                          
                    </div>  

               </div>  
                 <!-- endrow -->
                <!-- contentend -->  
                <div id="buo">
                <div class="row">     
                    
                    <div class="columnlarawan">
                            
                    <div align="center" id="larawanko"></div>

                    </div>
                    <div class="column"> 
                    <div id="photo"></div>

                    </div>  

               </div>
               </div> 

            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
  </div>
</div>
<style>
#rescuerform label.error {
  font-size: 0.8em;
  color: #F00;
  font-weight: bold;
  display: block;
 }
#rescuerform  input.error, #rescuerform select.error  {
  background: #FFA9B8;
  border: 1px solid red;
}
</style>