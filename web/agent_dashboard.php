<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Agent Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            bottom: 0;
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.5s;
        }
        .sidebar.open {
            left: 0;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            padding: 10px;
            border-bottom: 1px solid #444;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.5s;
        }
        .content.open {
            margin-left: 0;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f7f7f7;
            padding: 20px;
            border-bottom: none;
        }
        .card-body {
            padding: 30px;
        }
        .toggle-button {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 100;
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 10px;
        }
        .menu-icon {
            width: 24px;
            height: 24px;
            background-image: url('menu-icon.png');
            background-size: contain;
            background-repeat: no-repeat;
        }
        .menu-icon.open {
            background-image: url('close-icon.png');
        }
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <button class="toggle-button">
        <span class="menu-icon"></span>
    </button>
    <div class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Bookings</a></li>
            <li><a href="#">Payments</a></li>
            <li><a href="#">Bikes</a></li>
            <li><a href="#">Reports</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h2>Agent Dashboard</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>New Bookings</h5>
                    </div>
                    <div class="card-body">
                        <h1>10</h1>
                        <p>Today</p>
                        <p>20</p>
                        <p>This Week</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Running Bookings</h5>
                    </div>
                    <div class="card-body">
                        <h1>20</h1>
                        <p>Currently Active</p>
                        <p>5</p>
                        <p>Pending Pickup</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <h5>Payments</h5>
        </div>
        <div class="card-body">
            <h1>$1000</h1>
            <p>Total Payments</p>
            <p>$500</p>
            <p>Pending Payments</p>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <h5>Bikes</h5>
        </div>
        <div class="card-body">
            <h1>50</h1>
            <p>Total Bikes</p>
            <p>20</p>
            <p>Available Bikes</p>
        </div>
    </div>
</div>
</div>
</div>
<script>
    const toggleButton = document.querySelector('.toggle-button');
    const menuIcon = document.querySelector('.menu-icon');
    const sidebar = document.querySelector('.sidebar');
    const content = document.querySelector('.content');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        content.classList.toggle('open');
        menuIcon.classList.toggle('open');
    });
</script>
</body>
</html>