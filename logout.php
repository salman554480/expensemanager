<?php
session_start();
require_once('parts/db.php');
echo "<script>window.open('login.php','_self');</script>";
session_destroy();