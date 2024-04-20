<?php
include ('../INCLUDES/connect.php');
include ('../FUNCTIONS/common_function.php');

session_start();

$user_username = $user_email = $user_contact = $user_password = '';

if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_contact = $_POST['user_contact'];
    $user_ip = getIPAddress();

    $select_username_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result_username = mysqli_query($_con, $select_username_query);
    if (mysqli_num_rows($result_username) > 0) {
        echo "<script>alert('Username already exists!');</script>";
        $user_username = ''; // Clear username
        $user_email = htmlspecialchars($user_email);
        $user_contact = htmlspecialchars($user_contact);
        $user_password = htmlspecialchars($user_password);
    } else {
        $select_email_query = "SELECT * FROM `user_table` WHERE user_email='$user_email'";
        $result_email = mysqli_query($_con, $select_email_query);
        if (mysqli_num_rows($result_email) > 0) {
            echo "<script>alert('Email already exists!');</script>";
            $user_email = ''; // Clear email
            $user_username = htmlspecialchars($user_username);
            $user_contact = htmlspecialchars($user_contact);
            $user_password = htmlspecialchars($user_password);
        } else {
            $select_contact_query = "SELECT * FROM `user_table` WHERE user_mobile='$user_contact'";
            $result_contact = mysqli_query($_con, $select_contact_query);
            if (mysqli_num_rows($result_contact) > 0) {
                echo "<script>alert('Contact number already exists!');</script>";
                $user_contact = ''; // Clear contact
                $user_username = htmlspecialchars($user_username);
                $user_email = htmlspecialchars($user_email);
                $user_password = htmlspecialchars($user_password);
            } else {
                $insert_query = "INSERT INTO `user_table` (username, user_password, user_email, user_ip, user_mobile) VALUES ('$user_username', '$user_password', '$user_email', '$user_ip', '$user_contact')";

                $sql_execute = mysqli_query($_con, $insert_query);
                if ($sql_execute) {
                    echo "<script>alert('Registration successful!');</script>";
                    $user_username = '';
                    $user_email = '';
                    $user_contact = '';
                    $user_password = '';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" name="user_username" class="form-control"
                            placeholder="Enter username" autocomplete="off" required
                            value="<?php echo htmlspecialchars($user_username); ?>" />
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" name="user_email" class="form-control"
                            placeholder="Enter emailsss" autocomplete="off" required
                            value="<?php echo htmlspecialchars($user_email); ?>" />
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" name="user_password" class="form-control"
                            placeholder="Enter your password" autocomplete="off" required
                            value="<?php echo htmlspecialchars($user_password); ?>" />
                    </div>

                    <div class="form-outline">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" name="user_contact" class="form-control"
                            placeholder="Enter contact number" autocomplete="off" required
                            value="<?php echo htmlspecialchars($user_contact); ?>" />

                    </div>

                    <div class="mt-4">
                        <input type="submit" name="user_register" class="btn btn-outline-dark py-2 px-3"
                            value="Register">
                        <p class="mt-2 pt-2">Already have an account? <a href="user_login.php"
                                class="text-dark fw-bold">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>