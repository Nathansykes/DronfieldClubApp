<?php

session_start();


if ($_SESSION['valid'] ?? "")
    {
        echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {  
    //If not the user cannot view the page in full, send them back to home with noaccess
    header("Location: ../html/index.html? no_access");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Create New Student</title>
</head>

<?php

session_start();
//Checks if the cookie is true, welcomes back user
if (($_SESSION['valid'] ?? "") && ($_SESSION['accessLevel'] == 2) ?? "")
    {
        echo "Welcome back ".$_SESSION["User"].",  Access Level: ".$_SESSION['accessLevel'];
    }   
else {
    //If not the user cannot view the page in full
    header("Location: ../html/index.html? no_access");
    exit(0);
}



include "connect.php";

$fullName = $_POST['fullName'] ?? "";
$accessLevel = $_POST['accessLevel'] ?? "";
$userName = "";
$password = "";
$resetPass = true;

$previous = "javascript:history.go(-1)" ?? "";


$arr = explode(' ',trim($fullName));
$userName= $arr[0];


$characters = " 012345678910abcdefghihklmnopqrstuvwxyzABCDEFHIJKLMNOPQRSTUVWXYZ";
$numbers = "1234567890";
$min = 0;
$max = strlen($characters);
$max2 = strlen($numbers);

for($i = 0; $i <12; $i++)
{
    $randNum = rand($min,$max);
    $password .= $characters[$randNum]; 
    
}


for($i = 0; $i<4; $i++)
{
    $randNum = rand($min,$max2);
    $userName .= $numbers[$randNum]; 
}


$pwoptions   = ['cost' => 8,];
$passhash    = password_hash($password, PASSWORD_BCRYPT, $pwoptions);

//echo $userhash;



$sql = "INSERT INTO users (userName, userPass, fullName, accessLevel, resetPassword) VALUES ('$userName','$passhash','$fullName','$accessLevel','$resetPass')";




if (mysqli_query($link, $sql))
{
    ?>
    <form id= "newUserForm" action="manageUsersForm.php?newUser=success" method="post" enctype="multipart/form-data">
        <input name="password" type="hidden" value="<?php echo $password; ?>"> 
        <input name="userName" type="hidden" value="<?php echo $userName; ?>"> 
    </form>
    <script>
        document.getElementById("newUserForm").submit();
    </script>
    <?php

}
else 
{
    Header("Location: manageUsersForm.php?newUser=failed");
}
?>


<body>
</body>
</html>
