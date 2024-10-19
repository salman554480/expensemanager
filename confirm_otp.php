<?php
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
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
            <h1>Vali</h1>
        </div>
        <div class="login-box">
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

                    $select_otp = "SELECT * FROM otp WHERE user_email='$email' and otp_code='$otp_code'";
                    $run_otp = mysqli_query($conn, $select_otp);
                    if (mysqli_num_rows($run_otp) > 0) {
                        $delete_confirm_otp = "DELETE FROM otp where user_email='$email'";
                        $run_delete_confirm_otp =  mysqli_query($conn, $delete_confirm_otp);
                        $_SESSION['email'] = $email;
                        echo "<script>window.open('update_password.php','_self');</script>";
                    } else {
                        echo "<div class='alert alert-danger'> No OTP Found</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'> No Email Found</div>";
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