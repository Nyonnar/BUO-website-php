<?php
include('INCLUDES/connect.php');
include('FUNCTIONS/common_function.php');

session_start();

if (isset($_POST['update'])) {
    global $_con;
    $ip = getIPAddress();
    $quantities = $_POST['qty'];

    foreach ($quantities as $product_id => $qty) {
        // Check if quantity is zero
        if ($qty == 0) {
            echo "<script>alert(\"You can't have 0 quantity\");</script>";
            continue; // Skip updating database for this product
        }

        // Update cart for non-zero quantities
        $update_cart = "UPDATE `cart_details` SET quantity='$qty' WHERE ip_address='$ip' AND product_id='$product_id'";
        $result_product_quantities = mysqli_query($_con, $update_cart);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./style.css">
    <style>
        .cart_img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }
    </style>
</head>

<body>

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
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Total price: <?php total_Cart_price();?></a>
                        </li>

                    </ul>

                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
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
                if(!isset($_SESSION['username'])){
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome Guest</a>
                    </li>";
                }else{
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome".$_SESSION['username']."</a>
                    </li>";
                }

                if(!isset($_SESSION['username'])){
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='./USERS_AREA/user_login.php'>Login</a>
                    </li>";
                }else{
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
            <p class="text-center">Insert inspirational quote here</p>
        </div>

        <div class="container">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product title</th>
                            <th>Product image</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Total price</th>
                            <th>Remove</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $_con;
                        $ip = getIPAddress();
                        $total_price = 0;

                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
                        $result_query = mysqli_query($_con, $cart_query);

                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $product_id = $row['product_id'];
                            $quantity = $row['quantity'];

                            $select_product = "SELECT * FROM `products` WHERE product_id='$product_id'";
                            $result_product = mysqli_query($_con, $select_product);

                            if ($result_product && mysqli_num_rows($result_product) > 0) {
                                $product = mysqli_fetch_assoc($result_product);
                                $product_title = $product['product_title'];
                                $product_image = $product['product_image1'];
                                $product_price = $product['product_price'];

                                $total_product_price = $product_price * $quantity;
                                $total_price += $total_product_price;
                                ?>
                                <tr>
                                    <td><?php echo $product_title; ?></td>
                                    <td><img src="./ASSETS/<?php echo $product_image; ?>" class="cart_img"></td>
                                    <td><input type="text" name="qty[<?php echo $product_id; ?>]" value="<?php echo ($quantity > 1) ? $quantity : 1; ?>" class="form-control w-50"></td>
                                    <td><?php echo $product_price; ?></td>
                                    <td><?php echo $total_product_price; ?></td>
                                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id?>"></td>
                                    <td>
                                        <input type="submit" value="Update" class="btn btn-outline-warning" name="update">
                                        <input type="submit" value="Remove" class="btn btn-outline-danger" name="remove">
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>

            <?php
            function remove_cart_item(){
                global $_con;
                if(isset($_POST['remove'])){
                    foreach($_POST['removeitem'] AS $remove_id){
                        echo $remove_id;
                        $delete_query="DELETE FROM `cart_details` WHERE product_id=$remove_id";
                        $run_delete=mysqli_query($_con, $delete_query);
                        if($run_delete){
                            echo "<script>window.open('cart.php', '_self')</script>";
                        }
                    }
                }
            }

            echo $remove_item=remove_cart_item();
            ?>

            <div class="d-flex">
                <h4 class="px-3 text-dark">Subtotal: <?php echo $total_price; ?></h4>
                <a href="index.php"><button class="px-3 btn btn-outline-dark">Continue shopping</button></a>
                <a href="./USERS_AREA/checkout.php"><button class="mx-3 px-4 btn btn-dark">Check out</button></a>
            </div>
        </div>
    </div>

</div>

<?php
include('./INCLUDES/footer.php');
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>