<?php
include '../connection.php'; // Include your database connection file
include("connect.php");

// Start the session


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

        // Check if the email exists in the admin table
        $checkEmailSql = "SELECT email FROM admin WHERE email = ?";
        $stmt = $connection->prepare($checkEmailSql);

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Email exists in the admin table, proceed to insert subscription
                $stmt->close();
                
                // Insert subscription details into the database
                $insertSql = "INSERT INTO user_subscriptions (email, plan, amount, start_date, end_date) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = $connection->prepare($insertSql);
                if ($insertStmt) {
                    $insertStmt->bind_param('ssdss', $email, $plan, $amount, $start_date, $end_date);

                    if ($insertStmt->execute()) {
                        // Redirect to payment success page with payment details
                        header("Location: payment_success.php?email=$email&plan=$plan&amount=$amount&start_date=$start_date&end_date=$end_date");
                        exit();
                    } else {
                        // Handle database insertion error
                        echo "<h1>Error</h1>";
                        echo "<p>There was an error processing your payment. Please try again.</p>";
                        echo "<p>Error: " . $insertStmt->error . "</p>";
                    }
                    $insertStmt->close();
                } else {
                    echo "<h1>Error</h1>";
                    echo "<p>There was an error preparing the statement. Please try again.</p>";
                }
            } else {
                // Handle case where email does not exist in admin table
                echo "<h1>Error</h1>";
                echo "<p>Your email is not registered as an admin. Please contact support.</p>";
            }
            $stmt->close();
        } else {
            echo "<h1>Error</h1>";
            echo "<p>There was an error preparing the statement. Please try again.</p>";
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
