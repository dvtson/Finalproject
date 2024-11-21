<?php
include "conn.inc";

$sql = "SELECT * FROM login ORDER BY id";
$result = mysqli_query($conn, $sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Manage User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
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
        a {
            text-decoration: none;
            color: #5cb85c;
            margin-bottom: 15px;
            display: inline-block;
        }
        a:hover {
            color: #4cae4c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #5cb85c;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class='container'>
    <h1>Manage User</h1>
    <a href='addUser.html'>Add User</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>";

while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    echo "<tr>
            <td>{$id}</td>
            <td>{$row['username']}</td>
            <td>{$row['email']}</td>
            <td>{$row['roles']}</td>
            <td>{$row['status']}</td>
            <td><a href='editUser.php?id={$id}'>Edit</a></td>
            <td><a href='delUser.php?id={$id}' onclick='return confirm(\"Sure\");'>Delete</a></td>
          </tr>";
}

echo "</tbody>
    </table>
    <div class='footer'>
        <p><a href='admindex.php'>Admin's Homepage</a></p>
        <p><a href='logout2.php'>Logout</a></p>
    </div>
</div>

</body>
</html>";
?>