<?php
include '../connection.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve subscription details from the form
    $plan = $_POST['selected_plan'];
    $amount = $_POST['selected_amount'];
    $start_date = $_POST['selected_start_date'];
    $end_date = $_POST['selected_end_date'];
} else {
    // If the form is not submitted, redirect to subscription form
    header("Location: subscription.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 10px 0;
        }
        .button {
            display: flex;
            justify-content: center;
        }
        .button input {
            padding: 10px 20px;
            border: none;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .button input:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Confirmation</h1>
        <div class="details">
            <p><strong>Selected Plan:</strong> <?php echo ucfirst($plan); ?></p>
            <p><strong>Payment Amount:</strong> $<?php echo $amount; ?></p>
            <p><strong>Start Date:</strong> <?php echo $start_date; ?></p>
            <p><strong>End Date:</strong> <?php echo $end_date; ?></p>
        </div>
        <form action="process_payment.php" method="post">
            <input type="hidden" name="plan" value="<?php echo $plan; ?>">
            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
            <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
            <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
            <div class="button">
                <input type="submit" value="Confirm Payment">
            </div>
        </form>
    </div>
</body>
</html>
