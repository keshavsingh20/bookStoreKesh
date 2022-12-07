<?php include('partials/menu.php') ?>

<div class='main-content'>
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br> <br>

        <?php if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //display session message
                unset($_SESSION['add']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['session'])) //checking whether the session is set or not
            {
                echo $_SESSION['session']; //display session message
                unset($_SESSION['session']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['delete'])) //checking whether the session is set or not
            {
                echo $_SESSION['delete']; //display session message
                unset($_SESSION['delete']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['no-category-found'])) //checking whether the session is set or not
            {
                echo $_SESSION['no-category-found']; //display session message
                unset($_SESSION['no-category-found']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['update'])) //checking whether the session is set or not
            {
                echo $_SESSION['update']; //display session message
                unset($_SESSION['update']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['upload'])) //checking whether the session is set or not
            {
                echo $_SESSION['upload']; //display session message
                unset($_SESSION['upload']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['failed-remove'])) //checking whether the session is set or not
                {
                    echo $_SESSION['failed-remove']; //display session message
                    unset($_SESSION['failed-remove']); // removing session message
                }
            ?>

        <br><br>

        <!-- button to add category -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br> <br>
        <table class="tbl-full">
            <tr class="tbl-heading">
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php 
                //query to get all categories from database
                $sql = "SELECT * FROM `category`";

                //execute query
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //create serial number variable and assign value as 1
                $sn = 1;

                //check whether we have data in database or not
                if($count>0)
                {
                    //we have data in database
                    //get the data and display 
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['Title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

            <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $title; ?></td>

                <td>
                    <?php 
                    //check whether image name is available or not
                    if($image_name!="")
                    {
                        //display the image 
                        ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="" width="100px">
                    <?php

                    }
                    else{
                        //display a message
                        echo '<div class="error">Image Not Available.</div>';
                    }
                     ?>
                </td>

                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>"
                        class="btn-secondary">Update Category</a>
                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?> & image_name=<?php  echo $image_name;?>"
                        class="btn-danger">Delete Category</a>
                </td>
            </tr>

            <?php

                    }

                }
                else{
                    //we don't have data in database
                    // we'll display the message inside table
                    ?>
            <tr>
                <td colspan="6">
                    <div class="error">No Category Added.</div>
                </td>
            </tr>
            <?php
                }

            ?>

        </table>
        <div class="clearfix"></div>
    </div>
</div>

<?php include('partials/footer.php') ?>