<?php 
include('header.php');
require_once(dirname(__DIR__, 2) . '/mypartner/class/Website.php');
$website = new Website();

// Get search parameters
$pickup_location = isset($_GET['pickup_location']) ? $_GET['pickup_location'] : '';
$pickup_date = isset($_GET['pickup_date']) ? $_GET['pickup_date'] : '';
$return_date = isset($_GET['return_date']) ? $_GET['return_date'] : '';

// Get city name from ID
$location_name = '';
if(!empty($pickup_location)) {
    $city = $website->get_city($pickup_location);
    if(!empty($city)) {
        $location_name = $city[0]['name'];
    }
}
?>
<div class="page-fleets">
        <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Fleets Title Start -->
                <div class="fleets-title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <h1>Search Results For :</h1>
                    <span>
                        <?php 
                        $search_terms = [];
                        if(!empty($location_name)) $search_terms[] = "Location: " . htmlspecialchars($location_name);
                        if(!empty($pickup_date)) $search_terms[] = "Pickup: " . htmlspecialchars($pickup_date);
                        if(!empty($return_date)) $search_terms[] = "Return: " . htmlspecialchars($return_date);
                        echo !empty($search_terms) ? implode(' | ', $search_terms) : 'All Bikes';
                        ?>
                    </span>
                </div>
                <!-- Fleets Title End -->
            </div>
        
                <div class="col-lg-3">
                    <!-- Fleets Sidebar Start -->
                    <div class="fleets-sidebar wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <!-- Fleets Search Box Start -->
                        <div class="fleets-search-box">
                            <form id="fleetsForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" id="search" placeholder="Search..." required="">
                                    <button type="submit" class="section-icon-btn" fdprocessedid="1tijjh"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- Fleets Search Box End -->

                        <div class="fleets-sidebar-list-box">
                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>categories</h3>
                                </div>

                                <ul>
                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox1">
                                        <label class="form-check-label" for="checkbox1">sport cars</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox2">
                                        <label class="form-check-label" for="checkbox2">electric car</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox3">
                                        <label class="form-check-label" for="checkbox3">Convertible</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox4">
                                        <label class="form-check-label" for="checkbox4">luxury cars</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox5">
                                        <label class="form-check-label" for="checkbox5">sedan</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox6">
                                        <label class="form-check-label" for="checkbox6">coupe cars</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->

                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>pickup location</h3>
                                </div>

                                <ul>
                                    <?php 
                                    $cities = $admin->get_distinct_agent_cities();
                                    if(!empty($cities)) {
                                        foreach($cities as $index => $city) {
                                            $checkbox_id = 7 + $index;
                                            echo '<li class="form-check">';
                                            echo '<input class="form-check-input" type="checkbox" value="'.$city['id'].'" id="checkbox'.$checkbox_id.'" '.($pickup_location == $city['id'] ? 'checked' : '').'>';
                                            echo '<label class="form-check-label" for="checkbox'.$checkbox_id.'">'.$city['city'].'</label>';
                                            echo '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->

                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>dropoff location</h3>
                                </div>

                                <ul>
                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox11">
                                        <label class="form-check-label" for="checkbox11">abu dhabi</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox12">
                                        <label class="form-check-label" for="checkbox12">alain</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox13">
                                        <label class="form-check-label" for="checkbox13">dubai</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->
                        </div>                        
                    </div>
                    <!-- Fleets Sidebar End -->
                </div>
                
                <div class="col-lg-9">
                    <!-- Fleets Collection Box Start -->
                    <div class="fleets-collection-box">
                        <div class="row">
                            <?php 
                            // Get bikes from agent_bikes based on city filter or all
                            if(!empty($pickup_location)) {
                                $bikes = $website->get_agent_bikes_by_city($pickup_location);
                            } else {
                                $bikes = $website->get_all_agent_bikes();
                            }
                            if(!empty($bikes)) {
                                foreach($bikes as $bike) {
                            ?>
                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <?php if (!empty($bike['bike_image'])) { ?>
                                            <img src="<?php echo $web_url;?>images/<?php echo $bike['bike_image']; ?>" alt="<?php echo $bike['bike_name']; ?>">
                                        <?php } else { ?>
                                            <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 180px; background: #f0f0f0; font-size: 48px; color: #bbb;">
                                                <i class="fa fa-motorcycle"></i>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3><?php echo $bike['bike_brand']; ?></h3>
                                            <h2><?php echo $bike['bike_name']; ?></h2>
                                        </div>
                                        <!-- Perfect Fleets Content End -->

                                        <!-- Perfect Fleets Body Start -->
                                        <div class="perfect-fleet-body">
                                            <ul>
                                                <li><img src="images/icon-fleet-list-1.svg" alt="">Year: <?php echo htmlspecialchars($bike['year_manufecturing']); ?></li>
                                                <li><img src="images/icon-fleet-list-2.svg" alt="">Color: <?php echo htmlspecialchars($bike['color']); ?></li>
                                                <li><img src="images/icon-fleet-list-3.svg" alt="">Fuel: <?php echo htmlspecialchars($bike['fuel']); ?></li>
                                                <li><img src="images/icon-fleet-list-4.svg" alt="">Meter: <?php echo htmlspecialchars($bike['meter']); ?> km</li>
                                            </ul>
                                        </div>
                                        <!-- Perfect Fleets Body End -->

                                        <!-- Perfect Fleets Footer Start -->
                                        <div class="perfect-fleet-footer">
                                            <!-- Perfect Fleets Pricing Start -->
                                            <div class="perfect-fleet-pricing">
                                                <h2>₹<?php echo !empty($bike['price_per_km']) ? $bike['price_per_km'] : '0'; ?><span>/km</span></h2>
                                            </div>
                                            <!-- Perfect Fleets Pricing End -->

                                            <!-- Perfect Fleets Btn Start -->
                                            <div class="perfect-fleet-btn">
                                                <a href="<?php echo $web_url;?>pages/list_details.php?id=<?php echo $bike['id']; ?>" class="section-icon-btn"><img src="<?php echo $web_url;?>images/arrow-white.png" alt=""></a>
                                            </div>
                                            <!-- Perfect Fleets Btn End -->
                                        </div>
                                        <!-- Perfect Fleets Footer End -->
                                    </div>
                                    <!-- Perfect Fleets Content End -->
                                </div>
                                <!-- Perfect Fleets Item End -->
                            </div>
                            <?php 
                                }
                            } else {
                                echo '<div class="col-lg-12"><p>No bikes found for this location.</p></div>';
                            }
                            ?>
                        </div>
    
                            <div class="col-lg-12">
                                <!-- Fleets Pagination Start -->
                                <div class="fleets-pagination wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                    <ul class="pagination">
                                        <li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Fleets Pagination End -->
                            </div>
                        </div>
                    </div>
                    <!-- Fleets Collection Box End -->
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>