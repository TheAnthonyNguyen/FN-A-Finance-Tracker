<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account Information</title>
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
</head>
<body>

<?php
if (isset($_COOKIE["username"])) {
    echo "<h1>Update Account Information</h1>";
    echo "<form action=\"update_account_form.php\" method=\"post\">";

    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";

    // Establish a database connection
    $conn = new mysqli($server, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT account_number FROM ACCOUNT_OWNER";
    $result = $conn->query($sql);

    if ($result->num_rows != 0) {
        echo "Account number: <select name=\"account_number\">";

        while ($val = $result->fetch_assoc()) {
            echo "<option value='$val[account_number]'>$val[account_number]</option>";
        }

        echo "</select>";
        echo "<input type=submit name=\"submit\" value=\"View\">";
        echo "</form>";
    } else {
        echo "<p>Umm...you may want to enter some data. ;) </p>";
    }

    echo "</form>";
    $conn->close(); // Close the database connection
} else {
    echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>";
}
?>

</body>
</html>
