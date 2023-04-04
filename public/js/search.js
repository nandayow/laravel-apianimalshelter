$(document).ready(function() { 
  $('#availableanimalsearch').hide();

    $( "#search" ).autocomplete({
        // var data;
              source: function( request, response ) {
                // Fetch data
                console.log(request);
                $.ajax({
                  url:'/api/animal/search',
                  type: 'POST',
                  dataType: "json",
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  data: {search:request.term},
                  success: function( data ) { 
                   response( data );
              
                     console.log(data);

                  
                     } ,  error: function(){
                        console.log('AJAX load did not work');
                        alert("error");
                    }
                });
              },
              
          select: function (event, ui) {
            $('#search').val(ui.item.label);
            // alert( ui.item.value);
          // $('#customer_id').val(ui.item.value);
            $.ajax({
               type: "GET",
               url: "/api/animalprofile/"+ui.item.value,
               dataType: 'json',
               success: function (data) {
                   console.log(data);
                   $('#availableanimals').hide();
                   document.getElementById('adopteblediv').innerHTML = "";

                   $('#availableanimalsearch').show();

                   var oldImage = $('#adopteblediv img'); 
                   var newImage = " <img  class='display-dog' src="+data.image+">"; 

                  oldImage.hide();
 
                  $ ('#adoptebledivform') 
                             .append( newImage)
                             .append('<h1>'+data.animal_name +'</h1>')
                             .append('<p class="title">'+ data.category.breed_name+'</p>')
                             .append('<p>'+data.category.animal_type+'</p>')
                             .append(' <p>Adoptable</p>') 
                             .append('<button id="adoptsearchsubmit" type="submit" class=" btn btn-outline-primary class-button">Adopt</button>')
                            
                             var userid =$('#adopter_idfromheader').val();

                            $('#adopter_adopt_id').val(userid);
                            $('#adopter_animal_id').val(data.id);
                            
                  //fade in new image 
                    //fade out old image and remove from DOM
                    oldImage.fadeOut(1000,function()
                    {
                    $(this).remove();
                    });  
                        
                    $('#adoptsearchsubmit').on('click', function(e) { 
                      e.preventDefault()

                      let adoptebledivformData = new FormData($('#adoptebledivform')[0]);
                      console.log(adoptebledivformData);
                        for (var pair of adoptebledivformData.entries()) {
                        console.log(pair[0]+ ', ' + pair[1]); 
                          } 
                      
                        
                    $.ajax({
                        type: "POST",
                        url: "/api/adopted",
                        data: adoptebledivformData,
                        contentType: false,
                        processData: false,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        success: function(data) {
                                 console.log(data.success);

                                 swal({
                                  title: "Adoption",
                                  text: "You have to wait for the Shelter's approval.",
                                  type: "success",
                                  confirmButtonColor: '#DD6B55',
                                  confirmButtonText: 'Ok',
                                },
                               function(isConfirm){

                                if (isConfirm){ 
                                   window.top.location = window.top.location; 

                                } 
                             });
                   
                       },
                        error: function(error) {
                          swal("Sorry!", "Adoption exclusive for adoter only", "warning");
                        }
                    });
                  
                   
                   });

              },
               error: function(){
                 console.log('AJAX load did not work');
                 alert("error");
             }
           });
               return false;
         }//end select
       
          });


  
  }); //end ready

  
 