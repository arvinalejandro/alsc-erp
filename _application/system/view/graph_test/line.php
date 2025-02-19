
<div id="g_line" style="width: 50%; margin-top: 190px;">
            <canvas id="test_chart" height="450" width="600"></canvas>
</div>

     <script>
  
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
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
                data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
            }
        ]

    }  
    
    
    var ctx             = $("#test_chart").get(0).getContext("2d");
    var test_chart      = new Chart(ctx).Line(LineData, {
            responsive : true,
            animation : false,
            scaleOverride: true,
             scaleSteps: 20,
             scaleStepWidth: 5,
             scaleStartValue: 0
        });
        

    </script>