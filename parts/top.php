<?php session_start();
require_once('parts/db.php');

if (!isset($_SESSION['user_email'])) {
    // echo "no session";
    echo "<script>window.open('login.php','_self');</script>";
} else {
    $user_email = $_SESSION['user_email'];

    $select_user = "SELECT * FROM user WHERE user_email='$user_email' ";
    $run_user = mysqli_query($conn, $select_user);
    $row_user = mysqli_fetch_array($run_user);

    $user_id = $row_user['user_id'];
    $user_email = $row_user['user_email'];
    $user_name = $row_user['user_name'];
    $user_password = $row_user['user_password'];
    $user_created_at = $row_user['created_at'];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Discover reliable Digital World solutions with flexible plans to suit any need.">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.foldious.com/site-assets/images/favicon.png" />
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@foldious">
    <meta property="twitter:creator" content="@foldious">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Foldious">
    <meta property="og:title" content="Foldious - Digital World">
    <meta property="og:url" content="https://www.foldious.com/">
    <meta property="og:image" content="https://www.foldious.com/site-assets/images/favicon.png">
    <meta property="og:description"
        content="Discover reliable Digital World solutions with flexible plans to suit any need.">
    <title>Foldious - Digital World</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">