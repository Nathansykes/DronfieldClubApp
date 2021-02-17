<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dronfield Swimming Club - Registration</title>
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/desktop.css" media="only screen and (min-width : 800px)" />
    <link rel="icon" type="image/x-icon" href="../images/logoCOMP.png"/>
</head>
<?php

session_start();

//$secure = $_SESSION("Secure");

//Checks if the cookie is true, welcomes back user
//if (isset($_GET['cookie']) && $_GET['cookie'] == "true")
if (($_SESSION['valid'] ?? "") && (($_SESSION['accessLevel'] == 1 ?? "") || ($_SESSION['accessLevel'] > 1 ?? "")))
    {
        echo "Welcome back ".($_SESSION["User"]?? "").",  Access Level: ".$_SESSION['accessLevel'];
    }   
else {
    //If not the user cannot view the page in full
    header("Location: ../html/index.html? no_access");
    exit(0);
}

?>
<body>
    <div class="container">
        <header>
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

        <script>
            function darkMode() {
                var element = document.body;
                var element2 = document.loginLink;
                element.classList.toggle("darkMode");
                element2.classList.toggle("darkMode");
            }
        </script>

        <main>
            <div class="mainContent">
                <!--content goes here-->
                <h1 class="siteTitle">Dronfield Swimming Club | Registration </h1>
                <!--Here is the student records form which will execute the php script-->
                <?php
                include "connect.php";

                $classToRegister = $_POST['classToRegister'] ?? "";
                $update = $_POST['update'] ?? "";

                ?>
                <script> console.info(<?php echo $classToRegister; ?>) </script>
                <?php

                if(empty($classToRegister))
                {
                    $classToRegister = $_GET['classToRegister'];
                    ?>
                    <script> console.info(<?php echo $classToRegister; ?>) </script>
                    <?php
                }
                ?>
                <div class="form"> <!--Form for updating users-->
                  
                <?php
                //Student table
                $timeOfAttendance = date("Y-m-d 00:00:00");

                $studentNum = "";
                $sql = "SELECT studentNum FROM  classmember WHERE classId = '$classToRegister'";
                $result = mysqli_query($link, $sql);
                ?>
                
                <br> 
                <?php
                
                echo "<form action='register.php' method='post' enctype='multipart/form-data'>";
                echo "<table class= 'table'>";
                $counter=0;
                while ($row=mysqli_fetch_row($result))
                {	
                    $counter++;
                    echo "<tr class='tableRow'>";
                    echo "<td id=member".$counter." onclick='OpenRows(this.id)' class='topRow2'><span style='font-weight:bold'>Student Number: </span><br />". $row[0]."</td>";
                    $studentNum = $row[0];

                    $sql2 = "SELECT studentName FROM students WHERE studentNum = '$studentNum'";
                    $result2 = mysqli_query($link, $sql2);
                    
                    while ($row2=mysqli_fetch_row($result2))
                    {	
                        
                        
                        $checked = "";
                        $sqlCheck = "SELECT attendance FROM attendance WHERE classId = '$classToRegister' AND timeOfAttendance = '$timeOfAttendance' AND studentNum = '$studentNum'";
                        $resultCheck = mysqli_query($link, $sqlCheck);
                        
                        $values = mysqli_fetch_row($resultCheck);
                        $value = $values[0] ?? "";
                        
                        if ($value == 0)
                        {
                            $checked="";
                        }
                        else 
                        {
                            $checked="checked='true'";
                        }
                        
                        echo "<td id=member".$counter." class='topRow2'><span style='font-weight:bold'>Student Name: </span><br />". $row2[0]."</td>";
                        ?>
                        <td class='topRow2' style="width : 25% ">
                            <span style='font-weight:bold'> Present </span><br>
                            <input type="hidden" id="registerHidden" name="<?php echo $studentNum;?>" value="0">
                            <input type="checkbox" onclick="hideAbsent()" id="register" name="<?php echo $studentNum;?>" value="1" <?php echo $checked;?>>
                        
                        <?php
                        echo "</td>";
                        
                        echo "</tr>";
                        
                    }                     
                    
                }


                ?>
                <script>
                    function hideAbsent() 
                    {
                        if(document.getElementById("register").checked) 
                        {
                            document.getElementById('registerHidden').disabled = true;
                        }
                        
                    }
                </script>
                <?php
                echo "<input type='hidden' name='classIdToRegister' value='$classToRegister'>";
                ?>
                </table>
                <br>
                <input class='registerSubmit' type='submit' value='Submit' style="float: right">
                </form>

            </div>
            
        </main> <!--Main body ends here-->
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