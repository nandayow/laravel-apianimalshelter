$(document).ready(function() { 
    

    //  Diseasefetch
   $('#injurytable').DataTable({
    
     ajax: {
     url :"/api/diseaseinjury",
     // dataSrc: "",
     },
    //  select: true,
     dom: 'Bfrtip',
     buttons: [
        {text: 'Create New',
        id:'adddisease',
        className: 'btn btn-primary',

        action: function ( e, dt, node, config ) 
            {
              document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';
                // alert('eyy'); 
                   $("#injuryModal").trigger("reset");
                  $('#injuryModal').modal('show');
                  document.getElementById("cadd").value = " ";
            }
        },
     
       {
           extend: 'collection',
           text: 'Table Column Visibility',
           buttons: [
               {
                   text: 'DeletedFiles',
                   action: function ( e, dt, node, config ) {
                       dt.column( -2 ).visible( ! dt.column( -2 ).visible() );
                   }
               },
               {
                   text: 'ID',
                   action: function ( e, dt, node, config ) {
                       dt.column( 1 ).visible( ! dt.column( 1 ).visible() );
                   }
               }
           ]
       }, {
        extend: 'collection',
        text: 'Catefory',
        buttons: [
            {
                text: 'Injury',
                action: function ( e, dt, node, config ) {
                  $.fn.dataTable.ext.search.pop(); 
                  $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) { 
                        return data[3] == "Injury";
                      }
                  );  
                  this.draw();
                }
            },
            {
                text: 'Disease',
                id:"disease",
                action: function ( e, dt, node, config ) {
                  e.preventDefault();
                  $.fn.dataTable.ext.search.pop();
                  $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) { 
                        return data[3] == "Disease";
                      }
                  );   
                  this.draw();
                
                }
                },                     
        ] 
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

   ],columns: [ {
                     data:"id",
                render: function ( data, type, row ) {
                    if ( type === 'display' ) {
                        return '<input type="checkbox" class="editor-active">';
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
                searchable: false },
              { "data": "id" },
              { "data": "condition_name" },
              { "data": "condition_type" },  
              { "data": "deleted_at" }, 
              { "data" : null,render : function ( data, type, row ) {
                return "<a href='#' data-bs-toggle='modal' data-bs-target='#injuryshowtModal' id='injuryshowbtn' data-id="+ data.id +"><i class='fa fa-eye-slash' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' data-bs-toggle='modal' data-bs-target='#injuryeditModal' id='injuryeditbtn' data-id="+ data.id +"><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:24px' ></i></a><a href='#'  class='deletebtn' id='injurydel' data-id="+ data.id + "><i  class='fa fa-trash-o' style='font-size:24px; color:red' ></a></i><a href='#'  class='restorebtn' id='injuryrestore' data-id="+ data.id + "><i  class='fas fa-trash-restore' style='font-size:24px; color:red' ></a></i>";
              }
             
             }
        ],
       
       });

    //endfetch


// deletedisease

   //Delete Function
   $('#injurytable tbody').on( 'click','a.deletebtn', function (e) { 
    var table = $('#injurytable').DataTable();
    var id = $(this).data('id');
    var $row = $(this).closest('tr');
    console.log(id);
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
      url: "/api/diseaseinjury/"+ id ,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
          console.log(data);
          table.row( $row ).remove().draw(false);
             $row.fadeOut(4000, function () {
             table.row( $row ).remove().draw(false);

           });
          bootbox.alert(data.success);


         
      },
      error: function(error) {
          console.log(error);
      }
    });
 
       swal("Deleted!", "Records are successfully deleted!", "success");
       table.ajax.reload( null, false);

  
      } else {
        swal("Cancelled", "Your data file is safe :)", "error");
      }
   });
 
  });
