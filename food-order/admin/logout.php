<?php 

    include('../config/constants.php');
    //destroy the session

    session_Destroy();
    


    header('location:'.SITEURL.'admin/login.php');


?>