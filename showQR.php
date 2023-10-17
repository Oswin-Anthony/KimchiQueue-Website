<?php
include 'util/common.php';
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
} else {
    $student_id = $_SESSION['student_id'];
}

$ticket_id = $_GET['ticket_id'];

$sql = "SELECT * FROM tickets WHERE ticket_id=$ticket_id";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
$total = $row['total'];
$dishes = $row['dishes'];

include 'phpqrcode/qrlib.php';
$temp_dir = 'temp/';
if (!file_exists($temp_dir)) {
    mkdir($temp_dir);
}
$file_name = $temp_dir . 'test.png';
$code_string = $ticket_id . $total;
$file_name = $temp_dir . 'test' . md5($code_string) . '.png';
QRcode::png($code_string, $file_name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display QR</title>
    <link rel="stylesheet" href="style_showQR.css" type="text/css" />
</head>

<body>
    <nav class="navbar">
        <div class="navigation">
            <div class="logo">
                <a href="home.php">
                    <img src="images/knu_logo.png" alt="" />
                </a>
            </div>
            <ul>
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li>
                    <a href="ticket.php">My Tickets</a>
                </li>
                <li>
                    <a href="util/logout_submit.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="data">
        <p>
            Ticket ID -
            <?php echo $ticket_id; ?>
        </p>
        <img src="<?php echo $file_name; ?>" alt="Display QR Code">
        <p>
            <?php echo $dishes; ?>
        </p>
        <p>
            <?php echo 'Total = ' . $total . " WON"; ?>
        </p>
    </div>

    <div class="footer">
        <ul>
            <li>
                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfig11HE2PwYolRwjL3V24GQrCznaPzu_NgP3cwJQKWo_fuaw/viewform?usp=sf_link">Contact Us</a>
            </li>
        </ul>
    </div>
</body>

</html>