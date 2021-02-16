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
    
    
    echo $user;

    if(strpbrk($user, ';:"=-+/*_%&|\''))
    {
        header("Location: loginForm.php?invalidcharacters");
        exit (0);
    }
    if(strpbrk($pass, ';:"=-+/*&_%|\''))
    {
        header("Location: loginForm.php?invalidcharacters");
        exit (0);
    }

    $sql2 = "SELECT userPass FROM users";
    $result = mysqli_query($link, $sql2);
    $sql = "";

    $correct = false;

    while($row=mysqli_fetch_row($result))
    {
        $storedPassword = $row[0];
        
        if((password_verify($pass,$storedPassword)))
        {
            $sql = "SELECT * FROM users WHERE userName ='$user'";
            $pass = "";
            $correct = true;
            break; 
        }
        else 
        {
            $correct = false;
            
        }
    }

    if(!$correct)
    {
       header("Location: loginForm.php?password_incorrect");
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
        header("location: LoginForm.php?credit=false");
        exit;
    }
?>

<body>
</body>
</html>