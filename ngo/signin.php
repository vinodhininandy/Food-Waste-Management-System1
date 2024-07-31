<?php
session_start();
// $connection = mysqli_connect("localhost:3307", "root", "");
// $db = mysqli_select_db($connection, 'food');
include '../connection.php';
$msg=0;
if (isset($_POST['sign'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sanitized_emailid =  mysqli_real_escape_string($connection, $email);
  $sanitized_password =  mysqli_real_escape_string($connection, $password);
  // $hash=password_hash($password,PASSWORD_DEFAULT);

  $sql = "select * from admin where email='$sanitized_emailid'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);
 
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($sanitized_password, $row['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['location'] = $row['location'];
        $_SESSION['Aid']=$row['Aid'];
        header("Location:home.html");
      } else {
        $msg = 1;
        // echo '<style type="text/css">
        // {
        //     .password input{
                
        //         border:.5px solid red;
                
                
        //       }

        // }
        // </style>';
        // echo "<h1><center> Login Failed incorrect password</center></h1>";
      }
    }
  } else {
    echo "<h1><center>Account does not exists </center></h1>";
  }




  // $query="select * from login where email='$email'and password='$password'";
  // $qname="select name from login where email='$email'and password='$password'";


  // if(mysqli_num_rows($query_run)==1)
  // {
  // //   $_SESSION['name']=$name;

  //   // echo "<h1><center> Login Sucessful  </center></h1>". $name['gender'] ;

  //   $_SESSION['email']=$email;
  //   $_SESSION['name']=$name['name'];
  //   $_SESSION['gender']=$name['gender'];
  //   header("location:home.html");

  // }
  // else{
  //   echo "<h1><center> Login Failed</center></h1>";
  // }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="formstyle.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    <script src="signin.js" defer></script>
    
   
    <title>Register</title>
</head>
<body>
    <div class="container">
        <form action="" id="form" method="post">
            <span class="title">Login</span>
            <br>
            <br>
            <!-- <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
                <div class="error"></div>
            </div> -->
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" >
                <div class="error"></div>
            </div>
            <!-- <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <div class="error"></div>
            </div> -->
            <label class="textlabel" for="password">Password</label>
             <div class="password">
              
                <input type="password" name="password" id="password" required/>
                <!-- <i class="fa fa-eye-slash" aria-hidden="true" id="showpassword"></i> -->
                <!-- <i class="bi bi-eye-slash" id="showpassword"></i>  -->
                <!-- <i class="uil uil-lock icon"></i> -->
                <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>                
                <?php
                    if($msg==1){
                        echo ' <i class="bx bx-error-circle error-icon"></i>';
                        echo '<p class="error">Password don\'t match.</p>';
                    }
                    ?> 
             </div>
      

            <!-- <div class="input-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword">
                <div class="error"></div>
            </div> -->
         
            <button type="submit" name="sign">Login</button>
            <div class="login-signup" >
                    <span class="text">Don't have an account?
                        <a href="signup.php" class="text login-link">Register</a>
                    </span>
                </div>
        </form>
    </div>
    <script src="login.js" ></script>
    <!-- <script src="../login.js"></script> -->
</body>
</html>