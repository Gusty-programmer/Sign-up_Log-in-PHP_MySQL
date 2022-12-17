<?php 
include_once"header.php";
require_once 'private/includes/db.inc.php';
require_once 'private/includes/functions.inc.php';
?>

<section>
    <div class="divflex profile">
       <div class="menuprofil">
        <form id='profile' action="profile.php" method="post">
        <label><button type="submit" name="cont" class="menubtn">Contul meu <span>> </span></button>
    </form>
       </div>
       <div class="detailes">
      <?php 
    if(isset($_POST['cont'])){
        echo "<div class=\"datecont\">
            <ul>
            <li>Username: ".$_SESSION['userusername']."</li>
            <li>First name: ".$_SESSION['userfname']."</li>
            <li>Last name: ".$_SESSION['userlname']."</li>
            <li>Email: ".$_SESSION['useremail']."</li>
            </ul>
            <form action=\"profile.php\" method=\"post\">
            <label><button type=\"submit\" name=\"modif\" class=\"menubtn2\">Administreaza datele tale</button></label>
            </form>
            </div>";
     }   
      

    if(isset($_POST['modif']) || isset($_GET['error'])){
        echo "<section id='modif'>
        <div class=\"sign-form-div updatecont\">
        <form action=\"private/includes/signup.inc.php\" method=\"post\">
        <div class=\"rowform\">
        <label for=\"user\">Username</label>
        <input id=\"user\" type=\"text\" name=\"username\" placeholder=\"Username\" value=".$_SESSION['userusername']."></div><br><br>
        <div class=\"rowform\">
        <label for=\"fname\">First name</label>
        <input id=\"fname\" type=\"text\" name=\"firstname\" placeholder=\"Firstname\" value=".$_SESSION['userfname']."></div><br><br>
        <div class=\"rowform\">
        <label for=\"lname\">Last name</label>
        <input id=\"lname\" type=\"text\" name=\"lastname\" placeholder=\"Lastname\" value=".$_SESSION['userlname']."></div><br><br>
        <div class=\"rowform\">
        <label for=\"email\">Email</label>
        <input id=\"email\" type=\"text\" name=\"email\" placeholder=\"Email\" value=".$_SESSION['useremail']."></div><br><br>
        <button type=\"submit\" name=\"updatecont\">Salveaza</button>
        </form>
        </div></section>";
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
                   case "invalidlastname" :
                    echo " Numele de familie este invalid  !";
                    break;
                    case "invalidfirstname" :
                      echo " Prenumele este invalid  !";
                      break;
                case "userexist" :
                  echo " userul este deja ales !";
                   break;
                case "stmtfailed" :
                  echo " conectare nereusita !";
                  break;
                case "none" :
                  echo " Te-ai inregistrat cu successucces ! <br>";
                  
                  break;
            }
            }
        
 }
    
    ?>
    </div> 
    </div>
</section>

<?php 
include_once"footer.php";
?>