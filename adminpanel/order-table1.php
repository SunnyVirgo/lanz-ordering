 
       <?php include '../config/constant.php'; ?>
 <div class="card-header"> 
                    <h2>Recent Orders Today</h2>
                    <a href="order.php" class="btn1">View All</a>
                </div>
                <table class="table3">
                    <colgroup>
					<col width="5%">
					<col width="16%">
					<col width="16%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
                    <col width="10%">
					<col width="20%">
				</colgroup>
                  
                     <?php
                     $date = date('Y/m/d');
                     $sql = "SELECT * FROM orders WHERE date='$date' and status!=0 order by update_time DESC limit 5";

                     $res = mysqli_query($conn, $sql);

                     $count = mysqli_num_rows($res);

                     $sn = 1;

                     if ($res == true) {
                         $rows = mysqli_num_rows($res);

                         if ($count > 0) {
                            ?>
                            <thead>
                            <tr> <th>No.</th>
                            <th>Transaction Code</th>
                                <th>Customer Name</th>
                                <th>Table No.</th>
                                <th>Type</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                   <th>Order Item</th>
                                 
                            </tr>
                        </thead>
                        <?php
                             while ($rows = mysqli_fetch_assoc($res)) {

                                 $id = $rows['id'];
                                 $tcode = $rows['tcode'];
                                 $name = $rows['name'];
                                 $table = $rows['table'];
                                 $type = $rows['type'];
                                 $total = $rows['total_amount'];
                                 $status = $rows['status'];
                                 ?>
                                
                                <body>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                          <td><?php echo $tcode; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td>Table 0<?php echo $table; ?></td>
                                        <td><?php if ($type == 'in') {
                                            echo 'Dine-in';
                                        } else {
                                            echo 'Take-out';
                                        } ?></td>
                                        <td>₱ <?php echo number_format(
                                            $total,
                                            2
                                        ); ?></td>
                                        <td><?php if ($status == 2) { ?>
                                          <div class="status">Served</div>
                                      
                                        <?php } else { ?>
                                         <div class="status-not">Pending</div>
                                        <?php } ?></td>
                                        <td>
                                           <a href="viewitems.php?id=<?php echo $id; ?>"><button class="view"><i class="fa-solid fa-eye"  id=icon></i> View Order Items</button></a>
                                    </td>
                                <?php
                             }
                         } else {
                              ?>
                       
                                <div class="no-orders"><i> No orders yet!</i></div>
           
                        <?php
                         }
                     }
                     ?>

                </table>