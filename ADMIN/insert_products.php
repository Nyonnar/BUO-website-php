<?php
include ('../INCLUDES/connect.php');

if (isset($_POST['insert_products'])) {
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_categories = $_POST['product_categories'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];

    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];

    if ($product_title == '' or $description == '' or $product_keywords == '' or $product_categories == '' or $product_price == '' or $product_image1 == '' or $product_image2 == '') {
        echo "<script>alert('please fill all the fields')</script>";
        exit();
    } else {

        move_uploaded_file($temp_image1, "./PRODUCT_IMAGES/$product_image1");
        move_uploaded_file($temp_image2, "./PRODUCT_IMAGES/$product_image2");

        $insert_products = "INSERT INTO `products`(product_title, product_description, product_keywords, category_id, product_image1, product_image2, product_price, date, status) values('$product_title', '$description', '$product_keywords', '$product_categories', '$product_image1', '$product_image2', '$product_price', NOW(), '$product_status')";
        $result_query = mysqli_query($_con, $insert_products);
        if ($result_query) {
            echo "<script>alert('product added')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($_con) . "')</script>"; // Display MySQL error if query fails
        }
    }
}
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
    <title>Insert products</title>
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert products</h1>

        <!-- FORM -->
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product name</label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="Enter product name" autocomplete="off" required>
            </div>


            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="description" id="description" class="form-control"
                    placeholder="Enter product description" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keyword</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control"
                    placeholder="Enter keyword" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id="product_categories" class="form-select">
                    <option value="">Select category</option>

                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($_con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $categories_title = $row['category_title'];
                        $categories_id = $row['category_id'];
                        echo "<option value='$categories_id'>$categories_title</option>";
                    }

                    ?>
                </select>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"
                    placeholder="Enter image" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control"
                    placeholder="Enter image" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                    placeholder="Enter price" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_products" class="btn btn-outline-dark mb-3 px-3"
                    value="Insert products">
            </div>

        </form>
    </div>

</body>

</html>