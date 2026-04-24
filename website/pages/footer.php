 <!-- Footer Start -->
    <footer class="main-footer bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- About Footer Start -->
                     <div class="about-footer">
                        <!-- Footer Logo Start -->
                        <div class="footer-logo">
                            <img src="<?php echo $base_url.'theme/assets/images/'.$company[0]['logo'];?>" alt="">
                        </div>
                        <!-- Footer Logo End -->

                        <!-- About Footer Content Start -->
                         <div class="about-footer-content">
                            <p>Experience the ease and convenience of renting a bike with GetYourRide. </p>
                         </div>
                        <!-- About Footer Content End -->
                     </div>
                    <!-- About Footer End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Quick Links Start -->
                    <div class="footer-links footer-quick-links">
                        <h3>legal policy</h3>
                        <ul>                            
                            <li><a href="#">term & condition</a></li>
                            <li><a href="#">privacy policy</a></li>
                            <li><a href="#">legal notice</a></li>
                            <li><a href="#">accessibility</a></li>
                        </ul>
                    </div>
                    <!-- Footer Quick Links End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Menu Start -->
                    <div class="footer-links footer-menu">
                        <h3>quick links</h3>
                        <ul>                            
                            <li><a href="<?php echo $web_url;?>#">home</a></li>
                            <li><a href="<?php echo $web_url;?>#">about us</a></li>
                            <li><a href="<?php echo $web_url;?>#">cars</a></li>
                            <li><a href="<?php echo $web_url;?>#">services</a></li>
                        </ul>
                    </div>
                    <!-- Footer Menu End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Newsletter Start -->
                    <div class="footer-newsletter">
                        <h3>Subscribe to the Newsleeters</h3>
                        <!-- Footer Newsletter Form Start -->
                        <div class="footer-newsletter-form">
                            <form id="newslettersForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control"  id="mail" placeholder="Email ..." required>
                                    <button type="submit" class="section-icon-btn"><img src="<?php echo $web_url;?>images/arrow-white.svg" alt=""></button>
                                </div>
                            </form>
                        </div>
                        <!-- Footer Newsletter Form End -->
                    </div>
                    <!-- Footer Newsletter End -->
                </div>
            </div>

            <!-- Footer Copyright Section Start -->
            <div class="footer-copyright">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7">
                        <!-- Footer Copyright Start -->
                        <div class="footer-copyright-text">
                            <p>© <?php echo date('Y');?> Get Your Ride. All rights reserved.</p>
                        </div>
                        <!-- Footer Copyright End -->
                    </div>

                    <div class="col-lg-6 col-md-5">
                        <!-- Footer Social Link Start -->
                        <div class="footer-social-links">
                            <ul>
                                <li><a href="<?php echo $web_url;?>#"><i class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="<?php echo $web_url;?>#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="<?php echo $web_url;?>#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="<?php echo $web_url;?>#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="<?php echo $web_url;?>#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <!-- Footer Social Link End -->
                    </div>
                </div>
            </div>
            <!-- Footer Copyright Section End -->
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Jquery Library File -->
    <script src="<?php echo $web_url;?>js/jquery-3.7.1.min.js"></script>
    <!-- Jquery Ui Js File -->
    <script src="<?php echo $web_url;?>js/jquery-ui.js"></script>
    <!-- Bootstrap js file -->
    <script src="<?php echo $web_url;?>js/bootstrap.min.js"></script>
    <!-- Validator js file -->
    <script src="<?php echo $web_url;?>js/validator.min.js"></script>
    <!-- SlickNav js file -->
    <script src="<?php echo $web_url;?>js/jquery.slicknav.js"></script>
    <!-- Swiper js file -->
    <script src="<?php echo $web_url;?>js/swiper-bundle.min.js"></script>
    <!-- Counter js file -->
    <script src="<?php echo $web_url;?>js/jquery.waypoints.min.js"></script>
    <script src="<?php echo $web_url;?>js/jquery.counterup.min.js"></script>
    <!-- Magnific js file -->
    <script src="<?php echo $web_url;?>js/jquery.magnific-popup.min.js"></script>
    <!-- SmoothScroll -->
    <script src="<?php echo $web_url;?>js/SmoothScroll.js"></script>
    <!-- Parallax js -->
    <script src="<?php echo $web_url;?>js/parallaxie.js"></script>
    <!-- MagicCursor js file -->
    <script src="<?php echo $web_url;?>js/gsap.min.js"></script>
    <script src="<?php echo $web_url;?>js/magiccursor.js"></script>
    <!-- Text Effect js file -->
    <script src="<?php echo $web_url;?>js/SplitText.js"></script>
    <script src="<?php echo $web_url;?>js/ScrollTrigger.min.js"></script>
    <!-- YTPlayer js File -->
    <script src="<?php echo $web_url;?>js/jquery.mb.YTPlayer.min.js"></script>
    <!-- Wow js file -->
    <script src="<?php echo $web_url;?>js/wow.js"></script>
    <!-- Main Custom js file -->
    <script src="<?php echo $web_url;?>js/function.js"></script>
    <!-- Select2 js -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function(){
        var hasLocation = <?php echo !empty($_SESSION['location_id']) ? 'true' : 'false'; ?>;
        if (!hasLocation) {
            $.ajax({
                url: '<?php echo $base_url; ?>api/index.php',
                type: 'POST',
                data: JSON.stringify({action: 'api', page: 'served_location'}),
                contentType: 'application/json',
                success: function(data){
                    var options = '<option value="">Select Location</option>';
                    if (data.success && data.response && data.response.length > 0) {
                        data.response.forEach(function(loc){
                            options += '<option value="' + loc.id + '">' + loc.city + '</option>';
                        });
                    } else {
                        options = '<option value="">No locations available</option>';
                    }
                    $('#locationSelect').html(options);
                    $('#locationSelect').select2({
                        dropdownParent: $('#locationModal'),
                        width: '100%'
                    });
                    $('#locationModal').modal({backdrop: 'static', keyboard: false});
                    $('#locationModal').modal('show');
                },
                error: function(xhr, status, error){
                    $('#locationSelect').html('<option value="">Error loading locations</option>');
                    $('#locationSelect').select2({
                        dropdownParent: $('#locationModal'),
                        width: '100%'
                    });
                    $('#locationModal').modal({backdrop: 'static', keyboard: false});
                    $('#locationModal').modal('show');
                }
            });
        }
        $('#locationSelect').on('change', function(){
            var id = $(this).val();
            var text = $('#locationSelect option:selected').text();
            if (id) {
                $('#selectedLocationText').text(text);
                $.post('<?php echo $base_url; ?>set_location.php', {id: id}, function(response){
                    $('#locationModal').modal('hide');
                });
            }
        });
    });
    </script>
	
    <!-- Location Modal -->
    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background-image: url('<?php echo $web_url; ?>images/location.jpg'); background-size: cover; background-position: center;">
                <div class="modal-body" style="background: rgba(255,255,255,0.9); padding: 2rem;">
                    <h5 class="text-center mb-3">Select Your Location</h5>
                    <select id="locationSelect" class="form-control" style="width: 100%;">
                        <option value="">Loading...</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

</body>
</html>