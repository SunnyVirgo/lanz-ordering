      <?php include '../config/constant.php'; ?>


<div class="cards">
               <?php
               $date = date('Y/m/d');
               $sql4 = "SELECT sum(total_amount) as sum FROM orders where date='$date' and status!=0";
               $res4 = mysqli_query($conn, $sql4);
               $count4 = mysqli_num_rows($res4);
               $row4 = mysqli_fetch_assoc($res4);

               $total = $row4['sum'];
               ?>
        <div>
            <div class="numbers">₱ <?php echo number_format($total, 2); ?></div>
            <div class="card-name">Daily Total Sales</div>
        </div>
        <div class="iconbox">
             <i class="fa-solid fa-hand-holding-dollar"></i>
            
        </div>
    </div>

    <div class="cards">
        <?php
        $date = date('Y/m/d');
        $sql3 = "SELECT COUNT(*) as count FROM orders where date='$date' and status!=0";
        $res3 = mysqli_query($conn, $sql3);
        $count3 = mysqli_num_rows($res3);
        $row3 = mysqli_fetch_assoc($res3);

        $count = $row3['count'];
        ?>
        <div>
            <div class="numbers"><?php echo number_format($count); ?></div>
            <div class="card-name">Daily Total Orders</div>
        </div>
        <div class="iconbox">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
    </div>

    <div class="cards">
          <?php
          $sql5 = 'SELECT COUNT(*) as count FROM tbl_food where deleted=0';
          $res5 = mysqli_query($conn, $sql5);
          $count5 = mysqli_num_rows($res5);
          $row5 = mysqli_fetch_assoc($res5);

          $count6 = $row5['count'];
          ?>
        <div>
            <div class="numbers"><?php echo number_format($count6); ?></div>
            <div class="card-name">Total Menu</div>
        </div>
        <div class="iconbox">
           
            <i class="fa-solid fa-pizza-slice"></i>
        </div>
    </div>