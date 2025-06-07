<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               <?php 
                $agent_details = $agent->view_agent_one($_GET['id']);
                  $user_details = $admin->getone_user($agent_details[0]['uid']);  

               ?>
    <div class="card-header">
        <h5 class="card-title">Edit Verification Form</h5>
    </div>
    <?php include('alert.php');?>
    <div class="card-body content">
        <form name="add_agent" action="<?php echo $base_url.'index.php?action=agent&query=verify_agent';?>" method="post" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?php echo $agent_details[0]['id'];?>"/>
        <input type="hidden" name="uid" value="<?php echo $agent_details[0]['uid'];?>"/>

        <hr>
            <h5>Contact Person Details</h5>
            <hr>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="agentName">First Name</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo $agent_details[0]['fname'];?>" placeholder="Agent First Name" required>
                </div>
                <div class="form-group col-sm-3">
                    <label for="agentName">Last Name</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo $agent_details[0]['lname'];?>" placeholder="Agent Last Name" required>
                </div>
                <div class="form-group col-sm-3">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" name="phone" placeholder="Phone" value="<?php echo $agent_details[0]['phone'];?>" required>
                </div>
                <div class="form-group col-sm-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $agent_details[0]['email'];?>" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="alternatePhone">Designation</label>
                    <select name="designation" class="form-control" required>
                        <option selected="selected" disabled="disable">-Select</option>
                        <option value="1" <?php if($agent_details[0]['designation']==1){echo "selected='selected'";}?>>Owner</option>
                        <option value="2" <?php if($agent_details[0]['designation']==2){echo "selected='selected'";}?>>Partner</option>
                        <option value="3" <?php if($agent_details[0]['designation']==3){echo "selected='selected'";}?>>Director</option>
                        <option value="4" <?php if($agent_details[0]['designation']==4){echo "selected='selected'";}?>>Employee</option>
                        <option value="5" <?php if($agent_details[0]['designation']==5){echo "selected='selected'";}?>>Other</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="alternatePhone">Alternate Phone</label>
                    <input type="tel" class="form-control" name="phone2" placeholder="Alternate Phone"  value="<?php echo $agent_details[0]['phone2'];?>">
                </div>
                
            </div>

            <hr>
            <h5>Business Details</h5>
            <hr>
                <div class="form-group  row">
                    
                      <div class="form-group col-sm-4">
                          <label for="address">Business Name</label>
                          <textarea class="form-control" name="bname" rows="3" placeholder="Business Name" > <?php echo $agent_details[0]['bname'];?></textarea>
                      </div>

                      <div class="form-group col-sm-4">
                          <label for="address">Address</label>
                          <textarea class="form-control" name="baddress" rows="3" placeholder="Address" ><?php echo $agent_details[0]['baddress'];?></textarea>
                      </div>
                      <div class="form-group col-sm-4">
                          <label for="address">Land Mark</label>
                          <textarea class="form-control" name="landmark" rows="3" placeholder="Land Mark" ><?php echo $agent_details[0]['landmark'];?></textarea>
                      </div>
                </div>      
                
                <div class="form-group  row">
                
								<div class="col-md-4">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control" name="country" id="country" onchange="get_details('country','state','<?php echo $base_url.'index.php?action=admin&query=get_details&type=state&id=';?>')" >
                    <option disabled="disabled" >-- Select --</option>
                    <?php $country=$admin->get_country();
                    foreach($country as $r => $v)
                    {
                      echo "<option value='".$country[$r]['id'];
                        if($country[$r]['id']==$agent_details[0]['country']){
                          echo "selected='selected'";}
                      echo "'>".$country[$r]['name']."</option>";
                    }?>
                    </select>
                  </div>
								</div>

								  <div class="col-md-4">
									<div class="form-group">
									  <label>State</label>
									  <?php 
                    $state=$admin->get_states($agent_details[0]['country']);
                    ?>
									  <select class="form-control" name="state" id="state" onchange="get_details('state','city','<?php echo $base_url.'index.php?action=admin&query=get_details&type=city&id=';?>')" required>
                      <?php foreach($state as $k1=>$v1){?>
                      <option  value="<?php echo $state[$k1]['id'];?>" <?php if($agent_details[0]['state']==$state[$k1]['id']){echo "selected='selected'";}?>><?php echo $state[$k1]['name']; ?></option>
                      <?php }?>
                    </select>
									  <span id="msgstate"></span> 
									</div>
								  </div>

								  <div class="col-md-4">
									<div class="form-g4oup">
									  <label>City</label>
									  <?php 
                    $city=$admin->get_cities($agent_details[0]['state']);
                    ?>
									  <select class="form-control" name="city" id="city" required>
                    <?php foreach($city as $k2=>$v2){?>
                       <option selected="selected" value="<?php echo $city[$k2]['id'];?>" <?php if($agent_details[0]['city']==$city[$k2]['id']){echo "selected='selected'";}?>><?php echo $city[$k2]['name']; ?></option>
                    <?php }?>
                    </select>
									</div>
								  </div>

                               
            </div>
                                
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="panNumber">GSTIN</label>
                    <!-- <input type="file" class="form-control" name="gstin_file" placeholder="GSTIN" ><br> -->
                    <input type="text" class="form-control" name="gstin" placeholder="GSTIN" value="<?php echo $agent_details[0]['gstin'];?>">
                    <?php if($agent_details[0]['gstin_file']){?>
                      <br>  <a href="<?php echo $base_url.'theme/assets/images/'.$agent_details[0]['gstin_file'];?>" target="_blank"><span class='btn btn-sm btn-priamry'>View</span></a>
                    <?php }?>
                </div>
            
                <div class="form-group col-sm-3">
                    <label for="panNumber">Pan Card</label>
                    <!-- <input type="file" class="form-control" name="pan_file" placeholder="Pan Number" ><br> -->
                    <input type="text" class="form-control" name="pan" placeholder="Pan Number" value="<?php echo $agent_details[0]['pan'];?>">
                    <?php if($agent_details[0]['pan_file']){?>
                      <br>  <a href="<?php echo $base_url.'theme/assets/images/'.$agent_details[0]['pan_file'];?>" target="_blank"><span class='btn btn-sm btn-secondary'>View</span></a>
                      <?php }?>
                </div>

                <div class="form-group col-sm-3">
                    <label for="companyDocument">Business Licence</label>
                    <!-- <input type="file" class="form-control" name="business_licence_file" placeholder="Business Licence File" ><br> -->
                    <input type="text" class="form-control" name="business_licence" placeholder="Business Licence" value="<?php echo $agent_details[0]['business_licence'];?>" >
                    <?php if($agent_details[0]['business_licence_file']){?>
                      <br>  <a href="<?php echo $base_url.'theme/assets/images/'.$agent_details[0]['business_licence_file'];?>" target="_blank"><span class='btn btn-sm btn-info'>View</span></a>
                      <?php }?>
                </div>

                <div class="form-group col-sm-3">
                    <label for="Google Business">Google Business Listing Link</label>
                    <input type="text" class="form-control" name="google_business_link" value="<?php echo $agent_details[0]['google_business_link'];?>" placeholder="Google Business Listing Link">
                </div>

                
            </div>`
<hr>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label>Profile Status</label>
                        <select name="status" class="form-control" required>
                            <option  disabled="disable">-Select-</option>
                            <option value="0" <?php if($user_details[0]['status']=='0'){?>selected="selected"<?php }?>>Rejected</option>
                            <option value="1" <?php if($user_details[0]['status']=='1'){?>selected="selected"<?php }?>>Verify</option>
                            <option value="2" <?php if($user_details[0]['status']=='2'){?>selected="selected"<?php }?>>Disabled / New</option>
                            <option value="3" <?php if($user_details[0]['status']=='3'){?>selected="selected"<?php }?>>Verify Document</option>
                            
                            
                        </select>
                </div>

                <div class="form-group col-sm-3"><br>
                    <input type="submit" class="btn btn-warning" value="Verify & Send Email" name="verify_agent" />
                </div>
            </div>    

        </form>
    </div>
</div>



                  </div>

                </div>
                
               
              </div>
            </div>
          </div>
        </div>
      </div>