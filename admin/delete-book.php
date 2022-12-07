<?php include('../config/constants.php'); ?>

<?php
    //check whether the id or imagename is selected or not
    // get the id of book to be deleted

    if((isset($_GET['id']) && isset($_GET['image_name'])))
    {
        //get the value and delete book
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //first remove the phpysical image file if it is available
        if($image_name !="")
        {
            //image is available.get the path or location
            $path = "../images/book/".$image_name;

            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = '<div class="error">Failed to Remove Book Image</div>';
                
                //redirect to manage book page
                header('localhost:'.SITEURL.'admin/manage-book.php');
                die();
            }
        }

        //delete data from database

        // create sql query to delete the book
        $sql = "delete from `books` where id=$id";

        // execute the query 
        $res = mysqli_query($conn,$sql);

        //check whether the query is executed or not
        // redirect page to manage-book page with message (success or error)

        if($res==true){
            // query executed successfully and book deleted
            //echo "book Deleted.";

            //create session variable to display message 
            $_SESSION['delete'] = '<div class="success">Book Deleted Successfully.</div>';
        
            // redirect to manage book page
            header('location:'.SITEURL.'admin/manage-book.php');

        }
        else{
            // failed to delete book
            //echo "Failed to  Delete Book.";
            $_SESSION['delete'] = '<div class="error">Failed to Delete Book.</div>';

            header('location:'.SITEURL.'admin/manage-book.php');
        }


    }
    else{
        $_SESSION['unauth'] = '<div class="error">Unauthoriesed Access.</div>';
        //redirect to book page
        header('location:'.SITEURL.'admin/manage-book.php');
    }
?>