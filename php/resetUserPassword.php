<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="../images/logoCOMP.png"/>
</head>


<?php
    include "connect.php";
    session_start();
    $username = $_POST['userName'] ?? "";
    $password = $_POST['password'] ?? "";

    if ($username == "" || $password == "") 
    {
        header("Location: loginForm.php?invaliddetails");
        exit (0);
    }
    if(strpbrk($username, ';:"=-+/_%*&|\''))
    {
        header("Location: signUpForm.php?invalidcharacters");
        exit (0);
    }
    if(strpbrk($password, ';:"=-+/_%*&|\''))
    {
        header("Location: signUpForm.php?invalidcharacters");
        exit (0);
    }
    
    $pwoptions   = ['cost' => 8,];
    $passhash    = password_hash($password, PASSWORD_BCRYPT, $pwoptions);
    

    $sql = "UPDATE users SET userPass = '$passhash', resetPassword = '0' WHERE userName = '$username'";
    $result = mysqli_query($link, $sql);

    if($result)
    {
        header("location: securehomepage.php?session=true");
    }
    else 
    {
        header("location: logout.php");
    }
?>

<body>
</body>
</html>