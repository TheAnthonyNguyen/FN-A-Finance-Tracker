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
    $chequing_number = generateChequingNumber();
    $income_query = "select sum(amount) from INCOME where account_number = '$account_number' and income_designation = 'chequing'";
    $expense_query = "select sum(amount) from EXPENSES where account_number = '$account_number' and expense_designation = 'chequing'";

    $con = new mysqli($server, $username, $password, $database);

    if($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $chequing_exist_query = "select count(*) from CHEQUING_ACCOUNT where account_number = '$account_number'";
    $chequing_result = $con->query($chequing_exist_query);
    $row = $chequing_result->fetch_assoc();


    if ($row["count(*)"] > 0) {
        echo "<h3> Chequing account already exists for this account number.</h3>";
        echo "<p><a href=\"main.php\">Home</a></p>";
    } else {

        $income_result = $con->query($income_query);
        $expense_result = $con->query($expense_query);


        if (!$con->query($income_query) and !$con->query($expense_query)) {
            echo "Error: " . $con->error;
        }

        if($expense_result->fetch_assoc()["sum(amount)"] == NULL) {
            $expense_total = 0;
        } else {
            $row = $expense_result->fetch_assoc();
            $expense_total = $row["sum(amount)"];
        }
  
        if ($income_result->fetch_assoc()["sum(amount)"] == NULL) {
            $income_total = 0;
        } else {
            $row = $income_result->fetch_assoc();
            $income_total = $row["sum(amount)"];
        }

        $account_total = $income_total - $expense_total;


        $sql1 = "update ACCOUNTS set chequing_number = '$chequing_number' where account_number = '$account_number'";        

        if ($con->query($sql1)) {
            $sql = "insert into CHEQUING_ACCOUNT (account_total, account_number, chequing_number) values ('$account_total', '$account_number', '$chequing_number')";
            if ($con->query($sql)) {
                echo "<h3>Chequing account created!</h3><p>Your chequing account number: $chequing_number</p>";
                echo "<p><a href=\"main.php\">Home</a></p>";
            }
            
        } else {
            $err = $con->errno;
            if($err == 1062) {
                echo "<p> Chequing number already exists! </p>";
            } else {
                echo "error number $err";
            }
        }
    }

} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}



function generateChequingNumber() {
    $min = 1000000;
    $max = 9999999;
    return random_int($min, $max);
}

?>
</html>