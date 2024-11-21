<?php
include "conn.inc";
session_start();

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
        }
        a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            background: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
        }
        a:hover {
            background: #4cae4c;
        }
        .welcome {
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class='container'>
    <h1>Admin Dashboard</h1>
    <div class='welcome'>Welcome Admin " . $_SESSION['user'] . "</div>";

if ($_SESSION['role'] == 'admin') {
    echo "<p><a href='manageuser.php'>Manage User</a></p>";
    echo "<p><a href='addproduct.php'>Add Product</a></p>";
    echo "<p><a href='logout2.php'>Logout</a></p>";
}

echo "</div>
</body>
</html>";
?>
