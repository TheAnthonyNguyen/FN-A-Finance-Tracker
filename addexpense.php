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
    $expense_class = $_POST['expense_class'];
    $account_number = $_POST['account_number'];
    $amount = $_POST['amount'];
    $expense_designation = $_POST['expense_designation'];
    $expense_key = generateExpenseKey();

    $con = new mysqli($server, $username, $password, $database);

    $sql = "insert into EXPENSES (expense_class, account_number, amount, expense_designation, expense_key) values('$expense_class', '$account_number', '$amount', '$expense_designation', '$expense_key')"; 

    $chequing_exist_query = "select count(*) from CHEQUING_ACCOUNT where account_number = '$account_number'";
    $savings_exist_query = "select count(*) from SAVINGS_ACCOUNT where account_number = '$account_number'";
    $investing_exist_query = "select count(*) from INVESTING_ACCOUNT where account_number = '$account_number'";

    $chequing_result = $con->query($chequing_exist_query);
    $chequing_row = $chequing_result->fetch_assoc();

    $savings_result = $con->query($savings_exist_query);
    $savings_row = $savings_result->fetch_assoc();

    $investing_result = $con->query($investing_exist_query);
    $investing_row = $investing_result->fetch_assoc();



// fix no ouput messages showing
    if ($con->query($sql)) {
        echo "<h3> Successfully added expense to account. </h3>";
        if ($expense_designation == 'chequing' and $chequing_row["count(*)"] > 0) {
            $add_chequing_expense = "update CHEQUING_ACCOUNT set account_total = account_total - $amount where account_number = $account_number";
            if ($con->query($add_chequing_expense)) {
                echo "<p> Expense removed directly from chequing account. </p>";
            } else {
                echo "<p> Error removing amount from chequing account. </p>";
            }
        } elseif ($expense_designation == 'savings' and $savings_row["count(*)"] > 0) {
            $add_savings_expense = "update SAVINGS_ACCOUNT set account_total = account_total - $amount where account_number = $account_number";
            if ($con->query($add_savings_expense)) {
                echo "<p> Expense removed directly from savings account. </p>";
            } else {
                echo "<p> Error removing amount from savings account. </p>";
            }
        } elseif ($expense_designation == 'investing' and $investing_row["count(*)"] > 0) {
            $add_investing_expense = "update INVESTING_ACCOUNT set account_total = account_total - $amount where account_number = $account_number";
            if ($con->query($add_chequing_expense)) {
                echo "<p> Expense removed directly from investing account. </p>";
            } else {
                echo "<p> Error removing amount from investing account. </p>";
            }
        }
        echo "<a href=\"main.php\">Main Page</a>";
    } else {
        $err = $con->errno;
        echo "Error Number $err";
        }
    } else {
        echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}

function generateExpenseKey() {
    $min = 10000;
    $max = 99999;
    return random_int($min, $max);
}
?>
</html>
