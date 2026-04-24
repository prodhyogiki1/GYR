<form id="bookingform" class="white-popup-block mfp-hide booking-form" novalidate="true">
                                <div class="section-title">
                                    <h2>Reserve your <?php echo $bike['bike_name']; ?> today!</h2>
                                    <p>Fill out the form below to reserve your vehicle. Complete the necessary details to ensure a smooth rental experience.</p>
                                </div>                                
                                <fieldset>
                                    <div class="row">
                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="name" class="booking-form-control" id="name" placeholder="Full Name" required="">
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="email" name="email" class="booking-form-control" id="email" placeholder="Enter Your Email" required="">
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="phone" class="booking-form-control" id="phone" placeholder="Enter Your Number" required="">
                                            <div class="help-block with-errors"></div>
                                        </div>                                        

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <select name="cartype" class="booking-form-control form-select" id="cartype" required="">
                                                <option value="" disabled="" selected="">Choose Car Type</option>
                                                <option value="sport_car">sport car</option>
                                                <option value="convertible_car">convertible car</option>
                                                <option value="sedan_car">sedan car</option>
                                                <option value="luxury_car">luxury car</option>
                                                <option value="electric_car">electric car</option>
                                                <option value="coupe_car">coupe car</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <select name="location" class="booking-form-control form-select" id="pickuplocation" required="">
                                                <option value="" disabled="" selected="">Pick Up Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="dubai">dubai</option>
                                                <option value="sharjah">sharjah</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" placeholder="PickUp Date" class="booking-form-control datepicker hasDatepicker" id="pickupdate" required="">
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <select name="droplocation" class="booking-form-control form-select" id="droplocation" required="">
                                                <option value="" disabled="" selected="">Drop Off Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="sharjah">sharjah</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" class="booking-form-control datepicker hasDatepicker" id="returndate" placeholder="Return Date" required="">
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-12 mb-4">
                                            <textarea name="msg" class="booking-form-control" id="msg" rows="3" placeholder="Write Your Message" required=""></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-12 booking-form-group">
                                            <button type="submit" class="btn-default disabled">rent now</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                        </div>
                                    </div>                                    
                                </fieldset>
                            </form>