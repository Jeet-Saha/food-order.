<?php

    include('../config/constants.php');

    echo $id = $_GET['id'];   

    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);


    if($res==true)
    {
        //echo "Admin Deleted";
        $_SESSION['delete'] = "Admin Deleted Sucessfully";
        header('location:'.SITEURL. 'admin/manage-admin.php');
    }
    else
    {
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "Failed to Delete";
        header('location:'.SITEURL. 'admin/manage-admin.php');
    }


?>