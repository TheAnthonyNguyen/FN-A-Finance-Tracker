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
if(isset($_COOKIE["username"])) {
    
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $dob = $_POST['dob'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $account_number = generateAccountNumber();

    $con = new mysqli($server, $username, $password, $database);

    $sql = "insert into ACCOUNT_OWNER values ('$f_name', '$m_name', '$l_name', '$dob', '$phone_number', '$address', '$account_number')";
    $sql1 = "insert into ACCOUNTS (account_number) values('$account_number')";

    if ($con->query($sql) and $con->query($sql1)) {
        echo "<h3> Account creation successful! </h3>";
        echo "<p> Your account number is: $account_number</p>";
        echo "<a href=\"main.php\">Main Page</a>";
    } else {
        $err = $conn->errno;
        if($err == 1062) {
            echo "<p> Account number already exists! </p>";
        } else {
            echo "error number $err";
        }
    }

} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}


function generateAccountNumber() {
    $min = 10000000000;
    $max = 99999999999;
    return random_int($min, $max);
}


?>
</html>
