<?php
include '../connection.php';
$msg = 0;
if (isset($_POST['sign'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $location = $_POST['district'];

    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "select * from delivery_persons where email='$email'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        echo "<h1><center>Account already exists</center></h1>";
    } else {
        $query = "insert into delivery_persons(name,email,password,city) values('$username','$email','$pass','$location')";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            header("location:deliverylogin.php");
        } else {
            echo '<script type="text/javascript">alert("Data not saved")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="deliverycss.css">
</head>
<body>
    <div class="center">
        <h1>Register</h1>
        <form method="post" action="" id="form">
            <div class="txt_field">
                <input type="text" name="username" required/>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id="password" required/>
                <span></span>
                <label>Password</label>
                <div class="error" id="password-error"></div>
            </div>
            <div class="txt_field">
                <input type="email" name="email" required/>
                <span></span>
                <label>Email</label>
            </div>
            <div>
                <select id="district" name="district">
                    <option value="chennai">Chennai</option>
                    <option value="Karaikal">Karaikal</option>
                    <option value="Villupuram">Villupuram</option>
                    <option value="Pondicherry">Pondicherry</option>
                </select>
            </div>
            <input type="submit" name="sign" value="Register">
            <div class="signup_link">
                Already a member? <a href="deliverylogin.php">Sign in</a>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('password-error');
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

            if (!passwordPattern.test(password)) {
                event.preventDefault();
                passwordError.textContent = 'Password must be at least 8 characters long and contain at least one letter and one number.';
            } else {
                passwordError.textContent = '';
            }
        });
    </script>
</body>
</html>
