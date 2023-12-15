<html>
<style>
    body {
        background-image: url('BG2.0.jpg');
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
if(isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    $investing_number = $_POST['investing_number'];
    $count = 0;
    $columnLabels = array(
        0 => "Account Total: ",
        1 => "Account Number: ",
        2 => "Investing Number: ",
    );


    try {
        $con = new mysqli($server, $username, $password, $database);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $sql = "select * from INVESTING_ACCOUNT where investing_number='$investing_number'";
    $result = $con->query($sql);

    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            if ($count % count($columnLabels) === 0) {
                echo "<br>"; 
            }
            $count = 0;
            foreach($row as $columnName => $columnValue) {
                echo "$columnLabels[$count] $columnValue<br>";
                $count = $count + 1;
            }
        }

    } else {
        echo "No rows found.<br>";
    }

    echo "<a href=\"main.php\">Main Page</a>";

} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}

?>
</html>