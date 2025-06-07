<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
          
    <div class="card-header">
        <h2 class="card-title">Booking(s)</h2>
    </div>
    <div class="card-body content">


        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">On-Going</button>
          </li>
          <li class="nav-item" role="presentation">
          <button class="nav-link" id="verify-tab" data-bs-toggle="tab" data-bs-target="#verify" type="button" role="tab" aria-controls="verify" aria-selected="false">Pending</button>
          </li>
          <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Completed</button>
          </li>
        </ul>


        <div class="tab-content mt-3" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <h2 class="mb-3">On-Going</h2>
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
                                  $mybooking = $agent->mybooking($_SESSION['aid'],'2');
                                  $counter=1;
                                  if($mybooking)
                                  {
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
                                    <?php }} else {echo "<tr><td colspan='7'>No data found.</td></tr>";}?>
                                </tbody>
                            </table>
                    </div>

                    <div class="tab-pane fade show " id="verify" role="tabpanel" aria-labelledby="verify-tab">
                      <h2 class="mb-3">Pending</h2>
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
                                  $mybooking = $agent->mybooking($_SESSION['aid'],'1');
                                  $counter=1;
                                  if($mybooking)
                                  {
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
                                    <?php }} else {echo "<tr><td colspan='7'>No data found.</td></tr>";}?>
                                </tbody>
                            </table>
                    </div>

                    <div class="tab-pane fade show " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <h2 class="mb-3">Completed</h2>
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
                                  $mybooking = $agent->mybooking($_SESSION['aid'],'3');
                                  $counter=1;
                                  if($mybooking)
                                  {
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
                                    <?php }} else {echo "<tr><td colspan='7'>No data found.</td></tr>";}?>
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
        </div>
      </div>