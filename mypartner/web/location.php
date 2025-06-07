<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            
               
    <div class="card-header">
        <h5 class="card-title">Agent Information Form</h5>
    </div>
    <div class="card-body content">
        <form>
        <div class="row">
								<div class="col-md-3">
								<div class="form-group">
								  <label>Country</label>
								  <select class="form-control" name="country" id="country" onchange="get_details('country','state','<?php echo $base_url.'index.php?action=admin&query=get_details&type=state&id=';?>')">
									<option disabled="disabled" selected="selected" >-- Select --</option>
									<?php $country=$admin->get_country();
									foreach($country as $r => $v)
									{
										echo "<option value='".$country[$r]['id']."'>".$country[$r]['name']."</option>";
									}?>
								  </select>
								</div>
								</div>

								  <div class="col-md-3">
									<div class="form-group">
									  <label>State</label>
									 
									  <select class="form-control" name="state" id="state" onchange="get_details('state','city','<?php echo $base_url.'index.php?action=admin&query=get_details&type=city&id=';?>')"></select>
									  <span id="msgstate"></span> 
									</div>
								  </div>

								  <div class="col-md-3">
									<div class="form-group">
									  <label>City</label>
									  <select class="form-control" name="city" id="city"></select>
									  <span id="msgcity"></span> 
									</div>
								  </div>
            
            <div class="col-md-3"><button type="submit" class="btn btn-primary">Submit</button></div>
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