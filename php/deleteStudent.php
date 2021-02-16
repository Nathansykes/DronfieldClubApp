<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php

$studentIdToDelete = $_POST['studentIdToDelete'] ?? "";
$delete = $_POST['delete'] ?? "";
$previous = "javascript:history.go(-1)" ?? "";

include "connect.php";

if ($_SESSION['valid'] ?? "")
    {
        echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {  
    //If not the user cannot view the page in full, send them back to home with noaccess
    header("Location: ../html/index.html? no_access");
}

if ($studentIdToDelete == "") 
{
    header("Location: $previous?no_student");
    exit (0);
}

$sql = "DELETE FROM students WHERE studentNum = '$studentIdToDelete'";

if (mysqli_query($link, $sql))
	{
		echo "success";
		header('Location: databaseManagment.php? message=deletion success');
	}
	else 
		{
            echo "failed";
            header("Location: databaseManagment.php? message=deletion failed.$studentIdToDelete");
		}
?>

<body>
</body>
</html>