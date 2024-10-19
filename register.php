<?php session_start();
require_once('parts/db.php');
$select = "SELECT * FROM setting";
$run = mysqli_query($conn, $select);
$row = mysqli_fetch_array($run);
$website =  $row['website_name'];
$admin_email =  $row['admin_email'];

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo $website; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet"
        href="site-assets/register-assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css" />

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="site-assets/register-assets/css/style.css" />
    <style>
    .progress-bar {
        transition: width 0.5s ease;
    }

    .password-container {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }
    </style>


</head>

<body>
    <div class="wrapper">
        <div class="image-holder">
            <img src="site-assets/register-assets/images/cloud.jpg" alt="" />
        </div>
        <div class="form-inner">
            <form class="login-form" action="" method="post">
                <div class="form-header">
                    <h3>Sign up</h3>
                    <img src="site-assets/register-assets/images/sign-up.png" alt="" class="sign-up-icon" />
                </div>
                <div class="form-group">
                    <label for="">Full Name:</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="">E-mail:</label>
                    <input type="text" name="email" class="form-control" data-validation="email" id="email" />
                    <span id="email-error" style="color: white; display: none;"></span>
                </div>
                <div class="form-group">
                    <label for="">Password:</label>
                    <input type="password" class="form-control" name="password" data-validation="length"
                        data-validation-length="min8" />
                </div>



                <button name="submit" type="submit">create my account</button>
                <div class="socials">
                    <a href="login.php">
                        <p>Already Have Account? Login</p>
                    </a>
                    <!-- <a href="" class="socials-icon">
              <i class="zmdi zmdi-facebook"></i>
            </a>
            <a href="" class="socials-icon">
              <i class="zmdi zmdi-instagram"></i>
            </a>
            <a href="" class="socials-icon">
              <i class="zmdi zmdi-twitter"></i>
            </a>
            <a href="" class="socials-icon">
              <i class="zmdi zmdi-tumblr"></i>
            </a> -->
                </div>
            </form>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>
            const disallowedDomains = ['rambler.ru', 'tempmail.com', 'yopmail.com',
                'mailinator.com'
            ]; // Add more as needed

            const emailInput = document.getElementById('email');
            const errorMessage = document.getElementById('email-error');

            emailInput.addEventListener('input', function() {
                const emailValue = emailInput.value;
                const emailDomain = emailValue.split('@')[1];

                if (emailDomain && disallowedDomains.includes(emailDomain)) {
                    errorMessage.innerText = 'Please use a valid email address.';
                    errorMessage.style.display = 'block';
                    emailInput.value = "";
                } else {
                    errorMessage.style.display = 'none'; // Clear error message
                }
            });
            </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>
            function checkPasswordStrength() {
                const password = document.getElementById('inputPassword').value;
                const strengthBar = document.getElementById('passwordStrengthBar');
                const strengthText = document.getElementById('passwordStrengthText');
                let strength = 0;

                if (password.length > 7) strength += 20;
                if (password.match(/[a-z]+/)) strength += 20;
                if (password.match(/[A-Z]+/)) strength += 20;
                if (password.match(/[0-9]+/)) strength += 20;
                if (password.match(/[\W_]+/)) strength += 20;

                strengthBar.style.width = strength + '%';
                strengthBar.setAttribute('aria-valuenow', strength);

                if (strength <= 40) {
                    strengthBar.classList.remove('bg-success', 'bg-warning');
                    strengthBar.classList.add('bg-danger');
                    strengthText.textContent = 'Weak';
                } else if (strength <= 80) {
                    strengthBar.classList.remove('bg-success', 'bg-danger');
                    strengthBar.classList.add('bg-warning');
                    strengthText.textContent = 'Medium';
                } else {
                    strengthBar.classList.remove('bg-warning', 'bg-danger');
                    strengthBar.classList.add('bg-success');
                    strengthText.textContent = 'Strong';
                }
            }
            </script>

            <?php
      // Ensure this file contains your mysqli connection setup

      if (isset($_POST['submit'])) {
        // Retrieve form data

        $user_name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);


        // Check if email already exists
        $select = "SELECT * FROM user WHERE user_email='$email'";
        $run = mysqli_query($conn, $select);

        if (mysqli_num_rows($run) > 0) {
          echo "<div class='alert alert-danger'> Email Already Exist</div>";
        } else {


          // Insert data into database
          $insert = "INSERT INTO user (user_name, user_email, user_password) VALUES ('$user_name', '$email', '$password')";

          if (mysqli_query($conn, $insert)) {

            $delete_otp = "DELETE FROM otp WHERE user_email='$email'";
            $run_delete = mysqli_query($conn, $delete_otp);

            //OTP CODE
            $otp_code = rand(1000, 9999);
            $insert_otp = "INSERT INTO otp(user_email,otp_code) VALUES('$email','$otp_code');";
            mysqli_query($conn, $insert_otp);


            $message = "Your OTP Code is" . $otp_code;

            $to = $email;
            $subject = "4-Digit Code";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: ' . $admin_email . "\r\n";
            if (mail($email, $subject, $message, $headers)) {
              echo "mail sent";
            } else {
              echo "not sent";
            }



            $_SESSION['email'] = $email;
            echo "<script>window.open('verify_otp.php','_self');</script>";
          } else {
            echo "Error: " . mysqli_error($conn);
          }
        }
      }
      ?>
        </div>
    </div>

    <script src="site-assets/register-assets/js/jquery-3.3.1.min.js"></script>
    <script src="site-assets/register-assets/js/jquery.form-validator.min.js"></script>
    <script src="site-assets/register-assets/js/main.js"></script>
</body>
<!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>