<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <!-- Viewport here -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
    <!-- attach styles here -->
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/desktop.css" media="only screen and (min-width : 800px)"/>
    <link rel="icon" type="image/x-icon" href="../images/logoCOMP.png"/>
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
}
?>

<body>
    <div class="container">
        <header>
            <!--logo-->
            <div class="logo">
                <!--image logo will go here-->
                <img src="../images/logoCOMP.png" alt="Dronfield Swimming Club Logo" />

            </div>
            <!--login-->
            <div class="loginLink">
                <ul>
                    <li>
                        <a href="logout.php">Logout</a>
                        
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
                    <li><a href="conductTestForm.php">Conduct a Test</a></li>
                    <?php
                    $accessLevel = $_SESSION['accessLevel'] ?? "";
                    if ($accessLevel == 2)  // Access 1 is a coach, 2 is admin
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
                <h1 class="siteTitle">Dronfield Swimming Club | Add Student To Class </h1>
                <!--Here is the student records form which will execute the php script-->

                <?php

                include "connect.php";

                $sql = "SELECT * FROM  `Students` ORDER BY  `studentNum` DESC LIMIT 0 , 30";
                $result = mysqli_query($link, $sql);

                //echo $_GET['message'];
                //Student table
                echo "<br>
                <div class= 'form'>";
                
                echo "<table class= 'table'>";
                echo "<tr>";
                $counter=0;
                $classToUpdate = $_POST['classToUpdate'];
                
                while ($row=mysqli_fetch_row($result))
                {	
                        $studentToAdd = $row[0];
                        $counter++;
                        echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow'><span style='font-weight:bold'>Student Number: </span>". $row[0]. "</td>";
                        echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow'><span style='font-weight:bold'>Student Name: </span>". $row[1]. "</td>";
                        echo "</tr>";

                        echo "<tr id=member".$counter." class='tableRow hidden'>";
                        echo "<td colspan='2' id=member".$counter." class='tableRow hidden'>";                //Rows from the database	
                        ?>
                            <form  action="addStudentToClass.php" method="post" onsubmit="">
                                <input type="hidden" name="studentToAdd" value="<?php echo $studentToAdd; ?>">
                                <input type="hidden" name="classToUpdate" value="<?php echo "$classToUpdate"; ?>">
                                <input class="updateClassButton" type="submit" name="addStudent" value="Add Student To Class" class="updateButton">
                            </form>
                        <?php
                        echo "</td>";
                        
                        echo "</tr>";
                        echo "</form>";
                        
                    }
                    //Form for insert function
                
                    
                    
                echo "</table>";
                echo "</div";
                echo"<meta http-equiv='refresh' content='1'>";
                ?>
             </div>
            
        </main>
        <br/><br/>
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
</body>
</html>