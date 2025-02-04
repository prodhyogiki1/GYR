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
              ?>
              <tr>
                <th><?php echo $counter++;?></th>
                <td><?php echo $mybooking[$k]['uid'];?></td>
                <td><?php echo $mybooking[$k]['amount'];?></td>
                <td><?php echo date('d-m-Y', strtotime($mybooking[$k]['booking_from']));?></td>
                <td><?php echo $mybooking[$k]['status'];?></td>
                <td>
                <input type="button" class="btn btn-success btn-sm" value="View">  
                <input type="button" class="btn btn-secondary btn-sm" value="Return">
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