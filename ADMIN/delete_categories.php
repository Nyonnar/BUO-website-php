<?php

if (isset($_GET['delete_categories'])) {
    $delete_id = $_GET['delete_categories'];
    // echo $delete_id;

    $delete_category = "DELETE FROM `categories` WHERE category_id=$delete_id";
    $result_category = mysqli_query($_con, $delete_category);

    if ($result_category) {
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('./admin_index.php', '_self')</script>";
    }
}
?>