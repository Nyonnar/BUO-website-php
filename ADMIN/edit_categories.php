<?php
if (isset($_GET['edit_categories'])) {
    $edit_id = $_GET['edit_categories'];
    // echo $edit_id;
    $get_data = "SELECT * FROM `categories` WHERE category_id=$edit_id";
    $result = mysqli_query($_con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $category_title = $row['category_title'];
    $category_id = $row['category_id'];
}
?>

<div class="container-mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" id="category_title" value="<?php echo $category_title ?>" name="category_title"
                class="form-control" required="required">
        </div>

        <div class="text-center">
            <input type="submit" name="edit_category" value="Update Category" class="btn btn-info px-3 mb-3">
        </div>
    </form>

</div>


<?php

if (isset($_POST['edit_category'])) {
    $category_title = $_POST['category_title'];


    if ($category_title == '') {
        echo "<script>alert('Check all the fields')</script>";
    } else {
        $update_category = "UPDATE `categories` SET category_title='$category_title'
        WHERE category_id=$edit_id";
        $result_update = mysqli_query($_con, $update_category);
        if ($result_update) {
            echo "<script>alert('Category updated sucessfully')</script>";
            echo "<script>window.open('./admin_index.php', '_self')</script>";
        }
    }
}
?>