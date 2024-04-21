<?php
include ('../INCLUDES/connect.php');
include ('../FUNCTIONS/common_function.php');

session_start();

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

    if (!isset($_con) ||!mysqli_ping($_con)) {
        echo "<script>alert('Error: Database connection failed!')</script>";
        exit;
    }

    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($_con, $select_query);
    if (!$result) {
        echo "<script>alert('Error: ". mysqli_error($_con). "')</script>";
        exit;
    }

    $row_count = mysqli_num_rows($result);
    if ($row_count == 0) {
        echo "<script>alert('Error: Username not found!')</script>";
    } else {
        $row_data = mysqli_fetch_assoc($result);
        if (!password_verify($user_password, $row_data["user_password"])) {
            echo "<script>alert('Error: Invalid password!')</script>";
        } else {
            echo "<script>alert('Log in successful!')</script>";
        }
    }
}
?>