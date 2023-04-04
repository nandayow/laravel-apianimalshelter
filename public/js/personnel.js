$(document).ready(function() { 

// Fetch
$('#personneltable').DataTable({
  
    "order": [[ 0, "desc" ]],
    ajax: {
      url :"/api/personnel",
  
      // dataSrc: "",
      },
      // select: true,
      dom: 'Bfrtip',
      
      buttons: [
        {text: 'Create new',
        id:'addpersonnel',
        className: 'btn btn-primary',
  
        action: function ( e, dt, node, config ) 
            {
              document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';
              
                // // alert('eyy');  
                
                $("#personnelform").trigger("reset"); 
                $('#personnelModal').modal('show');
            }
        },
     
        {
            extend: 'collection',
            text: 'Column Visibility',
            className: "Visibility",
    
            buttons: [
                {
                    text: 'Personnel ID', 
    
                    action: function ( e, dt, node, config ) {
                        dt.column( 0 ).visible( ! dt.column( 0 ).visible() );
                    }
                },
                {
                    text: 'Image',
                    action: function ( e, dt, node, config ) {
                        dt.column( 1 ).visible( ! dt.column(1).visible() );
                    }
                },
                {
                  text: 'Fullname',
                  action: function ( e, dt, node, config ) {
                      dt.column( 2 ).visible( ! dt.column( 2 ).visible() );
                  }
              },{
                text: 'Email',
                action: function ( e, dt, node, config ) {
                    dt.column( 3 ).visible( ! dt.column( 3 ).visible() );
                }
             },{
                text: 'Role',
                action: function ( e, dt, node, config ) {
                    dt.column( 4 ).visible( ! dt.column( 4 ).visible() );
                }
            },
              {
                  text: 'Phone',
                  action: function ( e, dt, node, config ) {
                      dt.column( 5 ).visible( ! dt.column( 5).visible() );
                  }
              },
              {
                text: 'Addressline',
                action: function ( e, dt, node, config ) {
                    dt.column( 6 ).visible( ! dt.column( 6).visible() );
                }
              }, 
              {
                text: 'Town ',
                action: function ( e, dt, node, config ) {
                    dt.column( 7 ).visible( ! dt.column( 7).visible() );
                }
              },
              {
                text: 'Zipcode',
                action: function ( e, dt, node, config ) {
                    dt.column(8).visible( ! dt.column(8).visible() );
                }
              },             {
                text: 'Gender',
                action: function ( e, dt, node, config ) {
                    dt.column(9).visible( ! dt.column(9).visible() );
                }
              },
            ],
        },   
 
        {
          text: 'pdf',
          extend: 'pdfHtml5',
          exportOptions: {
            columns: ':visible',
            rows: ':visible' 
        }
        },                    {
          text: 'excel',
          extend: 'excelHtml5',
          exportOptions: {
            columns: ':visible',
            rows: ':visible' 
        }
       },
    ]
     ,columns: [
        
               { "data": "id"},
               { data: 'image',render: function (data, type, row, meta)
               {
                 return '<img src="' + data + '" height="50" width="50"/>';
               }
               }, 
               {
                "data": null,
                "render": function(data, type, full, meta){
                   return full["fname"] + " " + full["lname"];
                }
               },
               { "data": "email" },
               { "data": "role" },
               { "data": "phone" },
               { "data": "addressline" },
              { "data": "town" },  
              { "data": "zipcode" },
              { "data": "gender" },            
              { "data": "deleted_at" },     
              { "data" : null,render : function ( data, type, row ) {
                   return "<a href='#' data-bs-toggle='modal' data-bs-target='#personnelshowModal' id='personnelshowbtn' data-id="+ data.id +"><i class='fa fa-eye-slash' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' data-bs-toggle='modal' data-bs-target='#personneleditModal' id='personneleditbtn' data-id="+ data.id +"><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:24px' ></i></a><a href='#'  class='deletebtn' id='personneldel' data-id="+ data.id + "><i  class='fa fa-trash-o' style='font-size:24px; color:red' ></a></i><a href='#'  class='restorebtn' id='personnelrestore' data-id="+ data.id + "><i  class='fas fa-trash-restore' style='font-size:24px; color:red' ></a></i>";
                 }
                
               }
         ],
  
  }); 
// fetchend


// store
$('#personnelform').validate({
  rules: {
    fname: {
       required: true,  
     },
     lname: {
       required: true,
      },
      addressline: {
        required: true,
        },
        town: {
        required:true,
      },
      phone: {
      required:true,
      maxlength: 11,
      minlength: 11,
      digits: true,
      },zipcode: {
        required:true,
      },
      email: {
        required:true,
        email:true
      },birth_date:{
        required:true,
       },
      
  }, //end rules
  messages: {
    fname: {
        required: "Please  add name.",
       },
       phone: {
       required: 'Phone is a must',
      },
     
  },
  errorPlacement: function(error, element) { 
     
         error.insertAfter(element);
        
   } 

 }); // end validate 

$("#personnelsubmit").on('click', function(e) {   
  
  var formStatus = $('#personnelform').validate().form();
  if(true == formStatus)
    {

      let personnelData = new FormData($('#personnelform')[0]);
        console.log(personnelData);
      for (var pair of personnelData.entries()) {
      console.log(pair[0]+ ', ' + pair[1]); 
            } 
        
          
      $.ajax({
          type: "POST",
          url: "/api/personnel",
          data: personnelData,
          contentType: false,
          processData: false,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          dataType: "json",
          success: function(data) {
                   console.log(data);  
                  $("#personnelModal").modal("hide"); 
                  swal("Mabuhay!!", "Personnel Inserted", "success");   
                   $('#personneltable').DataTable().ajax.reload();           
        },
          error: function(error) {
              console.log('error');
          }
      });
    

    }else
    {

      e.preventDefault();
    }

});

// endstore

//edit 
$('#personneleditModal').on('show.bs.modal', function(e) {
  var id = $(e.relatedTarget).attr('data-id');
  document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';
  console.log(id);
$("#personnelupdateform").trigger("reset");
$("#personnel_id").val(id);
   $.ajax({
      type: "GET",
      url: "/api/personnel/" + id + "/edit",
      success: function(data){
          console.log(data);
          //  console.log(data.data[0].image);
               var oldImage = $('#img-personnel img'); 
               var newImage = "<img src="+data.data[0].image +" width='240px', height='173px',border-radius='50%'/>"; 
               oldImage.hide();
               $('#img-personnel').prepend(newImage);
               oldImage.fadeOut(1000,function()
              {
              $(this).remove();
              }); 
              $("#epersonnelfname").val(data.data[0].fname);
              $("#epersonneladdressline").val(data.data[0].addressline);
              $("#epersonnelzipcode").val(data.data[0].zipcode);  
              $("#epersonnelemail").val(data.data[0].email); 
              $("#epersonnellname").val(data.data[0].lname);   
              $("#epersonneltown").val(data.data[0].town);   
              $("#epersonnelphone").val(data.data[0].phone);  
              $("#epersonnel_birthday").val(data.data[0].birth_date);  
              $("#erole").val(data.data[0].role);  
              $("#user_id").val(data.data[0].user_id);  
              $("#userspan").text("UserID:" + data.data[0].user_id);  

              
              var kasarian = data.data[0].gender;
              
              if (kasarian == "Female")
              {
                  document.getElementById("epersonnelfemale").checked = true;
                  document.getElementById("epersonnelmale").checked = false;
  
              }else
              {
                  document.getElementById("epersonnelmale").checked = true;
                  document.getElementById("epersonnelfemale").checked = false;
  
  
              }
 
           },
       error: function(){
        console.log('AJAX load did not work');
        alert("error");
        }
    }); 

});//end edit



//   update
$("#personnelupdate").on('click', function(e) { 
  var fname = document.forms["personnelupdateform"]["fname"];
  var lname = document.forms["personnelupdateform"]["lname"];
  var addressline = document.forms["personnelupdateform"]["addressline"];
  var town = document.forms["personnelupdateform"]["town"];
  var phone = document.forms["personnelupdateform"]["phone"];
  var zipcode = document.forms["personnelupdateform"]["zipcode"];
  var birth_date = document.forms["personnelupdateform"]["birth_date"];
  var role = document.forms["personnelupdateform"]["role"];
  var email = document.forms["personnelupdateform"]["email"];

  let file = document.getElementById("epersonnelimage");
  var fileName = file.value,
  idxDot = fileName.lastIndexOf(".") + 1,
  extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
 
   
  function ValidateEmail() 
  {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))
    {
 
      return (true);
    }
      swal("Sorry!","You have entered an invalid email address!", "warning")
      email.value = " ";
      email.focus();
      return (false);
  }

  ValidateEmail();

  if (fname.value == "")
  {
      fname.placeholder = "Please type your firstname."
      fname.focus();

  }else if(lname.value == "")
  {
      lname.placeholder = "Please type your lastname."
      lname.focus();
  }else if( addressline.value =="")
  {
      addressline.placeholder = "Please type your addrress."
      addressline.focus();
  }else if(town.value == "")
  {
      town.placeholder = "Please type your town."
      town.focus();
  }else if( phone.value =="")
  {
      phone.placeholder = "Please type your phone."
      phone.focus();
  }else if (phone.value.length < 11 || phone.value.length > 11)
  {
      swal("Sorry!", "Your number must be 11 digits", "warning");   

  }else if( zipcode.value =="")
  {
      zipcode.placeholder = "Please type your zipcode."
      zipcode.focus();
  }else if (extFile == "")
  {
      swal("Sorry!", "Upload Image", "warning");   

  }else if (birth_date == "")
  {
    swal("Sorry!", "Click to show calendar", "warning");   

  }else if (role.value == 0)
  {
    swal("Sorry!", "Role not allowed", "warning");   
    role.focus();
  }else
   {
 
  e.preventDefault()
   var id = $('#personnel_id').val(); 
  console.log(id);
  let personnelupdateData = new FormData($('#personnelupdateform')[0]);
    console.log(personnelupdateData);
  for (var pair of personnelupdateData.entries()) {
  console.log(pair[0]+ ', ' + pair[1]); 
        } 
  
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          url: "api/personnel/" + id,
          data: personnelupdateData, 
          contentType: false,
          processData: false, 
          dataType: "json",
          success: function (data) {
              console.log(data); 
              $('#personneleditModal').each(function(){
                  $(this).modal('hide');
                });
                var table = $('#personneltable').DataTable();  
                setInterval( function () {
                  table.ajax.reload( null, false);
                },2000 ); 
               swal("Mabuhay!!", "Personnel Updated", "success") 
          },
          error: function(){
           console.log("error");
           
           }
      });
  }
});
// update end


