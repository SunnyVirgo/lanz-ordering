<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swipe/2.0.0/swipe.min.js"></script>

<?php include 'include.php'; ?>
    <!--home section start-->
<div class="wrapper" id="wrapper">
   
    <!--home section end-->
 
    <!--pizza section starts-->
   
<br><br><br><br><br>
   <section class="shakes" id="myTable">
 <!-- featured start -->
 <h1 class="heading">Try Our Featured Foods !!!</h1>
<br><br>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
  </a>
  <div class="carousel-inner">
    <?php
    $sql2 = "SELECT * FROM tbl_food WHERE deleted=0 and featured='Yes'";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);
    $qnty = 1;
    $active = true;
    if ($count2 > 0) {
      while ($row2 = mysqli_fetch_assoc($res2)) {
        $id = $row2['id'];
        $food_name = $row2['food_name'];
        $image_name = $row2['image_name'];
        $size = $row2['size'];
        $price = $row2['price'];
        $stocks = $row2['stocks'];
        $description = $row2['description'];
        ?>

        <div class="item <?php if ($active) { echo 'active'; $active = false; } ?>">
          <div class="box-car">
            <div class="img">
            <?php if ($image_name == '') {
              $sql5 = 'SELECT * FROM settings';
              $res5 = mysqli_query($conn, $sql5);
              $row5 = mysqli_fetch_assoc($res5);
              ?>
                   <img src="../images/foods/<?php echo $row5[
                'logo'
            ]; ?>" alt="">
                   <?php
            } else { ?>
              <img src="../images/foods/<?php echo $image_name; ?>" alt="">
            <?php } ?>
            </div>
                <div class="content">
            <h3><?php echo $food_name; ?></h3>
            <div class="desc">
              <p><?php echo $description; ?></p>
            </div>
            <span class="span">Size: <?php echo $size; ?></span><br>
            <span class="available">₱ <?php echo $price; ?></span>

            <?php if ($stocks > 0) { ?>
              <form action="" method="POST">
                <button class="btn" name="add">Add to cart</button>
                <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                <input type="hidden" name="food_name" value="<?php echo $food_name; ?>">
                <input type="hidden" name="size" value="<?php echo $size; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="quantity" value="<?php echo $qnty; ?>">
              </form>
            <?php } else { ?>
              <a class="btn1">Unavailable</a>
            <?php } ?>
            </div>
          </div>
      
        </div>
<?php
   }
 } else {
   echo 'No featured foods available';
 }
 ?>

  </div><!-- carousel-inner -->

  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
  </a>
  
</div><!-- myCarousel -->
   <!-- featured ends -->
   <br><br>
