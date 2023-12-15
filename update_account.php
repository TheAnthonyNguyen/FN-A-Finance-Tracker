<html>
    <h1>Update Account Information</h1>
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
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $server = "vlamp.cs.uleth.ca";
    $database = "gilm3660";
    
    try {
        $conn = new mysqli($server, $username, $password, $database);
    } catch (Exception $e) {
        echo "Connection Problem!";
        exit; 
    }
    
    // Construct the SQL query
    $sql = "update ACCOUNT_OWNER set 
            account_number='$_POST[account_number]', 
            f_name='$_POST[f_name]', 
            m_name='$_POST[m_name]', 
            l_name='$_POST[l_name]', 
            dob='$_POST[dob]', 
            phone_number='$_POST[phone_number]', 
            address='$_POST[address]'
            where account_number ='$_POST[oldname]'";
    
    try {
        // Execute the SQL query
        $conn->query($sql);
        echo "<h3>Information Updated Successfully</h3>"; 
        echo "<p><a href=\"main.php\">Main Page</a></p>";
    } catch (Exception $e) {
        echo "Error updating information: " . $conn->error;
    }
        
        
    }
    

 else {
    echo "<h3>You are not logged in!</h3><p><a href=\"login.php\"> Login </a></p>";
}
$conn->close();
?>
</body>
</html>
