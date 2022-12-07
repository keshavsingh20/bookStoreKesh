<?php include('partials-front/menu.php'); ?>

    <?php 
        //check whether the book is set or not
        if(isset($_GET['book_id']))
        {
            //get the book id and details of the selected book
            $book_id = $_GET['book_id'];

            $sql = "SELECT * from `books` WHERE `id`='$book_id'";

            //execute the query
            $res = mysqli_query($conn,$sql);

            //count the rows
            $count = mysqli_num_rows($res);

            //check whether the data is available or not
            if($count==1){
                //we have data
                //get the data from database
                $row = mysqli_fetch_assoc($res);

                $title = $row['Title'];
                $price = $row['price'];
                $imagae_name = $row['image_name'];
                
            }
            else{
                //book not available
                header('location:'.SITEURL);
            }

        }
        else{
            //redirect to home page
            header('location:'.SITEURL);
        }
    ?>

    <!-- book order Section Starts Here -->
    <section class="book-search">
    </section>
    <!-- Book order Section Ends Here -->

        <div class="container book-order-menu">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method ="POST">
                <fieldset>
                    <legend>Selected Book</legend>

                    <div class="book-menu-img">
                        <?php 
                            //check whether the image is available or not
                            if($imagae_name==""){
                                //image is not avialable
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            else
                            {
                                //image is available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/book/<?php echo $imagae_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                       
                    </div>
    
                    <div class="book-menu-desc">
                        <h3><?php echo $title; ?></h3>
                            <input type="hidden" name="book" value="<?php echo $title;?>">
                        <p class="book-price">₹ <?php echo $price; ?></p>
                            <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. john@email.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


        <?php 
            //check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //get all the details from the form
                $book = $_POST['book'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; //total = price * quantitiy
                date_default_timezone_set('Asia/Kolkata');
                $order_date = date("y-m-d h:i:sa"); //order date will get current date and time

                $status = "Ordered"; //can be three status like ordered, On Delivery, Delivered and Cancelled

                $customer_name = $_POST['full-name'];
                $customer_email = $_POST['email'];
                $customer_contact = $_POST['contact'];
                $customer_address = $_POST['address'];

                //save the order in database

                //create sql to save the data
                $sql2 = "INSERT INTO tbl_order SET 
                        `book` = '$book',
                        `price` = $price,
                        `quantity` = $qty,
                        `total` = $total,
                        `order_date` = '$order_date',
                        `status` = '$status',
                        `customer_name` = '$customer_name',
                        `customer_contact` = '$customer_contact',
                        `customer_email` = '$customer_email',
                        `customer_address` = '$customer_address'
                        ";

                //execute the query
                $res2 = mysqli_query($conn,$sql2);

                //check whether the query is executed or not
                if($res2==true)
                {
                   //query executed and order saved
                    $_SESSION['order'] = '<div class="success text-center">Book Ordered Successfully.</div>';
                    //redirect to home page
                    header('location:'.SITEURL);
                }
                else
                {
                    //failed to save order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order Book.</div>";
                    //redirect to home page
                    header('location:'.SITEURL);
                    
                }

            }
            else
            {

            }
                            
        ?>



        </div>




<?php include('partials-front/footer.php'); ?>