<html>
    <h1>Create Account</h1>
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
    echo "<form action=\"insert_account.php\" method=post>";

    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";


    $con = new mysqli($server, $username, $password, $database);

    echo "Enter First Name: <input type=text name=\"f_name\" size=20> <br><br>";
    echo "Enter Middle Name: <input type=text name=\"m_name\" size=20> <br><br>";
    echo "Enter Last Name: <input type=text name=\"l_name\" size=20> <br><br>";
    echo "Enter Birthday (yyyy/mm/dd): <input type=text name=\"dob\" size=8> <br><br>";
    echo "Enter Phone Number: <input type=text name=\"phone_number\" size=8> <br><br>";
    echo "Enter Address: <input type=text name=\"address\" size=20> <br><br>";    
    
    echo "<input type=submit name=\"submit\" value=\"Create Account\">";
    
    echo"</form>";
} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}
    echo "<p><a href=\"main.php\">Home</a></p>";
?>
</body>
</html>
