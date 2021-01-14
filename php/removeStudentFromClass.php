<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php

$studentIdToRemove = $_POST['studentIdToRemove'];
$classToUpdate = $_POST['classToUpdate'];
$remove = $_POST['remove'];

include "connect.php";

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