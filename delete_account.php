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
    $account_number = $_POST['account_number'];


    try {
        $con = new mysqli($server, $username, $password, $database);
    }catch (Exception $e) {
        echo $e->getMessage();
    }

    $sql = "delete from ACCOUNT_OWNER where account_number='$account_number'";
    $result = $con->query($sql);

    if($result->num_rows == 0) {
        echo "Successfully deleted account.<br>";
    } else {
        echo "Error deleting account.<br>" . mysqli_error($con); // fix this says it has an error even though it deletes the account
    }

    echo "<a href=\"main.php\">Main Page</a>";

} else {
    echo "<h3> You are not logged in! </h3> <p><a href=\"login.php\"> Login </a></p>";
}
?>
</html>