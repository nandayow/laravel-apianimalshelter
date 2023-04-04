<div id="dashboardcontainer" class="container chartcontainer">
<div class="header-dashboard">
</div>


<div class="row rowmain">
        <div class="column chart1">

                    <div class="row chartdate">
                            <div class="column chartdatecolumn">

                                    <h4>From:</h4>
                                    <input id="adoptedchart1" name="chart" class="center-block" type="text" value="2021-01-07"/> 

                            </div>
                            
                            <div class="column chartdatecolumn">

                                    <h4>To:</h4> 
                                    <input id="adoptedchart2" name="chart" class="center-block" type="text" value="2021-12-07"/>  

                            </div>
                    </div>

                    <canvas id="myChart"></canvas>

        </div>
        <div class="column chart2">

                  <div class="row chartdate">
                            <div class="column chartdatecolumn">

                                    <h4>From:</h4>
                                    <input id="adoptedchart3" name="chart" class="center-block" type="text" value="2021-01-07"/> 

                            </div>
                            
                            <div class="column chartdatecolumn">

                                    <h4>To:</h4> 
                                    <input id="adoptedchart4" name="chart" class="center-block" type="text" value="2021-12-07"/>  

                            </div>
                    </div>

                    <canvas id="myChart2"></canvas>

        
        </div>    
</div>


 
  <script>  
         $(function() {  
                  $( "#adoptedchart1" ).datepicker({ dateFormat:'yy-mm-dd' }); 
                  $( "#adoptedchart2" ).datepicker({ dateFormat:'yy-mm-dd' });  
                  $( "#adoptedchart3" ).datepicker({ dateFormat:'yy-mm-dd' }); 
                  $( "#adoptedchart4" ).datepicker({ dateFormat:'yy-mm-dd' });  

                      });  
 </script>  
 </div>