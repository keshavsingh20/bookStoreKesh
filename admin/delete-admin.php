<?php include('../config/constants.php'); ?>

<?php
    // get the id of admin to be deleted
    $id = (isset($_GET['id']) ? $_GET['id'] : '');

    // create sql query to delete the admin
    $sql = "delete from admin where id=$id";

    // execute the query 
    $res = mysqli_query($conn,$sql);

    //check whether the query is executed or not
    // redirect page to manage-admin page with message (success or error)
    
    if($res==true){
        // query executed successfully and admin deleted
        //echo "Admin Deleted.";

        //create session variable to display message 
        $_SESSION['delete'] = '<div class="success">Admin Deleted Successfully.</div>';
        
        // redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else{
        // failed to delete admin
        //echo "Failed to  Delete Admin.";
        $_SESSION['delete'] = '<div class="error">Failed to Delete Admin</div>';

        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>
