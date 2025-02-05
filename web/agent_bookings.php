<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
          
    <div class="card-header">
        <h5 class="card-title">Booking(s)</h5>
    </div>
    <div class="card-body content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Booking ID</th>
                    <th>Customer Name</th>
                    <th>Amount</th>
                    <th>From - To</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php 
              $mybooking = $agent->mybooking($_SESSION['aid']);
              $counter=1;
              foreach($mybooking as $k => $v){
                //--view customer details
                $customer = $agent->customer_details($mybooking[$k]['uid']);
              ?>
              <tr>
                <th><?php echo $counter++;?></th>
                <th><?php echo 'GYR'.$mybooking[$k]['id'];?></th>
                <td><?php echo $customer[0]['uname'];?></td>
                <td><?php echo $mybooking[$k]['amount'];?></td>
                <td><?php echo date('d-m-Y', strtotime($mybooking[$k]['booking_from']));?></td>
                <td><?php if($mybooking[$k]['status']=='1'){echo "Pending";}
                          if($mybooking[$k]['status']=='2'){echo "Ongoing";}
                          if($mybooking[$k]['status']=='3'){echo "Completed";}
                          if($mybooking[$k]['status']=='4'){echo "Cancelled By Agent";}
                          if($mybooking[$k]['status']=='5'){echo "Cancelled By Customer";}
                ?></td>
                <td>
                  <input type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="show_page_model('Booking Details of <?php echo 'GYR'.$mybooking[$k]['id'];?> ','<?php echo $base_url.'index.php?action=dashboard&nocss=booking_detail&id='.$mybooking[$k]['id'];?>')" value="View" >  

                  <?php if($mybooking[$k]['status']=='3'){?>
                  <input type="button" class="btn btn-secondary btn-sm" value="Return">
                  <?php }?>
                  
                  <input type="button" class="btn btn-danger btn-sm" value="Cancel">
                </td>
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