<?php
    require 'util/common.php';
    if (!isset($_SESSION['student_id'])) {
      header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style_home.css" type="text/css" />
    <title>Home</title>
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
    <div class="container">
      <div class="row">
      <?php
        $con= mysqli_connect("localhost", "root", "", "capstone_design-1") or die(mysqli_error($con));
        $q= mysqli_query($con,"SELECT * FROM cafeterias");
        while($row= mysqli_fetch_array($q)) 
        {
            $cafeteria_id=$row['cafeteria_id'];
            $q1= mysqli_query($con, "SELECT cafeteria_name FROM cafeterias WHERE cafeteria_id='$cafeteria_id'");
            $q2=mysqli_query($con,"SELECT img_url FROM cafeterias WHERE cafeteria_id='$cafeteria_id'");
            $row1= mysqli_fetch_array($q1);
            $row2= mysqli_fetch_array($q2); 
            ?>
            <div class="card">
                <a href="menu.php?id=<?php echo $cafeteria_id; ?>">
                    <img src="<?php echo $row2['img_url']; ?>">
                    <p><?php echo $row1['cafeteria_name']; ?></p>
                </a>
            </div>
            <?php 
        }
        ?>
        </div>
      </div>
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
