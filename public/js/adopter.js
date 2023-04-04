$(document).ready(function() { 



// store


$('#regform').validate({
  rules: {
    fname: {
       required: true,  
     },
     lname: {
       required: true,
      },
      phone: {
      required:true,
      maxlength: 11,
      minlength: 11,
      digits: true,
      },
      email: {
        required:true,
        email:true
      },birth_date:{
        required:true,
       },     password: {
        required: true,
        rangelength:[8,16]
     },
      
  }, //end rules
  messages: {
    fname: {
        required: "Please  add name.",
       },
       phone: {
       required: 'Phone is a must',
      },password: {
        required: 'Please type a password',
        rangelength: 'Password must be between 8 and 16 characters long.'
      },email: {
        required: "Please supply an e-mail address.",
        email: "This is not a valid email address."
      },
     
  },
  errorPlacement: function(error, element) { 
     
         error.insertAfter(element);
        
   } 

 }); // end validate 



$("#registersubmit").on('click', function(e) {   

  var formStatus = $('#regform').validate().form();
  if(true == formStatus){
 
    let regData = new FormData($('#regform')[0]);
      console.log(regData);
    for (var pair of regData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
          } 
       
    $.ajax({
        type: "POST",
        url: "/api/register",
        data: regData,
        contentType: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
                 console.log(data);  
                 $('#modalLoginAvatar').each(function(){
                  $(this).modal('hide');
                }); 
                 swal({
                  title: "Registration",
                  text: "You have to wait for the Shelter's approval.",
                  type: "success",
                  confirmButtonColor: '#DD6B55',
                  confirmButtonText: 'Ok',
                },
               function(isConfirm){

                if (isConfirm){ 
                  location.reload(); 

                } 
             });  
       },
        error: function(error) {
            console.log('error');
        }
    });

  }
  else
  {
    e.preventDefault();

  }
   
  });
  
  // endstore


// login

$('#logform').validate({
  rules: {
      email: {
        required:true,
        email:true
      },
      password: {
        required: true,
        rangelength:[8,16]
     },
      
  }, //end rules
  messages: {
      password: {
        required: 'Please type a password',
        rangelength: 'Password must be between 8 and 16 characters long.'
      },email: {
        required: "Please supply an e-mail address.",
        email: "This is not a valid email address."
      },
     
  },
  errorPlacement: function(error, element) { 
     
         error.insertAfter(element);
        
   } 

 }); // end validate 

$("#loginsubmit").on('click', function(e){
 
  var formStatus = $('#logform').validate().form();
  if(true == formStatus){
     
    let logData = new FormData($('#logform')[0]);
    console.log(logData);
     for (var pair of logData.entries()) {
      console.log(pair[0]+ ', ' + pair[1]);
        } 
      
  $.ajax({
      type: "POST",
      url: "/api/login",
      data: logData,
      contentType: false,
      processData: false,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
               console.log(data.status);   
              if(data.status !=200)
              {
                 swal({
                  title: "Adoption",
                  text:  data.error,
                  type: "warning",
                  confirmButtonColor: '#DD6B55',
                  confirmButtonText: 'Ok',
                },
               function(isConfirm){

                if (isConfirm){ 
                  location.reload(); 

                } 
             });
 
              }else
              {
                window.top.location = window.top.location;  

              }
     },
      error: function(error) {
          console.log('error');
      }
  });

  }
  else
  {
  e.preventDefault();

  }
 
});



$("#logout-form").on('click', function(e){

  e.preventDefault()
 
  var currentuser= $('#currentuser').val();
     
  $.ajax({
      type: "POST",
      url: "/api/logout",
      data: currentuser,
      contentType: false,
      processData: false,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
               console.log(data);   
               window.location.href = 'http://animalshelter.test/';
      },
      error: function(error) {
          console.log('error');
      }
  });

});


$("#profilesignout").on('click', function(e){

  e.preventDefault()
 
  var currentuser= $('#currentuser').val();
     
  $.ajax({
      type: "POST",
      url: "/api/logout",
      data: currentuser,
      contentType: false,
      processData: false,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
               console.log(data);   
               location.reload();
      },
      error: function(error) {
          console.log('error');
      }
  });

});
// Fetch
$('#requesttable').DataTable({
  
  "order": [[ 0, "desc" ]],
  ajax: {
    url :"/api/adopter_request",

    // dataSrc: "",
    },
    // select: true,
    dom: 'Bfrtip',
    
    buttons: [
     
   
      {
          extend: 'collection',
          text: 'Column Visibility',
          className: "Visibility",
  
          buttons: [
            
            {
              text: 'ID ',
              action: function ( e, dt, node, config ) {
                  dt.column( 0 ).visible( ! dt.column( 0).visible() );
              }
            },
            {
              text: 'Status',
              action: function ( e, dt, node, config ) {
                  dt.column(4).visible( ! dt.column(4).visible() );
              }
            },            
             {
              text: 'Email',
              action: function ( e, dt, node, config ) {
                  dt.column(2).visible( ! dt.column(2).visible() );
              }
            },
          ],
      },   

      {
        text: 'pdf',
        extend: 'pdfHtml5',
      },                    {
        text: 'excel',
        extend: 'excelHtml5',
     },
  ]
   ,columns: [
      
             { "data": "id"},   
             { "data": "name" },
             { "data": "email" },
             { "data": "role" },
             { "data": "status" },    
             { "data": "created_at" },      
            { "data" : null,render : function ( data, type, row ) {
                 return "</a></i><a href='#'  class='statusbtn' id='requeststatus' data-id="+ data.id + "><i  class='fas fa-lock' style='font-size:24px; color:blue' ></a></i>";
               }
              
             }
       ], 
}); 
// fetchend


 
//   update
$('#requesttable tbody').on( 'click','a.statusbtn', function (e) { 
 
  e.preventDefault()
  var table = $('#requesttable').DataTable();
  var id = $(this).data('id');
   
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "PUT",
          url: "api/admin/" + id,
          contentType: false,
          processData: false, 
          dataType: "json",
          success: function (data) {
              console.log(data);  
                 setInterval( function () {
                  table.ajax.reload( null, false);
                },2000 ); 
               swal("Mabuhay!!", "User Updated", "success") 
          },
          error: function(){
           console.log("error");
           
           }
      });
  
});
// update end