//Delete Function
   $('#personneltable tbody').on( 'click','a.deletebtn', function (e) { 
    var table = $('#personneltable').DataTable();
    var id = $(this).data('id');
    var $row = $(this).closest('tr');
    // console.log(id);
  e.preventDefault(); 
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Yes, I am sure!',
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: false
   },
   function(isConfirm){
  
     if (isConfirm){ 
      $.ajax({type: "DELETE",
      url: "/api/personnel/"+ id ,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
          console.log(data); 
             
       swal("Deleted!", "Records are successfully deleted!", "success");
       table.ajax.reload( null, false);
          // bootbox.alert(data.success); 
      },
      error: function(error) {
          console.log(error);
          swal("Deleted", "Your data is already deleted:)", "error");

      }
    }); 
  
      } else {
        swal("Cancelled", "Your data file is safe :)", "error");
      }
   });
 
  });
//enddelete 



// restore
$('#personneltable tbody').on( 'click','a.restorebtn', function (e) { 
  var table = $('#personneltable').DataTable();
  var id = $(this).data('id');
  var $row = $(this).closest('tr');
  console.log(id);
    $.ajax({type: "POST",
    url: "/api/restorepersonnel/"+ id ,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: "json",
    success: function(data) {
      var table = $('#personneltable').DataTable();  
      setInterval( function () {
        table.ajax.reload( null, false);
      },2000 );            
        swal("Mabuhay!!", "Personnel Restored", "success") 

    },
    error: function(error) {
        console.log(error);
        swal("Oops!!", "Restore Fail", "warning") 

    }
  });

 });

