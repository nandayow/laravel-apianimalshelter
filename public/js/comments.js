$(document).ready(function() { 




// show

$('#commentmodal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).attr('data-id');
        var x = document.getElementById("commentareapart");
        var y= document.getElementById("themessage");
        $("#petusername").text("  ");  

        x.style.display = "none";
        y.style.display = "none";

        $("#commentform").trigger("reset"); 
        document.getElementById('themessage').innerHTML = "";

 
    // alert(id);
     $.ajax({
        type: "GET",
        url: "/api/animalprofile/" + id,
        success: function(data){
                console.log(data);
                   var oldImage = $('#viewanimalimage img'); 
                   var newImage = "<img src="+data.image +"/>"; 
                   var oldImage2 = $('#userimage img');
                   
                  oldImage.hide();
                  oldImage2.hide();

                $('#viewanimalimage').prepend(newImage);
                    //fade in new image 
                    //fade out old image and remove from DOM
                    oldImage.fadeOut(1000,function()
                    {
                    $(this).remove();
                        }); 


                $('#userimage').prepend(newImage);
                oldImage2.fadeOut(1000,function()
                {
                $(this).remove();
                    }); 

                $("#pet_id").text("Pet ID:" + data.id);
                

                var petusernamepet = "<a href=''>"+ data.animal_name+"</a>"
                $("#petusername").prepend(petusernamepet);
                $("#petprofilegender").text("#"+data.gender);
                $("#petprofilebreed").text("#"+data.category.breed_name); 
                $("#petprofilestatus").text("#"+data.healthstatus);  
                
                $("#animal_idhidden").val(data.id);  

                
      

                            $.ajax({
                                type: "GET",
                                url: "/api/comment/" + id,
                                success: function(data){
                                        console.log(data.data.length); 
                                        $("#commenttotal").text(data.data.length + "  Comments");  

                                        
                                                $.each(data.data, function(key, value) {
                                                    console.log(value.body);
                                                    $('#themessage')
                                                    .append("<span class='userimage'><img src="+ "https://image.flaticon.com/icons/png/512/12/12638.png "+ "></span>")  
                                                     .append("<p id='messagetext' class='messagetext'>"+value.body+"</p>")

                                                }) 
                                    },
                                error: function(){
                                console.log('AJAX load did not work');
                                alert("error");
                                }
                            }); 
                        

    
             },
         error: function(){
          console.log('AJAX load did not work');
          alert("error");
          }
      }); 
  
  });




  $("#commenttotal").on('click', function(e){

    $('#infopart').fadeToggle();
    var x = document.getElementById("commentareapart");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }


    var y= document.getElementById("themessage");

    if (y.style.display === "none") {
        y.style.display = "block";
      } else {
        y.style.display = "none";
      }
  
  });

  
  $('#commentform').validate({
    rules: {
      comment: {
          required:true,
         },
    
        
    }, //end rules
    messages: {
      comment: {
          required: 'Please type a comment',
        } 
    },
    errorPlacement: function(error, element) { 
       
           error.insertAfter(element);
          
     } 
  
   }); // end validate

  $("#commentsubmit").on('click', function(e) {    
//   var formStatus = $('#commentform').validate().form();
//  if(true == formStatus)
//    {

//    }
    e.preventDefault()

    let commentData = new FormData($('#commentform')[0]);
      console.log(commentData);
    for (var pair of commentData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
          } 
      
 
    $.ajax({
        type: "POST",
        url: "/api/postcomment",
        data: commentData,
        contentType: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
                  console.log(data);
                  
                //   $('#commentmodal').each(function(){
                //     $(this).modal('show');
 
                //  })
                  $("#commentform").trigger("reset");
                  var id = $('#animal_idhidden').val();
                  // alert(id);
                  $.ajax({
                    type: "GET",
                    url: "/api/comment/" + id,
                    success: function(data){
                            console.log(data); 
                            $("#commenttotal").text(data.data.length + "  Comments");  
                            
 
                            document.getElementById('themessage').innerHTML = "";

                                    $.each(data.data, function(key, value) {
                                        console.log(value.body);
                                        $('#themessage')
                                        .append("<span class='userimage'><img src="+ "https://image.flaticon.com/icons/png/512/12/12638.png "+ "></span>")  
                                         .append("<p id='messagetext' class='messagetext'>"+value.body+"</p>")

                                    }) 
                        },
                    error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                    }
                }); 


        },
        error: function(error) {
            console.log('error');
        }
    });
   
  });





}) //end ready