
<div class="container-fluid">

  <div class="content-wrapper">
    
    <!------ one --->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
        
        <div class="card">
            <div class="card-header">
        
            <h4>Availablity & Booking</h4>        
                  <table class='table table-bordered'>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Bike</th>
                      <th>Year</th>
                      <th>Color</th>
                      <th>Price Per Day</th>
                      <th>Per Day KM</th>
                      <th>Availablility</th>
                      <th>Insurence</th>
                      <th>PUC</th>
                      <th>RC</th>
                      <th>Rates</th>
                    </tr>
                  <?php 
                  //-- view al bikes
                  $abikes=$agent->viewall_agent_bike($_SESSION['aid']);
                  if($abikes)
                  {
                  $counter=1;
                  
                  foreach($abikes as $k1 => $v){
                      echo "<tr>"; 
                        echo "<th>".$counter++."</th>";
                        echo "<td><img src='".$base_url."theme/assets/images/".$abikes[$k1]['front']."' height='50' width='auto'></td>";
                        echo "<td>".$abikes[$k1]['bid']."</td>";
                        echo "<td>".$abikes[$k1]['year_manufecturing']."</td>";
                        echo "<td>".$abikes[$k1]['color']."</td>";
                        echo "<td>".$abikes[$k1]['price_per_km']."</td>";
                        echo "<td>".$abikes[$k1]['per_day_km']."</td>";
                        echo "<td>"
                        ?>
                            <select class="form-control-sm" name="available">
                                <option value='0' <?php if($abikes[$k1]['available']=='0'){?>selected="selected"<?php }?>>Available</option>
                                <option value="1" <?php if($abikes[$k1]['available']=='1'){?>selected="selected"<?php }?>>Booked</option>
                                <option value="2" <?php if($abikes[$k1]['available']=='2'){?>selected="selected"<?php }?>>Discontinued</option>
                        <?Php 
                        echo "</td>";
                        ?>
                        <td><span class="btn btn-xs btn-primary btn-sm">Insurence</span></td>
                        <td><span class="btn btn-xs btn-secondary btn-sm">PUC</span></td>
                        <td><span class="btn btn-xs btn-warning btn-sm">RC</span></td>
                        <td>
                            <form name="rates[]" action="" method="post">
                            <input type="number" class='form-control-sm' style='width:80%; display:inline;' value='<?php echo $abikes[$k1]['price_per_km'];?>'>
                            <span class="ti ti-check btn btn-primary btn-sm"></span>
                            </form>    
                        </td>
                        <?php 
                      echo "</tr>";
                  }}
                  else
                  {echo "<tr><td colspan='6'>No Bikes Found</td></tr>";}
                  ?>                        
                  </table>
    
        </div>
    </div>
    
    
    </div>
    
    </div>  
    
    </div>
    
    </div>  
    </div>
    
    