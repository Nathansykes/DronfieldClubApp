<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Page Title</title>
</head>

<?php
session_start();
echo "Logged out ".$_SESSION["User"]."! ";

$valid = ($session['valid'] ?? "");

unset($valid);
ini_set($session ?? "", 0);
session_destroy();


exit("location: ../html/index.html");
// exit(header())
?>

<body>
</body>
</html>