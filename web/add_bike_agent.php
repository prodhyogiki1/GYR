<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               
    <div class="card-header">
        <h5 class="card-title">Add Bike (Agent) </h5>
        
    </div>
    <?php include('alert.php'); ?>
    <div class="card-body content">
        <form action="<?php echo $base_url.'index.php?action=agent&query=add_bike';?>" method="post" enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-3">
                <div class="form-group">
                <label>Agent Name <span class='text-danger'>*</span></label>
                <select name="aid"  class="form-control" required>
                
                <?php 
                if($_SESSION['utype']=='1'){
                ?>
                <option disabled="disabled" selected="selected">--Select--</option>
                <?php
                $agentl=$agent->viewall();
                foreach($agentl as $k=>$v){
                echo "<option value='".$agentl[$k]['id']."'>".$agentl[$k]['fname']." ".$agentl[$k]['lname']." - ".$agentl[$k]['bneme']."</option>";
                } }
                else
                {
                    $agentl=$agent->view_agent_one_byuid($_SESSION['uid']);
                    echo "<option value='".$agentl[0]['id']."'>".$agentl[0]['fname']." ".$agentl[0]['lname']." - ".$agentl[0]['bneme']."</option>";
                }
                ?>
                </select>
                </div>
                </div>
                </div>    
                
                
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Bike Brand <span class='text-danger'>*</span></label>
                        <select name="brand" id="brand"  class="form-control" onchange="get_details('brand','model','<?php echo $base_url.'index.php?action=admin&query=get_bike&type=brand&id=';?>')">
                        <option disabled="disabled" selected="selected" required>
                            <option disabled="disabled" selected="selected">--Select--</option>
                            <?php
                            $brand=$admin->get_bikes_brand();
                            foreach($brand as $k=>$v){
                                echo "<option value='".$brand[$k]['brand']."'>".$brand[$k]['brand']."</option>";    
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Model <span class='text-danger'>*</span></label>
                        <select name="model"  id='model' class="form-control" nchange="get_details('brand','bike','<?php echo $base_url.'index.php?action=admin&query=get_details&type=state&id=';?>')">
                        <option disabled="disabled" selected="selected" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Year Of Manufacture <span class='text-danger'>*</span></label>
                        <select name="year_manufecturing" class="form-control" required>
                            <option selected="selected" disabled="disable">-Select-</option>
                            <?php 
                            for($i=2000;$i<=date('Y');$i++){
                               echo "<option value='".$i."'>".$i."</option>";     
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Color <span class='text-danger'>*</span></label>
                        <select name="color"  class="form-control" required>
                            <option selected="selected" disabled="disable">-Select-</option>
                            <?php 
                            $color=$admin->get_bikes_color();
                            foreach($color as $k=>$v){
                            ?>
                            <option value="<?php echo $color[$k]['color_name'];?>" style="background-color: <?php echo $color[$k]['code'];?>"><?php echo $color[$k]['color_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Fuel Type (Petrol/Electric) <span class='text-danger'>*</span></label>
                        <select name="fuel"  class="form-control" required>
                            <option value="1">Petrol</option>
                            <option value="2">Electric</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Odometer Reading (With Meter Photo) <span class='text-danger'>*</span></label>
                        <input type="file" name="meter" class="form-control" accept="image/png, image/jpeg" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Insurance Expire Date (Upload Insurance) <span class='text-danger'>*</span></label>
                        <input type="date" name="insurence" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Pollution Certificat (Upload PUC) <span class='text-danger'>*</span></label>
                        <input type="file" name="puc" class="form-control" accept="image/png, image/jpeg" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="form-group row">
                        <h6>Bike Photos</h6>
                        <div class="col-sm-3">
                            <label for="name">Top <span class='text-danger'>*</span></label>
                            <input type="file" name="top" class="form-control" accept="image/png, image/jpeg" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="name">Back <span class='text-danger'>*</span></label>
                            <input type="file" name="back" class="form-control" accept="image/png, image/jpeg" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="name">Rear <span class='text-danger'>*</span></label>
                            <input type="file" name="rear" class="form-control" accept="image/png, image/jpeg" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="name">Front <span class='text-danger'>*</span></label>
                            <input type="file" name="front" class="form-control" accept="image/png, image/jpeg" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"><br>
                        <label for="email">Registration Number (Upload RC) <span class='text-danger'>*</span></label>
                        <input type="file" name="rc" class="form-control" accept="image/png, image/jpeg" required>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-3"><br>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>    
    </div>

        </div>
    </div>
</div>
