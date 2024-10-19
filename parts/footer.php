<nav class="bottom-nav">
        <a href="dashboard.php" class="nav-item"><i
                    class="app-menu__icon bi bi-house-door"></i> <br> Home</a>
        <a href="<?php echo $base_url;?>/folder.php?folder_key=<?php echo $get_folder_key;?>" class="nav-item"><i
                    class="app-menu__icon bi bi-folder"></i> <br> Drive</a>
        <a href="<?php echo $base_url;?>/counter.php?folder_key=<?php echo $get_folder_key;?>" class="nav-item upload-button">
            <i class="app-menu__icon bi bi-upload"></i>
        </a>
        <a href="<?php echo $base_url;?>/usage.php" class="nav-item"><i
                    class="app-menu__icon bi bi-pie-chart"></i> <br> Usage</a>
        <a href="<?php echo $base_url;?>/wallet.php" class="nav-item"><i
                    class="app-menu__icon bi bi-safe"></i> <br> Wallet</a>
    </nav>


<!-- Private Vault Modal Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
     <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Private Vault</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="input-group mb-3 w-100">
                            <input type="text" name="folder_password" class="form-control" placeholder="Enter Vault Key">
                            <button class="btn btn-success" name="create-vault" type="submit"
                                id="button-addon2">Create</button>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
  </div>
</div>
<?php
    require_once('parts/db.php');
                if (isset($_POST['create-vault'])) {
                    $folder_password = $_POST['folder_password'];
                    $new_vault_key = mt_rand(999999, 99999999);
                    $insert_vault = "INSERT INTO folder(user_id,folder_key,folder_name,parent_id,folder_password) VALUES('$user_id','$new_vault_key','Vault','100000000','$folder_password')";
                    $run_insert_vault = mysqli_query($conn, $insert_vault);
                    if ($run_insert_vault === true) {
                        echo "<script>window.open('dashboard.php','_self');</script>";
                    } else {
                        echo "<script>alert('Folder not created');</script>";
                    }
                }
                ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fab = document.getElementById('fab');
    const fabMenu = document.getElementById('fabMenu');

    fab.addEventListener('click', function() {
        const isVisible = fabMenu.style.display === 'flex';
        fabMenu.style.display = isVisible ? 'none' : 'flex';
    });
});
</script>
<div class="fab-container">
    <button class="fab" id="fab">
        <span class="fab-icon">+</span>
    </button>
    <div class="fab-menu" id="fabMenu">
        <a href="counter.php?folder_key=<?php echo $get_folder_key;?>" class="fab-menu-item" id="upload">
            <span class="fab-icon">⬆️</span>
        </a>
        <a href="folder.php?folder_key=<?php echo $get_folder_key;?>" class="fab-menu-item" id="drive">
            <span class="fab-icon">📁</span>
        </a>
        <a href="profile.php" class="fab-menu-item" id="settings">
            <span class="fab-icon">⚙️</span>
        </a>
    </div>
</div>
<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- Page specific javascripts-->

</body>

</html>