// restoreend



// show

$('#personnelshowModal').on('show.bs.modal', function(e) {
  var id = $(e.relatedTarget).attr('data-id');
   console.log(id);
$("#personnelshowform").trigger("reset");
    $.ajax({
      type: "GET",
      url: "/api/personnel/" + id,
      success: function(data){
          console.log(data);
             
          var oldImage = $('#simg-personnel img'); 
          var newImage = "<img src="+data.data.image +" width='240px', height='173px',border-radius='50%'/>"; 
          oldImage.hide();
          $('#simg-personnel').prepend(newImage);
          oldImage.fadeOut(1000,function()
         {
         $(this).remove();
         }); 
         $("#spersonnelfname").val(data.data.fname);
         $("#spersonneladdressline").val(data.data.addressline);
         $("#spersonnelzipcode").val(data.data.zipcode);  
         $("#spersonnelemail").val(data.data.email); 
         $("#spersonnellname").val(data.data.lname);   
         $("#spersonneltown").val(data.data.town);   
         $("#spersonnelphone").val(data.data.phone);  
         $("#spersonnel_birthday").val(data.data.birth_date);  
         $("#srole").val(data.data.role);  
          $("#suserspan").text("UserID:" + data.data.user_id);  

         
         var kasarian = data.data.gender;
         
         if (kasarian == "Female")
         {
             document.getElementById("spersonnelfemale").checked = true;
             document.getElementById("spersonnelmale").checked = false;

         }else
         {
             document.getElementById("spersonnelmale").checked = true;
             document.getElementById("spersonnelfemale").checked = false;


         }

          
           },
       error: function(){
        console.log('AJAX load did not work');
        alert("error");
        }
    }); 

});// endshow




});//end ready