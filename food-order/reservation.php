
<?php include('partials-front/menu.php'); ?>


    <?php
        if(isset($_GET['dinning_id']))
        {
            $dinning_id = $_GET['dinning_id'];
            $sql = "SELECT * FROM tbl_dinning WHERE id=$dinning_id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $image_name = $row['image_name'];
            }
            else
            {
                header('location:' .SITEURL);
            }
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD order Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your reservation.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Restaurant</legend>

                    <div class="food-menu-img">

                        <?php
                            if($image_name=="")
                            {
                                echo"<div calss='error'>Image not Available.</div>";
                            }
                            else
                            {
                                ?>

                                    <img src="<?php echo SITEURL; ?>images/dinning/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>



                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="restaurant" value="<?php echo $title; ?>">

                        <div class="order-label">No of Seats</div>
                        <input type="number" name="seats" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Jesus Christ" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 7980XXXXXX" class="input-responsive" required>

                    <div class="order-label">Date</div>
                    <input type="Date" name="Date" placeholder="E.g. DD/MM/YYYY" class="input-responsive" required>

                    <div class="order-label">Time</div>
                    <input type="Time" name="Time" placeholder="E.g. HH:MM" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            
            <?php
                if(isset($_POST['submit']))
                {
                    $restaurant = $_POST['restaurant'];
                    $seats = $_POST['seats'];
                    $status = "ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $reservation_date = $_POST['Date'];
                    $reservation_time = $_POST['Time'];


                    $sql2 = "INSERT INTO tbl_reservation SET
                        restaurant = '$restaurant',
                        seats = $seats,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        reservation_date = '$reservation_date',
                        reservation_time = '$reservation_time'

                    ";

                    //echo $sql2; die();

                    $res2 = mysqli_query($conn,$sql2);

                    if($res2==true)
                    {
                        $_SESSION['order'] = "<div class= 'success'>Reserved Sucessfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class= 'error'>Failed to Reserve.</div>";
                        header('location:'.SITEURL);
                    }
                }
            
            ?>






        </div>
    </section>
    <!-- fOOD order Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>