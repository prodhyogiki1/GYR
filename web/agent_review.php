<style>
  .check_btn{display:none;}
</style>
<div class="container-fluid">

  <div class="content-wrapper">
    
    <!------ one --->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
        
        <div class="card">
            <div class="card-header">
        
            <h4>Review(s)</h4> 
           
            <hr>      
            <span id="msgall"></span>
                  <table class='table table-bordered'>
                    <tr>
                      <th>#</th>
                      <!-- <th>Image</th> -->
                      <th>Booking ID</th>
                      <th>Bike</th>
                      <th>Customer Name</th>
                      <th>Date Of Booking</th>
                      <th>Date Of Review</th>
                      <th>Feedback</th>
                      <th>Revert</th>
                      <th>Date Of Revert</th>
                      <th>Utility</th>                      
                    </tr>
                  <?php 
                  //-- view al bikes
                  $abikes=$agent->viewall_agent_review($_SESSION['aid']);
                  if($abikes)
                  {
                  $counter=1;
                  
                  foreach($abikes as $k1 => $v){
                    //-- get bike
                    $bike=$admin->get_bike_one($abikes[$k1]['bid']);
                        $uname=$user->get_one_user($abikes[$k1]['uid']);
                      echo "<tr>"; 
                        echo "<th>".$counter++."</th>";
                        echo "<td>GYR".$abikes[$k1]['bid']."</td>";
                        echo "<td></td>";
                        echo "<td>".$uname[0]['uname']."</td>";
                        echo "<td>".$abikes[$k1]['booking_from']."</td>";
                        echo "<td>".$abikes[$k1]['date_time']."</td>";
                        echo "<td>".$abikes[$k1]['feedback']."</td>";
                        echo "<td>";
                            if($abikes[$k1]['revert'] != '')
                            {echo $abikes[$k1]['revert'];}
                            else{
                                echo '<input type="button" name="review" value="Add Response" class="btn btn-info btn-sm">'; }
                        echo "</td>";
                        echo "<td>".$abikes[$k1]['revert_datetime']."</td>";
                        
                        
                      echo "</tr>";
                  }}
                  else
                  {echo "<tr><td colspan='6'>No Review Found</td></tr>";}
                  ?>                        
                  </table>
    
        </div>
    </div>
    
    
    </div>
    
    </div>  
    
    </div>
    
    </div>  
    </div>
    
    