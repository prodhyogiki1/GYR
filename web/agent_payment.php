<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
          
    <div class="card-header">
        <h5 class="card-title">payment(s)</h5>
    </div>
    <div class="card-body content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Booking Id</th>
                    <th>Amount</th>
                    <th>From - To</th>
                    <th>Status</th>
                    <th>Bike</th>
                    <th>Receipt</th>
                </tr>
            </thead>
            <tbody>
              <?php 
              $counter=1;
              $tra=$agent->get_transaction($_SESSION['aid']);
              foreach($tra as $k=>$v){
                //--view customer details
                $customer = $agent->customer_details($tra[$k]['uid']);
                //--bike details 
                $bike_agent=$agent->get_bike_one($tra[$k]['bid']);
                $bike=$admin->get_bike_one($bike_agent[0]['bid']);
              ?>
              <tr>              
                  <td><?php echo $counter++;?></td>
                  <td><?php echo $customer[0]['uname'];?></td>
                  <td><?php echo 'GYR'.$tra[$k]['bookingid'];?></td>
                  <td><?php echo $tra[$k]['amount'];?></td>
                  <td><?php if($tra[$k]['payment_mode']=='0'){echo "Pay at store";}
                       if($tra[$k]['payment_mode']=='1'){echo "Online";}?></td>
                  <td><?php echo $tra[$k]['date_time'];?></td>
                  <td><?php echo  $bike_agent[0]['brand'].' ( '.$bike[0]['name'].' )'.' - '.$bike_agent[0]['color'].' - '.$bike_agent[0]['year_manufecturing'];?></td>
                  <td>
                    <i class="ti ti-eye btn btn-sm btn-success"></i
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