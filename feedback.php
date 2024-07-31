<?php

session_start();
include 'connection.php';

if (isset($_POST['feedback'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $msg = $_POST['message'];

    // Sanitize inputs
    $sanitized_email = mysqli_real_escape_string($connection, $email);
    $sanitized_name = mysqli_real_escape_string($connection, $name);
    $sanitized_msg = mysqli_real_escape_string($connection, $msg);

    // Prepare the query
    $query = "INSERT INTO user_feedback (name, email, message) VALUES ('$sanitized_name', '$sanitized_email', '$sanitized_msg')";

    // Execute the query
    if (mysqli_query($connection, $query)) {
        header("Location: contact.html");
    } else {
        echo '<script type="text/javascript">alert("Data not saved: ' . mysqli_error($connection) . '")</script>';
    }
}
?>
