<html>
    <h1>Update Account Information</h1>
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
    echo "<form action=\"update_account.php\" method=post>";

    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";

    try {
        $conn = new mysqli($server, $username, $password, $database);
    } catch (Exception $e) {
        echo "Connection Problem!";
        exit; 
    }

    $sql = "select * from ACCOUNT_OWNER where account_number = '$_POST[account_number]'";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Problem executing select.";
        exit;
    }

    if ($result->num_rows != 0) {
        $rec = $result->fetch_assoc();
        echo "Enter Account Number: <input type=text name=\"account_number\" value=\"$rec[account_number]\"><br><br>";
        echo "Enter First Name: <input type=text name=\"f_name\" value=\"$rec[f_name]\"><br><br>";
        echo "Enter Middle Name: <input type=text name=\"m_name\" value=\"$rec[m_name]\"><br><br>";
        echo "Enter Last Name: <input type=text name=\"l_name\" value=\"$rec[l_name]\"><br><br>";
        echo "Enter Birthday (yyyy/mm/dd): <input type=text name=\"dob\" value=\"$rec[dob]\"><br><br>";
        echo "Enter Phone Number: <input type=text name=\"phone_number\" value=\"$rec[phone_number]\"><br><br>";
        echo "Enter Address: <input type=text name=\"address\" value=\"$rec[address]\"><br><br>";
        echo "<input type=hidden name=\"oldname\" value=\"$_POST[account_number]\">";
        echo "<input type=submit name=\"submit\" value=\"Update Account\">";
    }

    echo "</form>";

    echo "<p><a href=\"main.php\">Home</a></p>";
    $conn->close(); // Close the database connection
} else {
    echo "<h3>You are not logged in!</h3><p><a href=\"login.php\"> Login </a></p>";
}
?>
</body>
</html>

