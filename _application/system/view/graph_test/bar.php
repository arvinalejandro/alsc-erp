
<div id="g_bar" style="width: 50%; margin-top: 190px;">
            <canvas id="test_chart" height="450" width="600"></canvas>
</div>

     <script>
  
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
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
    
    
    var ctx             = $("#test_chart").get(0).getContext("2d");
    var test_chart      = new Chart(ctx).Bar(barData, {
            responsive : true,
            animation : false,
            scaleOverride: true,
             scaleSteps: 20,
             scaleStepWidth: 5,
             scaleStartValue: 0
        });
                
   $("#test_chart").click(function(evt){
    var activeBars = test_chart.getBarsAtEvent(evt);
  
    });   
    </script>