<?php

session_start();

//$secure = $_COOKIE("Secure");

//Checks if the cookie is true, welcomes back user
//if (isset($_GET['cookie']) && $_GET['cookie'] == "true")
if ($_SESSION['valid'])
    {
        echo "Welcome back ".$_COOKIE["User"]."! ";
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
    <link rel="stylesheet" href="css/mobile.css">
    <link rel="stylesheet" href="css/desktop.css" media="only screen and (min-width : 800px)"/>
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
                        <a href="loginForm.php">Login</a>
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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="classes.html">Classes</a></li>
                    <li><a href="testing.html">Conduct a Test</a></li>
                </ul>
            </div>
        </nav>
         <!--the main content for the site-->
         <main>
             <div class="mainContent">
                 <div class="cotainer-fluid">
                    <div class="site-content">
                        <div class="d-flex flex-column">
                                <h1 class="siteTitle">Dronfield Swimming Club | Secure Homepage </h1>
                                <img src="https://cdn.discordapp.com/attachments/788419191870324769/798172367808888832/img-d59a1e029c9958cf333e15513f30d61d.png" alt="" />
                                <p class="siteDesc">Our swimming club has been around for over 30 years! With an incredible team behind us, 
                                    we welcomes all coaches and faculty staff to our online application!
                        </div>
                    </div>
                 </div>
             </div>

             <!--Boostrap cards informing Coaches what they can do with the application-->

             <div class="section-1">
                 <div class="row justify-content-center text-center">
                    <div class="container text-center">
                        <h1 class="section1Title">The Main Features</h1>
                        <p class="section1Desc">& how they benefit you!</p>
                    </div>
                 </div>
                 

                 <div class="col-md-4">
                     <div class="row justify-content-center text-center">
                        <div class="infoCard" style="width: 20rem;">
                            <img src="https://cdn.discordapp.com/attachments/788419191870324769/798218579031359488/progress-bar-square.png" alt="cardImage1" class="card-img-top">
                            <div class="card-body">
                                <h3 class="cardTitle">Track Progress!</h3>
                                <p class="cardDesc">As a coach, this application gives you the ability to track your swimmers progress throughout each session, allows you to identify
                                    areas that need to be worked on, and gives you an insight across completed sessions to see how much the swimmer has improved. 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="infoCard" style="width: 20rem;">
                                <img src="https://cdn.discordapp.com/attachments/788419191870324769/798229896551858226/smiling-female-coach-writing-clipboard-portrait-near-poolside-90451677.png" alt="cardImage1" class="card-img-top">
                                <div class="card-body">
                                    <h3 class="cardTitle">Conduct a test!</h3>
                                    <p class="cardDesc">As  
                                </div>
                            </div>
                        </div>
                        

     

                     </div>
             </div>

             

         </main>
    </div>
    <!--javaScript files will be executed here-->
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>