//enddelete 
 
  // adding
  $("#injurysubmit").on('click', function(e) {
    e.preventDefault();

    var laman ;
     if(document.getElementById('injuryradio').checked) {

        laman = "Injury";
      }else if(document.getElementById('diseaseradio').checked) {
         laman = "Disease";
    }   
 
   var data2 ={

        'name':laman,
        'namo':document.getElementById("cadd").value,
    }

    if(data2.namo ==" ")
    {
        var derror =  document.getElementById("derror");
        derror.innerText ="Kindlly indicate the condtion name";
    } else
    {

   
    
    console.log(data2);
    $.ajax({
        type: "POST",
        url: "/api/diseaseinjury",
        data: data2, 
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
                console.log(data);  
                $("#injuryModal").modal("hide"); 
                swal("Mabuhay!!", "Health Problem Inserted", "success");   
                 $('#injurytable').DataTable().ajax.reload();   
      },
        error: function(error) {
            console.log('error');
        }
    });
}
  });
//   endadd
 //edit 
 $('#injuryeditModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).attr('data-id'); 

    // console.log(id);
  $("#updateform").trigger("reset");

    $("#animal_id").val(id);
    // $('<input>').attr({type: 'hidden', id:'customerid',name: 'customer_id',value: id}).appendTo('#updateform');
    $.ajax({
        type: "GET",
        url: "/api/diseaseinjury/" + id + "/edit",
        success: function(data){
            console.log(data);
            console.log(data.conditions[0].condition_name);

            $('#ecadd').val(data.conditions[0].condition_name);
            $('#injurydisease_id').val(data.conditions[0].id);
            let pilay = data.conditions[0].condition_type;
            // alert(pilay);
            if (pilay == "Disease")
            {
                document.getElementById("ediseaseradio").checked = true;
                document.getElementById("einjuryradio").checked = false;

            }else
            {
                document.getElementById("einjuryradio").checked = true;
                document.getElementById("ediseaseradio").checked = false;


            }


             },
         error: function(){
          console.log('AJAX load did not work');
          alert("error");
          }
      }); 
   
  
      
  
  });//end edit
  

  $("#injuryupdate").on('click',function(e){
    e.preventDefault(); 

    var laman2 ;
    if(document.getElementById('einjuryradio').checked) {

       laman2 = "Injury";
     }else if(document.getElementById('ediseaseradio').checked) {
        laman2= "Disease";
   }   

    var id = $('#injurydisease_id').val(); 
      
        var data ={

            'sakit':laman2,
            'name':$('#ecadd').val(),
        }
        console.log(data);
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $.ajax({
          type: "PUT",
          url: "api/diseaseinjury/" + id,
          data: data,
          dataType: "json",
          success: function (response) {
              console.log(response); 
              $('#injuryeditModal').each(function(){
                $(this).modal('hide');
              });
              var table = $('#injurytable').DataTable();  
              setInterval( function () {
                table.ajax.reload( null, false);
              },2000 );              swal("Mabuhay!!", "Health Updated", "success") 
          },
          error: function(){
           console.log("error");
           
           }
      });
  });

// restore
  $('#injurytable tbody').on( 'click','a.restorebtn', function (e) { 
    var table = $('#injurytable').DataTable();
    var id = $(this).data('id');
    var $row = $(this).closest('tr');
    console.log(id);
      $.ajax({type: "POST",
      url: "/api/restorehealth/"+ id ,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
        var table = $('#injurytable').DataTable();  
        setInterval( function () {
          table.ajax.reload( null, false);
        },2000 );              swal("Mabuhay!!", "Health Restored", "success") 
  
      },
      error: function(error) {
          console.log(error);
          alert("panatalolo");
  
      }
    });
  
   });

// restoreend

// show
$('#injuryshowtModal').on('show.bs.modal', function(e) {
  var id = $(e.relatedTarget).attr('data-id');
 
   $.ajax({
      type: "GET",
      url: "/api/diseaseinjury/" + id,
      success: function(data){
              
              console.log(data.conditions[0].condition_name);
              $('#tottalcase').text("Total Case" +"(" +data.total.length +")");
              $('#showconname').val(data.conditions[0].condition_name);
              $('#showcontype').val(data.conditions[0].condition_type);

           },
       error: function(){
        console.log('AJAX load did not work');
        alert("error");
        }
    }); 


});
 

    });//end ready