<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Page Title</title>
</head>

<?php


if ($_SESSION['valid'] ?? "")
    {
        echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {  
    //If not the user cannot view the page in full, send them back to home with noaccess
    header("Location: ../html/index.html? no_access");
    exit(0);
}


$user = $_POST['username'] ?? "";
$pass = $_POST['password'] ?? "";
$passConfirm = $_POST['password2'] ?? "";
$signUpKey = $_POST['signUpKey'] ?? "";
$destination = $_POST['destination'] ?? "";

if ($user == "" || $pass == "" || $passConfirm == "" || $signUpKey == "") 
{
    header("Location: loginForm.php?invaliddetails");
    exit (0);
}

 // two ; was missing

 //$useroptions = ['cost' => 8,];
 //$userhash    = password_hash($user, PASSWORD_BCRYPT, $useroptions);
 $pwoptions   = ['cost' => 8,];
 $passhash    = password_hash($pass, PASSWORD_BCRYPT, $pwoptions);

 //echo $userhash;
 echo "<br />";
 echo $passhash;
 $pass = "";


if($destination == "signUp")
{
    
    ?>
    <body>
            <form id="signUpForm" action="signUp.php" method="post" onsubmit="">
                <input type="hidden" name="username" value="<?php echo $user ?>">
                <input type="hidden" name="password" value="<?php echo $passhash ?>">
                <input type="hidden" name="signUpKey" value="<?php echo $signUpKey ?>">
            </form>
            <script>
                document.getElementById("signUpForm").submit();
            </script>
    </body>
    <?php
}

if($destination == "login")
{

    ?>
    <body>
            <form id="loginForm" action="login.php" method="post" onsubmit="">
                <input type="hidden" name="username" value="<?php echo $user ?>">
                <input type="hidden" name="password" value="<?php echo $passhash ?>">
            </form>
            <script>
                document.getElementById("loginForm").submit();
            </script>
    </body>
    <?php
}

?>

</html>