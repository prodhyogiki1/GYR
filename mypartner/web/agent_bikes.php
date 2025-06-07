<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
          
    <div class="card-header">
        <h5 class="card-title">Bike Information Form</h5>
    </div>
    <div class="card-body content">
        <form>
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="agentName">Bike Company</label>
                    
                </div>
                <div class="form-group col-sm-4">
                    <label for="phone">Bike Model</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Phone" value="">
                </div>
                <div class="form-group col-sm-4">
                    <label for="email">Bike Color</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" value="">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="alternatePhone">Model year</label>
                    <input type="tel" class="form-control" id="alternatePhone" placeholder="Alternate Phone" value="">
                </div>
                <div class="form-group col-sm-4">
                    <label for="address">Accesories Details</label>
                    <textarea class="form-control" id="address" rows="3" placeholder="Address"></textarea>
                </div>
                <div class="form-group col-sm-4">
                    <label for="gstin">Bike Number</label>
                    <input type="text" class="form-control" id="gstin" placeholder="GSTIN" value="<?php echo $agent_p[0]['gstin'];?>">
                </div>
            </div>
           
            <div class="form-group row">
                
                <div class="form-group col-sm-4">
                    <label for="companyDocument">Bike Document(s)</label>
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