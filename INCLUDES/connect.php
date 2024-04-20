<?php

$_con = mysqli_connect('localhost', 'root', '', 'buo');
if (!$_con) {
    die(mysqli_error($_con));
}
?>