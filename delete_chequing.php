<html>
    <h1>Delete Chequing Account</h1>
<body>
<style>
    body {
        background-image: url('BG.jpg');
        background-size: cover;
        background-color: #043F81;
        color: white;
        font-family: "Times New Roman", Times, serif;
        font-size: 26px;
    }
    input[type=text] {
        width: 10%;
        padding: 6px 12px;
    }
    a {
        list-style-type: none;
        text-decoration: none;
        color: white;
    }
</style>
<?php
if (isset($_COOKIE["username"])) {
    echo "<form action=\"deletechequing.php\" method=post>";
    
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    
    
    $con = new mysqli($server, $username, $password, $database);

    echo "Enter Account Number: <input type=text name=\"account_number\" size=15> <br><br>";
    echo "Enter Chequing Number: <input type=text name=\"chequing_number\" size=15> <br><br>";

    echo "<input type=submit name=\"submit\" value=\"Delete Chequing Account\">";

    echo "</form>";


} else {
    echo "<h3> You are not logged in! </h3> <p><a href=\"login.php\"> Login </a></p>";
}
echo "<p><a href=\"main.php\">Home</a></p>";
?>

</body>
</html>