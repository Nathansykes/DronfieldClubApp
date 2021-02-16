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
$classId = $_POST['classId'] ?? "";

$destination = "";


switch ($classId) {
    case '1':
        $destination = "level1Test.php";
        break;
    case '2':
        $destination = "level2Test.php";
        break;
    case '3':
        $destination = "level3Test.php";
        break;
    case '4':
        $destination = "level4Test.php";
        break;
    case '5':
        $destination = "level5Test.php";
        break;
    case '6':
        $destination = "level6Test.php";
        break;
    case '7':
        $destination = "level7Test.php";
        break;
    default:
        # code...
        break;
}
?>
    <body>
            <form id="formToSubmit" action="<?php echo $destination;?>" method="post" onsubmit="">
                <input type="hidden" name="studentIdToTest" value="<?php echo $studentNum;?>">
                <input type="hidden" name="classId" value="<?php echo $classId; ?>">
            </form>
            <script>
                document.getElementById("formToSubmit").submit();
            </script>
    </body>
   


</html>