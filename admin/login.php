<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>Login-Book Store System</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


<section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>">
                    <img src="../images/logo.png" alt="Book Store Logo" class="img-responsive-logo">
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


    <div>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>

            <?php if(isset($_SESSION['login'])) //checking whether the session is set or not
            {
                echo $_SESSION['login']; //display session message
                unset($_SESSION['login']); // removing session message
            }
        ?>

            <?php if(isset($_SESSION['no-login-message'])) //checking whether the session is set or not
            {
                echo $_SESSION['no-login-message']; //display session message
                unset($_SESSION['no-login-message']); // removing session message
            }
        ?>
            <!-- login form starts here -->
            <form action="" method="POST" class="text-center text-size">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username" class="input-size"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password here" class="input-size"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary btn-login">
                <br><br>
            </form>
            <!-- login form ends here -->
            <p class="text-center">Created By - <a href="#" class="login-footer">Young Minds</a></p>
        </div>
    </div>
</body>

</html>


<?php

//check wheteher the submit button is clicked or not
    if(isset($_POST['submit'])){
        //process for login

        // get the data from login form

        // $username = $_POST['username'];
        // $password = md5($_POST['password']);

        //sql injection attack prevention
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        // sql to check with username and password exist or not
        $sql = "SELECT * from `admin` WHERE `Username`='$username' AND `Password`='$password'";

        // execute the query 
        $res = mysqli_query($conn,$sql);

        
            // count rows to check whether the user exist or not
            $count = mysqli_num_rows($res);
        
            if($count==1){
                //user available and login success
                $_SESSION['login'] = '<div class="success">You have logged in Successfully.</div>';
                $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it

                //redirect to home page
                header('location:'.SITEURL.'admin');

            }
            else{
                //user not available and login failed
                $_SESSION['login'] = '<div class="error">Login Failed. Username or Password did not match.</div>';
                //redirect to login page
                header('location:'.SITEURL.'admin/login.php');
            }
    

    }


?>

