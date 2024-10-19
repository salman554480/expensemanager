<?php
session_start();
if (isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];
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
    <title>Update Password</title>
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
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Update Password</h1>
        </div>
        <div class="login-box">
            <form class="login-form" action="" method="post">
                <h3 class="login-head"><i class="bi bi-person me-2"></i>Enter Password</h3>

                <div class="mb-3">
                    <label class="form-label">PASSWORD</label>
                    <input class="form-control" id="inputPassword" name="new_password" type="password"
                        placeholder="Create a password" oninput="checkPasswordStrength()">
                </div>
                <div class="progress my-2">
                    <div id="passwordStrengthBar" class="progress-bar" role="progressbar" style="width: 0%;"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small id="passwordStrengthText" class="form-text text-muted"></small>
                <div class="mb-3 btn-container d-grid">
                    <button name="submit" type="submit" class="btn btn-primary btn-block"><i
                            class="bi bi-box-arrow-in-right me-2 fs-5"></i>Update Password</button>
                </div>
            </form>


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
            require_once('parts/db.php');

            if (isset($_POST['submit'])) {

                $new_password = $_POST['new_password'];

                $select = "SELECT * FROM user WHERE user_email='$user_email'";
                $run = mysqli_query($conn, $select);
                if (mysqli_num_rows($run) > 0) {

                    $update_user = "UPDATE user SET user_password='$new_password' WHERE user_email='$user_email'";
                    $run_update = mysqli_query($conn, $update_user);
                    if ($run_update) {
                        echo "<div class='alert alert-success my-2'> <strong>Congratulations!</strong> Your Account Has Been Recoverd, please login <a class='btn bt-danger btn-sm' href='login.php'>Login</a></div>";
                    } else {
                        echo "<script>alert('Error!');</script>";
                    }
                } else {
                    echo "No Email Found";
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