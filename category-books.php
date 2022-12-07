<?php include('partials-front/menu.php'); ?>

    <?php 
        //check whether id is passed or not
        if(isset($_GET['id']))
        {
            //id is set
            $category_id = $_GET['id'];
            //get the category title based on cateory title
            $sql = "SELECT `Title` from `category` where `id` = '$category_id'";

            //execute the query
            $res = mysqli_query($conn,$sql);

            //get the value from database
            $row = mysqli_fetch_assoc($res);
            
            //get the title
            $category_title = $row['Title'];
        }
        else{
            //category not passed
            //redirect to home page
            header('locaton:'.SITEURL);
        }

    ?>

    <!-- Book sEARCH Section Starts Here -->
    <section class="book-search text-center">
        <div class="container">
            
            <h2 style="color: cyan; -webkit-text-stroke-width: .5px; -webkit-text-stroke-color: black;">Books on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- Book sEARCH Section Ends Here -->



    <!-- Book MEnu Section Starts Here -->
    <section class="book-menu">
        <div class="container">
            <h2 class="text-center">Book Menu</h2>

            <?php 
                //sql query to get books based on selected category
                $sql2 = "SELECT * from `books` where `category_id` = '$category_id'";

                //execute the query
                $res2 = mysqli_query($conn,$sql2);

                //count the rows
                $count2 = mysqli_num_rows($res2);
                
                //check whether the book is available or not
                if($count2>0){
                    //book is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['Title'];
                        $price = $row2['price'];
                        $description = $row2['Description'];
                        $image_name = $row2['image_name'];
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
                    echo "<div class='error'>Book Not Available</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- book Menu Section Ends Here -->



<?php include('partials-front/footer.php'); ?>