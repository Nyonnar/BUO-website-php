<?php

// include('./INCLUDES/connect.php');

function getproducts()
{
    global $_con;

    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM `products` WHERE category_id = $category_id ORDER BY RAND() LIMIT 0,3";
    } else {
        $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 0,3 ";
    }

    $result_query = mysqli_query($_con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $category_id = $row['category_id'];
        $product_price = $row['product_price'];
        echo "<div class='col-md-4 mb-3'>
        <div class='card'>
            <img src='./ADMIN/PRODUCT_IMAGES/$product_image1' class='card-img-top' alt='$product_image1'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>price: $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to cart</a>
                <a href='#' class='btn btn-outline-dark'>View more</a>
            </div>
        </div>
    </div>";
    }
}

function display_all_products()
{
    global $_con;

    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM `products` WHERE category_id = $category_id ORDER BY RAND()";
    } else {
        $select_query = "SELECT * FROM `products` ORDER BY RAND()";
    }

    $result_query = mysqli_query($_con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $category_id = $row['category_id'];
        $product_price = $row['product_price'];
        echo "<div class='col-md-4 mb-3'>
        <div class='card'>
            <img src='./ADMIN/PRODUCT_IMAGES/$product_image1' class='card-img-top' alt='$product_image1'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>price: $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to cart</a>
                <a href='#' class='btn btn-outline-dark'>View more</a>
            </div>
        </div>
    </div>";
    }
}


// function get_unique_categories(){
//     global $_con;

//     if(!isset($_GET['category'])){
//         $category_id=$_GET['category'];
//     $select_query = "SELECT * FROM `products` WHERE category_id=$category_id";
//     $result_query = mysqli_query($_con, $select_query);
//     while ($row = mysqli_fetch_assoc($result_query)) {
//         $product_id = $row['product_id'];
//         $product_title = $row['product_title'];
//         $product_description = $row['product_description'];
//         $product_image1 = $row['product_image1'];
//         $category_id = $row['category_id'];
//         $product_price = $row['product_price'];
//         echo " <div class='col-md-4 mb-3'>
//         <div class='card'>
//             <img src='./ADMIN/PRODUCT_IMAGES/$product_image1' class='card-img-top' alt='$product_image1'>
//             <div class='card-body'>
//                 <h5 class='card-title'>$product_title</h5>
//                 <p class='card-text'>$product_description</p>
//                 <a href='#' class='btn btn-dark'>Add to cart</a>
//                 <a href='#' class='btn btn-outline-dark'>View more</a>
//             </div>
//         </div>
//     </div>";
//          }
//     }
// }

function getcategories()
{
    global $_con;
    $select_categories = "SELECT * FROM `Categories`";
    $result_categories = mysqli_query($_con, $select_categories);
    while ($row_categories = mysqli_fetch_assoc($result_categories)) {
        $categories_title = $row_categories['category_title'];
        $categories_id = $row_categories['category_id'];
        echo "<li class='nav-item'><a href='index.php?category=$categories_id' class='nav-link'>$categories_title</a></li>";
    }
}

function search_product()
{
    global $_con;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE'%$search_data_value%'";

        $result_query = mysqli_query($_con, $search_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $category_id = $row['category_id'];
            $product_price = $row['product_price'];
            echo "<div class='col-md-4 mb-3'>
        <div class='card'>
            <img src='./ADMIN/PRODUCT_IMAGES/$product_image1' class='card-img-top' alt='$product_image1'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>price: $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to cart</a>
                <a href='#' class='btn btn-outline-dark'>View more</a>
            </div>
        </div>
    </div>";
        }
    }
}
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $_con;
        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];

        // Insert the item into the cart
        $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ('$get_product_id', '$ip', 1)";
        $result_insert = mysqli_query($_con, $insert_query);

        if ($result_insert) {
            echo "<script>alert('Item added to cart')</script>";
        }
    }
}

function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $_con;
        $ip = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
        $result_query = mysqli_query($_con, $select_query);
        $count_items = mysqli_num_rows($result_query);
    } else {
        global $_con;
        $ip = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
        $result_query = mysqli_query($_con, $select_query);
        $count_items = mysqli_num_rows($result_query);
    }
    echo $count_items;
}

function total_Cart_price()
{
    global $_con;
    $ip = getIPAddress();
    $total_price = 0;

    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
    $result_query = mysqli_query($_con, $cart_query);

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
        $result_products = mysqli_query($_con, $select_products);


        while ($row_product_price = mysqli_fetch_assoc($result_products)) {
            $product_price = $row_product_price['product_price'];
            $total_price += $product_price;
        }
    }

    echo $total_price;
}
?>