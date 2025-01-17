<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               
    <div class="card-header">
        <h5 class="card-title">View All Agent </h5>
    </div>
    <div class="card-body content">
        
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Designation</th>
                <th>Company</th>
                <th>Address</th>
                <th>Licence</th>
                <th>Utility</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $viewall=$agent->viewall();
            foreach($viewall as $row){
                echo "<tr>";
                echo "<td>".$row['fname'].' '.$row['fname']."</td>";
                echo "<td>".$row['designation']."</td>";
                echo "<td>".$row['bname']."</td>";
                echo "<td>".$row['baddress']."</td>";
                echo "<td> GSTIN : ".$row['gstin']."<br>"."PAN : ".$row['pan']."<br>"."Licence : ".$row['business_licence']."</td>";
                echo "<td>";
                ?>
                    <a href="<?php echo $base_url.'index.php?action=edit_agent&id='.$row['id'];?>"><i class='ti ti-pencil btn btn-info btn-sm'></i></a>
                    <a href="<?php echo $base_url.'index.php?action=dashboard&page=agent_bike_viewall&aid='.$row['id'];?>"><i class='ti ti-bike btn btn-warning btn-sm' data-toggle="modal" data-target="#exampleModal"></i></a>
                    <i class='ti ti-trash btn btn-danger btn-sm' onclick="deleteme('<?php echo $row['id'];?>')"></i>
                <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
            <th>Name</th>
                <th>Designation</th>
                <th>Company</th>
                <th>Address</th>
                <th>Licence</th>
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