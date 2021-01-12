<?php

session_start();

//$secure = $_COOKIE("Secure");

//Checks if the cookie is true, welcomes back user
//if (isset($_GET['cookie']) && $_GET['cookie'] == "true")
if ($_SESSION['valid'])
    {
        echo "Welcome back ".$_COOKIE["User"].",  Access Level: ".$_SESSION['accessLevel'];
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
                <img src="https://media.discordapp.net/attachments/788419191870324769/798146408313782282/LOGO.png" alt="" />

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
                    <li><a href="../html/index.html">Home</a></li>
                    <li><a href="../html/classes.html">Classes</a></li>
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
                <h1 class="siteTitle">Dronfield Swimming Club | Student Records </h1>
                <!--Here is the student records form which will execute the php script-->

                <?php

                include "connect.php";

                $sql = "SELECT * FROM  `Students` ORDER BY  `studentNum` DESC LIMIT 0 , 30";
                $result = mysqli_query($link, $sql);

                //echo $_GET['message'];
                //Student table
                echo "<br>
                        <div class= 'form'>
                        <table class= 'table'>
                        <tr>

                        </tr>";
                    //Rows from the database	
                while ($row=mysqli_fetch_row($result))
                    {	
                        echo "<tr>";
                        echo "<td>". $row[0]. "</td>";
                        echo "<td>". $row[1]. "</td>";
                        echo "<td>". $row[2]. "</td>";
                        echo "<td>". $row[3]. "</td>";
                        echo "<td>". $row[4]. "</td>";
                        echo "<td>". $row[5]. "</td>";
                        echo "<td>". $row[6]. "</td>";
                        echo "<td>". $row[7]. "</td>";
                        echo "<td>"
                        ?>

                        
                    
                            <form action="deleteRecord.php" method="post" onsubmit="">
                                <input type="hidden" name="studentIdToDelete" value="<?php echo $row[0]; ?>">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        
                            <form action="updateRecordForm.php" method="post" onsubmit="">
                                <input type="hidden" name="studentIdToUpdate" value="<?php echo $row[0]; ?>">
                                <input type="submit" name="update" value="Update">
                            </form>
                        

                        <?php
                
                        echo "</td>";
                        echo "<tr>";
                        echo "</form>";
                    }
                    //Form for insert function
                echo "<tr>";
                    echo "<form action='newRecordForm.php' method='post' enctype='multipart/form-data'>";
                    echo "<td><input type='submit' name='insert' value='Create New' required></td>";
                echo "<tr>";     
                echo "</table>";
                echo "</form>";
                echo "</div";
                ?>
                <br>    
             </div>
         </main>
    </div>
    <!--javaScript files will be executed here-->
    <script src="../scripts/jquery-3.4.1.min.js"></script>
    <script src="../scripts/main.js"></script>
</body>
</html>