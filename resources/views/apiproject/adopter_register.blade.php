<!--  -->
<div class="modal fade" id="modalLoginAvatar" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg modalLoginAvatar " >
      <div class="modal-content tiledBackground">
        <div class="modal-header text-center" id="regmodalheader">
          <h4  class="modal-title  w-100">Registration Form</h4>
          <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
        </div>
          <div class="modal-body">
             <form id="regform" method="#" action="#">
             <div class="row">
                              <div class="columnboxreg3">

                                         <input id="regfname" name="fname" class="mainLoginInput pagitans form-control center-block" type="text" placeholder="Firstname"/> 
                                  <script>  
                                          $(function() {  
                                              $( "#regbirth_date" ).datepicker({ dateFormat:'yy-mm-dd' });  

                                          });  
                                        </script>  
 			                                   <input id="regbirth_date"name="birth_date"  type="text"  class="mainLoginInput form-control center-block pagitans"  placeholder="Birth_Date"> 

                                          <input id="regemail" name="email" class="mainLoginInput  pagitans form-control center-block " type="email" placeholder="&#61447; Email"/>
                                          <input  id="regpassword"name="password" class="mainLoginInput pagitans form-control center-block" type="password" placeholder="&#61475; Password"/> 

                               </div>
                              <div  class="columnboxreg2">

                                       <input  id="reglname"name="lname" class="mainLoginInput pagitans form-control center-block" type="text" placeholder="Lastname"/> 
                                       <input  id="regphone"name="phone" class="mainLoginInput pagitans form-control center-block" type="text" placeholder="Contact No."/> 

                              </div>
               </div>  

           </form>
          </div>
          <div class="modal-footer text-center">

          <a id="loginreg" href="#" data-dismiss="modal" class="w-100 reglog"><b>Login</b></a>
          <button id="registersubmit" type="submit" class="btn btn-danger w-100">Signup</button>
        </div>
      </div>
  </div>
</div>
<!--  -->
 <!--  -->
<style>

#regform label.error {
  font-size: 0.8em;
  color: #F00;
  font-weight: bold;
  display: block;
 }
#regform  input.error, #regform select.error  {
  background: #FFA9B8;
  border: 1px solid red;
}
</style>