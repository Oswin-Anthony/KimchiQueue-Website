<?php
include 'common.php';
$student_id = $_SESSION['student_id'];
$dishes = "Dishes : ";
$total = $_GET['total'];

$sql = "SELECT * FROM cart WHERE student_id='$student_id'";
$query = mysqli_query($con, $sql);
while ($data = mysqli_fetch_array($query)) {
    $cafeteria_id = $data['cafeteria_id'];
    $dish_id = $data['dish_id'];
    $quantity = $data['quantity'];

    $sql1 = "SELECT * FROM menu WHERE dish_id='$dish_id'";
    $query1 = mysqli_query($con, $sql1);
    $row = mysqli_fetch_array($query1);
    $dish_name = $row['dish_name'];

    $dishes = $dishes . $dish_name . " [$quantity], ";
}
$dishes_sub = substr($dishes, 0, -2);

// Save Data into tickets table
$sql = "INSERT INTO tickets(cafeteria_id, dishes, student_id, total)
        VALUES('$cafeteria_id', '$dishes_sub', '$student_id','$total')";
$query = mysqli_query($con, $sql);

// Delete data from the cart table
$sql = "DELETE FROM cart WHERE student_id='$student_id'";
$query = mysqli_query($con, $sql);

// Get the ticket id of the latest created ticket by the same user
$sql = "SELECT * FROM tickets WHERE student_id = '$student_id' AND ticket_id = (SELECT MAX(ticket_id) FROM tickets);";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
$ticket_id = $row['ticket_id'];

header("Location: ../showQR.php?ticket_id=$ticket_id");
?>