<?php
// Start session and include database connection
session_start();
include("connect.php"); 

// Check if the admin is logged in
if (!isset($_SESSION['name'])) {
    header("location:signin.php");
    exit();
}

// Fetch delivery details from the database
$sql = "SELECT fd.Fid AS Fid, fd.name AS food_donor_name, fd.phoneno, fd.date, fd.address AS pickup_address, 
               ad.name AS delivery_person_name, ad.address AS delivery_address, fd.delivery_by
        FROM food_donations fd
        LEFT JOIN admin ad ON fd.assigned_to = ad.Aid 
        WHERE fd.assigned_to IS NOT NULL AND fd.delivery_by IS NOT NULL";

$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin - Delivery Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .table-container {
            width: 90%;
            margin: 20px auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            min-width: 400px;
        }

        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        table th,
        table td {
            padding: 12px 15px;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image"></div>
            <span class="logo_name">ADMIN</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="analytics.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
                <li><a href="donate.php">
                    <i class="uil uil-heart"></i>
                    <span class="link-name">Donates</span>
                </a></li>
                <li><a href="feedback.php">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Feedbacks</span>
                </a></li>
                
                <li><a href="admin_subscription.php">
                    <i class="uil uil-bill"></i>
                    <span class="link-name">Subscription</span>
                </a></li>
                <li><a href="delivery.php">
                    <i class="uil uil-truck"></i>
                    <span class="link-name">Delivery</span>
                </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="../logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <p class="logo">Delivery <b style="color: #06C167;">Details</b></p>
        </div>

        <div class="activity">
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Donor Name</th>
                                <th>Phone No</th>
                                <th>Date/Time</th>
                                <th>Pickup Address</th>
                                <th>Delivery Address</th>
                                <th>Delivery Person</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['Fid'] . "</td>";
                                    echo "<td>" . $row['food_donor_name'] . "</td>";
                                    echo "<td>" . $row['phoneno'] . "</td>";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td>" . $row['pickup_address'] . "</td>";
                                    echo "<td>" . $row['delivery_address'] . "</td>";
                                    echo "<td>" . $row['delivery_person_name'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No deliveries found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="admin.js"></script>
</body>
</html>

<?php
mysqli_close($connection);
?>
