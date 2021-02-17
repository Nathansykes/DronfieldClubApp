<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php

session_start();

$studentIdToRemove = $_POST['studentIdToRemove'] ?? "";
$classToUpdate = $_POST['classToUpdate'] ?? "";
$remove = $_POST['remove'] ?? "";

include "connect.php";

if ($_SESSION['valid'] ?? "")
    {
        echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {  
    //If not the user cannot view the page in full, send them back to home with noaccess
    header("Location: ../html/index.html? no_access");
    exit(0);
}


$sql = "DELETE FROM classMember WHERE studentNum = '$studentIdToRemove' AND classId = '$classToUpdate'";

if (mysqli_query($link, $sql))
	{
		echo "success";
		header("Location: updateClassForm.php? classToUpdate=$classToUpdate");
		
	}
	else 
		{
            echo "failed";
            header("Location: updateClassForm.php? classToUpdate=$classToUpdate");
		}
?>

<body>
</body>
</html>