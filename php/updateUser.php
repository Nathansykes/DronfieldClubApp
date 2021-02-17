<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php
session_start();

$userNameToUpdate = $_POST['userNameToUpdate'] ?? "";
$fullName = $_POST['fullName'] ?? "";
$accessLevel = $_POST['accessLevel'] ?? "";
$update = $_POST['update'] ?? "";

include "connect.php";

if ($_SESSION['valid']?? "")
    {
        echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {
    //If not the user cannot view the page in full
    header("Location: ../html/index.html? no_access");
    exit(0);
}

if ($userNameToUpdate == "") 
{
    header("Location: $previous?no_student");
    exit (0);
}

$sql = "UPDATE users SET 
                    fullName = '$fullName', 
                    accessLevel = '$accessLevel'
                    WHERE userName = '$userNameToUpdate'";
echo $sql;
if (mysqli_query($link, $sql))
	{
		echo "success";
		header("Location: manageUsersForm.php? message=update success.");
	}
	else 
		{
            echo "failed";
            header("Location: manageUsersForm.php? message=deletion failed.");
		}

?>

<body>

</body>
</html>