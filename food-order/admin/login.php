<?php include('../config/constants.php'); ?>


<html>
    <head>
        <title>
            Login - food order system
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>


            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            
            ?>
            <br><br>
            <!--login form starts -->

            <form action="" method="POST" class="text-center">
            Username: <br>                                                      
            <input type="text" name="username" placeholder=" Enter Username"><br><br><br>
            Password: <br>                                                      
            <input type="password" name="password" placeholder=" Enter Password"><br><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary"> <br>

            </form>






            <!--login form ends -->

        </div>

    </body>
</html>


<?php
    //submit button clicked or not
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username= '$username' AND password= '$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user available
            $_SESSION['login'] = "<div class='sucess'>Login Sucessful.</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>