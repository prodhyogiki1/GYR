<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               
    <div class="card-header">
        <h3 class='text-primary'>
            <?php 
            $agent_details = $agent->view_agent_one($_GET['aid']); 
            echo $agent_details[0]['fname'].' '.$agent_details[0]['lname'].' [ '.$agent_details[0]['bname'].' ]';
            ?>
        </h3>
        <h5 class="card-title">Agent Bike List & Availability</h5>
    </div>
    <div class="card-body content">
    

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Color</th>
                <th>Fuel</th>
                <th>Formalities</th>
                <th>Status</th>
                <th>Utility</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $viewall=$agent->viewall_agent_bike($_GET['aid']);
            foreach($viewall as $row){
                echo "<tr>";
                echo "<td>".$row['brand']."</td>";
                //-- get bike details
                $bike_details = $admin->get_bike_one($row['bid']);
                echo "<td>".$bike_details[0]['name'].'  ('.$row['year_manufecturing'].")</td>";
                echo "<td>".$row['color']."</td>";
                echo "<td>";
                if($row['fuel']=='1'){echo "Petrol";}
                if($row['fuel']=='2'){echo "Electric";}
                echo "</td>";
              
                echo "<td>";
                ?>
                    <?php if($row['rc'] != ''){?>
                    <i class='btn btn-info btn-sm'>RC</i>
                    <?php }?>

                    <?php if($row['meter'] != ''){?>
                    <i class='btn btn-warning btn-sm'>Meter</i>
                    <?php }?>

                    <?php if($row['puc'] != ''){?>
                    <i class='btn btn-secondary btn-sm'>PUC</i>
                    <?php }?>                  

                <?php
                echo "</td>";
                echo "<td>";
                        if($row['available']=='0'){echo "<i class='text-success'>Available</i>";}
                        if($row['available']=='1'){echo "<i class='text-info'>Booked</i>";}
                        if($row['available']=='2'){echo "<i class='text-danger'>Dis Countinued</i>";}
                echo "</td>";
                echo "<td>";
                ?>
                    <i class='ti ti-cash btn btn-sm btn-primary' data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="show_page_model('Rate Change for <?php echo $bike_details[0]['name'].'  ('.$row['year_manufecturing'].' )';?>','<?php echo $base_url.'index.php?action=dashboard&nocss=agent_bike_rate&id='.$row['id'];?>')"></i>
                    
                    <i class='ti ti-eye btn btn-sm btn-success'></i>
                    <i class='ti ti-trash btn btn-sm btn-danger'></i>
                <?php 
                echo  "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Color</th>
                <th>Fuel</th>
                <th>Formalities</th>
                <th>Status</th>
                <th>Utility</th>
            </tr>
        </tfoot>
    </table>
    
    </div>
</div>



                  </div>

                </div>
                
               
              </div>
            </div>
          </div>
        </div>
      </div>



    