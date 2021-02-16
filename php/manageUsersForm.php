<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <!-- Viewport here -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dronfield Swimming Club - New Student Form</title>
    <!-- attach styles here -->
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/desktop.css" media="only screen and (min-width : 800px)"/>
    <link rel="icon" type="image/x-icon" href="https://cdn.discordapp.com/attachments/788419191870324769/798955834453393418/logoCOMP.png"/>
</head>

<?php
session_start();
//Checks if the cookie is true, welcomes back user
if (($_SESSION['valid']) && ($_SESSION['accessLevel'] == 2))
    {
        echo "Welcome back ".$_COOKIE["User"].",  Access Level: ".$_SESSION['accessLevel'];
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
                    <li><a href="../html/testing.html">Conduct a Test</a></li>
                    <?php
                    if ($_SESSION['accessLevel'] == 2) // Access 1 is a coach, 2 is admin
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


                 <div class="form">
                    <form action="manageUsers.php" method="POST">
                        <input type="submit" name="submit" value="Generate A New Key">
                        <br><br>
                    </form>
                 </div>
                 <?php

                    include "connect.php";
                    $key = $_POST['key'];

                    if($key != "")
                    {
                        ?>
                            <h1>Key has been made!</h1>
                            <button onclick="copyToClipboard('<?php echo $key; ?>')">Copy Key To Clipboard</button>
                            
                        <?php
                    }
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
    <!--javaScript files will be executed here-->
    <script src="../scripts/jquery-3.4.1.min.js"></script>
    <script src="../scripts/main.js"></script>
    <script>
        <?php
        while ($row=mysqli_fetch_row($result))
        {	
            ?>
            document.getElementById("studentName").defaultValue = "<?php echo $row[1]; ?>"
            document.getElementById("studentDOB").defaultValue = "<?php echo $row[2]; ?>"
            document.getElementById("studentAddress").defaultValue = "<?php echo $row[3]; ?>"
            document.getElementById("parentName").defaultValue = "<?php echo $row[4]; ?>"
            document.getElementById("parentEmail").defaultValue = "<?php echo $row[5]; ?>"
            document.getElementById("parentPhone").defaultValue = "<?php echo $row[6]; ?>"
            document.getElementById("studentMedical").defaultValue = "<?php echo $row[7]; ?>"
        <?php } ?>
    </script>
</body>
</html>