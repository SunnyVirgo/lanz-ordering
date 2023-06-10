<?php include 'parts/menu2.php'; ?>
       
     
<div class ="wrapper" id="wrapper">   

    <?php if (isset($_POST['sort'])) {
        $date = $_POST['date'];
        $dates = $_POST['date2'];
    } else {
        $date = date('Y-m-d');
        $dates = date('Y-m-d');
    } ?>



     <?php if (isset($_POST['sort'])) {
         $date1 = new DateTime($_POST['date']);
         $date1 = $date1->format('F d, Y');
         $date2 = new DateTime($_POST['date2']);
         $date2 = $date2->format('F d, Y');
     } else {
         $date1 = date('F d, Y');
     } ?>

          <div class="list">
                <p>Daily Sales Report</p>
             <?php if(isset($_POST['sort'])){
                ?>
   <h3><?php echo $date1; ?> to <?php echo $date2; ?></h3>
   <?php
                }
                else{
                    ?>
<h3><?php echo $date1; ?></h3>
                    <?php

                }
                
                
                
                
                ?>
                
                
                <span>Search: <input type="search" name="search" id="search"></span>
                 </div>
             

           <form action="" method="POST">
           <span style="margin-left:1rem; font-weight:500;"> FROM: </span>
                <input type="date" name="date" value="<?php if (
                    isset($_POST['sort'])
                ) {
                    echo $_POST['date'];
                } ?>" required>
              <span style="margin-left:1rem; font-weight:500;"> TO: </span>
                <input type="date" name="date2" value="<?php if (
                    isset($_POST['sort'])
                ) {
                    echo $_POST['date2'];
                } ?>" required>
                <button class="srt" name="sort">Sort</button>
            </form>
            
          <a href="greport.php?date=<?php echo $date; ?> & date2=<?php echo $dates; ?> ">   <button class="prt"><i class="fa-solid fa-print"></i> Print</button></a>
          <div class ="table-section1"  id="table2">
                   
           <table class="table2">
             <colgroup>
                    <col width="6%">
					<col width="16%">
					<col width="9%">
					<col width="15%">
					<col width="10%">
                    <col width="13%">
                    <col width="13%">
                    <col width="9%">
                    <col width="9%">
				</colgroup>
             
           
          <?php if (isset($_POST['sort'])) {
              $sql = "SELECT * FROM orders WHERE status!=0  AND date between '$_POST[date]' and '$_POST[date2]' order by date and update_time DESC";

              $res = mysqli_query($conn, $sql);

              $count = mysqli_num_rows($res);

              $sn = 1;

              if ($res == true) {
                  $rows = mysqli_num_rows($res);

                  if ($count > 0) { ?>
                     <thead>  
                  
                        <th>Date</th>
                        <th>Transaction Code</th>
                        <th>Time</th>
                        <th>Customer Name</th>
                        <th>Table No.</th>
                        <th>Processed By</th>
                        <th>Total</th>
                        <th>Cash</th>
                        <th>Change</th>
                    
            </thead>
            <?php while ($rows = mysqli_fetch_assoc($res)) {

                $id = $rows['id'];

                $tcode = $rows['tcode'];
                $order_date1=$rows['date'];
                $order_date = date("m-d", strtotime($order_date1));
                $time = $rows['update_time'];
                $new_time = date('g:i A', strtotime($time));
                $name = $rows['name'];
                $pby = $rows['cashier'];
                $table = $rows['table'];
                $total = $rows['total_amount'];
                $tendered = $rows['tendered_amount'];
                $change = $rows['change_amount'];
                ?>
                         
                                <tbody  id="myTable">
                                    <tr>
                                        <td><?php echo $order_date; ?></td>
                                        <td><?php echo $tcode; ?></td>
                                        <td><?php echo $new_time; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $table; ?></td>
                                        <td><?php echo $pby; ?></td>
                                        <td><?php echo number_format(
                                            $total,
                                            2
                                        ); ?></td>
                                        <td><?php echo number_format(
                                            $tendered,
                                            2
                                        ); ?></td>
                                        <td><?php echo number_format(
                                            $change,
                                            2
                                        ); ?></td>
                                    </tr>
                                     
                                </tbody>


                          
                                <?php
            }} else { ?>
                             <div class = 'i'>'' No Daily Sales Yet ''</div>
                        <?php }
              }
          } else {
              $date = date('Y/m/d');

              $sql = "SELECT * FROM orders WHERE status!=0  AND date='$date' order by update_time DESC";

              $res = mysqli_query($conn, $sql);

              $count = mysqli_num_rows($res);

              $sn = 1;

              if ($res == true) {
                  $rows = mysqli_num_rows($res);

                  if ($count > 0) {
                      while ($rows = mysqli_fetch_assoc($res)) {

                          $id = $rows['id'];

                          $tcode = $rows['tcode'];
                          $order_date=$rows['date'];
                          $order_date1 = date("m-d", strtotime($order_date));
                          $time = $rows['update_time'];
                          $new_time = date('g:i A', strtotime($time));
                          $name = $rows['name'];
                          $pby = $rows['cashier'];
                          $table = $rows['table'];
                          $total = $rows['total_amount'];
                          $tendered = $rows['tendered_amount'];
                          $change = $rows['change_amount'];
                          ?>
                         
                                <tbody  id="myTable">
                                    <tr>
                                        <td><?php echo $order_date1; ?></td>
                                      <td><?php echo $tcode; ?></td>
                                        <td><?php echo $new_time; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $table; ?></td>
                                        <td><?php echo $pby; ?></td>
                                        <td><?php echo number_format(
                                            $total,
                                            2
                                        ); ?></td>
                                        <td><?php echo number_format(
                                            $tendered,
                                            2
                                        ); ?></td>
                                        <td><?php echo number_format(
                                            $change,
                                            2
                                        ); ?></td>
                                    </tr>
                                     
                                </tbody>


                          </td>
                                <?php
                      }
                  } else {
                       ?>
                        <div class = 'i'>'' No Daily Sales Yet ''</div>
                        <?php
                  }
              }
          } ?>
               
           </table>
          
       
                </div>
                <?php if (isset($_POST['sort'])) {

                    $sql2 = "SELECT SUM(total_amount)  AS sum from orders where date between '$_POST[date]' and '$_POST[date2]' and status!=0";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    $row2 = mysqli_fetch_assoc($res2);

                    $total = $row2['sum'];
                    ?>  
                    
           <div class="ta">
   <span> <h3>Total Sales</h3></span>
   <span class="amt"><h3>₱ <?php echo number_format($total, 2); ?></h3></span>
          

           </div>  
           <?php
                } else {

                    $sql2 = "SELECT SUM(total_amount)  AS sum from orders where date='$date' and status!=0";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    $row2 = mysqli_fetch_assoc($res2);

                    $total = $row2['sum'];
                    ?>   
           <div class="ta">
   <span> <h3>Total Sales</h3></span>
   <span class="amt"><h3>₱ <?php echo number_format($total, 2); ?></h3></span>
          

           </div>                           
                        <?php
                } ?>
                
              
</div>
            </div>
          
                   
<script>
      $(document).ready(function(){
    $('#search').keyup(function(){
        search_table($(this).val());
    });
    function search_table(value){
        $('#myTable tr').each(function(){
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

</script>
<script src="toggle.js"></script>
