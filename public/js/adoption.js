$(document).ready(function() { 

 

$('#adoptionrequesttable').DataTable({
  
    "order": [[ 0, "desc" ]],
    ajax: {
      url :"/api/adopted",
  
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
        
               { "data": "animal_id"},    
               { "data": "adopters_myid"},    
               { "data": "email" }, 
               { "data": "status" },    
               { "data": "created_at" },      
              { "data" : null,render : function ( data, type, row ) {
                   return "<a href='#'  class='approvebtn' id='adoptionaccept' data-id="+ data.animal_id + "><i  class='fa fa-lock' style='font-size:24px; color:blue'></i></a><a href='#'  class='deletebtn' id='adoptionddenied' data-id="+ data.animal_id + "><i  class='fa fa-trash-o' style='font-size:24px; color:red'></i></a>";
                 }
                
               }
         ], 
  }); 

  //Delete Function
  $('#adoptionrequesttable tbody').on( 'click','a.deletebtn', function (e) { 
    var table = $('#adoptionrequesttable').DataTable();
    var id = $(this).data('id');
    var $row = $(this).closest('tr');
    // alert(id);
    // console.log(id);
  e.preventDefault(); 
    swal({
      title: "Are you sure?",
      text: "You will deny the adoption of this user?",
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
      url: "/api/adopted/"+ id ,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
          console.log(data); 
             
       swal("Denied!", "Adoption are successfully denied!", "success");
       table.ajax.reload( null, false);
          // bootbox.alert(data.success); 
      },
      error: function(error) {
          console.log(error);
          swal("Deleted", "Your data is already deleted:)", "error");

      }
    }); 
  
      } else {
        swal("Cancelled", "Adoption is still processing", "error");
      }
   });
 
  });
//enddelete 

$(".mybutton").click(function() {
  var id = $(this).data('id');
 
   var data = {
                  'animal_id':id,
             }

             console.log(data); 
             $.ajax({
              type: "POST",
              url: "/api/adopt",
              data: data,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function(data) {
                       console.log(data); 
                      //  location.reload(); 
                      if(data.status !=200)
                      {
                        swal("Sorry!",data.error, "warning");

                      }else
                      {
                        swal({
                          title: "Adoption",
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
                     
                      }
         
             },
              error: function(error) {
                //  console.log(error);
                swal("Sorry!", "Adoption exclusive for adoter only", "warning");

              }
          });

});


//   update
$('#adoptionrequesttable tbody').on( 'click','a.approvebtn', function (e) { 
 
  e.preventDefault()
  var table = $('#adoptionrequesttable').DataTable();
  var id = $(this).data('id');
  //  alert(id);
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "PUT",
          url: "api/adopted/" + id,
          contentType: false,
          processData: false, 
          dataType: "json",
          success: function (data) {
              console.log(data);  
                 setInterval( function () {
                  table.ajax.reload( null, false);
                },2000 ); 
               swal("Mabuhay!!", "Adoption Accepted", "success") 
          },
          error: function(){
           console.log("error");
           
           }
      });
  
});

 });//end ready 
