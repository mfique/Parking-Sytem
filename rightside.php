<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with Dynamic Content</title>
    <link rel="stylesheet" href="rightside.css">
    <style>
        .default-content {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .dashboard ul {
            list-style-type: none;
            padding: 0;
        }
        body{
            font-family:sans-serif;
        }

        .dashboard ul li a {
            display: block;
            margin-bottom:19px;
            font-size: 14px;
            text-decoration: none;
            color: #fff;
            background-color: black;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            font-family:sans-serif;
                   
        }

        .dashboard ul li a:hover {
           opacity:0.6;
        }
        
    </style>
</head>
<body>
    <div class="dashboard">
        <h1 class="text-align: center;">CAR<span style="color: #051c3e;">PARK</span></h1>
        <ul><li><a href="?page=admin_dashboard">Dashboard</a></li>
            <li><a href="?page=manage_categories">Manage Categories</a></li>
            <li><a href="?page=add_vehicle">Add Vehicle</a></li>
            <li><a href="?page=manage_vehicles">Manage Vehicles</a></li>
            <li><a href="?page=generate_reports">Generate Reports</a></li>
            <li><a href="?page=search_vehicle">Search Vehicle</a></li>
            <li><a href="?page=update_profile">Update Profile</a></li>
            <li><a href="?page=change_password">Change Password</a></li>
        
        </ul>
    </div>

    <div class="main-content">
    <?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'manage_categories':
            include 'manage_categories.php';
            break;
        case 'add_vehicle':
            include 'add_vehicle.html';
            break;
        case 'manage_vehicles':
            include 'manage_vehicles.php';
            break;
        case 'generate_reports':
            include 'generate_reports.php';
            break;
        case 'search_vehicle':
            include 'search_vehicle.php';
            break;
        case 'update_profile':
            include 'update_profile.html';
            break;
        case 'change_password':
            include 'change_password_admin.html';
            break;
        default:
            include 'admin_dashboard.html';
    }
} else {
    include 'admin_dashboard.html';;
}
?>

    </div>
</body>
</html>
