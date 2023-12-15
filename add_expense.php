<html>
    <h1>Add Expense</h1>
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
    echo "<form action=\"addexpense.php\" method=post>";

$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$server = "vlamp.cs.uleth.ca";
$database = "gilm3660";

$con = new mysqli($server, $username, $password, $database);

echo "Enter Expense Classification: <input type=text name=\"expense_class\" size=20> <br><br>";
echo "Enter Account Number: <input type=text name=\"account_number\" size=25> <br><br>";
echo "Enter Amount: <input type=text name=\"amount\" size=20> <br><br>";
echo "Enter Expense Designation: <input type=text name=\"expense_designation\" size=15> <br><br>";

echo "<input type=submit name=\"submit\" value=\"Add Expense\">";

echo "</form>";

} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}
echo "<p><a href=\"main.php\">Home</a></p>";
?>
</body>
</html>
