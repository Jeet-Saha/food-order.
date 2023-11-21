<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Reservation</h1>
        <br><br>


        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the Order Details
                $id=$_GET['id'];

                //Get all other details based on this id
                //SQL Query to get the order details
                $sql = "SELECT * FROM tbl_reservation WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);

                    $restaurant = $row['restaurant'];
                    $seats = $row['seats'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $reservation_date = $row['reservation_date'];
                    $reservation_time= $row['reservation_time'];
                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('location:'.SITEURL.'admin/manage-reservation.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Restaurant Name</td>
                    <td><b> <?php echo $restaurant; ?> </b></td>
                </tr>

                <tr>
                    <td>seats</td>
                    <td>
                        <input type="number" name="seats" value="<?php echo $seats; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="On Waiting"){echo "selected";} ?> value="On Waiting">On Waiting</option>
                            <option <?php if($status=="Reserved"){echo "selected";} ?> value="Reserved">Reserved</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
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
                    <td>Date: </td>
                    <td>
                        <input type="text" name="reservation_date" value="<?php echo $reservation_date; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Time: </td>
                    <td>
                        <textarea name="reservation_time" cols="30" rows="5"><?php echo $reservation_time; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $seats = $_POST['seats'];

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $reservation_date = $_POST['reservation_date'];
                $reservation_time = $_POST['reservation_time'];

                //Update the Values
                $sql2 = "UPDATE tbl_reservation SET 
                    seats = $seats,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    reservation_date = '$reservation_date',
                    reservation_time = '$reservation_time'
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Reservation Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Reservation.</div>";
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>