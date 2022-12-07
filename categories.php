<?php include('partials-front/menu.php'); ?>



    <!-- Categories Section Starts Here -->
    <section class="book-search text-center">
        <div class="container">
           <h1 style="color: cyan;  font-size: bold; -webkit-text-stroke-width: .5px; -webkit-text-stroke-color: black;"> Books Category.</h1>
        </div>
    </section>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Books</h2>

            <?php 
                //display all the categories that are active
                $sql = "SELECT * from `category` WHERE `active`='Yes'";

                //execute the query 
                $res = mysqli_query($conn,$sql);

                //count rows to chech whether category is avialable or not
                $count = mysqli_num_rows($res);

                if($count>0){
                    //categories avilable
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //get the values like id, title,image_name
                        $id = $row['id'];
                        $title = $row['Title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-books.php?id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //check whether image is availble or not
                                    if($image_name==""){
                                        //display message
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else{
                                        //image availble
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Book" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
            <?php
                    }
                }
                else{
                    //categories not available
                    echo '<div class="error">Category Not Found.';
                }
            ?>
           
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



<?php include('partials-front/footer.php'); ?>