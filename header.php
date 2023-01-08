<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Log php</title>
    <link rel="stylesheet" href= "Css/style.css">
    <script src=
        "https://www.google.com/recaptcha/api.js" async defer>
    </script>
</head>
<body>
    <div class="nav">
      <h1>Sign up & Log in</h1>
      <ul>
        <li><a href="index.php">Home</a></li>
        <?php 
        if(isset($_SESSION["userusername"])){
         
         echo "<li><a href='profile.php'>Profile</a></li>";
        echo "<li><a href='private/includes/logout.inc.php'>Log out</a></li>";
        echo "<li style='margin-left:100px;'>You are loged as  <span style='font-weight:bold; color:green;'>" . $_SESSION["userusername"] ."</span></li>";
        }
        else{
          echo "<li><a href='signup.php'>Sign up</a></li>";
          echo "<li><a href='login.php'>Log in</a></li>";
          
        }
        ?>
        
    </ul>  
    </div>
    