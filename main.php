<html>
<style>
    body {
        background-image: url('BG.jpg');
        background-size: cover;
        color: white;
        font-family: "Times New Roman", Times, serif;
        font-size: 25px;
        list-style-type: none; // fix
        a:link {
            color: white;
            font-family: "Times New Roman", Times, serif;
        }
        a:visited {
            color: white;
            font-family: "Times New Roman", Times, serif;
        }
        h1 {
            color: white;
            font-family: "Times New Roman", Times, serif;
        }
        a {
            list-style-type: none;
            text-decoration: none;
            color: white;
            font-family: "Times New Roman", Times, serif;
        }
        
    .dropdown-btn {
    background-color: #4682B4;
	color: white;
    text-decoration: none;
	padding: 15px;
	font-size: 25px;
	border: none;
    font-family: "Times New Roman", Times, serif;
}
    .dropdown {
    position: relative;
    display: inline-block;
    font-family: "Times New Roman", Times, serif;
}
    .dropdown-menu {
    display: none;
	position: absolute;
	background-color: #4682B4;
	min-width: 200px;
	box-shadow: 5px 16px 16px 8px rgba(0,0,0,0.4);
	z-index: 1;
    font-family: "Times New Roman", Times, serif;
}
    .dropdown-menu a {
	padding: 12px 16px;
	text-decoration: none;
	display: block;
    font-family: "Times New Roman", Times, serif;
} 
	.dropdown-menu a:hover {
    color: black;
    background-color: #cccccc;
    font-family: "Times New Roman", Times, serif;
}
	.dropdown:hover .dropdown-menu {
    font-family: "Times New Roman", Times, serif;
    display: block;
}

</style>
    <?php
    echo "<h1><center> MN&A Finance Tracker </center></h1>"
    ?>
    <?php
    echo "<p><center>- Select an Option -</center></p>"
    ?>
<!-- This page will contain links to all our other pages. When the other pages are made we will
include href tags to all those other pages. -->
<body>
    <center>
    <div class ="dropdown">
        <button class ="dropdown-btn">Account</button>
        <div class ="dropdown-menu">
        <a href="insert_account_form.php">Create Account</a>
        <a href="select_account_form.php">View Account Information</a>
        <a href="update_account_entry.php">Update Account</a>
        <a href="delete_account_form.php">Delete Account</a>
    </div>
</div>

    <div class ="dropdown">
        <button class ="dropdown-btn">Income & Expenses</button>
        <div class ="dropdown-menu">
        <a href="add_expense.php">Add an Expense</a>
        <a href="add_income.php">Add a Source of Income </a>
        <a href="view_expense.php">View Expenses</a>
        <a href="view_income.php">View Sources of Income </a>
        <a href="update_income_entry.php">Update Sources of Income </a>
        <a href="update_expense_entry.php">Update Expenses </a>
        <a href="delete_expense.php">Delete an Expense</a>
        <a href="delete_income.php">Delete a Source of Income</a>
    </div>
</div>

<div class ="dropdown">
        <button class ="dropdown-btn">Chequing</button>
        <div class ="dropdown-menu">
        <a href="insert_chequing_form.php">Create Your Chequing Account </a>
        <a href="view_chequing.php">View Your Chequing Account</a>
        <a href="delete_chequing.php">Delete Your Chequing Account</a>
    </div>
</div>

<div class ="dropdown">
        <button class ="dropdown-btn">Savings</button>
        <div class ="dropdown-menu">
        <a href="insert_savings_form.php">Create Your Savings Account </a>
        <a href="view_savings.php">View Your Savings Account</a>
        <a href="delete_savings.php">Delete Your Savings Account</a>
    </div>
</div>

<div class ="dropdown">
        <button class ="dropdown-btn">Investing</button>
        <div class ="dropdown-menu">
        <a href="insert_investing_form.php">Create Your Investing Account </a>
        <a href="view_investings.php">View Your Investing Account</a>
        <a href="delete_investing.php">Delete Your Investing Account</a>
    </div>
</div>

<div class ="dropdown">
        <button class ="dropdown-btn">Statements</button>
        <div class ="dropdown-menu">
        <a href="view_chequing_statement.php">View Your Chequing Statement </a>
        <a href="view_savings_statement.php">View Your Savings Statement </a>
        <a href="view_investings_statement.php">View Your Investing Statement </a>
    </div>
</div>

<div class ="dropdown">
        <button class ="dropdown-btn">Logout</button>
        <div class ="dropdown-menu">
        <a href="logout.php">User Logout</a>
    </div>
</div>

</center>
</body>
</html>
