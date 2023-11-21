<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Restaurant</h1>

        <br><br>


        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['Upload']))
            {
                echo $_SESSION['Upload'];
                unset($_SESSION['Upload']);
            }
        
        ?>

        <br><br>

        <!-- Add category from starts -->
        <form action="" method="POST" enctype="multipart/form-data" >
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr> 

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>


                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>


                <tr>
                    <td colspan="2" >
                        <input type="submit" name="submit" value="Add Restsurant" class="btn-secondary">
                    </td>
                    
                </tr>



            </table>
        <!-- Add category from ends -->



        <?php
           if(isset($_POST['submit']))
           {
            //echo "CLICKED";
            
            $title = $_POST['title'];
            if(isset($_POST['featured']))
            {
                $featured= $_POST['featured'];
            }
            else
            {
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active= $_POST['active'];
            }
            else
            {
                $active = "No";
            }
            
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];
                
                $ext = end(explode('.', $image_name));

                $image_name = "Food_Dinning_".rand(00000, 99999).'.'.$ext;


                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/dinning/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                if($upload==false)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload Image. </div>";
                    header('location:'.SITEURL.'admin/add-dinning.php');
                    die();
                }

            }
            else
            {
                $image_name="";
            }





            $sql = "INSERT INTO tbl_dinning SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                $_SESSION['add'] = "<div class='sucess'>Restaurant Added Sucessfully.</div>";
                header('location:'.SITEURL.'admin/manage-dinning.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='sucess'>Failed to ADD Restaurant.</div>";
                header('location:'.SITEURL.'admin/add-dinning.php');  

            }


           } 
        
        ?>




    </div>
</div>




<?php include('partials/footer.php'); ?>