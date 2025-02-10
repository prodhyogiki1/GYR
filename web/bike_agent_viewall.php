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
        
            <h4>Availablity & Booking</h4> 
            <input type="button" name="bulk upload" value="Bulk Update"  class="btn btn-secondary btn-sm bulk_upload" style=" margin-right:10px;" onclick="show_hide('bulk_upload','check_btn')">

            <input type="button" name="submit_bulk" class="btn btn-primary btn-sm" value="Update All" onclick="form_submit_bulk('check_btn')">

            <hr>      
            <span id="msgall"></span>
                  <table class='table table-bordered'>
                    <tr>
                      <th>#</th>
                      <!-- <th>Image</th> -->
                      <th>Bike</th>
                      <th>Year</th>
                      <th>Color</th>
                      
                      <th>Availablility</th>
                      <!-- <th>Document(s)</th> -->
                      <th>From</th>
                      <th>To</th>
                      <th>Per Day Limit (KM)</th>
                      <th>Rate Per KM (INR)</th>
                      <th>Utility</th>                      
                    </tr>
                  <?php 
                  //-- view al bikes
                  $abikes=$agent->viewall_agent_bike($_SESSION['aid']);
                  if($abikes)
                  {
                  $counter=1;
                  
                  foreach($abikes as $k1 => $v){
                    //-- get bike
                    $bike=$admin->get_bike_one($abikes[$k1]['bid']);

                      echo "<tr>"; 
                      ?>
                       <form name="form<?php echo $abikes[$k1]['id'];?>" id="form<?php echo $abikes[$k1]['id'];?>" action="<?php echo $base_url.'index.php?action=agent&query=rates_update';?>" method="post">
                      <?php
                        echo "<th>";?>
                        <input type="checkbox" class="check_btn" value="<?php echo $abikes[$k1]['id'];?>" name="checkid">
                        <input type="hidden" value="<?php echo $abikes[$k1]['id'];?>" name="id" >
                        <?php
                        echo "</th>";
                        //echo "<td><img src='".$base_url."theme/assets/images/".$abikes[$k1]['front']."' height='50' width='auto'></td>";
                        echo "<td>".$bike[0]['name']."</td>";
                        echo "<td>".$abikes[$k1]['year_manufecturing']."</td>";
                        echo "<td>".$abikes[$k1]['color']."</td>";
                        echo "<td>"
                        ?>
                            <select class="form-control-sm" name="available">
                                <option value='0' <?php if($abikes[$k1]['available']=='0'){?>selected="selected"<?php }?>>Available</option>
                                <option value="1" <?php if($abikes[$k1]['available']=='1'){?>selected="selected"<?php }?>>Booked</option>
                                <option value="2" <?php if($abikes[$k1]['available']=='2'){?>selected="selected"<?php }?>>Discontinued</option>
                        <?Php 
                        echo "</td>";
                        ?>
                        <!-- <td><span class="btn btn-xs btn-primary btn-sm">All Document(s)</span></td> -->
                       
                        <td><input type="date" name="from_date" class="form-control-sm" value='<?php echo $abikes[$k1]['from_date'];?>'></td>
                        <td><input type="date" name="to_date" class="form-control-sm" value='<?php echo $abikes[$k1]['to_date'];?>'></td>
                        <td><input type="number" name="per_day_km" class="form-control-sm" style='width:100%;' value='<?php echo $abikes[$k1]['per_day_km'];?>'></td>
                        <td>
                            <input type="hidden" name="id" value='<?php echo $abikes[$k1]['id'];?>'>
                            <input type="number" name="price_per_km" class='form-control-sm' style='width:100%;' value='<?php echo $abikes[$k1]['price_per_km'];?>'>                            
                        </td>
                        <td>
                          <span class="ti ti-check btn btn-primary btn-sm" onclick="form_submit('<?php echo $abikes[$k1]['id'];?>')"></span>
                          </form>  
                          <div  id="result<?php echo $abikes[$k1]['id'];?>"></div>
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
    
    