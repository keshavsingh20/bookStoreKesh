<?php include('partials-front/menu.php'); ?>



    <!-- Book sEARCH Section Starts Here -->
    <section class="book-search text-center">
        <div class="container">
            <?php 
                //get search keyword
                //$search = $_POST['search'];
                //sql injection attack prevention
                $search = mysqli_real_escape_string($conn,$_POST['search']);
             ?>   
            <h2 style="color: cyan; -webkit-text-stroke-width: .5px; -webkit-text-stroke-color: black;">Books on Your Search <a href="#?" class="text-white">"<?php echo $search ?>"</a></h2>

        </div>
    </section>
    <!-- Book sEARCH Section Ends Here -->



    <!-- Book MEnu Section Starts Here -->
    <section class="book-menu">
        <div class="container">
            <h2 class="text-center">Book Menu</h2>

            <?php 

                //sel query to get bookss based on the search keyword
                // $search = 'burger';some sql query  // then hacker can insert some bugs here and can get harms our database
                // "SELECT * FROM `books` where `Title` like '%%' OR `Description` like '%%'";
                $sql = "SELECT * FROM `books` where `Title` like '%$search%' or `Description` like '%$search%'";

                //execute the query 
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether book is available or not
                if($count>0){
                    //book available
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
                    //book not avialable
                    echo "<div class='error'>Book Not Found.</div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Book Menu Section Ends Here -->



<?php include('partials-front/footer.php'); ?>