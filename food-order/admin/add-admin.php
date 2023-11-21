<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                 echo $_SESSION['add'];
                 unset($_SESSION['add']);
             }
               
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>

                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>

                </tr>

                <tr>
                    <td colspan="2">
                       <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> 
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>


<?php
    //process the value and save in Database

    //Check weather the button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo"Button Clicked";

        //Get data from  from   
        $full_name = $_POST['full_name']; 
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //SQL query to save data in database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        
        ";

        // executing query and saving data into database  
         $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //check weather the query is executed or not
        if($res==TRUE)
        {
            //data inserted
            //echo "Data Inserted";
            $_SESSION['add'] = "Admin Added Sucessfully";
            header("location:".SITEURL.'admin/manage-admin.php');

        }

        else
        {
            //failed to insert
           //echo " failed to insert data";
           $_SESSION['add'] = "Failed to add Admin ";
            header("location:".SITEURL.'admin/add-admin.php');
        }


         

    }
    
?>