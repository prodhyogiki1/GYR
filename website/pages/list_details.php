
    <?php 
    include('header.php'); 
    require_once(dirname(__DIR__, 2) . '/mypartner/class/Website.php');
    $website = new Website();
    $bike_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $bike = $bike_id ? $website->get_agent_bike_by_id($bike_id) : null;
    ?>
<div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Feets Single Sidebar Start -->
                    <div class="fleets-single-sidebar">
                        <div class="fleets-single-sidebar-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <!-- Feets Single Sidebar Pricing Start -->
                             <?php if (!empty($bike['bike_image'])) { ?>
                                <img src="<?php echo $web_url;?>images/<?php echo $bike['bike_image']; ?>" alt="<?php echo $bike['bike_name']; ?>">
                            <?php } else { ?>
                               <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 220px; background: #f0f0f0; font-size: 64px; color: #bbb; margin-bottom: 24px;">
                            <i class="fa fa-motorcycle"></i>
                        </div>
                            <?php } ?>

                            <div class="fleets-single-sidebar-pricing">
                                <h2  class="text-success">₹ <?php echo $bike['price_per_km']; ?><span>/ par day</span></h2>
                                <h5 class="text-info">₹ <?php echo $bike['per_day_km']; ?><span>/ par day km runing limit</span></h5>
                                <h6 class="text-warning">₹ <?php echo $bike['security_deposit']; ?><span> Security Deposite</span></h6>
                            </div>
                            <!-- Feets Single Sidebar Pricing End -->

                            <!-- Feets Single Sidebar List Start -->
                            <div class="fleets-single-sidebar-list">
                                <ul>
                                    <li><img src="images/icon-fleets-single-sidebar-list-1.svg" alt="">Brand <span><?php echo $bike['brand']; ?></span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-2.svg" alt="">Year Manufecturing <span><?php echo $bike['year_manufecturing']; ?></span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-3.svg" alt="">Color <span><?php echo $bike['color']; ?></span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-4.svg" alt="">Fuel <span><?php echo $bike['fuel']; ?></span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-5.svg" alt="">Insurence <span><?php echo $bike['insurence']; ?></span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-6.svg" alt="">KM Runing <span><?php echo $bike['meter']; ?></span></li>
                                </ul>
                            </div>
                            <!-- Feets Single Sidebar List End -->

                            <!-- Feets Single Sidebar Btn Start -->
                            <div class="fleets-single-sidebar-btn">
                                <a href="#bookingform" class="btn-default popup-with-form">book now</a>
                                <span>or</span>
                                <a href="#" class="wp-btn"><i class="fa-brands fa-whatsapp"></i></a>                                
                            </div>
                            <!-- Feets Single Sidebar Btn End -->
                        </div>

                        <!-- Booking Form Box Start -->
                        <div class="booking-form-box">
                            <!-- Booking PopUp Form Start -->
                            <?php include('booking_form.php'); ?>
                            <!-- Booking PopUp Form End -->
                        </div>
                        <!-- Booking Form Box End -->
                    </div>
                    <!-- Feets Single Sidebar End -->
                </div>

                <div class="col-lg-8">
                    <!-- Feets Single Content Start -->
                    <div class="fleets-single-content">
                        <!-- Feets Single Slider Start -->
                        <div class="fleets-single-slider">
                            <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                                <div class="swiper-wrapper" id="swiper-wrapper-228c2f6d510e83341" aria-live="off" style="transition-duration: 1000ms; transform: translate3d(-2469px, 0px, 0px);"></div>

                       

                        <!-- Feets Information Start -->
                        <div class="fleets-information">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">general information</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">Know about <span class="text-danger"><?php echo $bike['bike_name']; ?></span></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">Lorem pretium fermentum quam, sit amet cursus ante sollicitudin velen morbi consesua the miss sustion consation porttitor orci sit amet iaculis nisan. Lorem pretium fermentum quam sit amet cursus ante sollicitudin velen fermen morbinetion consesua the risus consequation the porttiton.</p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Feets Information List Start -->
                            <div class="fleets-information-list wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                <ul>
                                    <li>24/7 Roadside Assistance</li>
                                    <li>Free Cancellation &amp; Return</li>
                                    <li>Rent Now Pay When You Arrive</li>
                                </ul>
                            </div>
                            <!-- Feets Information List End -->
                        </div>
                        <!-- Feets Information End -->

                        <!-- Feets Amenities Start -->
                        <div class="fleets-amenities">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">amenities</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">Premium amenities and features</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Feets Amenities List Start -->
                            <div class="fleets-amenities-list wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                                <ul>
                                    <li>music system</li>
                                    <li>toolkit</li>
                                    <li>abs system</li>
                                    <li>bluetooth</li>
                                    <li>full boot space</li>
                                    <li>usb charger</li>
                                    <li>aux input</li>
                                    <li>spare tyre</li>
                                    <li>power steering</li>
                                    <li>power windows</li>
                                </ul>
                            </div>
                            <!-- Feets Amenities List End -->
                        </div>
                        <!-- Feets Amenities End -->

                        <!-- Rental Conditions Faqs Start -->
                        <div class="rental-conditions-faqs">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">rental conditions</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">Policies and agreement</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Rental Conditions FAQ Accordion Start -->
                            <div class="rental-condition-accordion" id="rentalaccordion">
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                    <h2 class="accordion-header" id="rentalheading1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#rentalcollapse1" aria-expanded="true" aria-controls="rentalcollapse1" fdprocessedid="ib4tg">
                                            Driver's License Requirements
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse1" class="accordion-collapse collapse show" aria-labelledby="rentalheading1" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                                    <h2 class="accordion-header" id="rentalheading2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rentalcollapse2" aria-expanded="false" aria-controls="rentalcollapse2" fdprocessedid="jq9ax">
                                            Insurance and Coverage policy
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse2" class="accordion-collapse collapse" aria-labelledby="rentalheading2" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                    <h2 class="accordion-header" id="rentalheading3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rentalcollapse3" aria-expanded="false" aria-controls="rentalcollapse3" fdprocessedid="3un9l">
                                            Available payment Methods
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse3" class="accordion-collapse collapse" aria-labelledby="rentalheading3" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">
                                    <h2 class="accordion-header" id="rentalheading4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rentalcollapse4" aria-expanded="false" aria-controls="rentalcollapse4" fdprocessedid="bupjev">
                                            Cancellation and Modification policy
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse4" class="accordion-collapse collapse" aria-labelledby="rentalheading4" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                                    <h2 class="accordion-header" id="rentalheading5">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rentalcollapse5" aria-expanded="false" aria-controls="rentalcollapse5" fdprocessedid="qm8rvc">
                                            Smoking and Pet Policies
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse5" class="accordion-collapse collapse" aria-labelledby="rentalheading5" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s" style="visibility: visible; animation-delay: 1.25s; animation-name: fadeInUp;">
                                    <h2 class="accordion-header" id="rentalheading6">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rentalcollapse6" aria-expanded="false" aria-controls="rentalcollapse6" fdprocessedid="ywqv35">
                                            The minimum age Requirements
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse6" class="accordion-collapse collapse" aria-labelledby="rentalheading6" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                            </div>
                            <!-- Rental Conditions FAQ Accordion End -->
                        </div>
                        <!-- Rental Conditions Faqs End -->
                    </div>
                    <!-- Feets Single Content End -->
                </div>
            </div>
        </div>

            <?php include('footer.php'); ?>
