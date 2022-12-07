<?php include('partials/menu.php') ?>

<div class='main-content'>
    <div class="wrapper">
        <h1>Manage Book</h1>

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

        <?php if(isset($_SESSION['remove'])) //checking whether the session is set or not
                    {
                        echo $_SESSION['remove']; //display session message
                        unset($_SESSION['remove']); // removing session message
                    }
        ?>

        <?php if(isset($_SESSION['unauth'])) //checking whether the session is set or not
                    {
                        echo $_SESSION['unauth']; //display session message
                        unset($_SESSION['unauth']); // removing session message
                    }
        ?>

        <?php if(isset($_SESSION['no-book-found'])) //checking whether the session is set or not
                    {
                        echo $_SESSION['no-book-found']; //display session message
                        unset($_SESSION['no-book-found']); // removing session message
                    }
        ?>

        <?php if(isset($_SESSION['upload'])) //checking whether the session is set or not
                    {
                        echo $_SESSION['upload']; //display session message
                        unset($_SESSION['upload']); // removing session message
                    }
        ?>

        <?php if(isset($_SESSION['update'])) //checking whether the session is set or not
                    {
                        echo $_SESSION['update']; //display session message
                        unset($_SESSION['update']); // removing session message
                    }
        ?>


        <br> <br>
        <!-- button to add book -->
        <a href="<?php echo SITEURL; ?>admin/add-book.php" class="btn-primary">Add Book</a>
        <br> <br>
        <table class="tbl-full">
            <tr class="tbl-heading">
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php 
                //query to get all book from database
                $sql = "SELECT * FROM `books`";

                //execute query
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //create serial number variable and assign value as 1
                $sn = 1;

                //check whether we have data in database or not
                if($count>0)
                {
                    //we have book in database
                    //get the data and display 
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['Title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php 
                                //check whether image name is available or not
                                if($image_name!="")
                                {
                                    //display the image 
                                    ?>
                                <img src="<?php echo SITEURL;?>images/book/<?php echo $image_name?>" alt="" width="100px">
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
                                <a href="<?php echo SITEURL;?>admin/update-book.php?id=<?php echo $id; ?>"
                                    class="btn-secondary">Update Book</a>
                                <a href="<?php echo SITEURL;?>admin/delete-book.php?id=<?php echo $id; ?> & image_name=<?php  echo $image_name;?>"
                                    class="btn-danger">Delete Book</a>
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
                        <td colspan="7">
                            <div class="error">Books Not Added.</div>
                        </td>
                    </tr>
            <?php
                }

            ?>
        </table>
        <div class="clarfix"></div>
    </div>
</div>

<?php include('partials/footer.php') ?>