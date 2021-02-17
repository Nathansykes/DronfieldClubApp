<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php

session_start();

$delete = $_POST['delete'] ?? "";
$previous = "javascript:history.go(-1)" ?? "";
$userNameToRemove = $_POST['userNameToRemove'] ?? "";


if ($_SESSION['valid'] ?? "")
{
    echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
}   
else {  
    //If not the user cannot view the page in full, send them back to home with noaccess
    header("Location: ../html/index.html? no_access");
    exit(0);
}
include "connect.php";

if ($userNameToRemove == "") 
{
    header("Location: $previous?no_student");
    exit (0);
}

$sql = "DELETE FROM users WHERE userName = '$userNameToRemove'";

if (mysqli_query($link, $sql))
	{
		echo "success";
		header('Location: manageUsersForm.php? message=deletion success');
	}
	else 
		{
            echo "failed";
            header("Location: manageUsersForm.php? message=deletion failed.$userNameToRemove");
		}
?>

<body>
</body>
</html>