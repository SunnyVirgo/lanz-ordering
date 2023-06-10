<?php include '../config/constant.php';
include 'checklogin.php';
$sql = 'SELECT * FROM settings';
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="../fontawesome-free-6.1.2-web/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="shortcut icon" href="../images/foods/<?php echo $row[
                            'logo'
                        ]; ?>" type="image/x-icon">
    <script src="../sweetalert2/jquery-3.4.1.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../sweetalert2/bootstrap.bundle.min.js"></script>
    <script src="../sweetalert2/bootstrap.min.js"></script>
    <script src="../sweetalert2/bootstrap.js"></script>
    <style>
    
  </style>
</head>

<body>
    <section>
        <div class="lg"><a href="../adminpanel/logout.php" class="log-out"><i class="fa-solid fa-power-off"></i></a></div>
        <div class="circle"></div>
        <div class="circle1"></div>
        <div class="content">
            <div class="textBox">
                <?php
                $sql = 'SELECT * FROM settings';
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
                ?>
                <h2>Welcome to <?php echo $row['name']; ?>!</h2>
                <p><?php echo $row['qoute']; ?>    </p>
                <ul>
                    <li><span><i class="fa-solid fa-phone"></i></span> <i><u><?php echo $row['contact']; ?></u></i></li>
                    <li><span><i class="fa-solid fa-envelope-circle-check"></i></span><i><u><?php echo $row['email']; ?></u></i></li>
                    <li><span><i class="fa-solid fa-location-dot"></i></span> <i><?php echo $row['address']; ?></i></li>
                </ul>
                <a href="home.php" id='order-button'>Order Now</a>
                <div class="swipe-btn" ontouchstart="handleTouchStart(event)" ontouchmove="handleTouchMove(event)" ontouchend="handleTouchEnd()"><span class="running-arrows">
  </span>Swipe to Order <span class="running-arrows">
    <span class="blinking-arrow"> <i class="fa-solid fa-angle-right"></i></span>
    <span class="blinking-arrow"><i class="fa-solid fa-angle-right"></i></span>
    <span class="blinking-arrow"><i class="fa-solid fa-angle-right"></i></span>
  </span></div>
            </div>
           

            <div class="imgBox">
                <img src="svg/undraw_eating_together_re_ux62.svg" class="image" alt="" />
            </div>
    </section>
    <script>
  let touchStartX = 0;
  let touchEndX = 0;

  function handleTouchStart(event) {
    touchStartX = event.touches[0].clientX;
  }

  function handleTouchMove(event) {
    touchEndX = event.touches[0].clientX;
  }

  function handleTouchEnd() {
    if (touchEndX - touchStartX > 400) {
      window.location.href = "home.php";
    }
  }
</script>
    <script>
          $('.log-out').on('click', function(g) {
        g.preventDefault();
        const b = $(this).attr('href')

        Swal.fire({
            title: 'Are You Sure?',
            text: 'You will be logged out!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText:'Log Out',
        }).then((result) => {
            if (result.value) {
                document.location.href = b;
            }
        })
    })
    </script>
</body>

</html>