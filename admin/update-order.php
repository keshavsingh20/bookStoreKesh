<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        

        <?php 
            //check whether the id is set or not
            if(isset($_GET['id'])){
                // get the id of selected order
                    $id = $_GET['id'];

                // create the sql query to get the details
                $sql = "SELECT * from tbl_order where id=$id";

                // execute query 
                $res =  mysqli_query($conn,$sql);

                // check whether the query is executed or not
                if($res==true){
                    //check whether the data is available or not
                    $count = mysqli_num_rows($res);

                    // check whether we have order data or not
                    if($count==1){
                        //get the details
                        //echo "Order Available";

                        $row = mysqli_fetch_assoc($res);

                        $book = $row['book'];
                        $price = $row['price'];
                        $qty = $row['quantity'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                    }
                    else{
                        //details not available
                        //redirect to manage-order page
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                }
            }
            else{
                //redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30" style="width:40%">
                <tr>
                    <td>Book Nmae: </td>
                    <td><b> <?php echo $book ?> </b></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <b>₹ <?php echo $price ?> <b>
                    </td>
                </tr>
                <tr>
                    <td>Qty: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On
                                Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered
                            </option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


    <?php 
        //check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "Button Clicked"; 
                
            // get all the values from form to update 

            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;

            $status = $_POST['status'];

            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_contact = $_POST['customer_contact'];
            $customer_address = $_POST['customer_address'];

            //create a sql query to update order
            //    $sql = "UPDATE 'admin' SET
            //    'Full Name' = '$full_name',
            //    'Username' = '$username'
            //    where 'id' = '$id'
            //    ";

            $sql2 = "UPDATE `tbl_order` SET 
                `status` = '$status', 
                `quantity` = $qty,
                `total` = $total,
                `customer_name` = '$customer_name',
                `customer_contact` = '$customer_contact',
                `customer_email` = '$customer_email',
                `customer_address` = '$customer_address'
                WHERE `id` = '$id'";

            // execute the query

            $res2 = mysqli_query($conn,$sql2);

            // check whether the query is executed or not
            if($res2==true){
                //query executed and order updated
                $_SESSION['update']='<div class="success">Order Updated Successfully.</div>';

                // redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');

            }
            else{
                //failed to update the order page
                $_SESSION['update']='<div class="error">Failed to Update Order.</div>';

                // redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }
        
        ?>


    </div>
</div>


<?php include('partials/footer.php'); ?>