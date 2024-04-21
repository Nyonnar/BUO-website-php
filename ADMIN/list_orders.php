<h3 class="text-center text-success">List of Orders</h3>

<table class="table table-bordered-mt-5">
    <thead class="bg-info">
        <tr>
            <th>S1 No</th>
            <th>Due Amount</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bt-tertiary text-light">
        <?php
        $get_orders = "SELECT * FROM `user_orders`";
        $result = mysqli_query($_con, $get_orders);
        while ($row = mysqli_fetch_assoc($result)) {
            $order_id = $row["order_id"];
            $amount_due = $row["amount_due"];
            $invoice_number = $row["invoice_number"];
            $total_products = $row["total_products"];
            $order_date = $row["order_date"];
            $order_status = $row["order_status"];
            ?>
            <tr class='text-center'>
                <td><?php echo $order_id ?> </td>
                <td><?php echo $amount_due ?></td>
                <td><?php echo $invoice_number ?></td>
                <td><?php echo $total_products ?></td>
                <td><?php echo $order_date ?></td>
                <td><?php echo $order_status ?></td>
                <td>
                    <a href='admin_index.php?delete_orders=<?php echo $order_id ?>' class='text-dark'>
                        <i class='fa-solid fa-trash'></i>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>

    </tbody>
</table>