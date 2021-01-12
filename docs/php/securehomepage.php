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
    <title>Dronfield Swimming Club - Home</title>
    <!-- attach styles here
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     -->
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/desktop.css" media="only screen and (min-width : 800px)"/>
</head>
<body onresize="resizeFunction()">
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
                    <li><a href="securehomepage.php">Home</a></li>
                    <li><a href="../html/classes.html">Classes</a></li>
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
                <h1 class="siteTitle">Dronfield Swimming Club | Welcome! </h1>
                <img src="../images/swimmer-min.png" alt="" />
                <p class="siteDesc">Our swimming club has been around for over 30 years! With an incredible team behind us, 
                    we welcomes all coaches and faculty staff to our online application!</p>
                <br><br>
                
                <div class="sectionBreak">
                    <h1 class="sectionTitle">The Main Features</h1>
                    <p class="sectionDesc">& how they benefit you!</p>
                    <br><br>
                </div>
                <div class="cards">

                    <div class="card">
                        <div class="cardImage">
                            <img src="../images/trackProgress-min.png" alt="cardImage1" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h3 class="cardTitle">Track Progress!</h3>
                            <p class="cardDesc">As a coach, this application gives you the ability to track your swimmers progress throughout each session, allows you to identify
                            areas that need to be worked on, and gives you an insight across completed sessions to see how much the swimmer has improved. </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="cardImage">
                            <img src="../images/conductATest -min.png" alt="cardImage2" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h3 class="cardTitle">Conduct a test!</h3>
                            <p class="cardDesc">When you as a coach feel your class is ready to progress in to the next group, this application provides you the feature to conduct a test,
                                in which you can set up desired milestones for the swimmers to attempt to acheive certain thresholds and evaluate
                                whether you feel they are ready to move to the next group!</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="cardImage">
                            <img src="../images/completeControl-min.png" alt="cardImage2" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h3 class="cardTitle">Complete control!</h3>
                            <p class="cardDesc">This application allows the coach to be completely in control and commit changes such as removing or adding swimmers to certain groups, conduct notes about a certain 
                                swimmers performance and track attendence and achieved goals, all whilst inheriting a fast and seamless UI system. </p>
                        </div>
                    </div>

                </div>
                <br><br>
                <br><br>
                <br><br>
             </div>

             <!--Boostrap cards informing Coaches what they can do with the application-->    

         </main>
         <footer>
            <div class="row">
                <address>
                  Dronfield Sports Centre<br />
                  Dronfield<br />
                  Derbyshire<br />
                  S42 6NG
    <!--javaScript files will be executed here-->
    <script src="../scripts/jquery-3.4.1.min.js"></script>
    <script src="../scripts/main.js"></script>
</body>
</html>