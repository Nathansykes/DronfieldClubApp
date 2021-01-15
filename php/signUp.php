<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="https://cdn.discordapp.com/attachments/788419191870324769/798955834453393418/logoCOMP.png"/>
</head>


<?php
    include "connect.php";
    session_start();
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $passConfirm = $_POST['password2'];
    $signUpKey = $_POST['signUpKey'];
    
    $sql = "SELECT * FROM userKey";
    $result = mysqli_query($link, $sql);

    if($result)
    {
        echo "result = true";
    }
    if(false===$result)
    {
        printf("error: %s\n", mysqli_error($link));
    }
    
    $created = false;
    $counter = 1;
    $key = "";
    while($row=mysqli_fetch_row($result))
    {
        $key = $row[0];
        
        if($signUpKey == $key)
        {
            //access level 1
            $sql = "INSERT into users(userName,userPass,accessLevel) VALUES('$user','$pass',$counter)";
            if (mysqli_query($link, $sql))
            {
                header("Location: signUpForm.php? message=signup success");
                $created = true;
                break;
                
            }
            else 
            {
                header("Location: signUpForm.php? message=signup failed");
                       
            }

        }
        $counter++;//keeps track of which row loop is on
    }
    if(!$created)
    {
        header("Location: signUpForm.php? message=signup bottom failed");

    }

    
?>

<body>
</body>
</html>