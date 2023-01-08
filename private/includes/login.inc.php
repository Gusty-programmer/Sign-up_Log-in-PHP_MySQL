<?php
include_once "captcha.php";
if(isset($_POST["submit"])){
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
      
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
                . $secret_key . '&response=' . $_POST['g-recaptcha-response'];
       
       $response = file_get_contents($url);      
       $response = json_decode($response);
   
   if ($response->success == true){
    $username = $_POST['name'];
    $pwd = $_POST['pswd'];

require_once 'db.inc.php';
require_once 'functions.inc.php';

if(emptyInputLogin($username, $pwd) !== false){
    header('location: ../../login.php?error=emptyinput');
    exit();
 }
 loginUser($conn, $username, $pwd);
}
}
else{
    header("location: ../../login.php?error=captcha"); 
    exit();
}
}
else{
    header("location: ../../login.php"); 
    exit();
 }