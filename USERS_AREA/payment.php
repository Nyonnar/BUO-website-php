<?php
include ('../INCLUDES/connect.php');
include ('../FUNCTIONS/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--BOOTSTRAP CSS--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Payment</title>
</head>

<body>
    <?php
    $user_ip = getIPAddress();
    $get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
    $result = mysqli_query($_con, $get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];


    ?>
    <div class="container">
        <h2 class="text-center text-dark my-3">Payment options</h2>
        <div class="row">
            <div class="text-center my-5">
                <a href="order.php?user_id=<?php echo $user_id ?>">
                    <h2>pay cash<h2>
                </a>
            </div>
        </div>
    </div>
</body>

</html>