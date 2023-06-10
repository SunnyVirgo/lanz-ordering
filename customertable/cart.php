<?php
include 'include.php';
$table = $_SESSION['table'];
?>
<div class="cont">
<div class="cart" id="cart">
          <div class="table">
                <table>
                    <colgroup>
                    <col width=15%>
                    <col width=39%>
                    <col width=15%>
                    <col width=15%>
                    <col width=15%>
                    <col width=1%>
                    

                
                </colgroup>
                    <thead>
                        <th>Quantity</th>
                        <th>Food</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Total Price</th>
                       
                        <th>Remove</th>
                    </thead>
                    <hr/>
                    <tbody>
                      <?php
                      $date = date('Y/m/d');
                      $tprice = 0;
                      $tamount = 0;
                      $total = 0;
                      if (isset($_SESSION['cart'])) {
                          foreach ($_SESSION['cart'] as $key => $value) {

                              $total = $value['fprice'] * $value['fqnty'];
                              $tamount += $value['fprice'] * $value['fqnty'];
                              ?>
                           
                                   <tr class='tr'>
                     <!-- <td><button class="minus">-</button> -->
                     <td>
                        <form action="" method="POST">
                            <input type="number" class="qnty" name="chqnty" value="<?php echo $value[
                                'fqnty'
                            ]; ?>" min="1" max="10">  
                               <button type="hidden" class="qnty" name="update">  </button>
                    </td>
                        <td><input type='hidden' name='item' value="<?php echo $value[
                            'food'
                        ]; ?>"><?php echo $value['food']; ?> </td>
                        <td><span ><?php echo $value['fsize']; ?></span></td>
                        <td><input type="hidden" class="iprice" value="<?php echo number_format(
                            $value['fprice'],
                            2
                        ); ?>">₱ <?php echo number_format(
    $value['fprice'],
    2
); ?></td>
                        <td>₱ <span ><?php echo number_format(
                            $total,
                            2
                        ); ?></span></td>
                        
                          
                        <td> 
                            <button  name='remove' class='remove'><i class='fa-solid fa-trash'></i></button>
                      <input type='hidden' name='item' value="<?php echo $value[
                          'food'
                      ]; ?>">
                             </form>
                        </td>
                        
                        </tr>
                      
                    <?php
                          }
                      }

                      // remove

                      if (isset($_POST['remove'])) {
                          foreach ($_SESSION['cart'] as $key => $value) {
                              if ($value['food'] === $_POST['item']) {
                                  $sql = "UPDATE tbl_food SET stocks= stocks + '$value[fqnty]' WHERE id='$value[fid]'";
                                  $res = mysqli_query($conn, $sql);
                                  unset($_SESSION['cart'][$key]);
                                  $_SESSION['cart'] = array_values(
                                      $_SESSION['cart']
                                  );
                                  echo "<script> Swal.fire({
                            type: 'success',
                            confirmButtonColor: ' blue',
                            text: 'Item removed!',
                            timer:2000,
                            showConfirmButton:false
                        }).then(function() {
                            window.location = 'cart.php';
                        })
                        </script>";
                              }
                          }
                      }

                      if (isset($_POST['update'])) {
                          $sql2 = "SELECT *FROM tbl_food WHERE id='$value[fid]'";
                          $res2 = mysqli_query($conn, $sql2);
                          $row2 = mysqli_fetch_assoc($res2);
                          $available = $_POST['chqnty'] - $value['fqnty'];
                          if ($row2['stocks'] >= $available) {
                              foreach ($_SESSION['cart'] as $key => $value) {
                                  if ($value['food'] === $_POST['item']) {
                                      $newqty =
                                          $_POST['chqnty'] - $value['fqnty'];
                                      $sql1 = "UPDATE tbl_food SET stocks= stocks - '$newqty' WHERE id='$value[fid]'";
                                      $res1 = mysqli_query($conn, $sql1);
                                      $_SESSION['cart'][$key]['fqnty'] =
                                          $_POST['chqnty'];
                                      echo "<script> window.location.href= 'cart.php';</script>";
                                  }
                              }
                          } else {
                              echo "<script> Swal.fire({
                            type: 'error',
                            confirmButtonColor: ' blue',
                            text: 'Not enough stocks',
                            timer:2000,
                            showConfirmButton:false
                        }).then(function() {
                            window.location = 'cart.php';
                        })
                        </script>";
                          }
                      }
                      ?>
                            

                   
                    </tbody>
                   
                </table>
                 </div>
     
          
        </div>
        <div class="details">
           
            <form action="" method="POST">
                 <input type="hidden" name="table" value="<?php echo $table; ?>">
                    <input type="hidden" name="date" value="<?php echo $date; ?>">
         <div class="head"><h1>Table <?php echo $table; ?></h1></div> 
         <h2 id="title">Total Amount Payable: </h2><br><h1> <span id="gtotal"> ₱ <?php echo number_format(
             $tamount,
             2
         ); ?></span></h1><br>
         <div><span><label for="name" id="title">Please Enter Your Name:</label><br><br><input type="text" autocomplete="off" class="name" name="name" id="name" required></span><br><br><br>
                <span><label for="" id="title">Select Order Type:</label><br><br><br><input type="radio" name="type" id="dine" value="in" required><label for="dine"> Dine In</label><br><br>
            <input type="radio" name="type" id="take" value="out"><label for="take" required> Take Out</label></span>
 <?php
 if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <div class="out"><a href=""><button name="checkout" >Check Out</button></a></div>
        
        </div>
        </div>
        </form>
        <?php }

 if (isset($_POST['checkout'])) {

     $sql3 = "INSERT INTO `lanz_pizza`.`orders` (`name`,`table`,`type`,`date`) VALUES ('$_POST[name]','$_POST[table]','$_POST[type]','$_POST[date]')";
     if (mysqli_query($conn, $sql3)) {
         $order_id = mysqli_insert_id($conn);
         $sql4 =
             'INSERT INTO `lanz_pizza`.`order_details` (`order_id`,`food_id`,`qnty`,`total_price`) VALUES (?,?,?,?)';
         $stmt = mysqli_prepare($conn, $sql4);
         if ($stmt) {
             $total = 0;
             mysqli_stmt_bind_param(
                 $stmt,
                 'iiid',
                 $order_id,
                 $food_id,
                 $qnty1,
                 $total
             );
             foreach ($_SESSION['cart'] as $key => $values) {
                 $food_id = $values['fid'];
                 $food = $values['food'];
                 $price1 = $values['fprice'];
                 $qnty1 = $values['fqnty'];
                 $total = $values['fprice'] * $values['fqnty'];

                 mysqli_stmt_execute($stmt);
             }
             unset($_SESSION['cart']);
             echo "<script> Swal.fire({
                            type: 'success',
                            title: 'SUCCESS ' ,
                            confirmButtonColor: ' blue',
                            text: 'Please Pay at the Counter!',
                        }).then(function() {
                            window.location = 'history.php';
                        })
                        </script>";
         } else {
             echo "<script> Swal.fire({
                            type: 'error',
                            title: 'OPPPS',
                            confirmButtonColor: ' blue',
                            text: 'Error prepare occured!',
                        }).then(function() {
                            window.location = 'cart.php';
                        })
                        </script>";
         }
     } else {
         echo "<script> Swal.fire({
                            type: 'error',
                            title: 'OPPPS',
                            confirmButtonColor: ' blue',
                            text: 'Error occured!',
                        }).then(function() {
                            window.location = 'cart.php';
                        })
                        </script>";
     }
 }
 ?>
    </div>
   <script>

    var iprice=document.getElementsByClassName('iprice');
    var iquantity=document.getElementsByClassName('qnty');
    var itotal=document.getElementsByClassName('itotal');
    var gtotal=document.getElementById('gtotal');

    function subTotal()
    {
        gt=0;
        for(i=0;i<iprice.length;i++)
        {
            itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);

            gt=gt+(iprice[i].value)*(iquantity[i].value);
        }
        gtotal.innerText=gt;
    }

    subTotal();


   </script>
           
   