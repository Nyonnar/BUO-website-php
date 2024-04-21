<?php
include ('../INCLUDES/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--BOOTSTRAP CSS--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FONTAWESOME LINK-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <title>Admin</title>
</head>

<body>

    <div class="container-fluid p-0">
        <!-- NAV -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="../ASSETS/LOGO.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Welcome guest</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- HEADER GREETING -->
        <div class="greeting">
            <h3 class="text-center p-2">Manage details</h3>
        </div>

        <!-- BUTTONS -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 align-items-center">

                <div>
                    <p class="text-light text-center">Admin</p>
                </div>

                <div class="button text-center">
                    <button><a href="insert_products.php" class="nav-link text-dark bg-white my-2">Insert
                            products</a></button>
                    <button><a href="admin_index.php?view_products" class="nav-link text-dark bg-white my-2">View
                            products</a></button>
                    <button><a href="admin_index.php?insert_category" class="nav-link text-dark bg-white my-2">Insert
                            categories</a></button>
                    <button><a href="admin_index.php?view_categories" class="nav-link text-dark bg-white my-2">View
                            categories</a></button>
                    <button><a href="admin_index.php?list_orders" class="nav-link text-dark bg-white my-2">All
                            orders</a></button>
                    <button><a href="#" class="nav-link text-dark bg-white my-2">Verified users</a></button>
                    <button><a href="#" class="nav-link text-dark bg-white my-2">Logout</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <?php
        if (isset($_GET['insert_category'])) {
            include ('insert_categories.php');
        }
        if (isset($_GET['view_products'])) {
            include ('view_products.php');
        }
        if (isset($_GET['edit_products'])) {
            include ('edit_products.php');
        }
        if (isset($_GET['delete_products'])) {
            include ('delete_products.php');
        }
        if (isset($_GET['view_categories'])) {
            include ('view_categories.php');
        }
        if (isset($_GET['edit_categories'])) {
            include ('edit_categories.php');
        }
        if (isset($_GET['delete_categories'])) {
            include ('delete_categories.php');
        }
        if (isset($_GET['list_orders'])) {
            include ('list_orders.php');
        }
        ?>
    </div>


    <?php
    include ('../INCLUDES/footer.php');
    ?>


    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>