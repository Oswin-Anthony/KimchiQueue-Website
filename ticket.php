<!DOCTYPE html>
<?php
    require 'util/common.php';
    $student_id=$_SESSION['student_id'];
    if (!isset($_SESSION['student_id'])) {
      header("Location: index.php");
    }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style_ticket.css" type="text/css" />
    <title>My Tickets</title>
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

    <h1>My Tickets</h1>

    <div class="table">
      <table>
        <thead>
          <tr>
          <th class="T_id">Ticket ID</th>
          <th class="time">Time</th>
          <th class="T_cafe">Cafetaria Name</th>
          <th class="T_price">Total Price(KRW)</th>
        </tr>
        </thead>
        <tbody>
        <?php
          $q= mysqli_query($con,"SELECT * FROM tickets where student_id = '$student_id'");
          while($row = mysqli_fetch_array($q)) 
          {
            $ticket_id = $row['ticket_id'];
            $time = $row['time'];
            $cafeteria_id = $row['cafeteria_id'];
            $total = $row['total'];

            $sql = "SELECT * FROM cafeterias WHERE cafeteria_id='$cafeteria_id'";
            $query = mysqli_query($con, $sql);
            $row_new = mysqli_fetch_array($query);
            $cafeteria_name = $row_new['cafeteria_name'];

            ?>
                <tr>
                    <td class="T_id"><?php echo $ticket_id; ?> </td>
                    <td class="time"><?php echo $time; ?></td>
                    <td class="T_cafe"><?php echo $cafeteria_name; ?></td>
                    <td class="T_price"><?php echo $total; ?></td>
                    <td class="QR_button">
                      <a href="showQR.php?ticket_id=<?php echo $ticket_id; ?>"><button>GET QR</button></a>
                    </td>
                </tr>
                <?php 
            }
          ?>
        </tbody>
      </table>
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
