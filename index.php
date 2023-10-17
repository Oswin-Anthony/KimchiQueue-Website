<!DOCTYPE html>
<?php session_set_cookie_params(0); 
session_start();?>
<html>
  <head>
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Inter&display=swap"
      rel="stylesheet"
    />
    <link href="style_index.css" rel="stylesheet" />
    <title>Login</title>
  </head>
  <?php  
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
             $url = "https://";   
        else  
             $url = "http://";   
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   

        // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];     
  ?> 
  <body>
    <div class="red_menu_bar">
      <img src="images/knu_logo.png" />
    </div>

    <div class="grey_box">
      <p class="login">Login</p>
      <?php 
        $n=strlen($url);
        $word=substr($url,($n-5));
        if ($word=="error")
        {
          ?> <p style="color: red; text-align: center"><i>
          <?php
            echo "Incorrect Credentials! Try again."
          ?>
          </i>
          <br>
          </p>
          <?php
        }
                                    
        ?>
      <form method="POST" action="util/login_submit.php">
        <input type="text" name="student_id" class="id_field" />
        <input type="password" name="password" class="pw_field" />
        <input type="submit" value="Submit" class="login_red_box" />
      </form>
    </div>
  </body>
</html>