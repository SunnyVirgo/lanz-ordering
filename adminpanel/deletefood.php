
<link rel="stylesheet" href="../fontawesome-free-6.1.2-web/fontawesome-free-6.1.2-web/css/all.css">
    <link rel="stylesheet" href= "newstyle.css">
<?php
include '../config/constant.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE tbl_food SET deleted=1 WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        header('location:' . SITEURL . 'adminpanel/managefood.php?n=1');
    } else {
        header('location:' . SITEURL . 'adminpanel/managefood.php?fails=1');
    }
}
if (isset($_GET['id1'])) {
    $id1 = $_GET['id1'];
    $sql = "SELECT * FROM tbl_food  WHERE id=$id1";

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $id3 = $row['category_id'];

    $sql = "SELECT * FROM food_category  WHERE id=$id3";

    $res = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($res);
    if ($row1['deleted'] == 0) {
        $sql = "UPDATE tbl_food SET deleted=0 WHERE id=$id1";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            header('location:' . SITEURL . 'adminpanel/managefood.php?n=1');
        } else {
            header('location:' . SITEURL . 'adminpanel/managefood.php?fails=1');
        }
    } else {
        header('location:' . SITEURL . 'adminpanel/managefood.php?fails=1');
    }
}


?>
