<?php 
require_once "private/includes/captcha.php";
include_once "header.php";
?>
<section class="sign-form">
<div class="sign-form-div">
  <h1>SIGNUP</h1>
<form method="post" action="private/includes/signup.inc.php">
    Username<br><input type="text" name="username" require><br><br>
    Email<br><input type="email" name="email" require><br><br>
    Password<br><input type="password" name="pswd" require><br><br>
    Repeat password<br><input type="password" name="pswdrepet" require><br><br>
    Firstname<br><input type="text" name="firstname" require><br><br>
    Lastname<br><input type="text" name="lastname" require><br><br>
    <div class="g-recaptcha"  data-sitekey=<?php echo" $public_key "?>></div>
    <button type="submit" name="submit" require>Signup</button>
</form>  
</div>
<?php
if(isset($_GET["error"])){
switch($_GET["error"]){
  case "invalidusername" :
    echo " username este invalid  !";
    break;
    case "emptyinput" :
      echo " Nu ai completat toate intrarile !";
      break;
    case "invalidemail" :
       echo "email-ul este invalid !";
      break;
    case "passworddontmatch" :
       echo " parola nu se potriveste !";
       break;
       case "invalidlastname" :
        echo " Numele de familie este invalid  !";
        break;
        case "invalidfirstname" :
          echo " Prenumele este invalid  !";
          break;
    case "existusername" :
      echo " username este deja ales !";
       break;
    case "stmtfailed" :
      echo " conectare nereusita !";
      break;
      case "captcha" :
        echo " Reverifica reCaptcha !";
        break;
    case "none" :
      echo " Te-ai inregistrat cu successucces ! <br>";
      echo "<button class='btnlog'><a href='login.php'>Log in</a></button>";
      break;
}
}
?>
</section>

<?php
include_once"footer.php";
?>