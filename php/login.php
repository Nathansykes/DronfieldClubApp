<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Page Title</title>
</head>

<?php
    session_start();
    include "../php/connect.php";
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $credit = $_GET['credit'];
    $cookie = $_GET['cookie'];
    
    
    $sql2 = "SELECT userPass FROM users";
    $result = mysqli_query($link, $sql2);
    $sql = "";

    while($row=mysqli_fetch_row($result))
    {
        echo "\npassword is \n". $row[0];
        echo "\npassword is \n". $pass;

        $storedPassword = $row[0];
        
        if((password_verify($pass,$storedPassword)))
        {
            echo "\n this did work :) \n";
            $sql = "SELECT * FROM users WHERE userName ='$user'";
            $pass = "";
            break; 
        }
        else 
        {
            echo "\n did not work :( \n";
            
        }
    }
    $pass="";
    
    //This will select all of my user records
    
    $result2 = mysqli_query($link, $sql);
    
    //Checking user details are correct against the database
    if (mysqli_num_rows($result2) == 1) {
        $row = mysqli_fetch_array($result2);
        //Stores user's accessLevel for secure page
        
        //Checks if cookie has not been created
        if(!isset($_COOKIE["User"]))
        {
            
            //creates cookie
            setcookie("User", $row['userName'], time()+9000);
            //Secure Page
            $_SESSION['valid'] = true;
            $_SESSION['accessLevel'] = $row['accessLevel'];
            header("location: securehomepage.php?cookie=true");
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
            $_SESSION['valid'] = true;
            $_SESSION['accessLevel'] = $row['accessLevel'];
            header("location: securehomepage.php?cookie=true");
        }
    } else {
        //Login Page
        session_destroy();
        header("location: LoginForm.php?credit=false $pass");
        exit;
    }
?>

<body>
</body>
</html>