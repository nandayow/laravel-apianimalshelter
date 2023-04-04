<!--  -->
<div class="modal fade" id="modalLogin" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg modalLogin" >
      <div class="modal-content tiledBackgroundlog">
        <div class="modal-header text-center" id="loginmodalheader">
          <h4  class="modal-title  w-100">Login Form</h4>
          <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
        </div>
          <div class="modal-body">
             <form id="logform" method="#" action="#">
 
                 <input id="loginemail" name="email" class="mainLoginInput   pagitan  form-control center-block " type="email" placeholder="&#61447; Email"  />
                 <br>
                  <input  id="loginpassword"name="password" class="mainLoginInput pagitan  form-control center-block" type="password" placeholder="&#61475; Password"  /> 
                 <br>
           </form>
          </div>
          <div class="modal-footer text-center newfoot">

          <a id="loginsignup" href="#"  class="w-100 loginlog"><b>Signup</b></a>
          <button id="loginsubmit" type="submit" class="btn btn-warning w-100">Login</button>
        </div>
      </div>
  </div>
</div>
<!--  -->
<style>

#logform label.error {
  font-size: 0.8em;
  color: #F00;
  font-weight: bold;
  display: block;
  margin-left: 53px;
}
#logform  input.error, #logform select.error  {
  background: #FFA9B8;
  border: 1px solid red;
}
</style>