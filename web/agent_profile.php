<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
      <?php 
        $agent_p=$agent->view_agent_one($_SESSION['uid']);
      ?>         
    <div class="card-header">
        <h5 class="card-title">Agent Information Form</h5>
    </div>
    <div class="card-body content">
        <form>
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="agentName">Agent Name</label>
                    <input type="text" class="form-control" id="agentName" placeholder="Agent Name" value="<?php echo $agent_p[0]['aname'];?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Phone" value="<?php echo $agent_p[0]['phone'];?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $agent_p[0]['email'];?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="alternatePhone">Alternate Phone</label>
                    <input type="tel" class="form-control" id="alternatePhone" placeholder="Alternate Phone" value="<?php echo $agent_p[0]['phone2'];?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" rows="3" placeholder="Address"><?php echo $agent_p[0]['address'];?></textarea>
                </div>
                <div class="form-group col-sm-4">
                    <label for="gstin">GSTIN</label>
                    <input type="text" class="form-control" id="gstin" placeholder="GSTIN" value="<?php echo $agent_p[0]['gstin'];?>">
                </div>
            </div>
            <div class="form-group  row">
								<div class="col-md-4">
								<div class="form-group">
								  <label>Country</label>
								  <select class="form-control" name="country" id="country" onchange="get_details('country','state','<?php echo $base_url.'index.php?action=leads&query=get_details&type=state&id=';?>')">
									<option disabled="disabled" selected="selected" >-- Select --</option>
									<?php $country=$admin->get_country();
									foreach($country as $r => $v)
									{
										echo "<option value='".$country[$r]['id']."'>".$country[$r]['name']."</option>";
									}?>
								  </select>
								</div>
								</div>

								  <div class="col-md-4">
									<div class="form-group">
									  <label>State</label>
									 
									  <select class="form-control" name="state" id="state" onchange="get_details('state','city','<?php echo $base_url.'index.php?action=leads&query=get_details&type=city&id=';?>')"></select>
									  <span id="msgstate"></span> 
									</div>
								  </div>

								  <div class="col-md-3">
									<div class="form-g4oup">
									  <label>City</label>
									  <select class="form-control" name="city" id="city"></select>
									  <span id="msgcity"></span> 
									</div>
								  </div>

                               
                            </div>
                                
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="panNumber">Pan Number</label>
                    <input type="text" class="form-control" id="panNumber" placeholder="Pan Number" value="<?php echo $agent_p[0]['pan'];?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="companyDocument">Company Document(s)</label>
                    <input type="file" class="form-control" id="companyDocument" multiple>
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