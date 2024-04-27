<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result_query = mysqli_query($_con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_mobile = $row_fetch['user_mobile'];
}

if (isset($_GET['user_update'])) {
    $update_id = $user_id;
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_mobile = $_POST['user_mobile'];

    $update_data = "UPDATE `user_table` SET username='$username', user_email='$user_email', user_mobile='$user_mobile' WHERE user_id='$upate_id'";
    $result_query_update = mysqli_query($con, $update_data);
    if ($result_query_update) {
        echo "<script>alert('Updated successfully')</script>";
        echo "<script>window.open('logout.php', '_self')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit account</title>
</head>

<body>
    <h3 class="text-center text-success mb-4">Edit account</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile">
        </div>

        <input type="submit" value="update" class="btn btn-outline-dark py-2 px-3" name="user_update">
    </form>
</body>

</html>