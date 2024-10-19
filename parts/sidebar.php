<aside class="app-sidebar">
    <div class="app-sidebar__user">

        <img class="app-sidebar__user-avatar" src="site-assets/images/favicon.png" alt="User Image">

        <div>
            <p class="app-sidebar__user-name"><?php echo $user_name; ?></p>
            <p class="app-sidebar__user-designation">
                Online
            </p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon bi bi-speedometer"></i><span
                    class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Category</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="category_view.php"><i class="icon bi bi-circle-fill"></i> View
                        Categories</a>
                </li>
                <li><a class="treeview-item" href="category_add.php"><i class="icon bi bi-circle-fill"></i> Add
                        Category</a></li>
            </ul>
        </li>

    </ul>

</aside>