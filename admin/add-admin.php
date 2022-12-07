<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //display session message
                unset($_SESSION['add']); // removing session message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full-name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="user-name" placeholder="Your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>

<?php 
    //process the value from form and save it in Database
    //check wether the value submit button is clicked or not 
    if(isset($_POST['submit']))
    {
        //button clicked 
       // echo "Button Clicked";

       //get the data from form
       $full_name = $_POST['full-name'];
       $username = $_POST['user-name'];
       $password = md5($_POST['password']);  //Password Encryption with MD5

        //sql query to save data in database
        // $sql = "INSERT INTO admin SET
        //     'Full Name' = '$full_name',
        //     'Username' = '$username',
        //     'Password' = '$password'
        //     ";

        $sql = "INSERT INTO `admin` ( `Full Name`, `Username`, `Password`) VALUES ( '$full_name', '$username', '$password')";
        
        //execute query and save data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
        //check whether the (query is executed) data is inserted or not and display approriate message
        if($res==TRUE){
            // data inserted
            //echo "Data Inserted";
            
            // create a session variable to display message
            $_SESSION['add'] = '<div class="success">Admin Added Successfully</div>';

            //redirect page to mange-admin page 
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            //data not inserted
            //echo "Failed to insert data";
            // create a session variable to display message
            $_SESSION['add'] = '<div class="error">Failed to add Admin</div>';

            //redirect page  to add-admin page
            header('location:'.SITEURL.'admin/add-admin.php');
        }
    }
    
?>