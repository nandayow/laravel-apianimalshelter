$(document).ready(function() { 
   

// startfetchanimaltable

$('#animaltable').DataTable({
  
  "order": [[ 1, "desc" ]],
  ajax: {
    url :"/api/animal/all",

    // dataSrc: "",
    },
    // select: true,
    dom: 'Bfrtip',
    
    buttons: [
      {text: 'Create new',
      id:'addanimal',
      className: 'btn btn-primary',

      action: function ( e, dt, node, config ) 
          {
            document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';
              // alert('eyy');
                  //breed
                  $.ajax({
                    type: "GET",
                    url: "/api/breed/",
                    success: function(data){
                
                          $.each(data, function(key, value) {
                            //  console.log(value);
                            var id = value.id;
                            var name = value.breed_name + "  Animal:" + value.animal_type;
                            // console.log(id);
                          var option = "<option value='"+id+"'>"+name+"</option>";  
                          $("#sel_breed").append(option); 
                          });

                        },
                    error: function(){
                      console.log('AJAX load did not work');
                      alert("error");
                      }
                  });  

                     //selectRescuer
                     $.ajax({
                      type: "GET",
                      url: "/api/selectRescuer/",
                      success: function(data){
                  
                            $.each(data, function(key, value) {
                              // console.log(value);
                              var id = value.id;
                              var lname = value.lname;
                              var fname = value.fname;
                              var name = fname + " " + lname + "  with ID:#" +id;
                              // console.log(id);
                            var option = "<option value='"+id+"'>"+name+"</option>";  
                            $("#rescuer_animal").append(option); 
                            });

                          },
                      error: function(){
                        console.log('AJAX load did not work');
                        alert("error");
                        }
                    });  

                     //Condition
                  $.ajax({
                    type: "GET",
                    url: "/api/selectDisease/",
                    success: function(data){
                
                          $.each(data, function(key, value) {
                            //  console.log(value);
                            var id = value.id;
                            var name = value.condition_name;
                            var type=  value.condition_type
                            // console.log(id);

                            if (type !== "Injury") {
                                       $('#conditions')
                                      .prepend(`<input type="checkbox"  id="injuryform" name="injury" value="${id}" required>`)
                                      .prepend(`<label for="injuryform">${name}</label></div>`)
                             }else{

                                       $('#conditions2')
                                      .prepend(`<input type="checkbox"  id="injuryform" name="injury" value="${id}" required>`)
                                      .prepend(`<label for="injuryform">${name}</label></div>`)
 
                            }


                          });

                        },
                    error: function(){
                      console.log('AJAX load did not work');
                      alert("error");
                      }
                  });  


              $("#animalform").trigger("reset");
              $('label[for=injuryform]').remove();
              $('label[for=res]').remove();
              $(':checkbox').remove();
            
                 $('#meron')
                      .prepend(`<input type="checkbox"  id="res" name="res" value="No">`)
                      .prepend(`<label for="res">Already Exist?</label></div>`)
              $('#animalModal').modal('show');
              $('#rescueraddform').hide();

          }
      },
   
      {
          extend: 'collection',
          text: 'Column Visibility',
          className: "Visibility",
  
          buttons: [
              {
                  text: 'Rescued Date', 
  
                  action: function ( e, dt, node, config ) {
                      dt.column( -3 ).visible( ! dt.column( -3 ).visible() );
                  }
              },
              {
                  text: 'Animal Breed',
                  action: function ( e, dt, node, config ) {
                      dt.column( -4 ).visible( ! dt.column( -4).visible() );
                  }
              },
              {
                text: 'Category',
                action: function ( e, dt, node, config ) {
                    dt.column( -5 ).visible( ! dt.column( -5 ).visible() );
                }
            },
            {
                text: 'Gender',
                action: function ( e, dt, node, config ) {
                    dt.column( -6 ).visible( ! dt.column( -6).visible() );
                }
            },
            {
              text: 'HealthStatus',
              action: function ( e, dt, node, config ) {
                  dt.column( -7 ).visible( ! dt.column( -7).visible() );
              }
            },
            {
              text: 'Image',
              action: function ( e, dt, node, config ) {
                  dt.column( -8).visible( ! dt.column( -8).visible() );
              }
            },
            {
              text: 'Animal Name',
              action: function ( e, dt, node, config ) {
                  dt.column( -9 ).visible( ! dt.column( -9).visible() );
              }
            },
            {
              text: 'ID',
              action: function ( e, dt, node, config ) {
                  dt.column( -10 ).visible( ! dt.column( -10).visible() );
              }
            },
          ],
      },        
      
      {
        extend: 'collection',
        text: 'Catefory',
        buttons: [
            {
                text: 'Dog',
                action: function ( e, dt, node, config ) {
                  $.fn.dataTable.ext.search.pop(); 
                  $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) { 
                        return data[6] == "Dog";
                      }
                  );  
                  this.draw();
                }
            },
            {
                text: 'Cat',
                id:"cat",
                action: function ( e, dt, node, config ) {
                  e.preventDefault();
                  $.fn.dataTable.ext.search.pop();
                  $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) { 
                        return data[6] == "Cat";
                      }
                  );   
                  this.draw();
                
                }
                },              {
                  text: 'Deleted Files',
                  id:"deleted",
                  action: function ( e, dt, node, config ) {
                    e.preventDefault();
                    $.fn.dataTable.ext.search.pop();
                    $.fn.dataTable.ext.search.push(
                      function(settings, data, dataIndex) { 
                          return data[9] !== null;
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
  ]
   ,columns: [
    {
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
             { "data": "id",},
             { "data": "animal_name" },
             { data: 'image',render: function (data, type, row, meta)
               {
                 return '<img src="' + data + '" height="50" width="50"/>';
               }
             },   
            { "data": "healthstatus" },  
            { "data": "gender" },      
            { "data": "animal_type" },  
            { "data": "breed_name" },     
            { "data": "rescued_date",                                           
             orderable: false,
            searchable: false }, 
            { "data": "deleted_at" },   
            { "data" : null,render : function ( data, type, row ) {
                 return "<a href='#' data-bs-toggle='modal' data-bs-target='#animalshowModal' id='animalshowbtn' data-id="+ data.id +"><i class='fa fa-eye-slash' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' data-bs-toggle='modal' data-bs-target='#animaleditModal' id='animaleditbtn' data-id="+ data.id +"><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:24px' ></i></a><a href='#'  class='deletebtn' id='animaldel' data-id="+ data.id + "><i  class='fa fa-trash-o' style='font-size:24px; color:red' ></a></i><a href='#'  class='restorebtn' id='rescuerrestore' data-id="+ data.id + "><i  class='fas fa-trash-restore' style='font-size:24px; color:red' ></a></i>";
               }
              
             }
       ],

}); //fetch end

 //Delete Function
   
 $('#animaltable tbody').on( 'click','a.deletebtn', function (e) { 
  var table = $('#animaltable').DataTable();
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
    url: "/api/animal/"+ id ,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: "json",
    success: function(data) {
        console.log(data);
        table.row( $row ).remove().draw(false);
           $row.fadeOut(4000, function () {
           table.row( $row ).remove().draw(false);
         });

          setInterval( function () {
           table.ajax.reload( null, false);
         },2000 );

        // bootbox.alert(data.success);
    },
    error: function(error) {
        console.log(error);
    }
  });

     swal("Deleted!", "Records are successfully deleted!", "success");

    } else {
      swal("Cancelled", "Your animal data file is safe :)", "error");
    }
 });

});//end del 

