<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               
    <div class="card-header">
        <h5 class="card-title">View All Bookings </h5>
    </div>
    <div class="card-body content">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date & Time</th>
                <th>Booking</th>
                <th>Bike</th>
                <th>Agent</th>
                <th>Days</th>
                <th>Status</th>
                <th>Utility</th>
            </tr>
        </thead>
        <tbody>
    <?php $booking=$user->get_all_booking();
    foreach($booking as $k=>$v){

        //-- access UID and BID from array
    ?>
   
            <tr>
                <td><?php echo $booking[$k]['id'];?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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