<h1 class="heading">All Foods</h1>
        <br><br><br>
        <div class="box-container" >
         
   <?php
   $sql2 = 'SELECT * FROM tbl_food WHERE deleted=0';
   $res2 = mysqli_query($conn, $sql2);
   $count2 = mysqli_num_rows($res2);
   $qnty = 1;
   if ($count2 > 0) {
       while ($row2 = mysqli_fetch_assoc($res2)) {

           $id = $row2['id'];
           $food_name = $row2['food_name'];
           $image_name = $row2['image_name'];
           $size = $row2['size'];
           $price = $row2['price'];
           $stocks = $row2['stocks'];
           $description = $row2['description'];
           ?>
    
    
                    <div class="box">
                        <div class="front">
                          
                         <?php if ($image_name == '') {
                          $sql5 = 'SELECT * FROM settings';
                          $res5 = mysqli_query($conn, $sql5);
                          $row5 = mysqli_fetch_assoc($res5);
                          ?>
                               <img src="../images/foods/<?php echo $row5[
                            'logo'
                        ]; ?>" alt="">
                               <?php
                         } else {
                              ?>
                                  <img src="../images/foods/<?php echo $image_name; ?>" alt="">
                                <?php
                         } ?>
              
                <h3><?php echo $food_name; ?></h3>
           
              
                     <span class="span">Size: <?php echo $size; ?></span><br>
                     <span class="available">₱ <?php echo $price; ?></span>
               
               
               
                <?php if ($stocks > 0) { ?>
                      <form action="" method="POST">
                     <button class="btn" name="add">Add to cart</button>
                      <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                       <input type="hidden" name="size" value="<?php echo $size; ?>">
                  <input type="hidden" name="food_name" value="<?php echo $food_name; ?>">
                  <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $qnty; ?>">
                     
                     </form>
                     <?php } else { ?>
                        <br>
                        <button class="btn1">Unavailable</button>
                     <?php } ?>
                     </div>
                     <div class="back">
                     <div class="desc">
                        <h3>Description</h3>
                     <p><?php echo $description; ?></p></div>
                     </div>

     
    

    </div>
                <?php
       }
   } else {
       echo 'NO FOOD ADDED';
   }

   if (isset($_POST['add'])) {
       $sql1 = "SELECT * FROM tbl_food WHERE id='$id'";
       $res1 = mysqli_query($conn, $sql1);

       $row1 = mysqli_fetch_assoc($res1);

       $stock = $row1['stocks'];

       if ($tock < 1) {
           echo "<script> Swal.fire({
                type: 'error',
                text: 'Food is out of Stock!',
                timer:800,
                showConfirmButton:false
                })</script>";
       } else {
       }

       $food_id = $_POST['food_id'];
       $food = $_POST['food_name'];
       $price1 = $_POST['price'];
       $qnty1 = $_POST['quantity'];
       $fsize = $_POST['size'];

       if (isset($_SESSION['cart'])) {
           $check = array_column($_SESSION['cart'], 'food');
           if (in_array($food, $check)) {
               echo "<script> Swal.fire({
                type: 'error',
                text: 'Food already in cart!',
                timer:800,
                showConfirmButton:false
                })</script>";
           } else {
               $count = count($_SESSION['cart']);
               $_SESSION['cart'][$count] = [
                   'food' => $food,
                   'fprice' => $price1,
                   'fqnty' => $qnty1,
                   'fid' => $food_id,
                   'fsize' => $fsize,
               ];
               $sql = "UPDATE tbl_food SET stocks = stocks - '$qnty1' WHERE id='$food_id'";
               $res = mysqli_query($conn, $sql);
               echo "<script> Swal.fire({
                                type: 'success',
                                text: 'Added to Cart!',
                                timer:800,
                                showConfirmButton:false
                                }).then(function() {
                            window.location = 'home.php';
                        })
                        </script>";
           }
       } else {
           $_SESSION['cart'][] = [
               'food' => $food,
               'fprice' => $price1,
               'fqnty' => $qnty1,
               'fid' => $food_id,
               'fsize' => $fsize,
           ];
           $sql5 = "UPDATE tbl_food SET stocks = stocks - '$qnty1' WHERE id='$food_id' ";
           $res5 = mysqli_query($conn, $sql5);
           echo "<script> Swal.fire({
            type: 'success',
            text: 'Added to Cart!',
             timer:800,
             showConfirmButton:false
        }).then(function() {
                            window.location = 'home.php';
                        })
                        </script>";
       }
   }
   ?>




        </div>
    </section>
</div>
    <!--hot drinks section end-->

    <script>
    window.addEventListener('load', function () {
      var carousel = document.getElementById('myCarousel');
      var swipe = new Swipe(carousel, {
        startSlide: 0,
        speed: 400,
        auto: false,
        continuous: true,
        disableScroll: false
});
});
</script>






<script>

$(document).ready(function(){
    $('#search').keyup(function(){
        search_table($(this).val());
    });
    function search_table(value){
        $('#myTable .box').each(function(){
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0)
                {
                    found='true';
                }
            });
            if(found=='true'){
                $(this).show();
            }
            else{
                $(this).hide();
            }
        });
    }
  });


  $(document).ready(function() {
    $('.box').click(function() {
        if (!$(this).hasClass('flipped')) {
            $('.box.flipped').removeClass('flipped');
            $(this).addClass('flipped');
        } else {
            $(this).removeClass('flipped');
        }
    });

    $('button[name="add"]').click(function(event) {
        event.stopPropagation();
    });
});


   
</script>

</body>
 
</html>