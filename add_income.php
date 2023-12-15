<html>
    <h1>Add Source of Income</h1>
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
if(isset($_COOKIE["username"])) {
    echo "<form action=\"addincome.php\" method=post>";

$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$server = "vlamp.cs.uleth.ca";
$database = "gilm3660";

$con = new mysqli($server, $username, $password, $database);

echo "Income Classification: <input type=text name=\"income_class\" size=20> <br><br>";
echo "Account Number: <input type=text name=\"account_number\" size=25> <br><br>";
echo "Amount: <input type=text name=\"amount\" size=20> <br><br>";
echo "Income Designation: <input type=text name=\"income_designation\" size=15> <br><br>";

echo "<input type=submit name=\"submit\" value=\"Add source of income\">";

echo "</form>";

} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}
echo "<p><a href=\"main.php\">Home</a></p>";
?>

</body>
</html>
