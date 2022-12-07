<!-- add constants.php file for database connection -->
<?php include('../config/constants.php'); ?>
<?php include('login-check.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Store Website: Admin page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!--menu section starts here-->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-book.php">Books</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!--menu section ends here-->

