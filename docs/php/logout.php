<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Page Title</title>
</head>

<?php
session_start();
echo "Logged out ".$_COOKIE["User"]."! ";

setcookie("User", '', null - 1, '/');

unset($session['valid']);
ini_set($session, 0);
session_destroy();


exit(header("location: ../html/index.html"));

?>


<body>
</body>
</html>