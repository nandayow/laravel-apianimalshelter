 
<div id="diseasecontent">
   <div  class="table-responsive">

    <table id="injurytable" class="table yajra-dt tableko">
      <thead>
        <tr>
        <th><input name="active" value="1" id="active" type="checkbox" /></th>
          <th>ID</th> 
          <th>CategoryName</th>
          <th>CategoryType</th>
          <th>DletedFiles</th> 
          <th>Action</th> 
         </tr>
      </thead>
      <tbody id="diseasebody">
      </tbody>
      <tfoot> 
          <th></th> 
          <th>ID</th> 
          <th>CategoryName</th>
          <th>CategoryType</th>      
          <th>DletedFiles</th> 
          <th>Action</th>  
      </tfoot>
    </table>
  </div>
  </div>


<!-- Create Modal -->

<!-- Modal Create content-->
  
<div class="modal fade" id="injuryModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create new</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="injuryform" method="#" action="#">


             <div class="row"> 

               <div class="form-group column">
                <input type="radio" id="injuryradio" name="condition_type" value="Injury"
                      checked>
                <label for="injuryradio">Injury</label>
              </div>

              <div class="form-group column">
                <input type="radio" id="diseaseradio" name="condition_type" value="Disease">
                <label for="diseaseradio">Disease</label>
              </div>  
            </div> 

                <label for="cadd" class="control-label">Condition Name</label>
                <input type="text" class="form-control diseasetextbox" id="cadd" name="condition_name" required>  
                  <span id='derror'></span>
            
              </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
          <button id="injurysubmit" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>
<!--  -->

<!-- edit -->
<div class="modal fade" id="injuryeditModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit new</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="injuryeditform" method="#" action="#">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden"  id="injurydisease_id" name="id" value=""> 

             <div class="row"> 

               <div class="form-group column">
                <input type="radio" id="einjuryradio" name="econdition_type" value="Injury">
                <label for="einjuryradio">Injury</label>
              </div>

              <div class="form-group column">
                <input type="radio" id="ediseaseradio" name="econdition_type" value="Disease">
                <label for="ediseaseradio">Disease</label>
              </div>  
            </div> 

                <label for="ecadd" class="control-label">Condition Name</label>
                <input type="text" class="form-control diseasetextbox" id="ecadd" name="condition_name">  
                  <span id='derror'></span>
            
              </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
          <button id="injuryupdate" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>
 
</div>
<!--  ennd -->


<!-- show -->
<div class="modal fade" id="injuryshowtModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Health Problem Information</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
             <form id="injuryshowform" method="#" action="#">
                   <label id="tottalcase" class="redomoko"></label>
                   <br>

                 <label for="showconname" class="control-label">Condition Name</label>
                 <input type="text" class="form-control diseasetextbox" id="showconname" name="condition_name">  

                <label for="showcontype" class="control-label">Condition Name</label>
                <input type="text" class="form-control diseasetextbox" id="showcontype" name="condition_type">  
             
              </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
  </div>
</div>
 
</div>
<!--  ennd -->