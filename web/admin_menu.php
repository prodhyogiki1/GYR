<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
data-sidebar-position="fixed" data-header-position="fixed">
<!------- menu start --------->
<aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar" data-simplebar>
        <div class="d-flex mb-4 align-items-center justify-content-between">
            <a href="index.html" class="text-nowrap logo-img ms-0 ms-md-1">
            <img src="<?php echo $base_url;?>theme/assets/images/logos/logo.jpeg" width="100" alt="">   
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="mb-4 pb-2">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link primary-hover-bg"
                href="<?php echo $base_url.'index.php?action=dashboard&page=dashboard';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-primary rounded-3">
                  <i class="ti ti-layout-dashboard fs-7 text-primary"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Dashboard</span>
              </a>
            </li>


            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
              <span class="hide-menu">Agent(s)</span>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link warning-hover-bg"
                href="<?php echo $base_url.'index.php?action=dashboard&page=add_agent';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-warning rounded-3">
                  <i class="ti ti-user fs-7 text-warning"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Add Agents</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link warning-hover-bg"
                href="<?php echo $base_url.'index.php?action=dashboard&page=viewall_agent';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-warning rounded-3">
                  <i class="ti ti-article fs-7 text-warning"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">View All Agents</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link danger-hover-bg"
                href="<?php echo $base_url.'index.php?action=dashboard&page=location';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-danger rounded-3">
                  <i class="ti ti-location fs-7 text-danger"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Location</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link success-hover-bg"
                href="<?php echo $base_url.'index.php?action=dashboard&page=bikes';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-success rounded-3">
                  <i class="ti ti-bike fs-7 text-success"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Bikes</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link primary-hover-bg"
                href="<?php echo $base_url.'index.php?action=dashboard&page=support_tickets';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-primary rounded-3">
                  <i class="ti ti-file-description fs-7 text-primary"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Support Tickets</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link indigo-hover-bg"
                href="<?php echo $base_url.'index.php?action=dashboard&page=reviews';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-indigo rounded-3">
                  <i class="ti ti-typography fs-7 text-indigo"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Review(s)</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link success-hover-bg"
                href="<?php echo $base_url.'index.php?action=dashboard&page=bookings';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-success rounded-3">
                  <i class="ti ti-mood-happy fs-7 text-success"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Booking(s)</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link warning-hover-bg"
                href="<?php echo $base_url.'logout.php';?>"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-warning rounded-3">
                  <i class="ti ti-login fs-7 text-warning"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Logout</span>
              </a>
            </li>
            
            
           
          </ul>
       

          <div class="mt-5 blocks-card sidebar-ad">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://prodhyogiki.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">Prodhyogiki</a></p>
          </div>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>

    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
     