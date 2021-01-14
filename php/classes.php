<?php

session_start();

//$secure = $_COOKIE("Secure");

//Checks if the cookie is true, welcomes back user
//if (isset($_GET['cookie']) && $_GET['cookie'] == "true")
if (($_SESSION['valid']) && (($_SESSION['accessLevel'] == 1) || ($_SESSION['accessLevel'] == 2)))
    {
        echo "Welcome back ".$_COOKIE["User"].",  Access Level: ".$_SESSION['accessLevel'];
    }   
else {
    //If not the user cannot view the page in full
    die("Access to content denied") ;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <!-- Viewport here -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Classes</title>
    <!-- attach styles here -->
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/desktop.css" media="only screen and (min-width : 720px)"/>
    <link rel="icon" type="image/x-icon" href="https://cdn.discordapp.com/attachments/788419191870324769/798955834453393418/logoCOMP.png"/>
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
                <h1 class="siteTitle">Dronfield Swimming Club | Classes </h1>
                <!--Here is the student records form which will execute the php script-->

                <?php

                include "connect.php";

                $sql = "SELECT * FROM  `Classes` ORDER BY  `classDay` DESC LIMIT 0 , 30";
                $result = mysqli_query($link, $sql);
                $classId = 0;
                $studentNum = "";

                //echo $_GET['message'];
                //Student table
                echo "<br>
                <div class= 'form'>";
                echo "<form action='newStudentForm.php' method='post' enctype='multipart/form-data'>";
                echo "<input class= 'newMemberButton' type='submit' name='insert' value='Create New' required";
                echo "<br>";
                echo "</form>";
                echo "<table class= 'table'>";
                echo "<tr>";
                $counter=0;
                while ($row=mysqli_fetch_row($result))
                {	
                    $datetime =strtotime($row[2]);
                    $time = date('H:i',$datetime);

                    $counter++;
                    echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow'><span style='font-weight:bold'>Class Number: </span><br/>". $row[0]. "</td>";
                    echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow'><span style='font-weight:bold'>Day: </span><br/>". $row[1]. "</td>";
                    echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow'><span style='font-weight:bold'>Time: </span><br/>". $time. "</td>";
                    echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow'><span style='font-weight:bold'>Staff: </span><br/>". $row[3]. "</td>";
                    echo "</tr>";
                    $classId = $row[0];

                } 
                echo "</tr>";
                    echo "<td id=member".$counter." class='tableRow hidden' colspan='4'>";
                    ?>
                            <form action="updateClassForm.php" method="post" onsubmit="">
                                <input type="hidden" name="classToUpdate" value="<?php echo $classId; ?>">
                                <input type="submit" name="editClass" value="Update Class" class="updateClassButton">
                            </form>
                        <?php
                        echo "</td>";
                    echo "</tr>";
                
                $sql = "SELECT studentNum FROM  classmember WHERE classId = '$classId'";
                $result = mysqli_query($link, $sql);
                
                while ($row=mysqli_fetch_row($result))
                {	
                    echo "<tr id=member".$counter." class='tableRow hidden'>";
                    echo "<td class='classRecord' colspan='2'><span style='font-weight:bold'>Student Number: </span><br/>". $row[0]."</td>";
                    $studentNum = $row[0];

                    $sql2 = "SELECT studentName FROM  students WHERE studentNum = '$studentNum'";
                    $result2 = mysqli_query($link, $sql2);
                    
                    while ($row2=mysqli_fetch_row($result2))
                    {	
                        
                        echo "<td class='classRecord' colspan='2'><span style='font-weight:bold'>Student Name: </span><br />". $row2[0]."</td>";
                        
                    }
                    
                    echo "</form>";
                
                    while ($row2=mysqli_fetch_row($result2))
                    {	
                        
                        echo "<td class='classRecord' colspan='2'><span style='font-weight:bold'>Student Name: </span><br />". $row2[0]."</td>";
                        
                    }
                    
                    echo "</form>";
                
                    while ($row2=mysqli_fetch_row($result2))
                    {	
                        
                        echo "<td class='classRecord' colspan='2'><span style='font-weight:bold'>Student Name: </span><br />". $row2[0]."</td>";
                        
                    }
                    
                    echo "</form>";
                
                    while ($row2=mysqli_fetch_row($result2))
                    {	
                        
                        echo "<td class='classRecord' colspan='2'><span style='font-weight:bold'>Student Name: </span><br />". $row2[0]."</td>";
                        
                    }
                    
                    echo "</form>";
                }
                
                echo "</table>";
                    ?>
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
    <script src="../scripts/jquery-3.4.1.min.js"></script>
    <script src="../scripts/main.js"></script>
</body>
</html>