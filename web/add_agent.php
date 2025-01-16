<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               
    <div class="card-header">
        <h5 class="card-title">Agent Information Form</h5>
    </div>
    <div class="card-body content">
        <form>
        <hr>
            <h5>Contact Person Details</h5>
            <hr>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="agentName">First Name</label>
                    <input type="text" class="form-control" name="fname" placeholder="Agent First Name">
                </div>
                <div class="form-group col-sm-3">
                    <label for="agentName">Last Name</label>
                    <input type="text" class="form-control" name="lname" placeholder="Agent Last Name">
                </div>
                <div class="form-group col-sm-3">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" name="phone" placeholder="Phone">
                </div>
                <div class="form-group col-sm-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="alternatePhone">Designation</label>
                    <select name="designation" class="form-control" required>
                        <option selected="selected" disabled="disable">-Select</option>
                        <option value="1">Owner</option>
                        <option value="2">Partner</option>
                        <option value="3">Director</option>
                        <option value="4">Employee</option>
                        <option value="5">Other</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="alternatePhone">Alternate Phone</label>
                    <input type="tel" class="form-control" name="alternatePhone" placeholder="Alternate Phone">
                </div>
                
            </div>

            <hr>
            <h5>Business Details</h5>
            <hr>
                <div class="form-group  row">
                    
                      <div class="form-group col-sm-4">
                          <label for="address">Business Name</label>
                          <textarea class="form-control" name="bname" rows="3" placeholder="Business Name" required></textarea>
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
                    <input type="file" class="form-control" name="gstin" placeholder="GSTIN">
                </div>
            
                <div class="form-group col-sm-3">
                    <label for="panNumber">Pan Card</label>
                    <input type="file" class="form-control" name="pan" placeholder="Pan Number">
                </div>

                <div class="form-group col-sm-3">
                    <label for="companyDocument">Business Licence</label>
                    <input type="file" class="form-control" name="business_licence" multiple>
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