<html>
<style>
        body {
        background-image: url('BG2.0.jpg');
        background-size: cover;
        color: white;
        font-family: "Times New Roman", Times, serif;
        font-size: 26px;
        list-style-type: none 
        }
        a:link {
            color: white;
            font-family: "Times New Roman", Times, serif;
        }
        a:visited {
            color: white;
            font-family: "Times New Roman", Times, serif;
        }
    </style>
<?php

if(isset($_COOKIE['username'])) {

    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    $account_number = $_POST['account_number'];
    $investing_number = $_POST['investing_number'];


    try {
        $con = new mysqli($server, $username, $password, $database);
    }catch (Exception $e) {
        echo $e->getMessage();
    }

    $sql = "delete from INVESTING_ACCOUNT where account_number='$account_number' and investing_number='$investing_number'";

    $result = $con->query($sql);

    if($result->num_rows == 0) {
        echo "Successfully deleted account.<br>";
    } else {
        echo "Error deleting investing account.<br>" . mysqli_error($con);
    }

    echo "<a href=\"main.php\">Main Page</a>";

} else {
    echo "<h3> You are not logged in! </h3> <p><a href=\"login.php\"> Login </a></p>";
}
?>
</html>