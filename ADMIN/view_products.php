<h3 class="text-center text-success">All products</h3>

<table class="table table-bordered-mt-5">
    <thead class="bg-info">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bt-tertiary text-light">
        <?php
        $get_products = "SELECT * FROM `products`";
        $result = mysqli_query($_con, $get_products);
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row["product_id"];
            $product_title = $row["product_title"];
            $product_image1 = $row["product_image1"];
            $product_price = $row["product_price"];
            $status = $row["status"];
            ?>
            <tr class='text-center'>
                <td><?php echo $product_id ?> </td>
                <td> <?php echo $product_title ?></td>
                <td><img src='./PRODUCT_IMAGES/<?php echo $product_image1 ?>' class='product_img' /></td>
                <td><?php echo $product_price ?></td>
                <td>
                    <!-- <?php
                    $get_count = "SELECT * FROM `orders_pending` WHERE `product_img`=$product_id";
                    $result_count = mysqli_query($_con, $get_products);
                    $rows_count = mysqli_num_rows($result_count);
                    echo $rows_count;

                    ?> -->
                </td>
                <td><?php echo $status ?></td>
                <td>
                    <a href='admin_index.php?edit_products=<?php echo $product_id ?>' class='text-dark'>
                        <i class='fa-solid fa-pen-to-square'></i>
                    </a>
                </td>
                <td>
                    <a href='admin_index.php?delete_products=<?php echo $product_id ?>' class='text-dark'>
                        <i class='fa-solid fa-trash'></i>
                    </a>
                </td>
            </tr>
            <?php

        }
        ?>

    </tbody>
</table>