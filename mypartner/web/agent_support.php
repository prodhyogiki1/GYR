<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Support</h5>
                    <a href="<?php echo $base_url.'index.php?action=dashboard&page=agent_my_tickets';?>" class="btn btn-primary btn-sm">
                        <i class="ti ti-list me-1"></i>View My Tickets
                    </a>
                </div>
            </div>
            <div class="card-body content">
                <?php if(isset($_GET['status']) && $_GET['status']=='1'){?>
                <div class="alert alert-success">Your ticket has been created.</div>
                <?php }?>

                <form method="post" action="<?php echo $base_url.'index.php?action=agent&query=save_support_ticket';?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="">-- Select --</option>
                                <option value="Sales">Sales</option>
                                <option value="Booking">Booking</option>
                                <option value="Technical">Technical</option>
                            </select>
                        </div>
                        <div class="col-md-12" id="booking-wrapper" style="display:none;">
                            <label class="form-label">Select Booking</label>
                            <select name="booking_id" id="booking_id" class="form-select">
                                <option value="0">-- Select Booking --</option>
                                <?php 
                                $ongoing = $agent->mybooking($_SESSION['aid'],'2');
                                $pending = $agent->mybooking($_SESSION['aid'],'1');
                                $bookings = array();
                                if($ongoing){ foreach($ongoing as $b){ $bookings[] = $b; } }
                                if($pending){ foreach($pending as $b){ $bookings[] = $b; } }
                                if($bookings){
                                    foreach($bookings as $b){
                                        echo "<option value='".$b['id']."'>".'GYR'.$b['id']." - ".date('d-m-Y', strtotime($b['booking_from']))."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

<script>
    (function(){
        var category = document.getElementById('category');
        var bookingWrapper = document.getElementById('booking-wrapper');
        function toggleBooking(){
            if(category.value === 'Booking'){
                bookingWrapper.style.display = '';
            } else {
                bookingWrapper.style.display = 'none';
            }
        }
        category.addEventListener('change', toggleBooking);
    })();
</script> 