$("#logout-adopter").on('click', function(e){

  e.preventDefault()
 
  var currentuser= $('#currentuser').val();
     
  $.ajax({
      type: "POST",
      url: "/api/logout",
      data: currentuser,
      contentType: false,
      processData: false,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
               console.log(data);   
               location.reload();
      },
      error: function(error) {
          console.log('error');
      }
  });

});


// showadopter
 
$('#myprofileModal').on('show.bs.modal', function(e) {
  var id = $(adopter_idfromheader).val();
  //  alert(id);
  document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';
 
    $.ajax({
      type: "GET",
      url: "/api/adopter/" + id,
      success: function(data){
          console.log(data);
             
           var oldImage = $('#profileimage img'); 
           var newImage = "<img src="+data.data[0].image +"/>"; 
          oldImage.hide();
          $('#profileimage').prepend(newImage);
          oldImage.fadeOut(1000,function()
         {
         $(this).remove();
         }); 
            $("#profilename").val(data.data[0].fname + " " + data.data[0].lname);
            $("#profilephone").val(data.data[0].phone);  
            $("#profileemail").val(data.data[0].email); 
            $("#profileaddressline").val(data.data[0].addressline);
            $("#profilezipcode").val(data.data[0].zipcode);  
            $("#profiletown").val(data.data[0].town);   
            $("#profilebirth_date").val(data.data[0].birth_date);   
            
            $("#profile_id").val(data.data[0].id);
          var kasarian = data.data[0].gender;
         
         if (kasarian == "Female")
         {
             document.getElementById("profilegender").value = "Female";
 
         }else if (kasarian == "Male")
         {
          document.getElementById("profilegender").value = "Male";

         }else{
          document.getElementById("profilegender").value = "kindly Confirm your Gender.";

         }
 
         $.each(data.animal, function(key, value) {
          console.log(value.image);
           $('#galleryimage').prepend("<a href="+value.image+"><img src="+value.image +"/> "+ value.animal_name+"</a>")
        })

        $('#galleryimage a').click(function(evt) {
          //don't follow link
           evt.preventDefault();
           var imgPath = $(this).attr('href');
           var oldImage = $('#galleryphoto img');
 
           var newImage = $("<img src="+imgPath +"/>");
           newImage.hide();

           $('#galleryphoto').prepend(newImage);
           newImage.fadeIn(1000);

           oldImage.fadeOut(1000,function(){
              $(this).remove();
                 });	
        });
          
           },
       error: function(){
        console.log('AJAX load did not work');
        alert("error");
        }
    }); 

});// endshow
 
// gellery
$("#mygallery").on('click', function(e){

  $('#infopart').fadeToggle();
  var x = document.getElementById("gallerypart");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }

  
});
$("#adopterprofile").on('click', function(e){
  $('#infopart').show(); 
  var x = document.getElementById("gallerypart");
  
    x.style.display = "none";
 
});

$("#updateprofile").on('click', function(e){
  
  e.preventDefault()
   var id = $('#profile_id').val(); 
  // alert(id);
  let myprofileModalformData = new FormData($('#myprofileModalform')[0]);
    console.log(myprofileModalformData);
  for (var pair of myprofileModalformData.entries()) {
  console.log(pair[0]+ ', ' + pair[1]); 
        } 
  
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          url: "api/adopter/" + id,
          data: myprofileModalformData, 
          contentType: false,
          processData: false, 
          dataType: "json",
          success: function (data) {
              console.log(data); 
              $('#myprofileModal').each(function(){
                   $(this).modal('show');

                });
              //   var table = $('#personneltable').DataTable();  
              //   setInterval( function () {
              //     table.ajax.reload( null, false);
              //   },2000 ); 

             swal("Mabuhay!!", "Information Updated", "success") 
             
          },
          error: function(){
           console.log("error");
           
           }
      });
});

$("#sarado").on('click', function(e) {
  e.preventDefault();  
  window.location.href = 'http://animalshelter.test/'; 
  document.getElementById("mySidenav").style.width = "0";
  
  });//end animal
  

});//endready