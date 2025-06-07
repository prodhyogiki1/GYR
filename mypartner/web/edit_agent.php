<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               <?php 
                $agent_details = $agent->view_agent_one($_GET['id']);
               ?>
    <div class="card-header">
        <h5 class="card-title">Edit Agent Information Form</h5>
    </div>
    <div class="card-body content">
        <form name="add_agent" action="<?php echo $base_url.'index.php?action=agent&query=edit_agent';?>" method="post" enctype="multipart/form-data">
        <hr>
            <h5>Contact Person Details</h5>
            <hr>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="agentName">First Name</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo $agent_details[0]['fname'];?>" placeholder="Agent First Name">
                </div>
                <div class="form-group col-sm-3">
                    <label for="agentName">Last Name</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo $agent_details[0]['lname'];?>" placeholder="Agent Last Name">
                </div>
                <div class="form-group col-sm-3">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" name="phone" placeholder="Phone" value="<?php echo $agent_details[0]['phone'];?>">
                </div>
                <div class="form-group col-sm-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $agent_details[0]['email'];?>">
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
                          <textarea class="form-control" name="bname" rows="3" placeholder="Business Name" required> <?php echo $agent_details[0]['bname'];?></textarea>
                      </div>

                      <div class="form-group col-sm-4">
                          <label for="address">Address</label>
                          <textarea class="form-control" name`="baddress" rows="3" placeholder="Address"></textarea>
                      </div>
                      <div class="form-group col-sm-4">
                          <label for="address">Land Mark</label>
                          <textarea class="form-control" name="landmark" rows="3" placeholder="Land Mark"></textarea>
                      </div>
                </div>      
                
                <div class="form-group  row">
                
								<div class="col-md-4">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control" name="country" id="country" onchange="get_details('country','state','<?php echo $base_url.'index.php?action=admin&query=get_details&type=state&id=';?>')">
                    <option disabled="disabled" selected="selected" >-- Select --</option>
                    <?php $country=$admin->get_country();
                    foreach($country as $r => $v)
                    {
                      echo "<option value='".$country[$r]['id'];
                        if($agent_details[0]['country']==$country[$r]['id']){
                          echo "selected='selected'";}
                      echo "'>".$country[$r]['name']."</option>";
                    }?>
                    </select>
                  </div>
								</div>

								  <div class="col-md-4">
									<div class="form-group">
									  <label>State</label>
									  <select class="form-control" name="state" id="state" onchange="get_details('state','city','<?php echo $base_url.'index.php?action=admin&query=get_details&type=city&id=';?>')"></select>
									  <span id="msgstate"></span> 
									</div>
								  </div>

								  <div class="col-md-4">
									<div class="form-g4oup">
									  <label>City</label>
									  <select class="form-control" name="city" id="city"></select>
									  <span id="msgcity"></span> 
									</div>
								  </div>

                               
            </div>
                                
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="panNumber">GSTIN</label>
                    <input type="file" class="form-control" name="gstin_file" placeholder="GSTIN"><br>
                    <input type="text" class="form-control" name="gstin" placeholder="GSTIN">
                </div>
            
                <div class="form-group col-sm-3">
                    <label for="panNumber">Pan Card</label>
                    <input type="file" class="form-control" name="pan_file" placeholder="Pan Number"><br>
                    <input type="text" class="form-control" name="pan" placeholder="Pan Number">
                </div>

                <div class="form-group col-sm-3">
                    <label for="companyDocument">Business Licence</label>
                    <input type="file" class="form-control" name="business_licence_file" placeholder="Business Licence File"><br>
                    <input type="text" class="form-control" name="business_licence" placeholder="Business Licence">
                </div>

                <div class="form-group col-sm-3">
                    <label for="Google Business">Google Business Listing Link</label>
                    <input type="text" class="form-control" name="google_business_link" placeholder="Google Business Listing Link">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Submit</button>
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