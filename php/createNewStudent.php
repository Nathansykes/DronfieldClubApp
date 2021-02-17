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

$studentNum = $_POST['studentNum'] ?? "";
$studentName = $_POST['studentName'] ?? "";
$studentDOB = $_POST['studentDOB'] ?? "";
$studentAddress = $_POST['studentAddress'] ?? "";
$parentName = $_POST['parentName'] ?? "";
$parentEmail = $_POST['parentEmail'] ?? "";
$parentPhone = $_POST['parentPhone'] ?? "";
$studentMedical = $_POST['studentMedical'] ?? "";
$previous = "javascript:history.go(-1)" ?? "";

if ($studentNum == "") 
{
    header("Location: $previous? no_class");
    exit (0);
}

//header("Location: databaseManagment.php? message=values received.$studentNum.$studentName.$studentDOB.$studentAddress.$parentName.$parentEmail.$parentPhone.$studentMedical");

$sql = "INSERT INTO students(studentNum,studentName,studentDOB,studentAddress,parentName,parentEmail,parentPhone,studentMedical) 
                    VALUES('$studentNum','$studentName','$studentDOB','$studentAddress','$parentName','$parentEmail','$parentPhone','$studentMedical')";

if (mysqli_query($link, $sql))
	{
		echo "success";
		header("Location: databaseManagment.php? message=update success.$studentNum");
	}
else 
    {
        echo "failed";
        header("Location: databaseManagment.php? message=deletion failed.$studentNum");
    }


?>

<body>
</body>
</html>
