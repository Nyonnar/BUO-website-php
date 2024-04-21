<h3 class="text-center text-success">All categories</h3>

<table class="table table-bordered-mt-4">
    <thead class="bg-info">
        <tr>
            <th>S1No</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bt-tertiary text-light">
        <?php
        $get_categories = "SELECT * FROM `categories`";
        $result = mysqli_query($_con, $get_categories);
        while ($row = mysqli_fetch_assoc($result)) {
            $category_id = $row["category_id"];
            $category_title = $row["category_title"];
            ?>
            <tr class='text-center'>
                <td><?php echo $category_id ?> </td>
                <td> <?php echo $category_title ?></td>
                <td>
                    <a href='admin_index.php?edit_categories=<?php echo $category_id ?>' class='text-dark'>
                        <i class='fa-solid fa-pen-to-square'></i>
                    </a>
                </td>
                <td>
                    <a href='admin_index.php?delete_categories=<?php echo $category_id ?>' class='text-dark'>
                        <i class='fa-solid fa-trash'></i>
                    </a>
                </td>
            </tr>
            <?php

        }
        ?>

    </tbody>
</table>