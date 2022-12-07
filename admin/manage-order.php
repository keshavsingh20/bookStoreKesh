<?php include('partials/menu.php') ?>

<div class='main-content'>
    <div class="wrapper" style="width:100%">
        <h1>Manage Order</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['update'])) //checking whether the session is set or not
                {
                    echo $_SESSION['update']; //display session message
                    unset($_SESSION['update']); // removing session message
                }
        ?>
        <br>
        
        <table class="tbl-full">
            <tr class="tbl-heading">
                <th>S.N.</th>
                <th>Book</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Stauts</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            <?php 
                //get all the orders from database
                //display order in a way so that latest order first
                $sql = "SELECT * FROM `tbl_order` ORDER BY `id` DESC";

                //execute query
                $res = mysqli_query($conn,$sql);

                //count the rows
                $count = mysqli_num_rows($res);
                //create serial number with initial value 1
                $sn = 1;

                if($count>0)
                {
                    //order avialable
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $book = $row['book'];
                        $price = $row['price'];
                        $qty = $row['quantity'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $book; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total ?></td>
                            <td><?php echo $order_date; ?></td>

                            <td> <strong>
                                <?php 
                                    //Ordered, On Delivery, Delivered, Cancelled
                                    if($status=="Ordered")
                                    {
                                        echo "<label>$status</label>";
                                    }
                                    elseif($status=="On Delivery"){
                                        echo "<label style='color: orange'>$status</label>";
                                    }
                                    elseif($status=="Delivered"){
                                        echo "<label style='color: green'>$status</label>";
                                    }
                                    elseif($status=="Cancelled"){
                                        echo "<label style='color: red'>$status</label>";
                                    }
                                ?>
                                </strong>
                            </td>

                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>"
                                    class="btn-secondary">Update Order</a>
                            </td>
                        </tr>

            <?php
                    }
                }
                else{
                    //order not availble
                    echo "<tr> <td colspan=12 class='error'>Orders Not Avilable</td></tr>";
                }

            ?>

        </table>
        <div class="clearfix"></div>
    </div>
</div>

<?php include('partials/footer.php') ?>