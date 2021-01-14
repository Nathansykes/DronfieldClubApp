
<?php

session_start();

//$secure = $_COOKIE("Secure");

//Checks if the cookie is true, welcomes back user
//if (isset($_GET['cookie']) && $_GET['cookie'] == "true")
if ($_SESSION['valid'])
    {
        echo "Welcome back ".$_COOKIE["User"].", Access Level: ".$_SESSION['accessLevel']."! ";
    }   
else {
    //If not the user cannot view the page in full
    die("Access to content denied") ;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <!-- Viewport here -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
    <!-- attach styles here -->
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/desktop.css" media="only screen and (min-width : 800px)"/>
</head>
<body>
    <div class="container">
        <header>
            <!--logo-->
            <div class="logo">
                <!--image logo will go here-->
                <img src="https://cdn.discordapp.com/attachments/788419191870324769/798955834453393418/logoCOMP.png" alt="Dronfield Swimming Club Logo" />

            </div>
            <!--login-->
            <div class="loginLink">
                <ul>
                    <li>
                        <a href="../php/loginForm.php">Login</a>
                    </li>
                </ul>
            </div>
            <!--burger menu-->
            <div class="burgerMenu">
                <div class="bars">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </div>
        </header>
         <!--navigation header at top of page-->
        <nav class="mainNav">
            <div class="row">
                <ul>
                    <li><a href="securehomepage.php">Home</a></li>
                    <li><a href="classes.php">Classes</a></li>
                    <li><a href="../html/testing.html">Conduct a Test</a></li>
                    <?php
                    if ($_SESSION['accessLevel'] == 2) 
                    {
                        ?>
                        <li><a href="databaseManagment.php">Manage Members</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
         <!--the main content for the site-->
         <main>
             <div class="mainContent">
                 <!--content goes here-->
                 <h1 class="siteTitle">Dronfield Swimming Club | Update </h1>
                 <!--Here is the login form which will execute the php script-->

                 <?php

                    include "connect.php";

                    $classToUpdate = $_POST['classToUpdate'];
                    $update = $_POST['update'];

                    ?>
                        <script> console.info(<?php echo $classToUpdate; ?>) </script>
                    <?php


                    if(empty($classToUpdate))
                    {
                        $classToUpdate = $_GET['classToUpdate'];
                        ?>
                        <script> console.info(<?php echo $classToUpdate; ?>) </script>
                        <?php
                    }

                    $sql = "SELECT * FROM  classes WHERE classId = '$classToUpdate'";
                    $result = mysqli_query($link, $sql);
                 ?>



                 <div class="form"> <!--Form for updating meeting-->
                 <h2>Update Class</h2>
                 <br><br>
                 <br><br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input name="classToUpdate" type="hidden" value="<?php echo $_POST['classIdToUpdate']; ?>">
                        <label for="classDay">Day of the Week</label>
                            <select name="classDay" id="classDay">
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                            </select>
                        <label for="classTime">Time (24hr)</label>
                        <input type="time" id="classTime" name="classTime">
                        <label for="classStaff">Staff</label>
                        <input type="text" id="classStaff" name="classStaff">
                        <br><br>
                        <input type="submit" name="submit" class="newMemberbutton">
                        <br><br>
                    </form>
                 </div>

                 <div class="form"> <!--Form for updating users-->
                 <h2>Update Students</h2>
                 
                 
                 <?php
                 //Student table

                //$sql = "SELECT * FROM  `Classes` ORDER BY  `classDay` DESC LIMIT 0 , 30";
                //$result = mysqli_query($link, $sql);
                $studentNum = "";

                //echo $_GET['message'];
                
                $sql = "SELECT studentNum FROM  classmember WHERE classId = '$classToUpdate'";
                $result = mysqli_query($link, $sql);
                
                ?>
                <div class= "form">
                <form action="addStudentToClassList.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="classToUpdate" value="<?php echo $classToUpdate; ?>">
                <input class= "newMemberButton" type="submit" name="insert" value="Add Student" required>
                <br>
                </form>
                    
                <?php
                echo "<table class= 'table'>";
                $counter=0;
                while ($row=mysqli_fetch_row($result))
                {	
                    $counter++;
                    echo "<tr class='tableRow'>";
                    echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow'><span style='font-weight:bold'>Student Number: </span><br />". $row[0]."</td>";
                    $studentNum = $row[0];

                    $sql2 = "SELECT studentName FROM  students WHERE studentNum = '$studentNum'";
                    $result2 = mysqli_query($link, $sql2);
                    
                    while ($row2=mysqli_fetch_row($result2))
                    {	
                        
                        echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow'><span style='font-weight:bold'>Student Name: </span><br />". $row2[0]."</td>";
                       
                        echo "<tr id=member".$counter." class='tableRow hidden'>";
                        echo "<td id=member".$counter." class='tableRow hidden' colspan='2'>";                //Rows from the database	
                        ?>
                            <form action="removeStudentFromClass.php" method="post" onsubmit="">
                                <input type="hidden" name="studentIdToRemove" value="<?php echo $studentNum; ?>">
                                <input type="hidden" name="classToUpdate" value="<?php echo $classToUpdate; ?>">
                                <input type="submit" name="remove" value="Remove Student" class="newMemberbutton">
                            </form>
                        <?php
                        echo "</td>";
                        echo "</td>";
                        echo "</tr>";
                        
                    } 
                    
                    
                }
                echo "</form>";
                
                
                echo "</table>";
                ?>

                 <br><br>
                 
                 </div>

             </div>
         </main>
    </div>
    <footer>
        <div class="row">
            <address>
                Dronfield Sports Centre<br /> Dronfield<br /> Derbyshire<br /> S42 6NG
            </address>
        </div>
    </footer>
    <!--javaScript files will be executed here-->
    <script src="../scripts/jquery-3.4.1.min.js"></script>
    <script src="../scripts/main.js"></script>
    <script>
        <?php
        while ($row=mysqli_fetch_row($result))
        {	
            ?>
            var temp;
            var classDay = document.getElementById("classDay");
            

            for (var i = 1; i < 7; i++) // seven days in a week
            {
                if(classDay[i].value = "<?php echo $row[1]; ?>")
                {
                    classDay.selectedIndex = i;
                    break;
                }
                
            }
            document.getElementById("classTime").defaultValue = "<?php echo $row[2]; ?>"
            document.getElementById("classStaff").defaultValue = "<?php echo $row[3]; ?>"
        <?php } ?>
    </script>
</body>
</html>