<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php

session_start();

$studentIdToUpdate = $_POST['studentIdToUpdate'] ?? "";
$update = $_POST['update'] ?? "";
$studentName = $_POST['studentName'] ?? "";
$studentDOB = $_POST['studentDOB'] ?? "";
$studentAddress = $_POST['studentAddress'] ?? "";
$parentName = $_POST['parentName'] ?? "";
$parentEmail = $_POST['parentEmail'] ?? "";
$parentPhone = $_POST['parentPhone'] ?? "";
$studentMedical = $_POST['studentMedical'] ?? "";
$previous = "javascript:history.go(-1)" ?? "";


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

if ($studentIdToUpdate == "") 
{
    header("Location: $previous?no_student");
    exit (0);
}

$sql = "UPDATE students SET 
                    studentName = '$studentName', 
                    studentDOB = '$studentDOB',
                    studentAddress = '$studentAddress',
                    parentName = '$parentName',
                    parentEmail = '$parentEmail',
                    parentPhone = '$parentPhone',
                    studentMedical = '$studentMedical'
                    WHERE studentNum = '$studentIdToUpdate'";
echo $sql;
if (mysqli_query($link, $sql))
	{
		echo "success";
		header("Location: databaseManagment.php? message=update success.");
	}
	else 
		{
            echo "failed";
            header("Location: databaseManagment.php? message=deletion failed.");
		}

?>

<body>

</body>
</html>