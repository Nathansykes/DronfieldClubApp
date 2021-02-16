<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Page Title</title>
</head>

<?php
session_start();

if ($_SESSION['valid'] ?? "")
    {
        echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {  
    //If not the user cannot view the page in full, send them back to home with noaccess
    header("Location: ../../html/index.html? no_access");
}

$studentNum = $_POST['studentIdToTest'] ?? "";
$classId = $_POST['classIdToRegister'] ?? "";

echo "<br><br>";
echo "Student ID: ".$studentNum;
echo "<br><br>";

echo "Class ID: ".$classId;
echo "<br><br>";

$numOfObjective = 0;

//$classId = str_replace($classId,"\"","")

$classId = (int)$classId;

switch ($classId) {
    case 1:
        $numOfObjective = 13;
        break;
    case 2:
        $numOfObjective = 10;
        break;
    case 3:
        $numOfObjective = 9;
        break;
    case 4:
        $numOfObjective = 13;
        break;
    case 5:
        $numOfObjective = 12;
        break;
    case 6:
        $numOfObjective = 11;
        break;
    case 7:
        $numOfObjective = 10;
        break;
    default:
        break;
}
echo "Num of Objectives: ".$numOfObjective;
echo "<br><br>";

$objectives = [];



for ($i= 0; $i < $numOfObjective; $i++) // loop through number of tests
{
    $testPassFail = $_POST['test'.$i] ?? "";
   
    array_push($objectives,$testPassFail);
}

$passed = true; // Define passed with no default or false and set it as true if criteria is met

for ($i= 0; $i < count($objectives); $i++) //
{
    echo "test".$i." ".$objectives[$i];
    echo "<br><br>";
    if ($objectives[$i] == '0') // if test returned a zero
    {
        $passed = false;
        //break;
    } // after this loop, GOTO the else right away, skipping the if-else loop on line 74 entirely
}




include "../connect.php";

$newClassId = 0;

if($passed) 
{
    if ($classId < 7) 
    {
        $newClassId = $classId+1;
    }
    else 
    {
        header("Location: ../conductTestForm.php? student=passed");
        exit(0);
    }

    $sql = "UPDATE classmember SET classId = '$newClassId' WHERE studentNum = '$studentNum'";

    if (mysqli_query($link, $sql)) 
    {
        echo "success";
		header("Location: ../conductTestForm.php? student=passed");
    }
    else 
    {
        echo "failed";
		header("Location: ../conductTestForm.php? sql=failed");
    }
    // Move them up a group
}
else
{
    header("Location: ../conductTestForm.php? student=failed");
    // Send a message to the coach/admin to say they failed
}

?>
    <body>
            <form id="formToSubmit" action="" method="post" onsubmit="">
                <input type="hidden" name="studentIdToTest" value="<?php echo $studentNum;?>">
                <input type="hidden" name="classId" value="<?php echo $classId; ?>">
            </form>
            <script>
                //document.getElementById("formToSubmit").submit();
            </script>
    </body>
   


</html>