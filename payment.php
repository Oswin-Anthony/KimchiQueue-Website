<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style_payment.css" type="text/css" />
  <title>Payment</title>
</head>

<body>
  <nav class="navbar">
    <div class="navigation">
      <div class="logo">
        <a href="home.html">
          <img src="images/knu_logo.png" alt="" />
        </a>
      </div>
      <ul>
        <li>
          <a href="#">Home</a>
        </li>
        <li>
          <a href="ticket.html">My Tickets</a>
        </li>
        <li>
          <a href="index.html">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <h1>Payment</h1>

  <div class="grey_box">
    <div class="content">
      <form>
        <p>Pay With</p>
        <img src="images/cards.jpg" width="80%" class="im" />
        <p>Card Number</p>
        <input type="text" class="c_no" />
        <input type="text" class="c_no" />
        <input type="text" class="c_no" />
        <input type="text" class="c_no" />
        <p>Expiry Date</p>
        <input type="text" class="m_no" />
        <input type="text" class="m_no" />
        <p>CVV</p>
        <input type="password" class="p_no" />
        <br />
        <!-- <a href="util/clear_cart.php"><input type="submit" value="Submit" class="submit" /></a> -->

      </form>
    </div>
  </div>

  <div class="button">
    <a href="util/clear_cart.php?total=<?php echo $_GET['total']; ?>">
      <button>Pay Now</button>
    </a>
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