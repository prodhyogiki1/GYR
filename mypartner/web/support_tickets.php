<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               
    <div class="card-header">
        <h5 class="card-title">View All Support Tickets </h5>
    </div>
    <div class="card-body content">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Beand</th>
                <th>Fuel Tank Capacity</th>
                <th>Max Power</th>
                <th>Max Torque</th>
                <th>transmission</th>
                <th>Utility</th>
            </tr>
        </thead>
        <tbody>
    <?php $bikes=$admin->get_all_support_tickets();
    foreach($bikes as $k=>$v){
    ?>
   
            <tr>
            <td><?php echo $bikes[$k]['name'];?></td>
                <td><?php echo $bikes[$k]['category'];?></td>
                <td><?php echo $bikes[$k]['status'];?></td>
                <td></td>
                <td><?php echo $bikes[$k]['last_modified'];?></td>
                <td><?php echo $bikes[$k]['date_time'];?></td>
                <td> <i class="ti ti-pencil btn btn-xs btn-warning"></i> <i class="ti ti-trash btn btn-xs btn-danger"></i></td>
            </tr>
            

            <?php }?>
        </tbody>
        
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