<html>
    <h1>Update Expense Form</h1>
<body>
<style>
    body {
        background-image: url('BG.jpg');
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
if (isset($_COOKIE["username"])) {
    echo "<form action=\"update_expense.php\" method=post>";
    
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    $account_number = $_POST['account_number'];

    

    $con = new mysqli($server, $username, $password, $database);

    $get_user_expenses = "select * from EXPENSES where account_number = $account_number";

    $result = $con->query($get_user_expenses);
    if($result->num_rows > 0) {
        echo "<p> Select Expense to Update: </p>";
        echo "<select name = \"selected_expense\">";
        
        while ($row = $result->fetch_assoc()) {
            $expense_key = $row['expense_key'];
            $expense_class = $row['expense_class'];
            echo "<option value=\"$expense_key\">$expense_class</option>";
        }

        echo "</select><br><br>";

        echo "Enter New Expense Class: <input type=text name=\"new_expense_class\" size=15> <br><br>";
        echo "Enter New Amount: <input type=text name=\"new_amount\" size=15> <br><br>";
        echo "Enter New Expense Designation: <input type=text name=\"new_expense_designation\" size=15> <br><br>";
        echo "<input type=submit name=\"submit\" value=\"Expense Access\">";

        echo "</form>";


    } else {
        echo "<p> User has no expenses. </p>";
    }



} else {
    echo "<h3> You are not logged in! </h3> <p><a href=\"login.php\"> Login </a></p>";
}
    echo "<p><a href=\"main.php\">Home</a></p>";
?>

</body>
</html>