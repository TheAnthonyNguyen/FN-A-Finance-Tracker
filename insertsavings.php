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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_COOKIE["username"])) {
    
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    $account_number = $_POST['account_number'];
    $savings_number = generateSavingsNumber();
    $amount_query = "select sum(amount) from INCOME where account_number = '$account_number' and income_designation = 'savings'";

    $con = new mysqli($server, $username, $password, $database);

    if($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $savings_exist_query = "select count(*) from SAVINGS_ACCOUNT where account_number = '$account_number'";
    $savings_result = $con->query($savings_exist_query);
    $row = $savings_result->fetch_assoc();


    if ($row["count(*)"] > 0) {
        echo "<h3> Savings account already exists for this account number.</h3>";
        echo "<p><a href=\"main.php\">Home</a></p>";
    } else {

        $amount_result = $con->query($amount_query);


        if (!$con->query($amount_query)) {
            echo "Error: " . $con->error;
        }
  
        if ($amount_result->fetch_assoc()["sum(amount)"] == NULL) {
            $account_total = 0;
        } else {
            $row = $amount_result->fetch_assoc();
            $account_total = $row["sum(amount)"];
        }

        echo "<pre>";
        print_r($account_number);
        echo "<br>";
        print_r($savings_number);
        echo "</pre>";



        $sql1 = "update ACCOUNTS set savings_number = '$savings_number' where account_number = '$account_number'";
        //$sql = "insert into CHEQUING_ACCOUNT (account_total, account_number, chequing_number) values ('$account_total', '$account_number', '$chequing_number')";
        



        if ($con->query($sql1)) {
            $sql = "insert into SAVINGS_ACCOUNT (account_total, account_number, savings_number) values ('$account_total', '$account_number', '$savings_number')";
            if ($con->query($sql)) {
                echo "<h3>Savings account created!</h3><p>Your savings account number: $savings_number</p>";
                echo "<p><a href=\"main.php\">Home</a></p>";
            }
            
        } else {
            $err = $con->errno;
            if($err == 1062) {
                echo "<p> Savings number already exists! </p>";
            } else {
                echo "error number $err";
            }
        }
    }

} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}



function generateSavingsNumber() {
    $min = 1000000;
    $max = 9999999;
    return random_int($min, $max);
}

?>
</html>