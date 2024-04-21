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
    <title>Log in</title>
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Log in</h2>
        <div class="row d-flex align-items-center justify-content-center mt-4">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">

                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" name="user_username" class="form-control"
                            placeholder="Enter username" autocomplete="off" required />
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" name="user_password" class="form-control"
                            placeholder="Enter your password" autocomplete="off" required />
                    </div>

                    <div class="mt-4">
                        <input type="submit" name="user_login" class="btn btn-outline-dark py-2 px-3" value="Login">
                        <p class="mt-2 pt-2">Don't have an account? <a href="user_registration.php"
                                class="text-dark fw-bold"> Register</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    if (!isset($_con) || !mysqli_ping($_con)) {
        echo "<script>alert('Error: Database connection failed!')</script>";
        exit;
    }

    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($_con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();
    if (!$result) {
        echo "<script>alert('Error: " . mysqli_error($_con) . "')</script>";
        exit;
    }

    $select_cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($_con, $select_cart_query);
    $row_count_cart = mysqli_num_rows($select_cart);
    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        if (password_verify($user_password, $row_data['user_password'])) {
            // echo "<script>alert('Login successful!')</script>";
            if ($row_count == 1 and $row_count_cart == 0) {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successful!')</script>";
                echo "<script>window.open('profile.php', '_self')</script>";
            } else {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successful!')</script>";
                echo "<script>window.open('payment.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials')</script>";
    }

    // $row_count = mysqli_num_rows($result);
    // if ($row_count == 0) {
    //     echo "<script>alert('Error: Username not found!')</script>";
    // } else {
    //     $_SESSION['username']=$user_username;
    //     $row_data = mysqli_fetch_assoc($result);
    //     if (!password_verify($user_password, $row_data["user_password"])) {
    //         echo "<script>alert('Error: Invalid password!')</script>";
    //     } else {
    //         echo "<script>alert('Log in successful!')</script>";
    //     }
    // }
}
?>