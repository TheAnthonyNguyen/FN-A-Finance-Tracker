<html>
<style>
    body {
        background-image: url('BG2.0.jpg');
        background-size: cover;
        color: white;
        font-family: "Times New Roman", Times, serif;
        font-size: 26px;
        list-style-type: none;
    }

    a:link,
    a:visited {
        color: white;
        font-family: "Times New Roman", Times, serif;
    }
</style>

<?php
echo "<h1> Investing Statement Information </h1>";

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    $account_number = $_POST['account_number'];
    $statement_id = generateStatementID();
    $count = 0;
    $columnLabels = array(
        0 => "Classification: ",
        1 => "Account Number: ",
        2 => "Amount: ",
        3 => "Designation: ",
        4 => "Key: ",
        5 => "Type: ",
        6 => "Total Amount Saved: "
    );

    try {
        $con = new mysqli($server, $username, $password, $database);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    // Modify the SQL query to join INCOME and EXPENSES tables
    $sql = "select *, 'INCOME' as type from INCOME where account_number='$account_number' and income_designation='investing' union select *, 'EXPENSE' as type from EXPENSES where account_number='$account_number' and expense_designation='investing'";

    $result = $con->query($sql);

    $totalIncome = 0;
    $totalExpenses = 0;

    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            if ($count % count($columnLabels) === 0) {
                echo "<br>";
            }
            echo "<br>";
            $count = 0;
            foreach ($row as $columnName => $columnValue) {
                echo "$columnLabels[$count] $columnValue";
                // Add a label for the type (INCOME or EXPENSE)
                //if ($count == 5) {
                    //echo " (Type: " . $row['type'] . ")";
                //}
                echo "<br>";
                $count = $count + 1;
            }

            // Accumulate amounts for income and expenses
            if ($row['type'] == 'INCOME') {
                $totalIncome += $row['amount'];
            } elseif ($row['type'] == 'EXPENSE') {
                $totalExpenses += $row['amount'];
            }
        }

        // Calculate and display the total amount saved
        $totalAmountSaved = $totalIncome - $totalExpenses;
        echo "<br>";
        echo "$columnLabels[6] $totalAmountSaved<br>";
        echo "Statement ID: '$statement_id'<br>";
    } else {
        echo "No rows found.<br>";
    }

    echo "<a href=\"main.php\">Main Page</a>";
} else {
    echo "<h3> You are not logged in! </h3><p><a href=\"login.php\"> Login </a></p>";
}

function generateStatementID() {
    $min = 10000000000;
    $max = 99999999999;
    return random_int($min, $max);
}

?>
</html>
