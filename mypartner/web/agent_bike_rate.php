<?php 
$bike = $agent->get_bike_one($_GET['id']);
//-- bike details
$bike_details = $admin->get_bike_one($bike[0]['bid']);
?>
<span id="msgbike_rate"></span>
<form name="bike_rate" action="<?php echo $base_url.'index.php?action=agent&query=bike_rate';?>" id="bike_rate" method="post">
    <input type="hidden" name="id" value="<?php echo $bike[0]['id'];?>">
<table class='table table-bordered'>
    <tr>
        <th>Bike</th>
        <td><?php echo $bike_details[0]['name'];?></td>
    </tr>
    <tr>
        <th>Brand</th>
        <td><?php echo $bike[0]['brand'];?></td>
    </tr>
    <tr>
        <th>Fuel</th>
        <td><?php echo $bike[0]['fuel'];?></td>
    </tr>
    <tr>
        <th>Per Day Km Limit</th>
        <td>
            <input type="number" name="per_day_km" value="<?php echo $bike[0]['per_day_km'];?>" class="form-control">
        </td>
    </tr>
    <tr>
        <th>Per Km Price (INR)</th>
        <td><input type="number" name="price_per_km" value="<?php echo $bike[0]['price_per_km'];?>" class="form-control"></td>
    </tr>
    <tr>
        <th>Availablity</th>
        <td>
            <select name="available" class="form-control" >
                <option disabled='disbaled' selected='selected'>-Select-</option>
                <option value='0' <?php if($bike[0]['available']=='0'){echo "selected='selected'";}?>>Available</option>
                <option value='2' <?php if($bike[0]['available']=='2'){echo "selected='selected'";}?>>Dis-Continue</option>
            </select>
        </td>
    </tr>
    <tr>
        <th>Security Deposit</th>
        <td><input type="number" name="security_deposit" value="<?php echo $bike[0]['security_deposit'];?>" class="form-control"></td>
    </tr>
    <tr>
        <th><input type="reset" name="reset" value="Reset" class="btn btn-sm btn-secondary"></th>
        <td><input type="button" onclick="form_submit('bike_rate')" name="submit" value="Submit" class="btn btn-sm btn-primary"></td>
    </tr>
</table>
</form>