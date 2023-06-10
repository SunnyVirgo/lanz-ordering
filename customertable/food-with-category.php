<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swipe/2.0.0/swipe.min.js"></script>
<?php include 'include.php'; ?>
<div class="wrapper" id="wrapper">
<?php if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql1 = "SELECT category_name FROM food_category WHERE id=$category_id";
    $res1 = mysqli_query($conn, $sql1);

    $row1 = mysqli_fetch_assoc($res1);

    $category_name = $row1['category_name'];
} else {
} ?>
<br><br><br><br><br><br>
    <section class="shakes" id="">

 <h1 class="heading"> <?php echo $category_name; ?></h1>
 <br><br><br>
        <div class="box-container" id="myTable">
<?php
$sql2 = "SELECT * FROM tbl_food WHERE deleted=0 AND category_id=$category_id ";
$res2 = mysqli_query($conn, $sql2);
$count2 = mysqli_num_rows($res2);
$qnty = 1;
if ($count2 > 0) {
    while ($row2 = mysqli_fetch_assoc($res2)) {

        $food_name = $row2['food_name'];
        $image_name = $row2['image_name'];
        $size = $row2['size'];
        $price = $row2['price'];
        $stocks = $row2['stocks'];
        $description = $row2['description'];
        $id = $row2['id'];
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
                  <input type="hidden" name="food_name" value="<?php echo $food_name; ?>">
                  <input type="hidden" name="size" value="<?php echo $size; ?>">
                  <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $qnty; ?>">
                     
                     <?php } else { ?>
                        <br>
                     <button class="btn1">Unavailable</button>
                     <?php } ?>
            </form> 
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
    echo "NO FOOD AVAILABLE IN ' $category_name '";
}

if (isset($_POST['add'])) {
    $sql1 = "SELECT * FROM tbl_food WHERE id='$id'";
    $res1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($res1);

    $stock = $row1['stocks'];

    if ($stock < 1) {
        echo "<script> Swal.fire({
                type: 'error',
                text: 'Food is out of Stock!',
                timer:2000,
                showConfirmButton:false
                })</script>";
    } else {
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
                timer:2000,
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
                                timer:2000,
                                showConfirmButton:false
                                }).then(function() {
                            window.location = 'food-with-category.php?category_id= $category_id';
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
            $sql = "UPDATE tbl_food SET stocks = stocks - '$qnty1' WHERE id='$food_id'";
            $res = mysqli_query($conn, $sql);
            echo "<script> Swal.fire({
            type: 'success',
            text: 'Added to Cart!',
             timer:2000,
             showConfirmButton:false
        }).then(function() {
                            window.location = 'food-with-category.php?category_id= $category_id';
                        })
                        </script>";
        }
    }
}
?>
            

    
        </div>
    </section>
    </div>
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