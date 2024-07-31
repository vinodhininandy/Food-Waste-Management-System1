<?php
// $connection = mysqli_connect("localhost:3307", "root", "");
// $db = mysqli_select_db($connection, 'food');
 include("connect.php"); 
if($_SESSION['name']==''){
	header("location:signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Document</title>
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
            <div class="logo-image">
                <!--<img src="images/logo.png" alt="">-->
            </div>

            <span class="logo_name">ADMIN</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <!-- <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Content</span>
                </a></li> -->
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
                <li><a href="#">
                    <i class="uil uil-user"></i>
                    <span class="link-name">Profile</span>
                </a></li>
                <li><a href="admin_subscription.php">
                    <i class="uil uil-bill"></i>
                    <span class="link-name">Subscription</span>
                </a></li>
                <li><a href="delivery.php">
                    <i class="uil uil-truck"></i>
                    <span class="link-name">Delivery</span>
                </a></li>
                <!-- <li><a href="#">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Share</span>
                </a></li> -->
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
            <!-- <p>Food Donate</p> -->
            <p  class ="logo" >Your <b style="color: #06C167; ">History </b></p>
             <p class="user"></p>
            <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div> -->
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <br>
        <br>
        <br>
        <div class="activity">
        <div class="table-container">
         
         <div class="table-wrapper">
         <table class="table">
        <thead>
        <tr>
            <th >Name</th>
            <th>food</th>
            <th>Category</th>
            <th>phoneno</th>
            <th>date/time</th>
            <th>address</th>
            <th>Quantity</th>
            <!-- <th>Action</th> -->
         
          
           
        </tr>
        </thead>
         <?php
          


          // Define the SQL query to fetch unassigned orders
          
          $sql = "SELECT * FROM food_donations WHERE assigned_to = 'Fid'";
          
          // Execute the query
          $result=mysqli_query($connection, $sql);
      
          
          // Check for errors
          if (!$result) {
              die("Error executing query: " . mysqli_error($conn));
          }
          
          // Fetch the data as an associative array
          $data = array();
          while ($row = mysqli_fetch_assoc($result)) {
              $data[] = $row;
          }
    
      
       ?> 
    
        </tbody>
        <?php foreach ($data as $row) { ?>
        <?php    echo "<tr><td data-label=\"name\">".$row['name']."</td><td data-label=\"food\">".$row['food']."</td><td data-label=\"category\">".$row['category']."</td><td data-label=\"phoneno\">".$row['phoneno']."</td><td data-label=\"date\">".$row['date']."</td><td data-label=\"Address\">".$row['address']."</td><td data-label=\"quantity\">".$row['quantity']."</td>";
?>
  <?php } ?>
    </table>
         </div>
                </div>
                
         
            
        </div>
            <!-- <P>Your history</P> -->

        

    </section>
    <script src="admin.js"></script>
</body>
</html>