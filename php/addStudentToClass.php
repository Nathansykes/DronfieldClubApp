<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php

$studentToAdd = $_POST['studentToAdd'];
$classToUpdate = $_POST['classToUpdate'];


include "connect.php";

if ($_SESSION['valid'])
    {
        echo "Welcome back ".$_COOKIE["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {  
    //If not the user cannot view the page in full, send them back to home with noaccess
    header("Location: ../html/index.html? no_access");
}

$sql = "INSERT INTO classmember(classId, studentNum) VALUES('$classToUpdate', '$studentToAdd')";

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