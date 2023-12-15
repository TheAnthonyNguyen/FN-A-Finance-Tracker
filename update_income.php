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
    echo "<h1> Updated Income Information </h1>";
    ?>
<?php

if(isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    $account_number = $_POST['account_number'];
    $income_class = $_POST['new_income_class'];
    $income_designation = $_POST['new_income_designation'];
    $amount = $_POST['new_amount'];
    $income_key = $_POST['selected_income'];


    try {
        $con = new mysqli($server, $username, $password, $database);
    }catch (Exception $e) {
        echo $e->getMessage();
    }

    $sql = "update INCOME set income_class = '$income_class', amount = '$amount', income_designation = '$income_designation' where income_key = '$income_key'";
    $getOldData = "select amount, income_designation from INCOME where income_key = $income_key";

    $chequing_exist_query = "select count(*) from CHEQUING_ACCOUNT where account_number = '$account_number'";
    $savings_exist_query = "select count(*) from SAVINGS_ACCOUNT where account_number = '$account_number'";
    $investing_exist_query = "select count(*) from INVESTING_ACCOUNT where account_number = '$account_number'";

    $chequing_result = $con->query($chequing_exist_query);
    $chequing_row = $chequing_result->fetch_assoc();

    $savings_result = $con->query($savings_exist_query);
    $savings_row = $savings_result->fetch_assoc();

    $investing_result = $con->query($investing_exist_query);
    $investing_row = $investing_result->fetch_assoc();

    $amountRow = $con->query($getOldData)->fetch_assoc()["amount"];
    echo "<pre>";
    print_r($amountRow);
    echo "</pre>";

    // Deletes the new amount from chequing, savings or investing account from the Incomes old designation, assuming the account exists.
    if($con->query($getOldData)) {
        if($chequing_result == 'chequing' and $chequing_row["count(*)"] > 0) {
            $remove_chequing_amount = "update CHEQUING_ACCOUNT set account_total -= $amountRow where account_number = $account_number";
            if($con->query($remove_chequing_amount)) {
                echo "<p> Money removed from chequing account </p>";
            }
        } elseif($savings_result == 'savings' and $savings_row["count(*)"] > 0) {
            $remove_savings_amount = "update SAVINGS_ACCOUNT set account_total -= $amountRow where account_number = $account_number";
                if($con->query($remove_savings_amount)) {
                    echo "<p> Money removed from savings account </p>";
            }
        } elseif($investing_result == 'investing' and $investing_row["count(*)"] > 0) {
            $remove_investing_amount = "update INVESTING_ACCOUNT set account_total -= $amountRow where account_number = $account_number";
                if($con->query($remove_investing_amount)) {
                    echo "<p> Money removed from investing account </p>";
            }
    }
}

if ($income_designation == 'chequing' and $chequing_row["count(*)"] > 0) {
    $add_chequing_amount = "update CHEQUING_ACCOUNT set account_total += $amountRow where account_number = $account_number";
    if ($con->query($add_chequing_amount)) {
        echo "<p> Money added to chequing account </p>";
    }
} elseif ($income_designation == 'savings' and $savings_row["count(*)"] > 0) {
    $add_savings_amount = "update SAVINGS_ACCOUNT set account_total += $amountRow where account_number = $account_number";
    if ($con->query($add_savings_amount)) {
        echo "<p> Money added to savings account </p>";
    }
} elseif ($income_designation == 'investing' and $investing_row["count(*)"] > 0) {
    $add_investing_amount = "update INVESTING_ACCOUNT set account_total += $amountRow where account_number = $account_number";
    if ($con->query($add_investing_amount)) {
        echo "<p> Money added to investing account </p>";
    }
}


    if($con->query($sql)) {
        echo "Income data successfully updated.<br>";
    } else {
        echo "Error update chequing account.<br>" . mysqli_error($con);
    }

    echo "<a href=\"main.php\">Main Page</a>";

} else {
    echo "<h3> You are not logged in! </h3> <p><a href=\"login.php\"> Login </a></p>";
}
?>
</html>