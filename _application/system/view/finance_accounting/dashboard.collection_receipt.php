<div id="content_body">   
    <div id="content_body"> 
    <div id="side_nav" style="width: 180px;">
        <ul>
            <li><a href="/finance_accounting/dashboard/official_receipt">OR</a></li>
            <li><a href="/finance_accounting/dashboard/collection_receipt">CR</a></li>
            <li><a href="/finance_accounting/dashboard/ca_receipt">CAR</a></li>
        </ul>   
    </div>    
    
    <div id="side_listings" class="pad_standard" style="margin-left:180px;">     
        <div>
            <table width="100%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;">
                <thead>
                    <tr>
                        <td width="70%">Choose Graph</td>
                        <td colspan="2">
                            <form action="#">
                                <select name="chart_type" onchange="changeVal(this)">
                                <option value="1">Sources of Cash</option>
                                <option value="2">Uses of Cash</option>
                                <option value="3">Cash Inflow vs. Outflow</option>
                                <option value="4">Total Cash Outflows</option>
                                <option value="5">Net Cash Inflows</option>
                            </select>
                            </form>
                        </td>
                    </tr>
                </thead>
            </table>
             <table id="data_table" width="100%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;display: none;">
                <tr>
                    <td>Euismod consequat</td>
                    <td>366</td>
                    <td>12512</td>
                </tr>    
                <tr>
                    <td>Adipiscing </td>
                    <td>564</td>
                    <td>324</td>
                </tr>  
                <tr>
                    <td>Vl rutrum quam</td>
                    <td>7456</td>
                    <td>4564</td>
                </tr>  
                <tr>
                    <td>Vestibulum semper</td>
                    <td>212</td>
                    <td>3634</td>
                </tr>  
                <tr>
                    <td>Vestibulum lobortis</td>
                    <td>125</td>
                    <td>8678</td>
                </tr>  
            </table>
            
        </div>
          <label></label>
          
        <div class="float_left">
            <div class="pad_standard">
                <canvas id="canvasGraph" height="400" width="1100"></canvas>
            </div>
            
        </div>
    </div>
    

 </div>  
 
  <label></label>
<script>
 //Bar Graph 
    var g_type      = 1;
    var gSwitch     = 1;
    var randomScalingFactor = function(){ return Math.round(Math.random()*10000000)};
    var test_chart;
    function changeVal(opVal)
    {
        g_type  = $(opVal).val();
        changeGraph(g_type);     
        
        
         
    }
    
    changeGraph(g_type);
    
    function changeGraph(g_type)
    {
          if(gSwitch == 0)
          {
                   test_chart.destroy();
                  
          }    
          
        if(g_type == 5)
        {
               
            var barData = {
                    labels : ["January","February","March","April","May","June","July","August"],
                    datasets : [
                        {
                            fillColor : "#1A314D",
                            strokeColor : "#4374A1",
                            highlightFill: "#919296",
                            highlightStroke: "#CC092F",
                            data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                        }
                    ]

                }
                
              
                var ctx             = $("#canvasGraph").get(0).getContext("2d");
                 gSwitch = 0 ;
                test_chart      = new Chart(ctx).Bar(barData, {
                        responsive : true,
                        animation : false,
                        scaleOverride: true,
                     scaleSteps: 20,
                     scaleStepWidth: 500000,
                     scaleStartValue: 0
                    });
                            
               $("#canvasGraph").click(function(evt){
                var activeBars = test_chart.getBarsAtEvent(evt);
              
                });
            //==============================================================    
        }
       else if(g_type == 4)
        {
               
            var barData = {
                    labels : ["January","February","March","April","May","June","July","August"],
                    datasets : [
                        {
                            fillColor : "#1A314D",
                            strokeColor : "#4374A1",
                            highlightFill: "#919296",
                            highlightStroke: "#CC092F",
                            data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                        }
                    ]

                }
                
              
                var ctx             = $("#canvasGraph").get(0).getContext("2d");
                 gSwitch = 0 ;
                test_chart      = new Chart(ctx).Bar(barData, {
                        responsive : true,
                        animation : false,
                        scaleOverride: true,
                     scaleSteps: 20,
                     scaleStepWidth: 500000,
                     scaleStartValue: 0
                    });
                            
               $("#canvasGraph").click(function(evt){
                var activeBars = test_chart.getBarsAtEvent(evt);
              
                });
            //==============================================================    
        }
        else if(g_type == 3)
        {
            
              var LineData = {
                labels : ["January","February","March","April","May","June","July","August"],
                datasets : [
                    {
                        fillColor : "rgba(220,220,220,0.5)",
                        strokeColor : "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                    },
                    {
                        fillColor : "rgba(151,187,205,0.5)",
                        strokeColor : "rgba(151,187,205,0.8)",
                        highlightFill : "rgba(151,187,205,0.75)",
                        highlightStroke : "rgba(151,187,205,1)",
                        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                    }
                ]

            }  
            
             
             var ctx             = $("#canvasGraph").get(0).getContext("2d");
               gSwitch = 0 ; 
              test_chart      = new Chart(ctx).Line(LineData, {
                    responsive : true,
                    animation : false,
                    scaleOverride: true,
                     scaleSteps: 20,
                     scaleStepWidth: 500000,
                     scaleStartValue: 0
                });
            
             //==============================================================  
        }
        else if(g_type == 1)
        {
              var pieData = [
                    {
                        value: randomScalingFactor(),
                        color:"#AABBCC",
                        highlight: "#FFBBFF",
                        label: "Sales"
                    },
                    {
                        value: randomScalingFactor(),
                        color: "#22FBAC",
                        highlight: "#FFBBFF",
                        label: "Other Cash Inputs"
                    }
                   ];
    
    
   
              
              
                     var ctx            = $("#canvasGraph").get(0).getContext("2d");
                     gSwitch = 0 ;
                     test_chart      = new Chart(ctx).Pie(pieData, {
                    responsive : true,
                     animation : false
                   
                });
                  
            //==============================================================  
        } 
        else if(g_type == 2)
        {
              var pieData = [
                    {
                        value: randomScalingFactor(),
                        color:"#AABBCC",
                        highlight: "#FBBFFF",
                        label: "Development Cost"
                    },
                    {
                        value: randomScalingFactor(),
                        color: "#22FBAC",
                        highlight: "#FBBFFF",
                        label: "Housing"
                    }
                    ,
                    {
                        value: randomScalingFactor(),
                        color: "#11FBAC",
                        highlight: "#FBBFFF",
                        label: "Land Acquisitions"
                    }
                    ,
                    {
                        value: randomScalingFactor(),
                        color: "#44FBAC",
                        highlight: "#FBBFFF",
                        label: "Operating Expense"
                    }
                    ,
                    {
                        value: randomScalingFactor(),
                        color: "#33FBAC",
                        highlight: "#FBBFFF",
                        label: "Others"
                    }
                   ];
    
    
   
              
              
                     var ctx            = $("#canvasGraph").get(0).getContext("2d");
                     gSwitch = 0 ;
                     test_chart      = new Chart(ctx).Pie(pieData, {
                    responsive : true,
                     animation : false
                   
                });
                  
            //==============================================================  
        }
        else
        {
            
        }
        
    }
    

    
</script>