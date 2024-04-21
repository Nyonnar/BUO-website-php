<?php
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    // echo $edit_id;
    $get_data = "SELECT * FROM `products` WHERE product_id=$edit_id";
    $result = mysqli_query($_con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $product_price = $row['product_price'];

    $select_category = "SELECT * FROM `categories` WHERE category_id=$category_id";
    $result_category = mysqli_query($_con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $categories_title = $row_category["category_title"];
}
?>

<div class="container-mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title ?>" name="product_title"
                class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" id="product_description" value="<?php echo $product_description ?>"
                name="product_description" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" value="<?php echo $product_keywords ?>" name="product_keywords"
                class="form-control" required="required">
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" class="form-select">

                <option value="<?php echo $categories_title ?>"><?php echo $categories_title ?></option>
                <?php
                $select_category_all = "SELECT * FROM `categories`";
                $result_category_all = mysqli_query($_con, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_id = $row_category_all["category_id"];
                    $category_title = $row_category_all["category_title"];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>


        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">image 1</label>
            <input type="file" id="product_image1" name="product_image1" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">image 2</label>
            <input type="file" id="product_image2" name="product_image2" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" id="product_price" value="<?php echo $product_price ?>" name="product_price"
                class="form-control" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
        </div>


    </form>

</div>


<?php

if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];

    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];

    if (
        $product_title == '' or $product_description == '' or $product_keywords == '' or
        $product_category == '' or $product_price == '' or $product_image1 == '' or $product_image2 == ''
    ) {
        echo "<script>alert('Check all the fields')</script>";
    } else {
        move_uploaded_file($temp_image1, "./PRODUCT_IMAGES/$product_image1");
        move_uploaded_file($temp_image2, "./PRODUCT_IMAGES/$product_image2");

        $update_product = "UPDATE `products` SET product_title='$product_title',
        product_description='$product_description', product_keywords='$product_keywords',
        category_id='$product_category', product_image1='$product_image1', 
        product_image2='$product_image2', product_price='$product_price', date=NOW()
        WHERE product_id=$edit_id";
        $result_update = mysqli_query($_con, $update_product);
        if ($result_update) {
            echo "<script>alert('Product updated sucessfully')</script>";
            echo "<script>window.open('./admin_index.php?view_products', '_self')</script>";
        }
    }
}
?>