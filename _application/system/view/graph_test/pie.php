
<div id="g_pie" style="width: 50%; margin-top: 190px;">
            <canvas id="test_chart" height="450" width="600"></canvas>
</div>

 <script>
  
    var pieData = [
                    {
                        value: 300,
                        color:"#F7464A",
                        highlight: "#FF5A5E",
                        label: "Red"
                    },
                    {
                        value: 50,
                        color: "#46BFBD",
                        highlight: "#5AD3D1",
                        label: "Green"
                    },
                    {
                        value: 100,
                        color: "#FDB45C",
                        highlight: "#FFC870",
                        label: "Yellow"
                    }
                   ];
    
    
   
        
        window.onload = function(){
                var ctx = document.getElementById("test_chart").getContext("2d");
                window.myPie = new Chart(ctx).Pie(pieData, {
            responsive : true,
             animation : false
           
        });
            };
  
</script>