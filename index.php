<?php
include ('INCLUDES/connect.php');
include ('FUNCTIONS/common_function.php');

session_start();
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
    <!--CSS--->
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>

    <!-- HEADER -->

    <div class="container-fluid" p-0>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="./ASSETS/LOGO.png" alt="LOGO" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Account</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i
                                    class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Total price: <?php total_Cart_price(); ?></a>
                        </li>

                    </ul>

                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-dark" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
        <?php
        cart();
        ?>

        <!-- 2ND NAV -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">

                <?php
                if (!isset($_SESSION['username'])) {
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome Guest</a>
                    </li>";
                } else {
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome, " . $_SESSION['username'] . "!</a>
                    </li>";
                }

                if (!isset($_SESSION['username'])) {
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='./USERS_AREA/user_login.php'>Login</a>
                    </li>";
                } else {
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='./USERS_AREA/logout.php'>Logout</a>
                    </li>";
                }
                ?>

            </ul>
        </nav>

        <!-- GREETING -->
        <div class="greeting_section mt-3">
            <h3 class="text-center">Welcome to Buo!</h3>
            <p class="text-center">insert inspirational na quote dito ems</p>
        </div>

        <!-- ROW -->
        <div class="row">
            <div class="col-md-10">

                <!-- PRODUCTS SECTION-->
                <div class="row">

                    <?php
                    getproducts();
                    $ip = getIPAddress();
                    // echo 'User Real IP Address - '.$ip;
                    ?>

                </div>
            </div>

            <!-- SIDE NAV -->
            <div class="col-md-2 bg-body-tertiary p-0">
                <ul class="navbar-nav me-auto text-center">

                    <li class="nav-item bg-dark p-3">
                        <a href="#" class="nav-link text-light">
                            <h6>Categories</h6>
                        </a>
                    </li>

                    <?php
                    getcategories();
                    ?>

                </ul>
            </div>

        </div>
    </div>

    <?php
    include ('./INCLUDES/footer.php');
    ?>

    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>