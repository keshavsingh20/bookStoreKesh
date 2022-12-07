<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Book</h1>
        <br><br>

        <?php if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //display session message
                unset($_SESSION['add']); // removing session message
            }
        ?>

        <?php if(isset($_SESSION['upload'])) //checking whether the session is set or not
            {
                echo $_SESSION['upload']; //display session message
                unset($_SESSION['upload']); // removing session message
            }
        ?>

        <br><br>

        <!-- add-category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Book Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Book">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="35" rows="5"
                            placeholder="Description of the Book."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
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
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="submit" name="submit" value="Add Book" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- add-book form ends -->
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
       $title = $_POST['title'];
       $price = $_POST['price'];
       $description = $_POST['description'];
       $category = $_POST['category'];

       //whether the button is selected or not
       if(isset($_POST['featured']))
       {
           //get the value from form
           $featured = $_POST['featured'];
       }
       else{
            //set the default value  
            $featured = "No";         
       }

       if(isset($_POST['active']))
       {
           //get the value from form
           $active = $_POST['active'];
       }
       else{
            //set the default value  
            $active = "No";         
       }

       //check whether image is slected or not for image name accordingly
        //    print_r($_FILES['image']);
        //    die(); //break the code here to check the value of image
        
        // if(isset($_FILES['file_name from form']['name'])) //name property from above code

        if(isset($_FILES['image']['name']))
        {
            //upload the image 
            // to upload image we need image name and source path and destination path

            $image_name  = $_FILES['image']['name'];

            //upload the image only if image is selected
            if($image_name!=""){

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
            }
        }
        else{
            //don't upload the image and set the value as blank
            $image_name="";
        }
       
        
        //sql query to save data in database

        $sql2 = "INSERT INTO `books` ( `Title`,`Description`,`price`, `image_name`,`category_id`, `featured`, `active`) VALUES ( '$title', '$description', '$price', '$image_name',' $category', '$featured', '$active')";
        
        //execute query and save data in database
        $res = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        
        //check whether the (query is executed) data is inserted or not and display approriate message
        if($res==TRUE){
            // query executed and book added
            //echo "Data Inserted";
            
            // create a session variable to display message
            $_SESSION['add'] = '<div class="success">Book Added Successfully</div>';

            //redirect page to mange-book page 
            header('location:'.SITEURL.'admin/manage-book.php');
        }
        else{
            //failed to add categroy
            //echo "Failed to insert data";
            // create a session variable to display message
            $_SESSION['add'] = '<div class="error">Failed to add Book.</div>';

            //redirect page  to add-book page
            header('location:'.SITEURL.'admin/add-book.php');
        }
    }
    
?>