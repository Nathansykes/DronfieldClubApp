<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php
$classToUpdate = $_POST['classToUpdate'];
$update = $_POST['update'];
$classDay = $_POST['classDay'];
$classTime = $_POST['classTime'];
$classStaff = $_POST['classStaff'];


include "connect.php";

if ($_SESSION['valid'])
    {
        echo "Welcome back ".$_COOKIE["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {  
    //If not the user cannot view the page in full, send them back to home with noaccess
    header("Location: ../html/index.html? no_access");
}

$dateTimeFormat = strtotime($datetime);



$sql = "UPDATE classes SET 
                    classDay = '$classDay', 
                    classTime = '0000-00-00 $classTime:00',
                    classStaff = '$classStaff'
                    WHERE classId = '$classToUpdate'";
//echo $sql;
echo $classToUpdate;
echo "\n";
echo $classDay;
echo "\n";
echo $classTime;
echo "\n";
echo $dateTimeFormat;
echo "\n";
echo $classStaff;
echo "\n";
echo "0000-00-00 $classTime:00";
if (mysqli_query($link, $sql))
	{
		echo "success";
		header("Location: classes.php? message=success");
	}
else 
    {
        echo "failed";
		header("Location: classes.php? message=failed");
    }

?>

<body>

</body>
</html>