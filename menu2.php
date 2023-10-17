<?php
include 'util/common.php';
if (!isset($_SESSION['student_id'])) {
  header("Location: index.php");
} else {
  $student_id = $_SESSION['student_id'];
}

if (isset($_GET["id"])) {
  $cafe_id = $_GET["id"];
  $sql = "SELECT * FROM cafeterias WHERE cafeteria_id='$cafe_id'";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  $cafe = $row['cafeteria_name'];
} else {
  header("Location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style_menu.css" type="text/css" />
  <title>Menu</title>
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

  <div class="selector">
    <div class="des">
      <?php echo $cafe; ?>
      <br>
      <?php echo $_SESSION['type']; ?>
    </div>
    <form method="post">
      <input type="radio" id="op1" name="time" value="Breakfast" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Breakfast')
        echo 'checked'; ?> <?php if (isset($_SESSION['type']))
             echo ' disabled'; ?> />
      <label for="op1">Breakfast</label><br />

      <input type="radio" id="op2" name="time" value="Lunch" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Lunch')
        echo 'checked'; ?><?php if (isset($_SESSION['type']))
            echo ' disabled'; ?> />
      <label for="op2">Lunch</label><br />

      <input type="radio" id="op3" name="time" value="Dinner" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Dinner')
        echo 'checked'; ?><?php if (isset($_SESSION['type']))
            echo ' disabled'; ?> />
      <label for="op3">Dinner</label><br />

      <input class="btn" type="submit" name="submit" value="Check Menu" disabled />
    </form>
  </div>

  <div class="table">
    <table>
      <tr>
        <th class="name">Item Name</th>
        <th class="price">Item Price (KRW)</th>
      </tr>
      <?php
      $type = $_SESSION['type'];
      $sql = "SELECT * FROM menu WHERE cafeteria_id='$cafe_id' AND type='$type'";
      $query = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_array($query)) {
        $name = $row['dish_name'];
        $price = $row['dish_price'];
        $dish_id = $row['dish_id'];

        // to check if the dish_id is present in the cart table
        $q = "select * FROM cart WHERE dish_id='$dish_id'";
        $query1 = mysqli_query($con, $q);
        $rows = mysqli_num_rows($query1);
        // to check if the dish_id is present in the cart table
      
        ?>
        <tr>
          <td class="name">
            <?php echo $name; ?>
          </td>
          <td class="price">
            <?php echo $price; ?>
          </td>
          <td class="add">
            <a
              href="util/add_dish.php?cafeteria_id=<?php echo $cafe_id; ?>&dish_id=<?php echo $dish_id; ?>&student_id=<?php echo $student_id; ?>">
              <?php if ($rows > 0) { ?> <button 'disabled' style="background-color: #c3f6c3;">Added</button>
              <?php } ?>
              <?php if ($rows == 0) { ?> <button>Add</button>
              <?php } ?>
            </a>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>
  </div>
  <?php
  $qu = "select * FROM cart";
  $query2 = mysqli_query($con, $qu);
  $rows1 = mysqli_num_rows($query2); ?>

  <div class="proceed">
    <button onClick=showAlert()>PROCEED</button>
    </a>
  </div>

  <script type="text/javascript">
    function showAlert() {
      var result = confirm("<?php echo $rows1; ?> items are added to the cart. Do you want to proceed?");
      if (result) {
        window.location.href = "cart.php"; // Redirect to cart.php
      } else {
        // Code to handle cancellation
      }
    }
  </script>

  <div class="footer">
    <ul>
      <li>
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfig11HE2PwYolRwjL3V24GQrCznaPzu_NgP3cwJQKWo_fuaw/viewform?usp=sf_link">Contact Us</a>
      </li>
    </ul>
  </div>
</body>

</html>