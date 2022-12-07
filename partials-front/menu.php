<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store Website</title>

    <!--Link here css-->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!--navbar section start-->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>">
                    <img src="images/logo.png" alt="Book Store Logo" class="img-responsive-logo">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>books.php">Books</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact-us.php">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin">Admin</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!--navbar section end-->