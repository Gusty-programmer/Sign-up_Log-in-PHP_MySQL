<?php

function emptyInputSignup($firstName, $lasttName, $username,$email, $pwd, $pwdrepet){
    $result;
   if(empty($firstName) || empty($lasttName) || empty($username) || empty($pwd) || empty($pwdrepet) || empty($email)){
        $result = true;
   }
   else{
    $result = false;
   }
   return $result;
}
function emptyInputUpdate($firstName, $lastName, $username,$email){
    $result;
   if(empty($firstName) || empty($lastName) || empty($username)){
        $result = true;
   }
   else{
    $result = false;
   }
   return $result;
}
function invalidUsername($username){
    $result;
    if(!preg_match("/^[\w]*$/", $username)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
 }
 function invalidName($firstname){
    $result;
    if(!preg_match("/^[A-Z][a-z]*(\s[A-Z])?[a-z]*$/", $firstname)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
 }
 function wrongName($lastname){
    $result;
    if(!preg_match("/^[A-Z][a-z]*$/", $lastname)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
 }
 function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
 }

 function pwdMatch($pwd, $pwdrepet){
    $result;
    if($pwd !== $pwdrepet){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
 }

 function userExist($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE Username = ? OR Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("include: ../../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $result_data = mysqli_stmt_get_result($stmt);
    if($row_data = mysqli_fetch_assoc($result_data)){
        return $row_data;
    }
    else{
        return false;
    }
    mysqli_stmt_close($stmt);
 }

 function createUser($conn, $firstName, $lasttName, $email, $pwd, $username){
    $sql = "INSERT INTO users (FirstName, LastName, Email, Password, Username) VALUE (?,?,?,?,?) ";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("include: ../../signup.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); // securizarea parolei 
    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lasttName, $email, $hashedPwd, $username); 
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../../login.php");
    exit();
 }
 // functii login

 function emptyInputLogin($username, $pwd){
    $result;
   if(empty($username) || empty($pwd)){
        $result = true;
   }
   else{
    $result = false;
   }
   return $result;
}
function loginUser($conn, $username, $pwd){
    $userExist = userExist($conn, $username, $username);
    if($userExist === false){
        header('location: ../../login.php?error=wronglogin');
    exit();
    }
    $pwdHashed = $userExist['Password'];
    $checkPwd = password_verify($pwd, $pwdHashed);
    

    if($checkPwd === false){
        header('location: ../../login.php?error=wronglogin');
    exit();
    }
    else if($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $userExist['userId'];
        $_SESSION["userusername"] = $userExist["Username"];
        $_SESSION["userfname"] = $userExist["FirstName"];
        $_SESSION["userlname"] = $userExist["LastName"];
        $_SESSION["useremail"] = $userExist["Email"];
         header('location: ../../index.php');
        exit();
    }
    }
        //profile function
         function updateUser($conn, $firstName, $lastName, $email, $username, $userid){
            $sql = "Update users SET FirstName=?, LastName=?, Email=?, Username=? WHERE Id = ? ";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("include: ../../profile.php?error=stmtfailed");
                exit();
            }
            
            mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $email, $username,$userid); 
            mysqli_stmt_execute($stmt);
        
            mysqli_stmt_close($stmt);
            $_SESSION["userusername"] = $username;
            $_SESSION["userfname"] = $firstName;
            $_SESSION["userlname"] = $lastName;
            $_SESSION["useremail"] = $email;
            header("location: ../../profile.php");
            exit();
         }
         function newuserExist($conn, $username, $email, $userid){
            $sql = "SELECT * FROM users WHERE (name = ? OR Email = ?) AND Id != ?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("include: ../../signup.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $userid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                return true;
            }
            else{
                return false;
            }
            mysqli_stmt_close($stmt);
         }