// resstore
 $('#animaltable tbody').on( 'click','a.restorebtn', function (e) { 
  var table = $('#animaltable').DataTable();
  var id = $(this).data('id');
  var $row = $(this).closest('tr');
  console.log(id);
  
    $.ajax({type: "POST",
    url: "/api/restoreanimal/"+ id ,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: "json",
    success: function(data) {
      var table = $('#animaltable').DataTable();  
        setInterval( function () {
          table.ajax.reload( null, false);
        },2000 );             
         swal("Mabuhay!!", "Animal Restored", "success") 
  
    },
    error: function(error) {
        console.log(error);
        alert("panatalolo");

    }
  });

 });



//edit 
$('#animaleditModal').on('show.bs.modal', function(e) {
  var id = $(e.relatedTarget).attr('data-id');
  $(':checkbox').remove();
  $('label[for=kid]').remove();

  document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';

  console.log(id);
$("#updateform").trigger("reset");

  $("#animal_id").val(id);
  // $('<input>').attr({type: 'hidden', id:'customerid',name: 'customer_id',value: id}).appendTo('#updateform');
  $.ajax({
      type: "GET",
      url: "/api/animal/" + id + "/edit",
      success: function(data){
          console.log(data);
              console.log(data.animalimage.image);
             var oldImage = $('#animage img'); 
             var newImage = "<img src="+data.animalimage.image +" width='240px', height='240px'/>"; 
             $("#eanimal_name").val(data.animal[0].animal_name);
             $("#egender").val(data.animal[0].gender);
             $("#myrescuer").text("#" + data.animal[0].rescuer_id);
             console.log(data.animal[0].rescuer_id);
             $("#ehealthstatus").val(data.animal[0].healthstatus);  
             $("#eapproximate_age").val(data.animal[0].approximate_age);   
             $("#ecategory").val(data.animal[0].breed_name);   
             $("#ecreated_at").val(data.animal[0].created_at);  
             $("#erescued_date").val(data.animal[0].rescued_date);  
             oldImage.hide();
             $('#animage').prepend(newImage);
              //fade in new image 
              //fade out old image and remove from DOM
              oldImage.fadeOut(1000,function()
              {
              $(this).remove();
                  }); 

                  let asul = data.animalconditionnew;
                  let green= data.animalcondition;
                  for(i in asul){

                          $('#econditions')
                                  .prepend(`<input type="checkbox"  id="kid" name="${ data.animalcondition[i].condition_name}" value="${ data.animalcondition[i].id}" checked>`)
                                  .prepend(`<label for="kid">${ data.animalcondition[i].condition_name}</label></div>`)
                                 
                          
                      // console.log( data.animalcondition[i]);
                    
                  }; 
                  for(g in green){
                          // console.log(data.animalcondition[g].id)

                                $('#econditions2')
                                 .prepend(`<input type="checkbox"  id="kid" name="${ data.animalcondition[g]}" value="${data.animalcondition[g].id}">`)
                                 .prepend(`<label for="kid">${ data.animalcondition[g].condition_name}</label></div>`)
                               
                         
                     // console.log( data.animalcondition[i]);
                   
                 }; 

                    
           },
       error: function(){
        console.log('AJAX load did not work');
        alert("error");
        }
    }); 


     //breed
  $.ajax({
    type: "GET",
    url: "/api/breed/",
    success: function(data){
 
          $.each(data, function(key, value) {
            //  console.log(value);
            var id = value.id;
            var name = value.breed_name;
            // console.log(id);
          var option = "<option value='"+id+"'>"+name+"</option>";  
          $("#esel_breed").append(option); 
          });

         },
     error: function(){
      console.log('AJAX load did not work');
      alert("error");
      }
  }); 

   //selectRescuer
   $.ajax({
    type: "GET",
    url: "/api/selectRescuer/",
    success: function(data){

          $.each(data, function(key, value) {
            // console.log(value);
            var id = value.id;
            var lname = value.lname;
            var fname = value.fname;
            var name = fname + " " + lname + "  with ID:#" +id;
            // console.log(id);
          var option = "<option value='"+id+"'>"+name+"</option>";  
          $("#erescuer_animal").append(option); 
          });

        },
    error: function(){
      console.log('AJAX load did not work');
      alert("error");
      }
  });  

});//end edit

