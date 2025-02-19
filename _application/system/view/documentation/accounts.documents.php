<div id="content_body">    
       
   <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
     
        <div style="overflow: auto;" id="_right_content_">  <!--set max-height by making it dynamic -->                               
                <form action="#" name="request_form" method="post">
                
               <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>                 
                            <td>Document</td>               
                            <td>Received by</td> 
                            <td>Date Submitted</td> 
                            <td>Date Cleared</td> 
                            <td>Status</td> 
                             <td align="center">
                            </td>             
                        </tr>
                    </thead>
                    
                    <tbody>                      
                        
                  <?=$_VIEW['row.documents']?>   
                    
                    
                    
                    </tbody>  
                </table>
                <label></label>              
            
        </div>    
    </div>
    <label></label>

</div>