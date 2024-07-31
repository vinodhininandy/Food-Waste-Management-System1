<?php
include 'connection.php';

session_start();

if (isset($_POST['sign'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM login WHERE email='$email'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        echo "<h1><center>Account already exists</center></h1>";
    } else {
        $query = "INSERT INTO login(name,email,password,gender) VALUES('$username','$email','$pass','$gender')";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            header("location:signin.php");
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
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="regform">
            <form action="" method="post" id="form">
                <p class="logo">Food Donate</p>
                <p id="heading">Create your account</p>
                
                <div class="input">
                    <label class="textlabel" for="name">User name</label><br>
                    <input type="text" id="name" name="name" required/>
                </div>
                <div class="input">
                    <label class="textlabel" for="email">Email</label>
                    <input type="email" id="email" name="email" required/>
                </div>
                
                <label class="textlabel" for="password">Password</label>
                <div class="password">
                    <input type="password" name="password" id="password" required/>
                    <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>                
                    <div class="error" id="password-error"></div>
                </div>
                
                <div class="radio">
                    <input type="radio" name="gender" id="male" value="male" required/>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female">Female</label>
                </div>
                
                <div class="btn">
                    <button type="submit" name="sign">Continue</button>
                </div>
                
                <div class="signin-up">
                    <p style="font-size: 20px; text-align: center;">Already have an account? <a href="signin.php">Sign in</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('password-error');
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // At least 8 characters, one letter, and one number

            if (!passwordPattern.test(password)) {
                event.preventDefault();
                passwordError.textContent = 'Password must be at least 8 characters long and contain at least one letter and one number.';
            } else {
                passwordError.textContent = '';
            }
        });

        const togglePassword = document.querySelector('#showpassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('uil-eye');
            this.classList.toggle('uil-eye-slash');
        });
    </script>
</body>
</html>
