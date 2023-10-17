<!DOCTYPE html>
<?php
include 'util/common.php';
if (!isset($_SESSION['student_id'])) {
  header("Location: index.php");
} else {
  $student_id = $_SESSION['student_id'];
}

$sql = "SELECT * FROM cart ORDER BY cart_id LIMIT 1";
$query = mysqli_query($con, $sql);
$cafeteria_id = mysqli_fetch_array($query)['cafeteria_id'];

$sql1 = "SELECT * FROM cafeterias WHERE cafeteria_id = '$cafeteria_id'";
$query1 = mysqli_query($con, $sql1);
$cafeteria_name = mysqli_fetch_array($query1)['cafeteria_name'];

$total = 0.0;
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style_cart.css" type="text/css" />
  <title>Cart</title>
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
  <p class="cafe">
    <?php echo $cafeteria_name; ?>
  </p>
  <p class="cart">Your Cart</p>
  <div class="table">
    <table>
      <tr>
        <th class="item_name">Item Name</th>
        <th class="item_price">Item Price (KRW)</th>
      </tr>
      <?php
      $sql2 = "SELECT * FROM cart";
      $query2 = mysqli_query($con, $sql2);
      while ($row = mysqli_fetch_array($query2)) {
        $dish_id = $row['dish_id'];
        $quantity = $row['quantity'];

        $sql3 = "SELECT * FROM menu WHERE dish_id='$dish_id'";
        $query3 = mysqli_query($con, $sql3);
        $dish_data = mysqli_fetch_array($query3);
        $dish_name = $dish_data['dish_name'];
        $dish_price = $dish_data['dish_price'];
        $total = $total + $dish_price * $quantity;

        $row_id = 'row_' . $dish_id;
        $display_id = 'display_' . $dish_id;

        ?>
        <tr>
          <td class="item_name">
            <?php echo $dish_name; ?>
          </td>
          <td class="item_price">
            <?php echo $dish_price; ?>
          </td>
          <td class="minus_button">
            <a href="util/update_cart.php?delid=<?php echo $dish_id; ?>">
              <button>-</button>
            </a>
          </td>
          <td class="no_of_items" id="number_display">
            <?php echo $quantity; ?>
          </td>
          <td class="plus_button">
            <a href="util/update_cart.php?addid=<?php echo $dish_id; ?>">
              <button onclick="updateNumber(this, 1)">+</button>
            </a>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>

  </div>
  <p class="total">Total =
    <?php echo $total; ?>
    KRW
  </p>
  <a href="payment.php?total=<?php echo $total; ?>">
    <div class="proceed">
      <button>PROCEED</button>
    </div>
  </a>
  <div class="footer">
    <ul>
      <li>
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfig11HE2PwYolRwjL3V24GQrCznaPzu_NgP3cwJQKWo_fuaw/viewform?usp=sf_link">Contact Us</a>
      </li>
    </ul>
  </div>
</body>

</html>