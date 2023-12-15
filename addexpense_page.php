<html>
    <body>
        <h1>Add Expense</h1>
        <?php include 'addexpense.php';
        echo "Testing: $server, $database";
        ?>
        <form action = "add_expense.php" method = post>
            Expense Class: <input type = text name = "expense class" size = 20><br>
            Account Number: <input type = text name = "account number" size = 25><br>
            Amount: <input type = text name = "ammount" size = 10><br>
            Expense Designation: <input type = text name = "expense designation" size = 15><br>
            Manager ID: <input type = text name = "Manager ID" size = 25><br>
            <input type = submit value = "Submit">
        </form>
    </body>
</html>