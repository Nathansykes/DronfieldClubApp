<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Page Title</title>
</head>

<?php
    include "connect.php";
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $credit = $_GET['credit'];
    $cookie = $_GET['cookie'];
    
    
    //This will select all of my user records
    $sql = "SELECT * FROM users WHERE userName ='$user' AND userPassword = '$pass'";
    
    $result = mysqli_query($link, $sql);
    
    //Checking user details are correct against the database
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $accessLevel = $row['userLevel'];
        //Stores user's accessLevel for secure page
        session_start();
        $_SESSION['accessLevel'] = $accessLevel;
        //Checks if cookie has not been created
        if(!isset($_COOKIE["User"]))
        {
            //creates cookie
            setcookie("User", $row['userName'], time()+9000);
            //Secure Page
            header("location: securepage.php");
        }
        else
        {
            //checks cookie matches the username
            if ($_COOKIE["User"] == $row['userName']) {
                echo "Welcome ".$_COOKIE["User"];
            } else {
                //creates cookie
                setcookie("User", $row['userName'], time()+9000);
            }
            //Secure Page where cookie exsists
        header("location: securepage.php?cookie=true");
        }
    } else {
        //Login Page
        header("location: LoginForm.php?credit=false");
        exit;
    }
?>

<body>
</body>
</html>