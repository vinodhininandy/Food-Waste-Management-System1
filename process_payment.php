<?php
include '../connection.php'; // Include your database connection file
include("connect.php");

// Start session


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve subscription details from the form
    $plan = $_POST['plan'];
    $amount = $_POST['amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Assuming the user is logged in and email is stored in session
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        // Insert subscription details into the database
        $sql = "INSERT INTO user_subscriptions (email, plan, amount, start_date, end_date) VALUES ('$email', '$plan', '$amount', '$start_date', '$end_date')";
        
        if (mysqli_query($connection, $sql)) {
            // Redirect to payment success page
            header("Location: payment_success.php");
            exit();
        } else {
            // Handle database insertion error
            echo "<h1>Error</h1>";
            echo "<p>There was an error processing your payment. Please try again.</p>";
            echo "<p>Error: " . mysqli_error($connection) . "</p>";
        }
    } else {
        // If the user is not logged in, redirect to the sign-in page
        header("Location: signin.php");
        exit();
    }
} else {
    // If the form is not submitted, redirect to subscription form
    header("Location: subscription.php");
    exit();
}
?>
