<?php 
include_once"header.php";
?>
<section class="sign-form">
<div class="sign-form-div">
  <h1>LOG IN</h1>
<form method="post" action="private/includes/login.inc.php">
    Username/Email<br><input type="text" name="name"><br><br>
    Password<br><input type="password" name="pswd"><br><br>
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
     
  }
  
  }
  ?>
</section>

<?php
include_once"footer.php";
?>