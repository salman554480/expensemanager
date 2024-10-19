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
                <h1><i class="bi bi-wallet"></i> Add Expense Category</h1>
                <!-- <p>Start a beautiful journey here</p> -->
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form action="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category Name</label>
                                        <input class="form-control" type="email" name="icategory_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category Image</label>
                                        <input class="form-control" type="file" name="icategory_image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <input class="btn btn-success" type="submit" name="submit">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once('parts/footer.php'); ?>