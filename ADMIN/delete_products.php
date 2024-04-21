<?php

if (isset($_GET['delete_products'])) {
    $delete_id = $_GET['delete_products'];
    // echo $delete_id;

    $delete_product = "DELETE FROM `products` WHERE product_id=$delete_id";
    $result_product = mysqli_query($_con, $delete_product);

    if ($result_product) {
        echo "<script>alert('Product deleted successfully')</script>";
        echo "<script>window.open('./admin_index.php', '_self')</script>";
    }
}
?>