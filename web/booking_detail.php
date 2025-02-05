<?php 
$booking = $agent->view_booking_agent_one($_GET['id']);
$customer = $agent->customer_details($booking[0]['uid']);
$bike_agent=$agent->get_bike_one($booking[0]['bid']);
$bike=$admin->get_bike_one($bike_agent[0]['bid']);
?>
<table class="table table-bordered">
    <tr>
        <th>Customer Name</th>
        <td><?php echo $customer[0]['uname'];?></td>
    </tr>
    <tr>
        <th>Contact</th>
        <td><?php echo $customer[0]['phone'].' / '.$customer[0]['email'];?></td>
    </tr>
    <tr>
        <th>Address</th>
        <td><?php echo $customer[0]['address'];?></td>
    </tr>
    <tr>
        <th>Booking Date & Time</th>
        <td><?php echo date('d-m-Y h:i:s',strtotime($booking[0]['booking_date_time']));?></td>
    </tr>
    <tr>
        <th>Booking Period</th>
        <td>From : <?php echo date('d-m-Y', strtotime($booking[0]['booking_from']));?> <br> To : <?php echo date('d-m-Y', strtotime($booking[0]['booking_to']));?> </td>
    </tr>
    <tr>
        <th>Bike Booked</th>
        <td><?php echo $bike_agent[0]['brand'].' ( '.$bike[0]['name'].' )'.' - '.$bike_agent[0]['color'].' - '.$bike_agent[0]['year_manufecturing'];?></td>
    </tr>
    <tr>
        <th>Payment Mode</th>
        <td>
            <?php 
            if($booking[0]['payment_mode']=='0'){echo "Pay at store";}
            if($booking[0]['payment_mode']=='1'){echo "Online";}
            ?>
        </td>
    </tr>
    <tr>
        <th>Payment Status</th>
        <td>
            <?php 
                //-- check payment status in transaction table
                if($booking[0]['payment_status']=='0'){echo "Pending";}
                if($booking[0]['payment_status']=='1'){echo "Success";}
                if($booking[0]['payment_status']=='2'){echo "Failed";}
            ?>
        </td>
    </tr>
    <tr>
        
    </tr>
</table>

<span id="resultmode_booking"></span>
<form name="mode_booking" id="formmode_booking" action="<?php echo $base_url.'index.php?action=agent&query=booking_accept';?>" method="post">
<table table class="table table-bordered" style="font-size:12px;">
    <tr>
        <th colspan="4" class="text-danger">Change Status (Payemnt & Ride)</th>
    </tr>
    <tr>        
        <th>Mode Of Payment</th>
        <td width="25%">
            <input type="hidden" name="bookingid" value="<?php echo $booking[0]['id'];?>">
            <select name="mode_of_payment" class="form-control">
                <option value="0" <?php if($booking[0]['payment_mode']=='0'){echo "selected='selected'";}?>>Cash</option>
                <option value="1" <?php if($booking[0]['payment_mode']=='1'){echo "selected='selected'";}?>>Online</option>
            </select>
        </td>
        <th>Amount Received</th>
        <td width="25%">
            <input type="number" name="amount" value="" class="form-control">
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <select name="status" class="form-control">
                <option value="2" <?php if($booking[0]['status']=='2'){echo "selected='selected'";}?>>Accept</option>
                <option value="4" <?php if($booking[0]['status']=='4'){echo "selected='selected'";}?>>Cancelled By Agent</option>
                <option value="5" <?php if($booking[0]['status']=='5'){echo "selected='selected'";}?>>Cancelled By Customer</option>
            </select>    
        </td>
        <th>KM Covered Till Date</th>
        <td>
            <input type="number" name="km_covered_start" value="<?php echo $booking[0]['km_covered_start']; ?>" class="form-control">
        </td>
    </tr>
    <?php if($booking[0]['status']=='1'){?>
    <tr>
       <td colspan="4">
            <input type="button" onclick="form_submit('mode_booking')" name="advance" value="Update" class="btn btn-warning btn-sm">
        </td>
    </tr>
    <?php }?>
</table>
</form>