<?php
include_once "captcha.php";
if(isset($_POST["submit"]) || isset($_POST["updatecont"])){

      if(isset($_POST["submit"])){
         $page = "signup";
      }
      if(isset($_POST["updatecont"])){
         $page = "profile";
      }

   if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
      
      $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
               . $secret_key . '&response=' . $_POST['g-recaptcha-response'];
      $response = file_get_contents($url);
      $response = json_decode($response);
 
 if ($response->success == true){

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];

require_once 'db.inc.php';
require_once 'functions.inc.php';

if(isset($_POST["submit"])){
$pwd = $_POST['pswd'];
$pwdrepet = $_POST['pswdrepet'];
$page = "signup";
if(emptyInputSignup($firstName, $lastName, $username, $email,$pwd, $pwdrepet) !== false){
   header('location: ../../signup.php?error=emptyinput');
   exit();
}
}
if(isset($_POST["updatecont"])){
   session_start();
   $userid = $_SESSION['userid'];
   $page = "profile";
if(emptyInputUpdate($firstName, $lastName, $username, $email) !== false){
   header('location: ../../profile.php?error=emptyinput');
   exit();
}
   }




//signup function

if(invalidUsername($username) !== false){
    header('location: ../../'.$page.'.php?error=invalidusername');
    exit();
 }
 if(invalidEmail($email) !== false){
    header('location: ../../'.$page.'.php?error=invalidemail');
    exit();
 }
if(invalidName($firstName) !== false){
   header('location: ../../'.$page.'.php?error=invalidfirstname');
   exit();
}
if(wrongName($lastName) !== false){
   header('location: ../../'.$page.'.php?error=invalidlastname');
   exit();
}
if(isset($_POST['updatecont'])){
   if(newuserExist($conn, $username, $email, $userid) !== false){
      header('location: ../../profile.php?error=userexist');
      exit();
   }
   
   updateUser($conn, $firstName, $lastName, $email, $username, $userid);
 }
if(isset($_POST["submit"])){
   

 if(pwdMatch($pwd, $pwdrepet) !== false){
    header('location: ../../signup.php?error=passworddontmatch');
    exit();
 }
 
 if(userExist($conn, $username, $email) !== false){
    header('location: ../../signup.php?error=existusername');
    exit();
 }
 if(isset($_POST['submit'])){
   createUser($conn, $firstName, $lastName, $email, $pwd, $username);
 }
 
}
 
 }
 }
 else{
   header('location: ../../'.$page.'.php?error=captcha'); 
   exit();
}
}  
else{
   header('location: ../../'.$page.'.php'); 
   exit();
}
