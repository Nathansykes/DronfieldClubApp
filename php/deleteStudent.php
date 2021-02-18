<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php

    session_start();

    //Instantaite new POST method variables in relation to the database to add a student to a class but set primitive to empty if null

    $studentIdToDelete = $_POST['studentIdToDelete'] ?? "";
    $archived = $_POST['archived'] ?? "";
    $delete = $_POST['delete'] ?? "";

    //Variable for previous instance of javascript, reload previous action made

    $previous = "javascript:history.go(-1)" ?? "";

    //Extend thread with connect.php

    include "connect.php";

    if ($_SESSION['valid'] ?? "")
        {
            //If the cookie is validated by a user/coach signing in, welcome them back to the page
            echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
        }   
    else 
        {  
            //If not the user cannot view the page in full, send them back to home with noaccess
            header("Location: ../html/index.html? no_access");
            exit(0);
        }

    //If field is empty

    if ($studentIdToDelete == "") 
    {
        header("Location: $previous?no_student"); //no student found
        exit (0);
    }

    $sql="";

    //If student is archived

    if($archived = "true") 
    {
        $sql = "DELETE FROM archiveStudents WHERE studentNum = '$studentIdToDelete'"; //Delete field from archive students where studentNum is equal to user being deleted
    }

    //If not

    else if($archived = "false")
    {
        $sql = "DELETE FROM students WHERE studentNum = '$studentIdToDelete'"; //Delete field from students where studentNum is equal to user being deleted
    }
    else
    {
        header("Location: $previous?no_student"); //No student found
        exit (0);
    }


    //If database recieves query

    if (mysqli_query($link, $sql))
    {
        echo "success";
        header('Location: databaseManagment.php? message=deletion success'); //Deletion success
    }
    else 
    {
        echo "failed";
        header("Location: databaseManagment.php? message=deletion failed.$studentIdToDelete"); //Deletion failed for (student)
    }
?>

<body>
</body>
</html>