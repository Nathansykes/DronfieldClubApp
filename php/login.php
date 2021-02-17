<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Page Title</title>
</head>

<?php
    session_start();
    $user = $_POST['username'] ?? ""; // this mean if nothing return empty string rather than null
    $pass = $_POST['password'] ?? "";
    $credit = $_GET['credit'] ?? "";
    
    
    echo $user;
    
    if ($user == "" || $pass == "") 
    {
        header("Location: loginForm.php?invaliddetails");
        exit (0);
    }
    
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
    
    include "connect.php";
    $sql2 = "SELECT userPass FROM users";
    $result = mysqli_query($link, $sql2);
    $sql = "";

    $correct = false;

    while($row=mysqli_fetch_row($result))
    {
        $storedPassword = $row[0];
        
        if(password_verify($pass,$storedPassword))
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
       header("Location: loginForm.php?password_credentials");
       exit(0);
    }
    $pass="";
    
    //This will select all of my user records
    
    $result2 = mysqli_query($link, ($sql));
    
    //Checking user details are correct against the database
    if (mysqli_num_rows($result2) == 1) {
        $row = mysqli_fetch_array($result2);
        //Stores user's accessLevel for secure page
        
        

        //Checks if cookie has not been created
        if(!isset($_SESSION["User"]))
        {
            
            //creates cookie
            //setcookie("User", $row['userName'], time()+9000);
            $_SESSION['User'] = $row['userName'];
            //Secure Page
            $_SESSION['valid'] = true;
            $_SESSION['accessLevel'] = $row['accessLevel'];

            if ($row[4] == 1) // if reset password is true
            {
                ?>
                <form action="resetUserPasswordForm.php" id="resetPass" method="post" enctype="multipart/form-data">
                    <input name="userName" type="hidden" value="<?php echo $user; ?>">
                </form>
                <script>
                    document.getElementById("resetPass").submit();
                </script>
                <?php
                exit(0);
            }

            header("location: securehomepage.php?session=true");
            exit(0);
        }
        else
        {
            //checks cookie matches the username
            if ($_SESSION["User"] == $row['userName']) {
                echo "Welcome ".$_SESSION["User"];
            } else {
                //creates cookie
                $_SESSION['User'] = $row['userName'];
                //setcookie("User", $row['userName'], time()+9000);
            }
            //Secure Page where cookie exsists
            $_SESSION['valid'] = true;
            $_SESSION['accessLevel'] = $row['accessLevel'];

            if ($row[4] == 1) // if reset password is true
            {
                ?>
                <form action="resetUserPasswordForm.php" id="resetPass" method="post" enctype="multipart/form-data">
                    <input name="userName" type="hidden" value="<?php echo $user; ?>">
                </form>
                <script>
                    document.getElementById("resetPass").submit();
                </script>
                <?php
                exit(0);
            }


            header("location: securehomepage.php?session=true");
            exit(0);
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