// selectbredd

$("#esel_breed").on('click', function(e) {

  var select = document.getElementById('esel_breed');
  var value = select.options[select.selectedIndex].text;
  // console.log(value); 
  if (value != "-- Select Breed --" )
  {
    document.getElementById('ecategory').value = '';
    $("#ecategory").val(value);     
  }else{
    var value1 = document.getElementById('ecategory').value;
    $("#ecategory").val(value1);    
  }
     
});


//update

$("#animalupdatebtn").on('click',function(e){
  e.preventDefault(); 
  var id = $('#animal_id').val();
  console.log(id);
  let val =  new Array();

  // alert(id);
  var select = document.getElementById('esel_breed');
  var value = select.options[select.selectedIndex].value;
  var select2 = document.getElementById('erescuer_animal');
  var value2 = select2.options[select2.selectedIndex].value;
  var kupasnalarawan = document.getElementById("eimage").src;
  var userid = document.getElementById('idmo').value;

  // console.log(value); 
  $(':checkbox:checked').each(function(i)
  {
      val[i] = $(this).val();

  }); 
 
//  console.log(categoryval);
  var data = {
      'animal_name': $('#eanimal_name').val(),
      'gender': $('#egender').val(),
      'healthstatus': $('#ehealthstatus').val(),
      'approximate_age': $('#eapproximate_age').val(), 
       'rescued_date': $('#erescued_date').val(), 
      'category':value,
      'image': $('#eimagename').val(),  
      'larawan':kupasnalarawan,  
      'rescuer_animal':value2,
      'vet_id':userid, 
      'try':val,
     
      
       
  }

  console.log(data);
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
      type: "PUT",
      url: "api/animal/" + id,
      data: data,  
      dataType: "json",
      success: function (response) {
          console.log(response);
          var last = response.item.id;
          console.log(last);
          $('#animaleditModal').each(function(){
            $(this).modal('hide');
          }); 

          var table = $('#animaltable').DataTable();  
          setInterval( function () {
            table.ajax.reload( null, false);
          },2000 );
          swal("Mabuhay!!", "Animal Updated", "success") 
      },
      error: function(){
        swal("Sorry!!", "Only the Vet  Can Update Animal", "warning") 
       
       }
  });

});


 
$('input[type="file"]').change(function(e) {
  var fileName = e.target.files[0].name;
  $(e.target).parent('div').find('.form-file-text').html(fileName) 
  console.log(fileName);
// Inside find search element where the name should display (by Id Or Class)

$("#eimagename").val(fileName);

}); 
 
