<?php include('partials-front/menu.php'); ?>



    <!-- Book sEARCH Section Starts Here -->
    <section class="book-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>book-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Book.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Book sEARCH Section Ends Here -->



    <!-- Book MEnu Section Starts Here -->
    <section class="book-menu ">
        <div class="container">
            <h2 class="text-center">
                Book Menu
            </h2>


            <?php
            //getting books from database that are active
            $sql = "SELECT * from `books` WHERE `active`='Yes'";

            //EXECUTE THE QUERY 
            $res = mysqli_query($conn,$sql);

            //count rows to chech whether book is avialable or not
            $count = mysqli_num_rows($res);

            if($count>0){
                //book avilable
                while($row = mysqli_fetch_assoc($res))
                {
                    //get the values like id, title,image_name
                    $id = $row['id'];
                    $title = $row['Title'];
                    $price = $row['price'];
                    $description = $row['Description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="book-menu-box">
                        <div class="book-menu-img">
                        <?php 
                                    //check whether image is availble or not
                                    if($image_name==""){
                                        //display message
                                        echo '<div class="error">Image Not Available.</div>';
                                    }
                                    else{
                                        //image availble
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/book/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                        </div>
                        <div class="book-menu-description">
                            <h4><?php echo $title; ?></h4>
                            <p class="book-price">₹ <?php echo $price; ?></p>
                            <p class="book-detail"><?php echo $description; ?></p><br>
                            <a href="<?php echo SITEURL; ?>order.php?book_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
        <?php
                }
            }
            else{
                //book not available
                echo '<div class="error">Book Not Found.</div>';
            }
        ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Book Menu Section Ends Here -->



<?php include('partials-front/footer.php'); ?>