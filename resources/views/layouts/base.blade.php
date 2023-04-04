<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title >AnimalShelter</title>
     <link rel="shortcut icon" type="image/jpg" href="https://image.flaticon.com/icons/png/512/12/12638.png"/>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">  
    
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" ></script>
    <script src="https://kit.fontawesome.com/c88097f817.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js" integrity="sha512-8NOmlkzoskIBni4iy5onHC57Mndt17mZgWkYJvxe5jwBJu3spYIRSjTkYJ9OLNS9Min+bsSqbDfGaoejWxyFiw==" crossorigin="anonymous"></script>
    <script src="{{asset('js/hidecontent.js')}}"></script>
    <script src="{{asset('js/rescuer.js')}}"></script>
    <script src="{{asset('js/personnel.js')}}"></script> 
    <script src="{{asset('js/animals.js')}}"></script>
    <script src="{{asset('js/disease.js')}}"></script>
    <script type="module" src="{{asset('js/adopter.js')}}"></script>
    <script type="module" src="{{asset('js/comments.js')}}"></script>
    <script type="module" src="{{asset('js/search.js')}}"></script> 
    <script  src="{{asset('js/adoption.js')}}"></script>
    <script  src="{{asset('js/home.js')}}"></script>

      <link rel = "stylesheet" type="text/css" href ="{{asset('css/custom.css')}}">
     <link rel = "stylesheet" type="text/css" href ="{{asset('css/style.css')}}">

    
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>


 
<!-- both -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.jqueryui.min.css" integrity="sha512-x2AeaPQ8YOMtmWeicVYULhggwMf73vuodGL7GwzRyrPDjOUSABKU7Rw9c3WNFRua9/BvX/ED1IK3VTSsISF6TQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons/2.0.1/js/dataTables.buttons.min.js" integrity="sha512-QZc1PH3GIO39Sd0/aCa+z7oytor2FmU8n/mjOheSAAZen9KBInfBcl1DLoNpFFZu9DbToWq+OBaVOpOBYkoX+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet"> 
 
 
<!-- DataTable -->


 <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel = "stylesheet" type="text/css" href ="{{asset('css/header.css')}}">

 


<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>  

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<!-- <script type="text/javascript" src="jscript/graph.js"> </script> -->

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/3.2.12/jquery.validate.unobtrusive.min.js" integrity="sha512-o6XqxgrUsKmchwy9G5VRNWSSxTS4Urr4loO6/0hYdpWmFUfHqGzawGxeQGMDqYzxjY9sbktPbNlkIQJWagVZQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 </head>
<body>
@include('layouts.header')
 
@if(Auth::guard('sanctum')->user())

        @if(auth()->user()->role == "adopter") 
    
            @include('apiproject.adopter_profile')  
        @endif
        
@endif

 <div id="katawan" >
    @yield('body') 
</div>


@if(Auth::guard('sanctum')->user())

        @if(auth()->user()->role != "adopter" || auth()->user()->role != "rescuer")
        
        @include('apiproject.animal')         
        @include('apiproject.disease')
        @include('apiproject.rescuer')
        @include('apiproject.personnel')
        @include('apiproject.adopter_request')
        @include('apiproject.adoption')
        @include('apiproject.dashboard')

        @endif

 @else
 @include('apiproject.adopter_register')
 @include('apiproject.login')
@endif

</body>

 <!-- sweet -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


</html>