 
$(document).ready(function() { 

// Fetch
$('#rescuertable').DataTable({
  
    "order": [[ 0, "ASC" ]],
    ajax: {
      url :"/api/rescuer",
  
      // dataSrc: "",
      },
      // select: true,
      dom: 'Bfrtip',
      
      buttons: [
        {text: 'Create new',
        id:'addrescuer',
        className: 'btn btn-primary',
  
        action: function ( e, dt, node, config ) 
            {
              document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';
                // alert('eyy');  
                
  
                $("#rescuerform").trigger("reset"); 
                $('#rescuerModal').modal('show');
            }
        },
     
        {
            extend: 'collection',
            text: 'Column Visibility',
            className: "Visibility",
    
            buttons: [
                {
                    text: 'Rescued ID', 
    
                    action: function ( e, dt, node, config ) {
                        dt.column( 0 ).visible( ! dt.column( 0 ).visible() );
                    }
                },
                {
                    text: 'Firstname',
                    action: function ( e, dt, node, config ) {
                        dt.column( 1 ).visible( ! dt.column(1).visible() );
                    }
                },
                {
                  text: 'Lastname',
                  action: function ( e, dt, node, config ) {
                      dt.column( 2 ).visible( ! dt.column( 2 ).visible() );
                  }
              },
              {
                  text: 'Phone',
                  action: function ( e, dt, node, config ) {
                      dt.column( 3 ).visible( ! dt.column( 3).visible() );
                  }
              },
              {
                text: 'Addressline',
                action: function ( e, dt, node, config ) {
                    dt.column( 4 ).visible( ! dt.column( 4).visible() );
                }
              },
              {
                text: 'Image',
                action: function ( e, dt, node, config ) {
                    dt.column( 5).visible( ! dt.column( 5).visible() );
                }
              },
              {
                text: 'Town ',
                action: function ( e, dt, node, config ) {
                    dt.column( 6 ).visible( ! dt.column( 6).visible() );
                }
              },
              {
                text: 'Zipcode',
                action: function ( e, dt, node, config ) {
                    dt.column(7).visible( ! dt.column(7).visible() );
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
        
               { "data": "id",},
               { "data": "fname" },
               { "data": "lname" },
               { "data": "phone" },
               { "data": "addressline" },
               { data: 'image',render: function (data, type, row, meta)
                 {
                   return '<img src="' + data + '" height="50" width="50"/>';
                 }
               },   
              { "data": "town" },  
              { "data": "zipcode" },      
              { "data": "deleted_at" },     
              { "data" : null,render : function ( data, type, row ) {
                   return "<a href='#' data-bs-toggle='modal' data-bs-target='#rescuershowModal' id='rescuershowbtn' data-id="+ data.id +"><i class='fa fa-eye-slash' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' data-bs-toggle='modal' data-bs-target='#rescuereditModal' id='rescuereditbtn' data-id="+ data.id +"><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:24px' ></i></a><a href='#'  class='deletebtn' id='rescuerdel' data-id="+ data.id + "><i  class='fa fa-trash-o' style='font-size:24px; color:red' ></a></i><a href='#'  class='restorebtn' id='animalrestore' data-id="+ data.id + "><i  class='fas fa-trash-restore' style='font-size:24px; color:red' ></a></i>";
                 }
                
               }
         ],
  
  }); //fetch end
  
// fetchend


// store
$('#rescuerform').validate({
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

$("#rescuersubmit").on('click', function(e) {   
  
  var formStatus = $('#rescuerform').validate().form();
  if(true == formStatus){
    let resuerData = new FormData($('#rescuerform')[0]);
      console.log(resuerData);
    for (var pair of resuerData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
          } 
      
        
    $.ajax({
        type: "POST",
        url: "/api/rescuer",
        data: resuerData,
        contentType: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
                 console.log(data);  
                $("#rescuerModal").modal("hide"); 
                swal("Mabuhay!!", "Rescuer Inserted", "success");   
                 $('#rescuertable').DataTable().ajax.reload();           
      },
        error: function(error) {
            console.log('error');
        }
    });

  }
  else{ 
    e.preventDefault();
  }
    
  
});

// endstore


//edit 
$('#rescuereditModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).attr('data-id');
    document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';
    console.log(id);
  $("#rescuerupdateform").trigger("reset");
  $("#rescuer_id").val(id);
     $.ajax({
        type: "GET",
        url: "/api/rescuer/" + id + "/edit",
        success: function(data){
            console.log(data);
                console.log(data.data[0].image);
                var oldImage = $('#img-rescuer img'); 
                var newImage = "<img src="+data.data[0].image +" width='240px', height='240px'/>"; 
                oldImage.hide();
                $('#img-rescuer').prepend(newImage);
                oldImage.fadeOut(1000,function()
                {
                $(this).remove();
                }); 
                $("#erescuerfname").val(data.data[0].fname);
                $("#erescueraddressline").val(data.data[0].addressline);
                $("#erescuerzipcode").val(data.data[0].zipcode);  
                $("#erescuerlname").val(data.data[0].lname);   
                $("#erescuertown").val(data.data[0].town);   
                $("#erescuerphone").val(data.data[0].phone);   
             },
         error: function(){
          console.log('AJAX load did not work');
          alert("error");
          }
      }); 
  
  });//end edit
  

//   update
$("#rescuerupdate").on('click', function(e) {   
    let file = document.getElementById("erescuerimage");
    var fileName = file.value,
    idxDot = fileName.lastIndexOf(".") + 1,
    extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

    if (extFile == "")
    {
        swal("Sorry!", "Upload Image", "warning");   

    }else{
        
  
    e.preventDefault()
     var id = $('#rescuer_id').val(); 
    console.log(id);
    let resuerupdateData = new FormData($('#rescuerupdateform')[0]);
      console.log(resuerupdateData);
    for (var pair of resuerupdateData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
          } 
    
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "api/rescuer/" + id,
            data: resuerupdateData, 
            contentType: false,
            processData: false, 
            dataType: "json",
            success: function (data) {
                console.log(data); 
                $('#rescuereditModal').each(function(){
                    $(this).modal('hide');
                  });
                  var table = $('#rescuertable').DataTable();  
                  setInterval( function () {
                    table.ajax.reload( null, false);
                  },2000 ); 
                 swal("Mabuhay!!", "Rescuer Updated", "success") 
            },
            error: function(){
             console.log("error");
             
             }
        });
    }
  });
// update end


// show

 $('#rescuershowModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).attr('data-id');
     console.log(id);
  $("#rescuershowform").trigger("reset");
      $.ajax({
        type: "GET",
        url: "/api/rescuer/" + id,
        success: function(data){
            console.log(data);
                 var oldImage = $('#simg-rescuer img'); 
                var newImage = "<img src="+data.data.image +" width='240px', height='240px'/>"; 
                oldImage.hide();
                $('#simg-rescuer').prepend(newImage);
                oldImage.fadeOut(1000,function()
                {
                $(this).remove();
                }); 
                $("#srescuerfname").val(data.data.fname);
                $("#srescueraddressline").val(data.data.addressline);
                $("#srescuerzipcode").val(data.data.zipcode);  
                $("#srescuerlname").val(data.data.lname);   
                $("#srescuertown").val(data.data.town);   
                $("#srescuerphone").val(data.data.phone);   
                $("#tottalrescue").text("Animal Rescued:" + "(" + data.animal.length + ")");   

                $.each(data.animal, function(key, value) {
                    console.log(value.image);
                     $('#larawanko').prepend("<a href="+value.image+"><img src="+value.image +" width='180px', height='200px'/> </a>")
                  })

                  $('#larawanko a').click(function(evt) {
                    //don't follow link
                     evt.preventDefault();
                     var imgPath = $(this).attr('href');
                     var oldImage = $('#photo img');
		 			
                     var newImage = $("<img src="+imgPath +" width='450px', height='240px'/>");
                     newImage.hide();

                     $('#photo').prepend(newImage);
                     newImage.fadeIn(1000);

                     oldImage.fadeOut(500,function(){
                        $(this).remove();
                           });	
                  });

                  $('#buo').hide();
             },
         error: function(){
          console.log('AJAX load did not work');
          alert("error");
          }
      }); 
  
  });// endshow
  
 

$('#labasimage').on('click',function (e) {
    $('#buo').fadeToggle();
   });

   //Delete Function
   $('#rescuertable tbody').on( 'click','a.deletebtn', function (e) { 
    var table = $('#rescuertable').DataTable();
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
      url: "/api/rescuer/"+ id ,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success: function(data) {
          console.log(data);
          // table.row( $row ).remove().draw(false);
          //    $row.fadeOut(4000, function () {
          //    table.row( $row ).remove().draw(false);

          //  });
           
             
       swal("Deleted!", "Records are successfully deleted!", "success");
       table.ajax.reload( null, false);
          // bootbox.alert(data.success); 
      },
      error: function(error) {
          console.log(error);
      }
    }); 
  
      } else {
        swal("Cancelled", "Your data file is safe :)", "error");
      }
   });
 
  });
//enddelete 


// restore
$('#rescuertable tbody').on( 'click','a.restorebtn', function (e) { 
  var table = $('#rescuertable').DataTable();
  var id = $(this).data('id');
  var $row = $(this).closest('tr');
  console.log(id);
    $.ajax({type: "POST",
    url: "/api/restorerescuer/"+ id ,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: "json",
    success: function(data) {
      var table = $('#rescuertable').DataTable();  
      setInterval( function () {
        table.ajax.reload( null, false);
      },2000 );            
        swal("Mabuhay!!", "Rescuer Restored", "success") 

    },
    error: function(error) {
        console.log(error);
        swal("Oops!!", "Restore Fail", "warning") 

    }
  });

 });

// restoreend

   
}); //endredy