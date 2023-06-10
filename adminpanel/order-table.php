      <?php include '../config/constant.php'; ?>
           <table class="table2" id="myTable">
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
              <thead>  
                  
                        <th>No.</th>
                        <th>Transaction Code</th>
                        <th>Customer Name</th>
                        <th>Table No.</th>
                        <th>Type</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Order Items</th>
                    
</thead>
       <tbody>
               <?php
               $sql = 'SELECT * FROM orders WHERE status!=0 order by date DESC';

               $res = mysqli_query($conn, $sql);

               $count = mysqli_num_rows($res);

               $sn = 1;

               if ($res == true) {
                   $rows = mysqli_num_rows($res);

                   if ($count > 0) {
                       while ($rows = mysqli_fetch_assoc($res)) {

                           $id = $rows['id'];
                           $tcode = $rows['tcode'];
                           $name = $rows['name'];
                           $table = $rows['table'];
                           $type = $rows['type'];
                           $total = $rows['total_amount'];
                           $status = $rows['status'];
                           ?>
                         
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
                                        <?php } ?>
                                        </td>
                                        <td>
                                           <a href="viewitems1.php?id=<?php echo $id; ?>"><button class="view"><i class="fa-solid fa-eye"></i> View Order Items</button></a>
                                    </td>
                                      </tr>
                                         </tbody>
                           
                   <?php
                       }
                   } else {
                        ?>
                            <tr>
                                <td colspan="6" class = 'no'> No orders added yet!</td>
                            </tr>
                        <?php
                   }
               }
               ?>
                  
                       
           </table>
          