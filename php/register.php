<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Register</title>
</head>

<?php
    session_start();
    include "../php/connect.php";

    if ($_SESSION['valid'] ?? "" && ($_SESSION['accessLevel'] == 2 ?? ""))
    {
        echo "Welcome back ".$_SESSION["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
    else 
    {
        //If not the user cannot view the page in full
        header("Location: ../html/index.html? no_access");
        exit(0);
    }

    $classId = $_POST['classIdToRegister'] ?? "";
   
    $studentNum = "";
    $sql = "SELECT studentNum FROM  classmember WHERE classId = '$classId'";        // getting all student numbers from database where classId matches
    $result = mysqli_query($link, $sql);
    $numOfStudents = mysqli_num_rows($result);                                      // storing number of students from registration form
    $success = false;

    while ($row=mysqli_fetch_row($result))
    {	
        $studentNum = $row[0];
        $attendance = $_POST[$studentNum];
        echo "<br>";
        echo $studentNum;
        echo "<br>";
        echo $_POST[$studentNum];
        echo "<br>";
        
        $timeOfAttendance = date("Y-m-d 00:00:00");                                 // format current date
        echo $timeOfAttendance;
        $sqlCheck = "SELECT * FROM attendance WHERE classId = '$classId' AND timeOfAttendance = '$timeOfAttendance'";
        $resultCheck = mysqli_query($link, $sqlCheck);
        $numOfRows = mysqli_num_rows($resultCheck);                                 // number of rows returned is stored
        
        echo "<br>";
        echo "<br>";
        echo "number of students :";
        echo $numOfStudents;
        echo "<br>";
        echo "<br>";

        if ($numOfRows == $numOfStudents)                                           // if number of rows returned is the same as the number of students
        {
            while ($row=mysqli_fetch_row($resultCheck))                             // loops only if sql return fields
            {
                echo "in while loop";
                                                                                    // update student record
                $sqlUpdate = "UPDATE attendance SET
                                attendance = '$attendance'
                                WHERE studentNum = '$studentNum' AND classId = '$classId' AND timeOfAttendance = '$timeOfAttendance'";
                echo "<br>";
                echo "<br>";
                echo $sqlUpdate;
                echo "<br>";
                echo "<br>";
                if (mysqli_query($link, $sqlUpdate))
                {
                    echo "<br>";
                    echo "update success";
                    echo "<br>";
                    $success = true;
                }
            }
        }
        if ($numOfRows < $numOfStudents)                                            // if number of students is less than insert new record
        {
            echo "here row is 0";
            $sqlInsert = "INSERT INTO attendance (classId, studentNum, timeOfAttendance, attendance) VALUES ('$classId', '$studentNum', '$timeOfAttendance', '$attendance')";
            echo "<br>";
            if (mysqli_query($link, $sqlInsert))
            {
                echo "<br>";
                echo "insert success";
                echo "<br>";
                $success = true;   
            }   
        }        
        
    }

    if($success)
    {
        //header("Location: securehomepage.php?message=register+success");
    }
    else 
    {
        //header("Location: securehomepage.php?message=register+failed");
    }

    
    
?>