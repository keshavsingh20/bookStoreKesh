<?php include('partials/menu.php') ?>

    <!--main content section starts here-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>

            <?php if(isset($_SESSION['login'])) //checking whether the session is set or not
                {
                    echo $_SESSION['login']; //display session message
                    unset($_SESSION['login']); // removing session message
                }
            ?>

            <div class="col-4 text-center">
                <?php
                    //sql query
                    $sql =  "SELECT * FROM category";

                    //execute query
                    $res = mysqli_query($conn,$sql);

                    //count rows
                    $count = mysqli_num_rows($res);

                ?>
                <h1><?php echo $count; ?></h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <?php
                    //sql query
                    $sql2 =  "SELECT * FROM books";

                    //execute query
                    $res2 = mysqli_query($conn,$sql2);

                    //count rows
                    $count2 = mysqli_num_rows($res2);

                ?>
                <h1><?php echo $count2; ?></h1>
                <br>
                Books
            </div>

            <div class="col-4 text-center">
                <?php
                    //sql query
                    $sql3 =  "SELECT * FROM tbl_order";

                    //execute query
                    $res3 = mysqli_query($conn,$sql3);

                    //count rows
                    $count3 = mysqli_num_rows($res3);

                ?>
                <h1><?php echo $count3; ?></h1>
                <br>
                Orders
            </div>

            <div class="col-4 text-center">
                <?php
                    //sql query to get total revenue generated
                    //aggreagate function in sql
                    $sql4 =  "SELECT SUM(`total`) AS `Total` FROM `tbl_order` WHERE `status`='Delivered'";

                    //execute query
                    $res4 = mysqli_query($conn,$sql4);

                    //get the value
                    $row4 = mysqli_fetch_assoc($res4);

                    //get total revenue 
                    $total_revenue = $row4['Total'];

                ?>
                <h1>₹<?php echo $total_revenue; ?></h1>
                <br>
                Revenue Generated
            </div>

            <div class="clearfix"></div>
        </div>

    </div>
    <!--main content ends here-->

 <?php include('partials/footer.php');