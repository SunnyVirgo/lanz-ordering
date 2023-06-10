   <!--begin  -->

   <?php include '../config/constant.php'; ?>
<script src="../sweetalert2/jquery-3.4.1.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
     <script src="../sweetalert2/bootstrap.bundle.min.js"></script>
      <script src="../sweetalert2/bootstrap.min.js"></script>
      <script src="../sweetalert2/bootstrap.js"></script>
                  <?php
                  $sql =
                      'SELECT * FROM `orders`  where status=1 order by update_time ASC';
                  $res = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($res);
                  if ($count == 0) {
                      echo " <div class='i'>'' No Orders To Serve ''</div>";
                  } else {
                      while ($rows = mysqli_fetch_assoc($res)) {
                          $id = $rows['id']; ?>
                             <div class="order-box">
                                    <div class="order-cont">
                                        <div class="order-header">
                                            <span>Table <?php echo $rows[
                                                'table'
                                            ]; ?></span>
                                            <span><?php echo $rows['tcode']; ?>
                                            
                                        </span>
                                        </span>
                                            <span><?php echo $rows[
                                                'name'
                                            ]; ?></span>
                                             <span><?php if (
                                                 $rows['type'] == 'in'
                                             ) {
                                                 echo 'Dine-In';
                                             } else {
                                                 echo 'Take-Out';
                                             } ?>
                                        </div>
                                        <div class="order-table-box">
                                        <table class="order-tbl">
                                            <colgroup>
                                        <col width="50%">
                                        <col width="30%">
                                        <col width="20%">
                                        
                                        </colgroup>
                                            <thead>
                                                <th>Food Name</th>
                                                <th>Size</th>
                                                <th>Qty</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT m.*, c.food_name as `food_name`, c.price as `price`, c.size as `size` from `order_details` m inner join tbl_food c on m.food_id = c.id where m.order_id = '{$rows['id']}'";
                                                #$sql1="SELECT * FROM order_details WHERE order_id = $rows[id]";
                                                $res1 = mysqli_query(
                                                    $conn,
                                                    $sql1
                                                );
                                                $count = mysqli_num_rows($res1);
                                                if ($count > 0) {
                                                    while (
                                                        $row1 = mysqli_fetch_assoc(
                                                            $res1
                                                        )
                                                    ) { ?>
                                                    <tr>
                                                    <td><?php echo $row1[
                                                        'food_name'
                                                    ]; ?></td>
                                                     <td><?php echo $row1[
                                                         'size'
                                                     ]; ?></td>
                                                    <td><?php echo $row1[
                                                        'qnty'
                                                    ]; ?></td>
                                                </tr>
                                                    <?php }
                                                }
                                                ?>
                                              
                                            </tbody>
                                        </table>
         
                                    </div>
                                        <div class="btn-serve">
                                           <form action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                      <a href="serve.php?id=<?php echo $rows[
                                          'id'
                                      ]; ?>" class="serve"> <button>SERVE</button></a>
                                          
                                        </div>
                                        </div>
                                   
                                </div>
                        <?php
                      }
                  }
                  ?>
                    <script>

                         $('.serve').on('click', function(s) {
        s.preventDefault();
        const a = $(this).attr('href')

        Swal.fire({
            title: 'Are You Sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText:'Serve',
        }).then((result) => {
            if (result.value) {
                document.location.href = a;
            }
        })
    });
    
                    </script>