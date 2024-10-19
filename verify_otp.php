<?php
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Verify Code</title>
    <style>
    .otp-input {
        width: 3rem;
        height: 3rem;
        text-align: center;
        font-size: 1.5rem;
        margin-right: 0.5rem;
    }
    </style>

</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Verify OTP</h1>
        </div>
        <div class="login-box">
            <?php if (isset($_GET['resend'])) {
                echo "<div class='p-2 bg-success text-light'>4-Digit Code Sent!</div>";
            } ?>
            <form class="login-form" action="" method="post">
                <h5 class="login-head">Enter Your 4-Digit Code</h5>
                <p class="text-center">4-Digit Verification Code sent to<br>
                    <b><?php echo $email; ?></b>
                </p>

                <div class="d-flex justify-content-center mb-3">
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp1" name="otp1" required
                        autofocus>
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp2" name="otp2" required>
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp3" name="otp3" required>
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp4" name="otp4" required>
                </div>
                <div class="mb-3 btn-container d-grid">
                    <button name="submit" type="submit" class="btn btn-primary btn-block"><i
                            class="bi bi-box-arrow-in-right me-2 fs-5"></i>Verify OTP</button>
                </div>
                <div class="small text-center"><a href="verify_otp.php?email=<?php echo $email ?>&resend=1">Resend
                        OTP!</a>
                </div>
                <div class="small text-center"><a href="register.php">Want to change Email</a>
                </div>

            </form>



            <script>
            document.addEventListener("DOMContentLoaded", function() {
                const inputs = document.querySelectorAll(".otp-input");

                inputs.forEach((input, index) => {
                    input.addEventListener("input", (event) => {
                        if (input.value.length === 1 && index < inputs
                            .length - 1) {
                            inputs[index + 1].focus();
                        }
                    });

                    input.addEventListener("keydown", (event) => {
                        if (event.key === "Backspace" && input.value ===
                            "" && index > 0) {
                            inputs[index - 1].focus();
                        }
                    });
                });
            });
            </script>


            <?php
            require_once('parts/db.php');

            if (isset($_POST['submit'])) {

                $otp1 = $_POST['otp1'];
                $otp2 = $_POST['otp2'];
                $otp3 = $_POST['otp3'];
                $otp4 = $_POST['otp4'];

                $otp_code = $otp1 . $otp2 . $otp3 . $otp4;

                $select = "SELECT * FROM user WHERE user_email='$email'";
                $run = mysqli_query($conn, $select);
                if (mysqli_num_rows($run) > 0) {
                    $row_user =  mysqli_fetch_array($run);
                    $user_name = $row_user['user_name'];


                    $select_otp = "SELECT * FROM otp WHERE user_email='$email' and otp_code='$otp_code'";
                    $run_otp = mysqli_query($conn, $select_otp);
                    if (mysqli_num_rows($run_otp) > 0) {
                        $update_user = "UPDATE user SET user_verify='1' WHERE user_email='$email'";
                        $run_update = mysqli_query($conn, $update_user);
                        $delete_otp = "DELETE FROM otp WHERE user_email='$email'";
                        $run_delete = mysqli_query($conn, $delete_otp);



                        if ($update_user && $run_delete) {

                            //Send Welcome Email

                            // Load the email template
                            //  $template = file_get_contents('site-assets/email/welcome.html');

                            // Replace placeholders with actual data
                            $name = $user_name; // Dynamic data
                            $message = "Hi" . $user_name . ", Welcome to Website";

                            // Set the email headers
                            $to = $email;
                            $subject = 'Welcome to Foldious';
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "From: " . $admin_email . "\r\n";

                            // Send the email
                            if (mail($to, $subject, $message, $headers)) {
                                echo 'Email sent successfully!';
                            } else {
                                echo 'Email sending failed.';
                            }


                            echo "<script>window.open('login.php?verify=1','_self');</script>";
                        } else {
                            echo "<script>alert('Error!');</script>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'> No OTP Found</div>";
                    }
                } else {
                    echo "No Email Found";
                }
            }
            ?>

            <!--Resend OTP-->
            <?php
            if (isset($_GET['email']) and isset($_GET['resend'])) {
                $resend_email = $_GET['email'];
                $delete_previous_otp = "DELETE FROM otp where user_email='$resend_email'";
                $run_delete = mysqli_query($conn, $delete_previous_otp);

                //OTP CODE
                $new_otp_code = rand(1000, 9999);
                $insert_otp = "INSERT INTO otp(user_email,otp_code) VALUES('$resend_email','$new_otp_code');";
                $run_resend = mysqli_query($conn, $insert_otp);
                if ($run_resend ===  true) {

                    $to = $resend_email;
                    $subject = "YOUR OTP CODE IS " . $new_otp_code;
                    $txt = "YOUR OTP CODE IS " . $new_otp_code;
                    $headers = "From: support@foldious.com	";
                    if (@mail($to, $subject, $txt, $headers)) {
                        echo "OTP resend successfully";
                    }

                    //      echo "<script>window.open('verify_otp.php?email=$resend_email','_self');</script>";
                } else {
                    echo "<div class='alert alert-danger'>Something Went Wrong, Please refresh the page</div>";
                }
            }
            ?>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
    </script>
</body>

</html>