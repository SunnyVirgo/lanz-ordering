<?php include 'parts/menu2.php'; ?>
       
     
            
       <div class ="wrapper" id="wrapper">

          <div class="list">
              <?php if (isset($_POST['sort'])) {
                  if ($_POST['month'] || $_POST['year'] > 0) {
                      $month1 = $_POST['month'];
                      $month = date('F', mktime(0, 0, 0, $month1, 10));
                      $year = $_POST['year'];
                  } else {
                      $month = date('F');
                      $year = date('Y');
                  }
              } else {
                  $month = date('F');
                  $year = date('Y');
              } ?>
                <?php if (isset($_POST['sort'])) {
                    $month2 = $_POST['month'];
                    $year2 = $_POST['year'];
                } else {
                    $month2 = date('m');
                    $year2 = date('Y');
                } ?>
                <p>Monthly Sales Report</p>
                <h3><?php echo $month . '  ' . $year; ?></h3>
                <span>Search: <input type="search" name="search" id="search"></span>
                
            </div><form action="" method="POST">
        <select name="month" id="month" required>
<option value="0">Select Month</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>



            </select>
            
                        <select name="year" id="month" required>
<option value="0">Select Year</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
<option value="2025">2025</option>
<option value="2026">2026</option>
<option value="2027">2027</option>
<option value="2028">2028</option>
<option value="2029">2029</option>
<option value="2030">2030</option>
<option value="2031">2031</option>
<option value="2032">2032</option>
<option value="2033">2033</option>
<option value="2034">2034</option>



            </select>
              <button class="srt" name="sort">Sort</button>
            </form>
            
          <a href="monthprint.php?month=<?php echo $month2; ?>&year=<?php echo $year2; ?>">   <button class="prt"><i class="fa-solid fa-print"></i> Print</button></a>
          <div class ="table-section1"  id="table2">
               

           <table class="table2">
             <colgroup>
                    <col width="5%">
					<col width="35%">
					<col width="25%">
					<col width="35%">
				</colgroup>

<?php if (isset($_POST['sort'])) {
    if ($_POST['month'] || $_POST['year'] < 0) {
        $current_month = $_POST['month'];
        $current_year = $_POST['year'];
        $sn = 1;

        $query = "SELECT DATE(date) as order_date, COUNT(*) as total_orders, SUM(total_amount) as total_sales FROM orders WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year and status != 0 GROUP BY date";

        $result = $conn->query($query);
        $count = mysqli_num_rows($result);
        if ($count > 0) { ?>
    <thead>  
                  
                        <th>No.</th>
                        <th>Date</th>
                        <th>Total Orders</th>
                        <th>Total Sales</th>
                    
            </thead>


<?php
$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[$row['order_date']] = [
        'total_orders' => $row['total_orders'],
        'total_sales' => $row['total_sales'],
    ];
}

foreach ($orders as $date => $order) {

    $date1 = new DateTime($date);
    $date1 = $date1->format('F d, Y');
    ?>
    
                                <tbody  id="myTable">
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $date1; ?></td>
                                      <td><?php echo $order[
                                          'total_orders'
                                      ]; ?></td>
                                        <td><?php echo number_format(
                                            $order['total_sales'],
                                            2
                                        ); ?></td>
                                    </tr>
                                     
                                </tbody>
               

<?php
}
} else { ?>
                             <div class = 'i'>'' No Monthly Sales Yet ''</div>
                        <?php }
    } else {
        $current_month = date('m');
        $current_year = date('Y');
        $sn = 1;

        $query = "SELECT DATE(date) as order_date, COUNT(*) as total_orders, SUM(total_amount) as total_sales FROM orders WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year GROUP BY date";

        $result = $conn->query($query);
        $count = mysqli_num_rows($result);
        if ($count > 0) { ?>


              <thead>  
                  
                        <th>No.</th>
                        <th>Date</th>
                        <th>Total Orders</th>
                        <th>Total Sales</th>
                    
            </thead>


     <?php
     $orders = [];
     while ($row = $result->fetch_assoc()) {
         $orders[$row['order_date']] = [
             'total_orders' => $row['total_orders'],
             'total_sales' => $row['total_sales'],
         ];
     }

     foreach ($orders as $date => $order) {

         $date1 = new DateTime($date);
         $date1 = $date1->format('F d, Y');
         ?>
    
                                <tbody  id="myTable">
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $date1; ?></td>
                                      <td><?php echo $order[
                                          'total_orders'
                                      ]; ?></td>
                                        <td><?php echo number_format(
                                            $order['total_sales'],
                                            2
                                        ); ?></td>
                                    </tr>
                                     
                                </tbody>
               

<?php
     }
     } else { ?>
                             <div class = 'i'>'' No Monthly Sales Yet ''</div>
                        <?php }
    }
} else {
    $current_month = date('m');
    $current_year = date('Y');
    $sn = 1;

    $query = "SELECT DATE(date) as order_date, COUNT(*) as total_orders, SUM(total_amount) as total_sales FROM orders WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year GROUP BY date";

    $result = $conn->query($query);
    $count = mysqli_num_rows($result);
    if ($count > 0) { ?>


              <thead>  
                  
                        <th>No.</th>
                        <th>Date</th>
                        <th>Total Orders</th>
                        <th>Total Sales</th>
                    
            </thead>


     <?php
     $orders = [];
     while ($row = $result->fetch_assoc()) {
         $orders[$row['order_date']] = [
             'total_orders' => $row['total_orders'],
             'total_sales' => $row['total_sales'],
         ];
     }

     foreach ($orders as $date => $order) {

         $date1 = new DateTime($date);
         $date1 = $date1->format('F d, Y');
         ?>
    
                                <tbody  id="myTable">
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $date1; ?></td>
                                      <td><?php echo $order[
                                          'total_orders'
                                      ]; ?></td>
                                        <td><?php echo number_format(
                                            $order['total_sales'],
                                            2
                                        ); ?></td>
                                    </tr>
                                     
                                </tbody>
               

<?php
     }
     } else { ?>
                             <div class = 'i'>'' No Monthly Sales Yet ''</div>
                        <?php }
} ?>   

               
           </table>
          
       
                </div>
               
        <?php
        $query1 = "SELECT SUM(total_amount) as total_sales FROM orders WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year";
        $res1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_assoc($res1);
        ?>
           <div class="ta">
   <span> <h3>Monthly Total Sales</h3></span>
   <span class="amt"><h3>₱ <?php echo number_format(
       $row1['total_sales'],
       2
   ); ?> </h3></span>
          

           </div>  
   
                
              
</div>
                   
</div>
<script src="toggle.js"></script>
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