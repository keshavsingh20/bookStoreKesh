<?php include('partials-front/menu.php'); ?>


<!--book search start -->
<section class="book-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>book-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Books.." required>
            <input type="submit" name="Submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<br>
<!--book search ends-->

<?php 
    if(isset($_SESSION['order'])) //check if session is set or not
    {
        echo $_SESSION['order']; //display message
        unset($_SESSION['order']); //unset the session
    }
    ?>

<!--book category section start -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Books</h2>

        <?php 
                //create sql query to display categories from database
                $sql = "SELECT * from `category` where `featured`='Yes' AND `active`='Yes' LIMIT 3";
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
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Book"
                    class="img-responsive img-curve">
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
                    echo '<div class="error">Category Not Added.';
                }
            ?>

        <div class="clearfix"></div>
    </div>
    <!--
    <p class="text-center">
        <a href="<?php echo SITEURL;?>category-books.php" ><b>See All Categories.</b></a>
    </p>
    -->
</section>
<!--book category section ends-->

<!--book menu section start -->
<section class="book-menu ">
    <div class="container">
        <h2 class="text-center">
            Book Menu
        </h2>

        <?php
            //getting books from database that are active and featured
            $sql2 = "SELECT * from `books` WHERE `active`='Yes' and `featured`='Yes' LIMIT 6";

            //EXECUTE THE QUERY 
            $res2 = mysqli_query($conn,$sql2);

            //count rows to chech whether book is avialable or not
            $count2 = mysqli_num_rows($res2);

            if($count2>0){
                //book avilable
                while($row = mysqli_fetch_assoc($res2))
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
                <img src="<?php echo SITEURL; ?>images/book/<?php echo $image_name; ?>" alt="Book"
                    class="img-responsive img-curve">
                <?php
                                    }
                                    ?>
            </div>
            <div class="book-menu-description">
                <h4><?php $title; ?></h4>
                <p class="book-price">₹ <?php echo $price; ?></p>
                <p class="book-detail"><?php echo $description; ?></p><br>
                <a href="<?php echo SITEURL; ?>order.php?book_id=<?php echo $id; ?>" class="btn btn-primary">Order
                    Now</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php
                }
            }
            else{
                //book not available
                echo '<div class="error">Book Not Available.</div>';
            }
        ?>

        <div class="clearfix"></div>
    </div>
    <p class="text-center">
        <a href="<?php echo SITEURL;?>books.php" ><b>See All Books</b></a>
    </p>
</section>
        
<!--book menu section ends-->

<?php include('partials-front/footer.php'); ?>