$('#meron').change(function () {
  $('#rescueraddform').fadeToggle();
 });

  $('#animalform').validate({
    rules: {
      animal_name: {
         required: true,  
       },
       gender: {
         required: true,
        },
        approximate_age: {
          required: true,
          digits: true,
         },
      image: {
          required:true,
        },
        rescued_date: {
          required:true,
        },
    }, //end rules
    messages: {
      animal_name: {
          required: "Please  add name.",
         },
        gender: {
         required: 'Please Identify gender',
        },
       
    },
    errorPlacement: function(error, element) { 
       
           error.insertAfter(element);
          
     } 
 
   }); // end validate 

 // adding
$("#animalsubmit").on('click', function(e) {
  
  var formStatus = $('#animalform').validate().form();
  if(true == formStatus){
    let formData = new FormData($('#animalform')[0]);
    let val =  new Array();
     console.log(formData);
    for (var pair of formData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
          } 
  
    $.ajax({
        type: "POST",
        url: "/api/animal",
        data: formData,
        contentType: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
              $.each(data, function(key, value) { 
                console.log(value); 
  
                var last = value;
  
                $("#animalModal").modal("hide"); 
                swal("Mabuhay!!", "Animal Inserted", "success");   
                 $('#animaltable').DataTable().ajax.reload();    
            
                 $(':checkbox:checked').each(function(i)
                   {
                  val[i] = $(this).val();
                   });  
                    for (let i = 0; i <val.length; i++)  
                  
                    {
                     $('<input>').attr({type: 'hidden', id:'cid',name: 'conid',value:val[i]}).appendTo('#animalform'); 
         
                     var data2 = {
      
                      'id':val[i],
                      'last':last,
      
                   }
      
                      console.log(data2);
                     $.ajax({
                            type: "POST",
                            url: "/api/storeDisease",
                            data:data2, 
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: "json",
                            success: function(data) {  
      
                              console.log(data);
                      
                             },
                             error: function(error) {
                                console.log('error');
                            }
                        });
              
                    }  
                
              });         
      },
        error: function(error) {
            console.log('error');
        }
    });
  } else {
    e.preventDefault();
  }  
 
});


// show

$('#animalshowModal').on('show.bs.modal', function(e) {
  var id = $(e.relatedTarget).attr('data-id');
 
   $.ajax({
      type: "GET",
      url: "/api/animal/" + id,
      success: function(data){
              console.log(data);
             var oldImage = $('#showanimage img'); 
             var newImage = "<img src="+data.image +" width='240px', height='300px'/>"; 
             $("#showanimal_name").val(data.animal_name);
             $("#showgender").val(data.gender);
             $("#showhealthstatus").val(data.healthstatus);  
             $("#showapproximate_age").val(data.approximate_age);   
             $("#showcategory").val(data.category.breed_name);
             $("#showstype").val(data.category.animal_type); 
             $("#showcreated").val(data.created_at);  
             $("#showrescued_date").val(data.rescued_date); 
 
             $("#fname").val(data.rescuer.fname + "  " +  data.rescuer.lname);  
             $("#created_at").val(data.rescuer.created_at);   
             $("#phone").val(data.rescuer.phone);
             $("#town").val(data.rescuer.town); 
             $("#addressline").val(data.rescuer.addressline);  
             $("#zipcode").val(data.rescuer.zipcode)      
 
             oldImage.hide();
             $('#showanimage').prepend(newImage);
              //fade in new image 
              //fade out old image and remove from DOM
              oldImage.fadeOut(1000,function()
              {
              $(this).remove();
                  }); 
           },
       error: function(){
        console.log('AJAX load did not work');
        alert("error");
        }
    }); 


});


}); //end ready

