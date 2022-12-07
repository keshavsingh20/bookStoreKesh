<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Book</h1>
        <br><br>

        <?php 
            //chceck whether the id is set or not
            if(isset($_GET['id']))
            {
                // get the id of selected book
                $book_id = $_GET['id'];

                // create the sql query to get the details
                $sql2 = "select * from `books` where id=$book_id";

                // execute query 
                $res2 =  mysqli_query($conn,$sql2);

                // check whether the query is executed or not
                if($res2==true){
                    //check whether the data is available or not
                    $count = mysqli_num_rows($res2);

                    // check whether we have book data or not
                    if($count==1){
                        //get the details
                        //echo "Book Available";

                        $row2 = mysqli_fetch_assoc($res2);

                        $title = $row2['Title'];
                        $description = $row2['Description'];
                        $price = $row2['price'];
                        $current_image = $row2['image_name'];
                        $current_category = $row2['category_id'];
                        $featured = $row2['featured'];
                        $active = $row2['active'];
                    }
                    else{
                        //redirect to manage-book page with page
                        $_SESSION['no-book-found'] = '<div class="error">Book Not Found.</div>';
                        header('location:'.SITEURL.'admin/manage-book.php');
                    }
                }
            }
            else{
                //redirect to manage-book page
                header('location:'.SITEURL.'admin/manage-book.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
                    <td>Book Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="35" rows="5"><?php echo $description?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:
                    </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //diplay the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/book/<?php echo $current_image; ?>" alt="" width="100px">
                                <?php
                            }
                            else{
                                //display the message
                                echo '<div class="error">Image Not Available</div>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                //Create php code to display categories from database
                                //Create sql to get all active categories from database
                                $sql = "SELECT * from `category` WHERE `active`='Yes'";

                                //execute query
                                $res = mysqli_query($conn,$sql);
                                
                                //count rows to chech whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //if count is greater than 0 we have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['Title'];
                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //we don't have categories
                                    ?>
                                    <option value="0" >No Category Book.</option>
                                    <?php
                                }

                                //display on dropdown
                             ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name ="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $book_id; ?>">
                        <input type="submit" name="submit" value="Update Book" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
       //echo "Button Clicked"; 
         
       // get all the values from form to update 

       $book_id = $_POST['id'];
       $title = $_POST['title'];
       $description = $_POST['description'];
       $price = $_POST['price'];
       $current_image = $_POST['current_image'];
       $category = $_POST['category'];

       $featured = $_POST['featured'];
       $active = $_POST['active'];

       //updating new image
       //check whether the image is selected or not

       if(isset($_FILES['image']['name']))
       {
           //get the image details
           $image_name = $_FILES['image']['name'];

           //check whether image is availabel or not
           if($image_name!=""){
               //image avialable
               //upload the new image 
                //auto rename image
                //get the extension of our image (.jpg/png/gif etc)
                $ext = end(explode('.',$image_name));

                //rename the image
                $image_name = "Book_Name_".rand(000,999).'.'.$ext;

                $source_path =  $_FILES['image']['tmp_name'];

                $destination_path = "../images/book/".$image_name;

                // upload image 
                $upload = move_uploaded_file($source_path,$destination_path);

                // check whether the image is uplaoded or not
                // and if the image is not uploaded then we will stop the process and redirect with error message

                if($upload==false){
                    //set message
                    $_SESSION['upload'] = '<div class="error">Failed to Upload Image.</div>';
                    // redirect to manage book page
                    header('location:'.SITEURL.'admin/manage-book.php');
                    //stop the process
                    die();
                }

               //remove current image if avilable
               if($current_image!=""){
                    $remove_path = "../images/book/".$current_image;
                    $remove = unlink($remove_path);

                    //check whether the image removed or not
                    //if failed then display message and stop the process

                    if($remove==false){
                        //failed to remove image
                        $_SESSION['failed-remove'] = '<div class="error">Failed to Remove Current Image</div>';
                        //redirect to manage book page
                        header('location:'.SITEURL.'admin/manage-book.php');
                        die();
                    }
                }
           }
           else{
               $image_name = $current_image;
           }
       }
       else{
           $image_name = $current_image;
       }
        //update the database

       $sql2 = "UPDATE `books` SET `Title` = '$title',`Description`='$description', `image_name` = '$image_name',`price`= '$price', `category_id`='$category', `featured` = '$featured', `active`  = '$active' WHERE `id` = '$book_id'";

       // exxecute the query

       $res2 = mysqli_query($conn,$sql2);

       // check whether the query is executed or not
       if($res2==true){
           //query executed and books updated
           $_SESSION['update']='<div class="success">Book Updated Successfully.</div>';

           // redirect to manage book page
           header('location:'.SITEURL.'admin/manage-book.php');

       }
       else{
           //failed to update the book
           $_SESSION['update']='<div class="error">Failed to Update Book.</div>';

           // redirect to manage book page
           header('location:'.SITEURL.'admin/manage-book.php');
       }
    }
?>

<?php include('partials/footer.php'); ?>