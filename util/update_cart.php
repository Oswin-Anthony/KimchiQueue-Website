<?php
include 'common.php';
$student_id = $_SESSION['student_id'];

if (isset($_GET['addid'])) {
    $addid = $_GET['addid'];
    $sql = "SELECT * FROM cart WHERE student_id='$student_id' AND dish_id='$addid'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        $data = mysqli_fetch_array($query);
        $quantity = $data['quantity'];

        $quantity = $quantity + 1;
        $sql = "UPDATE cart SET quantity=$quantity WHERE student_id='$student_id' AND dish_id='$addid'";
        $query = mysqli_query($con, $sql);
    }
} else if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $sql = "SELECT * FROM cart WHERE student_id='$student_id' AND dish_id='$delid'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        $data = mysqli_fetch_array($query);
        $quantity = $data['quantity'];

        if ($quantity == 1) {
            $sql = "DELETE FROM cart WHERE student_id='$student_id' AND dish_id='$delid'";
            $query = mysqli_query($con, $sql);
        } else {
            $quantity = $quantity - 1;
            $sql = "UPDATE cart  SET quantity=$quantity WHERE student_id='$student_id' AND dish_id='$delid'";
            $query = mysqli_query($con, $sql);
        }
    }
}
$sql = "SELECT * FROM cart WHERE student_id='$student_id'";
$query = mysqli_query($con, $sql);
if (mysqli_num_rows($query) < 1) {
    header("Location: ../home.php");
} else {
    header('Location: ../cart.php');
}
?>