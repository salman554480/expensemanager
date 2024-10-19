<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Settings Form</title>
</head>
<?php
require_once('parts/db.php');
$select = "SELECT * FROM setting";
$run = mysqli_query($conn, $select);
$row = mysqli_fetch_array($run);
$website =  $row['website_name'];
$email =  $row['admin_email'];

?>

<body>
    <div class="container mt-5">
        <h2>Update Settings</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="website_name">Website Name</label>
                <input type="text" class="form-control" id="website_name" value="<?php echo $website; ?>"
                    name="website_name" required>
            </div>
            <div class="form-group">
                <label for="admin_email">Admin Email</label>
                <input type="email" class="form-control" id="admin_email" value="<?php echo $email ?>"
                    name="admin_email" required>
                <small class="text-secondary">All the Emails(welcome email, OTP code) will send from this email</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>
        <?php
        // update_settings.php
        require_once('parts/db.php');


        if (isset($_POST['website_name']) && isset($_POST['admin_email'])) {
            // Get form data
            $website_name = $conn->real_escape_string($_POST['website_name']);
            $admin_email = $conn->real_escape_string($_POST['admin_email']);

            // Update query
            $sql = "UPDATE setting  SET website_name = '$website_name', admin_email = '$admin_email' WHERE setting_id = 1"; // Adjust the WHERE clause as needed

            if ($conn->query($sql) === TRUE) {
                echo "Settings updated successfully.";
                echo "<script>window.open('setting.php','_self');</script>";
            } else {
                echo "Error updating settings: " . $conn->error;
            }
        }
        // Close connection
        $conn->close();
        ?>

    </div>
    <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>