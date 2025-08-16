<div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-10">
                  <div class="">
                    <h5 class="card-title fw-semibold">Profit & Expenses</h5>
                  </div>
                  <div class="dropdown">
                    <button
                      id="dropdownMenuButton1"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                      class="rounded-circle btn-transparent rounded-circle btn-sm px-1 btn shadow-none"
                    >
                      <i class="ti ti-dots-vertical fs-7 d-block"></i>
                    </button>
                    <ul
                      class="dropdown-menu dropdown-menu-end"
                      aria-labelledby="dropdownMenuButton1"
                    >
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li>
                        <a class="dropdown-item" href="#">Another action</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="profit"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12 col-sm-6">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <!-- notification-->
                  <div class="card-body p-4">
                    <h5 class="card-title mb-10 fw-semibold">Notification</h5>
                    <div class="row align-items-center">
                      <div class="col-12" style="max-height:200px; overdlow-y:scroll;">
                        <ol>
                          <?php 
                            $notification=$admin->latest_alerts($_SESSION['uid']);
                            foreach($notification as $r=>$k)
                            {
                              echo "<li>".$notification[$r]['msg'];
                                echo "<br><i class='text-muted fs-2'>".date("d-m-Y h:i:s", strtotime($notification[$r]['date_time']))."</i>";                              
                              echo "</li>";
                            }
                          ?>
                        </ol>
                      </div>
                    </div>
                  </div>
                  <!-- notification ends-->


                </div>
              </div>
              <div class="col-lg-12 col-sm-6">
                <!-- Monthly Earnings -->
                <div class="card">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-10 fw-semibold"> Product Sales</h5>
                        <h4 class="fw-semibold mb-3">₹<?php echo number_format($admin->get_total_sales_inr()); ?></h4>
                        <div class="d-flex align-items-center pb-1">
                          <span
                            class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-down-right text-danger"></i>
                          </span>
                          <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                          <p class="fs-3 mb-0">last year</p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-danger rounded-circle p-7 d-flex align-items-center justify-content-center">
                            <i class="ti ti-currency-rupee fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="earning"></div>
                  <script>
                    $(document).ready(function() {
                        // Get monthly sales data from PHP
                        var monthlyData = <?php 
                            $monthly_sales = $admin->get_monthly_sales_data();
                            echo json_encode(array_values($monthly_sales));
                        ?>;
                        
                        // Chart configuration for monthly sales
                        var earningChartOptions = {
                            series: [{
                                name: 'Sales',
                                data: monthlyData
                            }],
                            chart: {
                                type: 'area',
                                height: 100,
                                toolbar: {
                                    show: false
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 2
                            },
                            colors: ['#ff6b6b'],
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.7,
                                    opacityTo: 0.2,
                                    stops: [0, 90, 100]
                                }
                            },
                            xaxis: {
                                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                labels: {
                                    show: false
                                }
                            },
                            yaxis: {
                                labels: {
                                    show: false
                                }
                            },
                            grid: {
                                show: false
                            },
                            tooltip: {
                                y: {
                                    formatter: function (val) {
                                        return '₹' + val.toLocaleString('en-IN');
                                    }
                                }
                            }
                        };
                        
                        // Initialize the chart
                        var earningChart = new ApexCharts(document.querySelector("#earning"), earningChartOptions);
                        earningChart.render();
                    });
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Upcoming Schedules</h5>
                </div>
                <style>
                  .timeline-widget {
                    padding-left: 0;
                  }
                  .timeline-item {
                    margin-bottom: 22px;
                    min-height: 60px;
                    align-items: flex-start !important;
                  }
                  .timeline-badge-wrap {
                    margin-right: 8px;
                  }
                  .timeline-desc {
                    padding-left: 24px;
                    word-break: break-word;
                    width: 100%;
                    display: block;
                  }
                  .timeline-desc .fw-semibold,
                  .timeline-desc .text-muted,
                  .timeline-desc .text-primary {
                    display: block;
                    width: 100%;
                  }
                </style>
                <ul class="timeline-widget mb-0 position-relative mb-n5" style="max-height: 400px; overflow-y: auto;">
                  <?php 
                    $recent_bookings = $admin->get_recent_bookings();
                    if($recent_bookings) {
                      foreach($recent_bookings as $booking) {
                        // Determine status color and text
                        $status_color = 'primary';
                        $status_text = 'Pending';
                        
                        if($booking['status'] == '1') {
                          $status_color = 'warning';
                          $status_text = 'Pending';
                        } elseif($booking['status'] == '2') {
                          $status_color = 'success';
                          $status_text = 'Ongoing';
                        } elseif($booking['status'] == '3') {
                          $status_color = 'info';
                          $status_text = 'Completed';
                        } elseif($booking['status'] == '4') {
                          $status_color = 'danger';
                          $status_text = 'Cancelled by Agent';
                        } elseif($booking['status'] == '5') {
                          $status_color = 'danger';
                          $status_text = 'Cancelled by Customer';
                        }
                        
                        // Format booking date
                        $booking_date = date('d M H:i', strtotime($booking['booking_date_time']));
                        $booking_period = date('d M', strtotime($booking['booking_from'])) . ' - ' . date('d M', strtotime($booking['booking_to']));
                        
                        // Agent name
                        $agent_name = $booking['agent_fname'] . ' ' . $booking['agent_lname'];
                        if(empty($agent_name) || $agent_name == ' ') {
                          $agent_name = 'Agent ID: ' . $booking['aid'];
                        }
                  ?>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-time text-dark flex-shrink-0 text-end"><?php echo $booking_date; ?></div>
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-<?php echo $status_color; ?> flex-shrink-0 my-2"></span>
                      <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">
                      <div class="fw-semibold">
                        Booking #GYR<?php echo $booking['id']; ?> - <?php echo $status_text; ?>
                      </div>
                      <div class="text-muted fs-2">
                        Customer: <?php echo $booking['customer_name'] ?: 'N/A'; ?> (<?php echo $booking['customer_phone']; ?>)
                      </div>
                      <div class="text-muted fs-2">
                        Period: <?php echo $booking_period; ?> | Amount: ₹<?php echo number_format($booking['amount']); ?>
                      </div>
                      <div class="text-primary fs-2 fw-semibold">
                        Agent: <?php echo $agent_name; ?>
                      </div>
                    </div>
                  </li>
                  <?php 
                      }
                    } else {
                  ?>
                  <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-time text-dark flex-shrink-0 text-end">--</div>
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                      <span class="timeline-badge border-2 border border-secondary flex-shrink-0 my-2"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">
                      <div class="text-muted">No bookings found</div>
                    </div>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <div
                  class="d-flex mb-4 justify-content-between align-items-center"
                >
                  <h5 class="mb-0 fw-bold">Top Performing Agents</h5>

                  <div class="dropdown">
                    <button
                      id="dropdownMenuButton1"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                      class="rounded-circle btn-transparent rounded-circle btn-sm px-1 btn shadow-none"
                    >
                      <i class="ti ti-dots-vertical fs-7 d-block"></i>
                    </button>
                    <ul
                      class="dropdown-menu dropdown-menu-end"
                      aria-labelledby="dropdownMenuButton1"
                    >
                      <li><a class="dropdown-item" href="#">View All Agent</a></li>
                    </ul>
                  </div>
                </div>

                <div class="table-responsive" data-simplebar>
                  <table
                    class="table table-borderless align-middle text-nowrap"
                  >
                    <thead>
                      <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Agent Name</th>
                        <th scope="col">Nu of Booking</th>
                        <th scope="col">Amount</th>
                        <th scope="col">City</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $top_agents = $admin->get_top_performing_agents();
                        if($top_agents) {
                          $sno = 1;
                          foreach($top_agents as $agent) {
                      ?>
                      <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo htmlspecialchars($agent['agent_name']); ?></td>
                        <td><?php echo $agent['num_bookings']; ?></td>
                        <td>₹<?php echo number_format($agent['total_amount']); ?></td>
                        <td><?php echo htmlspecialchars($agent['city']); ?></td>
                      </tr>
                      <?php 
                          }
                        } else {
                      ?>
                      <tr><td colspan="5" class="text-center">No data found</td></tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title fw-semibold">Top Selling Bikes</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Bike Name</th>
                        <th>Number of Booking</th>
                        <th>Success</th>
                        <th>Cancel</th>
                        <th>Pending</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $top_bikes = $admin->get_top_selling_bikes();
                        if($top_bikes) {
                          $sno = 1;
                          foreach($top_bikes as $bike) {
                      ?>
                      <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo htmlspecialchars($bike['bike_name']); ?></td>
                        <td><?php echo $bike['total_bookings']; ?></td>
                        <td><span class="badge bg-success"><?php echo $bike['success_bookings']; ?></span></td>
                        <td><span class="badge bg-danger"><?php echo $bike['cancel_bookings']; ?></span></td>
                        <td><span class="badge bg-warning"><?php echo $bike['pending_bookings']; ?></span></td>
                      </tr>
                      <?php 
                          }
                        } else {
                      ?>
                      <tr><td colspan="6" class="text-center">No data found</td></tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
       
      </div>
      </div>