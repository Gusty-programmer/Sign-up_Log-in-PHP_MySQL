<?php 
require_once "private/includes/captcha.php";
include_once "header.php";
?>
<section class="sign-form">
<div class="sign-form-div">
  <h1>LOG IN</h1>
<form method="post" action="private/includes/login.inc.php">
    Username/Email<br><input type="text" name="name"><br><br>
    Password<br><input type="password" name="pswd"><br><br>
    <div class="g-recaptcha"  data-sitekey=<?php echo $public_key ?>></div>
    <button type="submit" name="submit">Log in</button>
</form>  
</div>
<?php
if(isset($_GET["error"])){
switch($_GET["error"]){
  case "emptyinput" :
    echo " Nu ai completat toate intrarile !";
    break;
    case "wronglogin" :
      echo " Nu s-a efectuat logarea!";
      break;
      case "captcha" :
        echo " Reverifica reCaptcha!";
        break;
  }
  
  }
  ?>
</section>

<?php
include_once"footer.php";
?>