<?php

include '../connection.php'; // Include your database connection file
include("connect.php");
if (!isset($_SESSION['email'])) {
    header("Location:signup.php");
    exit();
}

// Retrieve subscription plans from the database
$sql = "SELECT * FROM user_scriptions";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subscription Plans</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        h1 {
            text-align: center;
        }
        
        label {
            display: inline-block;
            margin-bottom: 10px;
        }
        
        select, input[type="number"], input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
<h1>Subscription Form</h1>
    <form id="subscriptionForm" action="payment.php" method="post">
        <label for="plan">Select Plan:</label>
        <select name="plan" id="plan">
            <option value="basic">Basic</option>
            <option value="standard">Standard</option>
            <option value="premium">Premium</option>
        </select><br><br>
        
        <label for="amount">Payment Amount:</label>
        <input type="number" name="amount" id="amount" required readonly><br><br>
        
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required><br><br>
        
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required readonly><br><br>
        
        <!-- Hidden input fields to store selected plan, payment amount, and start/end dates -->
        <input type="hidden" name="selected_plan" id="selected_plan">
        <input type="hidden" name="selected_amount" id="selected_amount">
        <input type="hidden" name="selected_start_date" id="selected_start_date">
        <input type="hidden" name="selected_end_date" id="selected_end_date">
        
        <input type="submit" value="Subscribe">
    </div>
    </form>

    <script>
        document.getElementById('plan').addEventListener('change', function() {
            var plan = this.value;
            var amountInput = document.getElementById('amount');
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');
            
            // Set start date to current date
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            startDateInput.value = today;

            // Set payment amount based on selected plan
            if (plan === 'basic') {
                amountInput.value = '1000';
            } else if (plan === 'standard') {
                amountInput.value = '2000';
            } else if (plan === 'premium') {
                amountInput.value = '3000';
            }

            // Calculate end date based on selected plan
            var duration;
            if (plan === 'basic') {
                duration = 30; // Basic plan is valid for 30 days
            } else if (plan === 'standard') {
                duration = 60; // Standard plan is valid for 60 days
            } else if (plan === 'premium') {
                duration = 90; // Premium plan is valid for 90 days
            }
            var endDate = new Date();
            endDate.setDate(endDate.getDate() + duration);
            var end_dd = String(endDate.getDate()).padStart(2, '0');
            var end_mm = String(endDate.getMonth() + 1).padStart(2, '0');
            var end_yyyy = endDate.getFullYear();
            endDateInput.value = end_yyyy + '-' + end_mm + '-' + end_dd;
            
            // Set hidden input fields with selected plan, amount, start date, and end date
            document.getElementById('selected_plan').value = plan;
            document.getElementById('selected_amount').value = amountInput.value;
            document.getElementById('selected_start_date').value = startDateInput.value;
            document.getElementById('selected_end_date').value = endDateInput.value;
        });
    </script>
        </div>
    <?php  ?>
</body>
</html>
