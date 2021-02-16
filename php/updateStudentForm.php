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
</head>

<?php

session_start();

//$secure = $_SESSION("Secure");

//Checks if the cookie is true, welcomes back user
//if (isset($_GET['cookie']) && $_GET['cookie'] == "true")
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
                    <?php
                    $accessLevel = $_SESSION['accessLevel'] ?? "";
                    if ($accessLevel == 2)  // Access 1 is a coach, 2 is admin
                    {
                        ?>
                        <li><a href="databaseManagment.php">Manage Members</a></li>
                        <?php
                    }
                    ?>
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

                    $studentIdToUpdate = $_POST['studentIdToUpdate'];
                    $update = $_POST['update'];

                    $sql = "SELECT * FROM  Students WHERE studentNum = '$studentIdToUpdate'";
                    $result = mysqli_query($link, $sql);
                 ?>

                 <div class="form">
                    <form action="../php/updateStudent.php" method="post" enctype="multipart/form-data">
                        <input name="studentIdToUpdate" type="hidden" value="<?php echo $_POST['studentIdToUpdate']; ?>">
                        <label for="studentName">Student's Name</label>
                        <input type="text" id="studentName" name="studentName" required>
                        <label for="studentDOB">Student's Date of Birth</label>
                        <input type="date" id="studentDOB" name="studentDOB" required>
                        <label for="studentAddress">Student's Home Address</label>
                        <input type="text" id="studentAddress" name="studentAddress" required>
                        <label for="parentName">Student's Parent's Name (Only One Required)</label>
                        <input type="text" id="parentName" name="parentName" required>
                        <label for="parentEmail">Parent's Email</label>
                        <input type="email" id="parentEmail" name="parentEmail" required>
                        <label for="parentPhone">Parent's Phone</label>
                        <input type="tel" id="parentPhone" name="parentPhone" required>
                        <label for="studentMedical">Student's Medical Information</label>
                        <input type="text" id="studentMedical" name="studentMedical">
                        <br><br>
                        <input type="submit" name="submit">
                        <br><br>
                    </form>
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