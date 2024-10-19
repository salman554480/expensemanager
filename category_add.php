<?php require_once('parts/top.php'); ?>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php require_once('parts/sidebar.php'); ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-wallet"></i> Add Income Category</h1>
                <!-- <p>Start a beautiful journey here</p> -->
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form action="" action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category Name</label>
                                        <input class="form-control" type="text" name="category_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category Type</label>
                                        <select class="form-control" name="category_type">
                                            <option value="income">Income</option>
                                            <option value="expense">Expense</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category Image (Optional)</label>
                                        <input class="form-control" type="file" name="category_image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <input class="btn btn-success" type="submit" name="submit">
                                </div>
                            </div>
                        </form>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {



                            // Collect form data
                            $category_name = $_POST['category_name'];
                            $category_type = $_POST['category_type'];

                            // Handle file upload
                            $target_dir = "uploads/"; // Specify your upload directory
                            $category_image = basename($_FILES["category_image"]["name"]);

                            if ($category_image == "") {
                                $category_image = "default.jpg";
                            }


                            $sql = "INSERT INTO category (category_name, category_type,category_image) VALUES ('$category_name','$category_type', '$category_image')";

                            // Execute the query
                            if (mysqli_query($conn, $sql)) {
                                echo "<div class='p-1 bg-success text-white'>Record Inserted</div>";
                                move_uploaded_file($_FILES["category_image"]["tmp_name"], "uploads/$category_image");
                                echo "<script>
                                    setTimeout(function() {
                                        window.open('category_add.php', '_self');
                                    }, 2000);
                                </script>";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }


                            // Close the connection
                            $conn->close();
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once('parts/footer.php'); ?>