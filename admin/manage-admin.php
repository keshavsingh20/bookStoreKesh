<?php include('partials/menu.php'); ?>

<!--main content section starts here-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

        <?php if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //display session message
                unset($_SESSION['add']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['delete'])) //checking whether the session is set or not
            {
                echo $_SESSION['delete']; //display session message
                unset($_SESSION['delete']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['update'])) //checking whether the session is set or not
            {
                echo $_SESSION['update']; //display session message
                unset($_SESSION['update']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['user not found'])) //checking whether the session is set or not
            {
                echo $_SESSION['user not found']; //display session message
                unset($_SESSION['user not found']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['password not match'])) //checking whether the session is set or not
            {
                echo $_SESSION['password not match']; //display session message
                unset($_SESSION['password not match']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['change pwd'])) //checking whether the session is set or not
            {
                echo $_SESSION['change pwd']; //display session message
                unset($_SESSION['change pwd']); // removing session message
            }
        ?>

        <br><br><br>
        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br> <br>
        <table class="tbl-full">
            <tr class="tbl-heading">
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <!-- show data of admins from databse -->
            <?php 
                //query to get all data
                $sql = "select * from admin";
                $res = mysqli_query($conn,$sql);

                //chechk whether the query is executed or not
                if($res==true){
                    //count rows to check whether we have data in database or not
                    $count  =  mysqli_num_rows($res); //function to get all rows in database

                    //check the number of rows 
                    if($count>0){
                        $sn = 1;
                        //we have data in database
                        while($rows=mysqli_fetch_assoc($res)){
                            //using while loop to get all the data from database
                            //while loop will run as long as have data in database

                            //get individual data
                            $id = $rows['id'];
                            $full_name = $rows['Full Name'];
                            $username = $rows['Username'];


                            //display the values in our table
                            ?>
            <tr>
                <!--<td><?php echo $id."."; ?></td>    this will display admins by ids-->
                <td><?php echo $sn++; ?>
                <td><?php echo $full_name ?></td>
                <td><?php echo $username ?></td>
                <td>

                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"
                        class="btn-primary">Change Password</a>
                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                        class="btn-secondary">Update Admin</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                        class="btn-danger">Delete Admin</a>

            </tr>

            <?php

                    }
            }
            else{
            //we don't have data in databse
            }

            }
            ?>
            <!-- <tr>
                <td>1.</td>
                <td>Sahil Kumar</td>
                <td>sahil_18</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Sahil Kumar</td>
                <td>sahil_18</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Sahil Kumar</td>
                <td>sahil_18</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr> -->
        </table>
        <div class="clearfix"></div>
    </div>
</div>
<!--main content ends here-->

<?php include('partials/footer.php') ?>