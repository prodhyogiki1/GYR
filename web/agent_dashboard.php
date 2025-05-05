
<div class="container-fluid">

  <div class="content-wrapper">
    
    <!------ one --->
    <div class="row">
      
      <?php if($_SESSION['status']=='3'){?>
        <div class="alert alert-info">Your profile is under document verification.</div>
        <?php }if($_SESSION['status']=='2'){?>
          <div class="alert alert-danger">Your Profile has been disabled / deactivated. Please call or email us for further help.<br>Please complete your profile if not done.</div>
        <?php }?>  

          <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-10">
                  <div class="">
                    <h5 class="card-title fw-semibold">New Bookings</h5>
                  </div>
                </div>
                <?php 
                //--check new bookings
                $new_bookings=$agent->new_booking_dash($_SESSION['aid']);
                if($new_bookings)
                {
                  echo "<table class='table'>";
                  echo "<tr><th>#</th>";
                  echo "<th>Customer Name</th>";
                  echo "<th>Date & Time</th>";
                  echo "<th>Bike</th>";
                  echo "<th>Status</th>";
                  echo "</tr>";

                  $counter=1;
                  foreach($new_bookings as $k0=>$v)
                  {
                    $bike_name=$admin->get_bike_one($new_bookings[$k0]['bid']);
                    $user1 = $user->get_one_user($new_bookings[$k0]['uid']);
                    echo "<tr>";
                    echo "<td>".$counter++."</td>";
                      echo "<td>".$user1[0]['uname']."</td>";
                      echo "<td>".$new_bookings[$k0]['booking_date_time']."</td>";
                      echo "<td>".$bike_name[0]['name']."</td>";                    
                      echo "<td>";
                      
                          $status = $new_bookings[$k0]['status'];
                          if($status=='1'){$reason='On Going';}
                          if($status=='2'){$reason='Cancelled';}
                          if($status=='3'){$reason='Successfully Completed';}
                          if($status=='4'){$reason='Cancelled By Agent';}
                          if($status=='5'){$reason='Cancelled By Customer';}
                          echo $reason;

                      echo "</td>";
                    echo "</tr>";
                  }
                  echo "<tr><td colspan='4'><a href='".$base_url."index.php?action=dashboard&page=agent_bookings' class='btn btn-primary'>View All</a></td></tr>";
                  echo "</table>";
                }
                else
                {
                  echo "<div class='text-center'>";
                  echo "<img src='".$base_url."theme/assets/images/not_found.jpg' width='350'>";
                  echo "<h5>No New Booking(s)</h5>";
                  echo "</div>";
                }  
                ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12 col-sm-6">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-10 fw-semibold">Profile Status</h5>
                    <div class="row align-items-center">
                      <div class="col-7">
                        <?php 
                        $blank=1;
                        $full=1;
                        $profile = $agent->table_columns('agent');
                        $agent_details = $agent->view_agent_one($_SESSION['uid']);
                        foreach($profile as $k => $v)
                        {
                          //-- check emapty or not
                          $col = $profile[$k]['Field'];
                          $val = $agent_details[$k][$col];
                          if($val=='')
                          {$balank++;}
                          else
                          {$full++;}
                        }
                        $final = $blank+$full;
                        $per = $full/$final*100;
                        ?>
                        <h4 class="fw-semibold mb-3"><?php echo $per.'%';?></h4>
                        <div class="d-flex align-items-center">
                          <div class="me-3">
                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Complete</span>
                          </div>
                          <div>
                            <span class="round-8 bg-danger rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Incomplete</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="d-flex justify-content-center">
                          <div id="grade"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-sm-6">
                <!-- bikes -->
                <div class="card">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-10 fw-semibold"> Bike(s)</h5>
                        <h4 class="fw-semibold mb-3">Listed :- <?php echo count($agent->viewall_agent_bike($_SESSION['aid']));?></h4>
                        <div class="d-flex align-items-center pb-1">
                          <?php 
                          $bikegrp=$agent->agent_bike_group($_SESSION['aid']);
                          foreach($bikegrp as $k => $v)
                          {                           
                          ?>
                          <span
                            class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-up-right text-danger"></i>
                          </span>
                          <p class="text-dark me-1 fs-3 mb-0"><?php if($bikegrp[$k]['available']=='1')
                          {echo "Booked";}
                          else
                          {echo "Available";}
                          ?> : 
                          </p>
                          <p class="fs-3 mb-0"><?php echo $bikegrp[$k]['total'];?></p>
                          <?php }?>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-danger rounded-circle p-7 d-flex align-items-center justify-content-center">
                            <i class="ti ti-bike fs-7"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-sm-6">
                <!-- Monthly Earnings -->
                <div class="card">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-10 fw-semibold"> Total Earning(s)</h5>
                        <h4 class="fw-semibold mb-3">INR :- <?php $sum=$agent->total_amount($_SESSION['aid'],'3'); echo $sum[0]['amount'];?></h4>
                        <div class="d-flex align-items-center pb-1">
                          
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-success rounded-circle p-7 d-flex align-items-center justify-content-center">
                            <i class="ti ti-currency fs-7"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div id="earning"></div> -->
                </div>
              </div>


            </div>
          </div>
        </div>


        <!---- row 2 -------->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                  <h4>Availablity & Booking</h4>        
                  <table class='table table-bordered'>
                    <tr>
                      <th>#</th>
                      <th>Bike</th>
                      <th>Year</th>
                      <th>Color</th>
                      <th>Price Per KM</th>
                      <th>Per Day KM</th>
                      <th>Availablility</th>
                      <th></th>
                    </tr>
                  <?php 
                  //-- view al bikes
                  $abikes=$agent->viewall_agent_bike_limit($_SESSION['aid']);
                  if($abikes)
                  {
                  $counter=1;
                  
                  foreach($abikes as $k1 => $v){
                    //-- get bike details
                    $bike=$admin->get_bike_one($abikes[$k1]['bid']);

                      echo "<tr>"; 
                        echo "<th>".$counter++."</th>";
                        echo "<td>".$bike[0]['name']."</td>";
                        echo "<td>".$abikes[$k1]['year_manufecturing']."</td>";
                        echo "<td>".$abikes[$k1]['color']."</td>";
                        echo "<td>".$abikes[$k1]['price_per_km']."</td>";
                        echo "<td>".$abikes[$k1]['per_day_km']."</td>";
                        echo "<td>".$abikes[$k1]['available']."</td>";
                        echo "<td></td>";
                      echo "</tr>";
                  }
                  echo "<tr><td colspan='6'><a href='$base_url/index.php?action=dashboard&page=bike_agent_viewall'>View All</a></td></tr>";
                  }
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