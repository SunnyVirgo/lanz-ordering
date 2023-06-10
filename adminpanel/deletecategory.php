
<?php
include '../config/constant.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE food_category SET deleted=1 WHERE id=$id ";

    $res = mysqli_query($conn, $sql);

    $sql2 = "UPDATE tbl_food SET deleted=1 WHERE category_id=$id ";

    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        header('location:' . SITEURL . 'adminpanel/managecategory.php?n=1');
    } else {
        header('location:' . SITEURL . 'adminpanel/managecategory.php?fails=1');
    }
}

if (isset($_GET['id1'])) {
    $id1 = $_GET['id1'];

    $sql = "UPDATE food_category SET deleted=0 WHERE id=$id1 ";

    $res = mysqli_query($conn, $sql);

    $sql3 = "UPDATE tbl_food SET deleted=0 WHERE category_id=$id1 ";

    $res3 = mysqli_query($conn, $sql3);

    if ($res3 == true) {
        header('location:' . SITEURL . 'adminpanel/managecategory.php?n=1');
    } else {
        header('location:' . SITEURL . 'adminpanel/managecategory.php?fails=1');
    }
}


?>
