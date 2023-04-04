
$(document).ready(function() { 
  $.fn.dataTable.ext.errMode = 'none';

  $("#regformheader").on('click', function(e) {
    $('#regform').trigger("reset");
    document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';

  });

  $("#loginformheader").on('click', function(e) {
     $('#logform').trigger("reset");
  });



//AnimalTable Hide
$("#animalcontent").hide(); 
$("#diseasecontent").hide(); 
$("#rescuercontent").hide(); 
$("#personnelcontent").hide(); 
$("#requestcontent").hide();
$("#adoptionrequestcontent").hide(); 
$('#dashboardcontainer').hide();

// removing link that ruin my table
  var list = document.head.getElementsByTagName("link");
  var mylink =list[8];
  console.log(mylink);
  var mylink1 =list[4];

//   console.log(mylink1);
  // console.log(userid);
  
  $("#adopterprofile").on('click', function(e) {

    document.getElementById("mySidenav2").style.width = "0"; 

  });


// animalheader
 $("#animalheader").on('click', function(e) {
e.preventDefault();
mylink.remove(); 
mylink1.remove();
$("#animalcontent").show();
$("#diseasecontent").hide(); 
$("#katawan").hide(); 
$("#rescuercontent").hide(); 
$("#personnelcontent").hide(); 
$("#requestcontent").hide();  
$("#myprofile").hide(); 
$("#adoptionrequestcontent").hide(); 
$('#dashboardcontainer').hide();

document.getElementById("mySidenav").style.width = "0";



});//end animal

// diseaseheader 
$("#diseaseheader").on('click', function(e) {
    e.preventDefault();
    mylink.remove(); 
    mylink1.remove(); 
    $("#diseasecontent").show();
   $("#katawan").hide(); 
   $("#animalcontent").hide(); 
   $("#rescuercontent").hide(); 
   $("#personnelcontent").hide(); 
   $("#requestcontent").hide();  
   $("#myprofile").hide(); 
   $("#adoptionrequestcontent").hide(); 
   $('#dashboardcontainer').hide();

   document.getElementById("mySidenav").style.width = "0";

});
// enddisease

// rescuer
$("#rescuerheader").on('click', function(e) {
    e.preventDefault();
    mylink.remove(); 
    mylink1.remove(); 

   $("#rescuercontent").show();
   $("#diseasecontent").hide();
   $("#katawan").hide(); 
   $("#animalcontent").hide(); 
   $("#personnelcontent").hide(); 
   $("#requestcontent").hide();  
   $("#myprofile").hide(); 
   $("#adoptionrequestcontent").hide(); 
   $('#dashboardcontainer').hide();

   document.getElementById("mySidenav").style.width = "0";

});

// personnel
$("#personnelheader").on('click', function(e) {
  e.preventDefault();
  mylink.remove(); 
  mylink1.remove(); 

  $("#personnelcontent").show();  
 $("#rescuercontent").hide();
 $("#diseasecontent").hide();
 $("#katawan").hide(); 
 $("#animalcontent").hide(); 
 $("#requestcontent").hide();  
 $("#myprofile").hide(); 
 $("#adoptionrequestcontent").hide(); 
 $('#dashboardcontainer').hide();

 document.getElementById("mySidenav").style.width = "0";

});

// RequestAdopter

// request
$("#requestheader").on('click', function(e) {
  e.preventDefault();
  mylink.remove(); 
  mylink1.remove(); 
  
 $("#requestcontent").show();  
 $("#personnelcontent").hide();  
 $("#rescuercontent").hide();
 $("#diseasecontent").hide();
 $("#katawan").hide(); 
 $("#animalcontent").hide(); 
 $("#myprofile").hide(); 
 $("#adoptionrequestcontent").hide(); 
 $('#dashboardcontainer').hide();

 document.getElementById("mySidenav").style.width = "0";

});
$("#totareq").on('click', function(e) {
  e.preventDefault();
  mylink.remove(); 
  mylink1.remove(); 
  
 $("#requestcontent").show();  
 $("#personnelcontent").hide();  
 $("#rescuercontent").hide();
 $("#diseasecontent").hide();
 $("#katawan").hide(); 
 $("#animalcontent").hide(); 
 $("#myprofile").hide(); 
 $("#adoptionrequestcontent").hide(); 
 $('#dashboardcontainer').hide();

 document.getElementById("mySidenav").style.width = "0";

});

// adoption request
$("#adoptionrequestheader").on('click', function(e) {
  e.preventDefault();
  mylink.remove(); 
  mylink1.remove(); 

 $("#adoptionrequestcontent").show();  
 $("#requestcontent").hide();  
 $("#personnelcontent").hide();  
 $("#rescuercontent").hide();
 $("#diseasecontent").hide();
 $("#katawan").hide(); 
 $("#animalcontent").hide(); 
 $("#myprofile").hide(); 
 $('#dashboardcontainer').hide();
 document.getElementById("mySidenav").style.width = "0";

});

// dashboard 
$("#dashboradheader").on('click', function(e) {
  e.preventDefault();
  mylink.remove(); 
  mylink1.remove(); 
  $('#dashboardcontainer').show();
 $("#adoptionrequestcontent").hide();  
 $("#requestcontent").hide();  
 $("#personnelcontent").hide();  
 $("#rescuercontent").hide();
 $("#diseasecontent").hide();
 $("#katawan").hide(); 
 $("#animalcontent").hide(); 
 $("#myprofile").hide(); 

 document.getElementById("mySidenav").style.width = "0";
 document.head.innerHTML += '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">';

});


// hide adopted
// var x= document.getElementById("adoptedanimalshome");
 
// x.style.display = "none";
  
// $("#adoptedformheader").on('click', function(e){

//    var x = document.getElementById("adoptedanimalshome");
//   if (x.style.display === "none") {
//     x.style.display = "block";
//   } else {
//     x.style.display = "none";
//   }

 

// });


});//endready