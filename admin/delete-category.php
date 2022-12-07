<?php include('../config/constants.php'); ?>

<?php
    //check whether the id or imagename is selected or not
    // get the id of category to be deleted

    if((isset($_GET['id']) && isset($_GET['image_name'])))
    {
        //get the value and delete categroy
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //first remove the phpysical image file if it is available
        if($image_name !="")
        {
            //image is available.get the path or location
            $path = "../images/category/".$image_name;

            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = '<div class="error">Failed to Remove Categroy Image</div>';
                
                //redirect to manage category page
                header('localhost:'.SITEURL.'admin/manage-categroy.php');
                die();
            }
        }

        //delete data from database

        // create sql query to delete the category
        $sql = "delete from `category` where id=$id";

        // execute the query 
        $res = mysqli_query($conn,$sql);

        //check whether the query is executed or not
        // redirect page to manage-category page with message (success or error)

        if($res==true){
            // query executed successfully and category deleted
            //echo "category Deleted.";

            //create session variable to display message 
            $_SESSION['delete'] = '<div class="success">Category Deleted Successfully.</div>';
        
            // redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else{
            // failed to delete category
            //echo "Failed to  Delete Category.";
            $_SESSION['delete'] = '<div class="error">Failed to Delete Category</div>';

            header('location:'.SITEURL.'admin/manage-category.php');
        }


    }
    else{
        //redirect to category page
        header('location:'.SITEURL.'admin/manage-categroy.php');
    }
?>