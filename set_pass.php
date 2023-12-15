<?php
$username = $_POST['username'];
$password = $_POST['password'];
$server = "vlamp.cs.uleth.ca";
$database = "gilm3660";

try {
    $con = mysqli_connect($server, $username, $password, $database);
} catch (Exception $e) {
    echo $e -> getMessage();
}

echo "Username is $username, password is $password.";

setcookie("username", $username,time()+3600);
setcookie("password", $password,time()+3600);

header("Location:main.php");

?>
