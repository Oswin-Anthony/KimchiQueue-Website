<?php
include 'common.php';
if (isset($_GET['cafeteria_id'])) {
    $cafeteria_id = $_GET['cafeteria_id'];
    $dish_id = $_GET['dish_id'];
    $student_id = $_GET['student_id'];
    $quantity = 1;

    $sql = "SELECT * FROM cart";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num < 1) {
        $cart_id = 100;
    } else {
        $sql = "SELECT * FROM cart ORDER BY cart_id DESC LIMIT 1";
        $query = mysqli_query($con, $sql);
        $result = mysqli_fetch_array($query);
        $cart_id = $result['cart_id'] + 1;
    }
    $sql = "INSERT INTO 
            cart(cafeteria_id, dish_id, quantity, cart_id, student_id)
            VALUES('$cafeteria_id','$dish_id','$quantity','$cart_id','$student_id')";
    $query = mysqli_query($con, $sql);
    header("Location: ../menu2.php?id=$cafeteria_id");
} else {
    header("Location: ../home.php");
}
?>