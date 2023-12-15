
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
        
    </style>
    <body>
        <h1> MN&A Finance Tracker - Login </h1>
        <form action = "set_pass.php" method = post>
            MySQL username: <input type = text name = "username" size = 8>
            MySQL password: <input type = text name = "password" size = 20>
            <input type = submit value = "Login">
    </form>
</html>
