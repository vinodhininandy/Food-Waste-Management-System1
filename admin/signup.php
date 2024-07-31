<?php
session_start();
include '../connection.php';

if (isset($_POST['sign'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $location = $_POST['district'];
    $address = $_POST['address'];

    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM admin WHERE email='$email'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $_SESSION['message'] = "Account already exists";
    } else {
        $query = "INSERT INTO admin(name, email, password, location, address) VALUES('$username', '$email', '$pass', '$location', '$address')";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            $_SESSION['message'] = "Registration successful!";
            header("Location: signin.php");
            exit();
        } else {
            $_SESSION['message'] = "Data not saved";
        }
    }
    header("Location: signup.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formstyle.css">
    <script src="signin.js" defer></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        body {
            background: #d8ecec;
            background-attachment: fixed;
            margin: 0;
            font-family: 'Poppins', sans-serif; 
        }

        #form {
            width: 400px;
            margin: 6vh auto 0 auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: rgb(27, 26, 26);
        }

        #form button {
            background-color: black;
            color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding: 10px;
            margin: 20px 0px;
            cursor: pointer;
            font-size: 20px;
            width: 100%;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .text {
            color: #333;
            font-size: 14px;
        }

        a.text {
            color: #021060;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .input-group input,
        select,
        textarea {
            border-radius: 5px;
            font-size: 20px;
            margin-top: 5px;
            padding: 10px;
            border: .5px solid #63707E;
        }

        .input-group input:focus {
            outline: 0;
        }

        .input-group .error {
            color: rgb(242, 18, 18);
            font-size: 16px;
            margin-top: 5px;
        }

        .input-group.success input {
            border-color: #0f0260;
        }

        .login-signup {
            text-align: center;
        }

        .form .login-signup {
            margin-top: 30px;
            text-align: center;
        }

        select {
            width: 100%;
        }

        .input-group.error input {
            border-color: rgb(206, 67, 67);
        }

        .title {
            position: relative;
            font-size: 27px;
            font-weight: 600;
        }

        .title::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            background-color: #601502;
            border-radius: 25px;
        }

        .input-field i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 23px;
            transition: all 0.2s ease;
        }

        .password {
            position: relative;
        }

        .password input {
            width: 100%;
            font-size: 20px;
            border: .5px solid #63707E;
            border-radius: 6px;
            padding: 14px 15px;
            box-sizing: border-box;
            margin: 8px 0px 15px;
            color: black;
        }

        .fa-eye-slash,
        .bi,
        .uil {
            position: absolute;
            top: 28%;
            right: 4%;
            cursor: pointer;
        }

        .uil {
            top: 50%;
            bottom: 4%;
            transform: translateY(-50%);
            color: #595757;
            font-size: 23px;
            transition: all 0.2s ease;
        }

        .error {
            display: flex;
            align-items: center;
            margin-top: 6px;
            font-size: 14px;
            font-weight: 400;
            color: #d93025;
        }

        @media (max-width: 767px) {
            #form {
                width: 290px;
                margin: 40px auto;
                background-color: #fff;
                border-radius: 8px;
                padding: 30px;
            }
        }

        .logo {
            margin: 0;
            text-align: center;
            font-size: 22px;
            color: black;
        }

        .image-radio-group input[type="radio"] {
            display: none;
        }

        .image-radio-group label {
            display: inline-block;
            cursor: pointer;
        }

        .image-radio-group label img {
            border: 2px solid transparent;
        }

        .image-radio-group input[type="radio"]:checked + label img {
            border-color: rgb(46, 44, 44);
            border-radius: 10px;
        }

        .image-radio-group img {
            width: 125px;
            height: 125px;
        }
    
        .error {
            color: red;
            font-size: 12px;
        }
        .message {
            color: green;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post" id="form">
            <span class="title">Register</span>
            <br><br>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="message">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
            ?>
            <div class="input-group">
                <label for="username">Name</label>
                <input type="text" id="username" name="username" required/>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required/>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <div class="password">
                    <input type="password" name="password" id="password" required/>
                    <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>
                    <div class="error" id="password-error"></div>
                </div>
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <div class="input-field">
                <select id="district" name="district" style="padding:10px; padding-left: 20px;">
                    <option value="chennai">Chennai</option>
                    <option value="karaikal">Karaikal</option>
                    <option value="Villupuram">Villupuram</option>
                    <option value="Pondicherry">Pondicherry</option>
                </select>
            </div>
            <button type="submit" name="sign">Register</button>
            <div class="login-signup">
                <span class="text">Already a member?
                    <a href="signin.php" class="text login-link">Login Now</a>
                </span>
            </div>
        </form>
    </div>
    <br><br>
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
