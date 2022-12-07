<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php 
            //chceck whether the id is set or not
            if(isset($_GET['id']))
            {
                // get the id of selected category
                $id = $_GET['id'];

                // create the sql query to get the details
                $sql = "select * from `category` where id=$id";

                // execute query 
                $res =  mysqli_query($conn,$sql);

                // check whether the query is executed or not
                if($res==true){
                    //check whether the data is available or not
                    $count = mysqli_num_rows($res);

                    // check whether we have category data or not
                    if($count==1){
                        //get the details
                        //echo "Category Available";

                        $row = mysqli_fetch_assoc($res);

                        $title = $row['Title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else{
                        //redirect to manage-category page with page
                        $_SESSION['no-category-found'] = '<div class="error">Category Not Found.</div>';
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            }
            else{
                //redirect to manage-category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
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
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" alt="" width="100px">
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
                    <td>Select Image:
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input  <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name ="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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

       $id = $_POST['id'];
       $title = $_POST['title'];
       $current_image = $_POST['current_image'];
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
                $image_name = "Book_Category_".rand(000,999).'.'.$ext;

                $source_path =  $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;

                // upload image 
                $upload = move_uploaded_file($source_path,$destination_path);

                // check whether the image is uplaoded or not
                // and if the image is not uploaded then we will stop the process and redirect with error message

                if($upload==false){
                    //set message
                    $_SESSION['upload'] = '<div class="error">Failed to Upload Image.</div>';
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    //stop the process
                    die();
                }

               //remove current image if avilable
               if($current_image!=""){
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);

                    //check whether the image removed or not
                    //if failed then display message and stop the process

                    if($remove==false){
                        //failed to remove image
                        $_SESSION['failed-remove'] = '<div class="error">Failed to Remove Current Image</div>';
                        //redirect to manage category page
                        header('location:'.SITEURL.'admin/manage-category.php');
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

       $sql2 = "UPDATE `category` SET `Title` = '$title',`image_name` = '$image_name',`featured` = '$featured', `active`  = '$active' WHERE `category`.`id` = '$id'";

       // exxecute the query

       $res2 = mysqli_query($conn,$sql2);

       // check whether the query is executed or not
       if($res2==true){
           //query executed and category updated
           $_SESSION['update']='<div class="success">Category Updated Successfully.</div>';

           // redirect to manage category page
           header('location:'.SITEURL.'admin/manage-category.php');

       }
       else{
           //failed to update the category
           $_SESSION['update']='<div class="error">Failed to Update Category.</div>';

           // redirect to manage category page
           header('location:'.SITEURL.'admin/manage-category.php');
       }
    }
?>

<?php include('partials/footer.php'); ?>