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
    $income_class = $_POST['income_class'];
    $account_number = $_POST['account_number'];
    $amount = $_POST['amount'];
    $income_designation = $_POST['income_designation'];
    $income_key = generateIncomeKey();

    $con = new mysqli($server, $username, $password, $database);



    $check_income_key = "select count(*) from INCOME where income_key = $income_key";

    if($con->query($check_income_key)-> num_rows > 0) {
        $err = $con->errno;
        if ($err == 1062) {
            echo "<p> Account number already exists. </p>";
        } else {
            echo "Error Number $err";
        }
    }


    $sql = "insert into INCOME (income_class, account_number, amount, income_designation, income_key) values('$income_class', '$account_number', '$amount', '$income_designation', '$income_key')"; 
    
    $chequing_exist_query = "select count(*) from CHEQUING_ACCOUNT where account_number = '$account_number'";
    $savings_exist_query = "select count(*) from SAVINGS_ACCOUNT where account_number = '$account_number'";
    $investing_exist_query = "select count(*) from INVESTING_ACCOUNT where account_number = '$account_number'";

    $chequing_result = $con->query($chequing_exist_query);
    $chequing_row = $chequing_result->fetch_assoc();

    $savings_result = $con->query($savings_exist_query);
    $savings_row = $savings_result->fetch_assoc();

    $investing_result = $con->query($investing_exist_query);
    $investing_row = $investing_result->fetch_assoc();






// fix no output message
    if ($con->query($sql)) {
        echo "<h3> Successfully added income to account. </h3>";
        if ($income_designation == 'chequing' and $chequing_row["count(*)"] > 0) {
            $add_chequing_income = "update CHEQUING_ACCOUNT set account_total = account_total + $amount where account_number = $account_number";
            if ($con->query($add_chequing_income)) {
                echo "<p> Income added directly to chequing account. </p>";
            }
        } elseif ($income_designation == 'savings' and $savings_row["count(*)"] > 0) {
            $add_savings_income = "update SAVINGS_ACCOUNT set account_total = account_total + $amount where account_number = $account_number";
            if ($con->query($add_savings_income)) {
                echo "<p> Income added directly to savings account. </p>";
            }
        } elseif ($income_designation == 'investing' and $investing_row["count(*)"] > 0) {
            $add_investing_income = "update INVESTING_ACCOUNT set account_total = account_total + $amount where account_number = $account_number";
            if ($con->query($add_investing_income)) {
                echo "<p> Income added directly to investing account. </p>";
            }
        }
        echo "<a href=\"main.php\">Main Page</a>";
    } else {
        $err = $con->errno;
        if ($err == 1062) {
            echo "<p> Account number already exists. </p>";
        } else {
            echo "Error Number $err";
        }
    }
} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}

function generateIncomeKey() {
    $min = 10000;
    $max = 99999;
    return random_int($min, $max);
}
?>
</html>
