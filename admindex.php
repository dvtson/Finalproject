<?php
include"conn.inc";
session_start();

echo"Welcome Admin ".$_SESSION['user'];
if($_SESSION['role']=='admin')
{
echo"<p><a href='manageuser.php'>Manage User</a></p>";
echo"<p><a href='addproduct.php'>Add Product</a></p>";
echo"<p><a href='getproduct.php'>Get Product</a></p>";
echo"<p><a href='logout2.php'>Logout</a></p>";
}
?>