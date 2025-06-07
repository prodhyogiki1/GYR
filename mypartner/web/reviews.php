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
                <th>Booking</th>
                <th>Bike</th>
                <th>Agent</th>
                <th>Star</th>
                <th>Feedback</th>
                <th>Date & Time</th>
                <th>Utility</th>
            </tr>
        </thead>
        <tbody>
    <?php $bikes=$admin->get_all_feedback();
    foreach($bikes as $k=>$v){

        //-- access UID and BID from array
    ?>
   
            <tr>
                <td></td>
                <td><?php echo $bikes[$k]['bid'];?></td>
                <td></td>
                <td></td>
                <td><?php echo $bikes[$k]['star'];?></td>
                <td><?php echo $bikes[$k]['feedback'];?></td>
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