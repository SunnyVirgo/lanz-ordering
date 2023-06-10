<?php
include '../config/constant.php';
$sql = 'SELECT * FROM settings';
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>

    <!--font awesome cdn link-->
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-6.1.2-web/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="shortcut icon" href="../images/foods/<?php echo $row[
                            'logo'
                        ]; ?>" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    
    <script src="../sweetalert2/jquery-3.4.1.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
     <script src="../sweetalert2/bootstrap.bundle.min.js"></script>
      <script src="../sweetalert2/bootstrap.min.js"></script>
      <script src="../sweetalert2/bootstrap.js"></script>

</head>

<body>

    <!-- header section starts -->

    <header>
 <?php
 $sql = 'SELECT * FROM settings';
 $res = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($res);
 ?>
        <a href="home.php" class="logo"><?php echo $row['name']; ?></a>

        <nav class="navbar">
            <a class="btn2" href="home.php">Home</a>
            <?php
            $sql = 'SELECT * FROM food_category WHERE deleted=0';

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {

                    $id = $row['id'];
                    $category_name = $row['category_name'];
                    ?>
                                <a href="food-with-category.php?category_id=<?php echo $id; ?>" class="btn2"><?php echo $category_name; ?></a>
                               
                               
                        <?php
                }
            } else {
                echo 'NO CATEGORY AVAILABLE';
            }
            ?>

    
        </nav>

        <div class="boxContainer">
            <table class="elementsContainer">
                <tr>
                    <td>
                        <input type="text" id="search" placeholder="Search food..." class="search">
                    </td>
                
                </tr>
            </table>
        </div>

        <!--header section ends-->

        <div class="icons">
            <?php
            $count = 0;
            if (isset($_SESSION['cart'])) {
                $count = count($_SESSION['cart']);
            }
            ?>
            <a  href="cart.php" class="fas fa-shopping-cart"><span>(<?php echo $count; ?>)</span></a>
            
                                <a href="history.php"><i class="fa-solid fa-list-check"></i></a>
    <a href="index.php" class="fa fa-sign-out"></a>
        </div>
     

    
    </header>
<script>
     const currentLocation = location.href;
   const menuItem = document.querySelectorAll(".navbar a");
   const menuLength = menuItem.length;

   for(var i = 0; i < menuLength; i++) {
    if(menuItem[i].href === currentLocation) {
        menuItem[i].className = "active";
    }
   }
     $('.fa-sign-out').on('click', function(g) {
        g.preventDefault();
        const b = $(this).attr('href')

        Swal.fire({
            title: 'Are you sure you want exit?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText:'Exit',
        }).then((result) => {
            if (result.value) {
                document.location.href = b;
            }
        })
    })
    

   </script>
