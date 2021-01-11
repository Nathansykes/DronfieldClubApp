<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <!-- Viewport here -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
    <!-- attach styles here -->
    <link rel="stylesheet" href="css/mobile.css">
    <link rel="stylesheet" href="css/desktop.css" media="only screen and (min-width : 800px)"/>
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
                 <!--content goes here-->
                 <!--Here is the login form which will execute the php script-->
                <form action="login.php" method="post" enctype="multipart/form-data">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <input type="submit" name="submit">
                </form>
             </div>
         </main>
    </div>
    <!--javaScript files will be executed here-->
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/main.js"></script>

    <?php
    include "connect.php";
    //This is the message the user will recive if they enter invalid details
    if (isset($_GET['credit']) && $_GET['credit'] == "false")
        {
            echo "<br>Either username/password is incorrect, try again";
        }
    ?>
    
</body>
</html>