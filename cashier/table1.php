<?php include '../config/constant.php'; ?>
    <script src="../sweetalert2/jquery-3.4.1.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
     <script src="../sweetalert2/bootstrap.bundle.min.js"></script>
      <script src="../sweetalert2/bootstrap.min.js"></script>
      <script src="../sweetalert2/bootstrap.js"></script>   
<?php
$sql = 'SELECT * FROM `orders` where status=0';
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if ($count == 0) {
    echo " <div class='i'>'' No Orders To Process ''</div>";
} else {
    while ($rows = mysqli_fetch_assoc($res)) { ?>
                             <div class="order-box">
                                    <div class="order-cont">
                                        <div class="order-header">
                                            <table class="theader">
                                                <tr>
                                                    <td>Table Number: </td>
                                                    <td><?php echo $rows[
                                                'table'
                                            ]; ?></td>
                                            <tr>
                                            <td>Customer Name:</td>
                                            <td><?php echo $rows[
                                                'name'
                                            ]; ?></td>

                                            </tr>
                                                   
                                                    <td>Order Type:</td>
                                                    <td><?php if (
                                                $rows['type'] == 'in'
                                            ) {
                                                echo 'Dine-In';
                                            } else {
                                                echo 'Take-Out';
                                            } ?></td>
                                                </tr>
                                            </table>
                                            
                                        </div>
                                        <div class="order-table-box">
                                        <table class="order-tbl">
                                            <colgroup>
                                        <col width="35%">
                                        <col width="25%">
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="20%">
                                        </colgroup>
                                            <thead>
                                                <th>Food Name</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT m.*, c.food_name as `food_name`, c.price as `price`,c.size as size from `order_details` m inner join tbl_food c on m.food_id = c.id where m.order_id = '{$rows['id']}'";
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
                                                    <td><?php echo number_format(
                                                        $row1['price'],
                                                        2
                                                    ); ?></td>
                                                    <td><?php echo $row1[
                                                        'qnty'
                                                    ]; ?></td>
                                                    <td><?php echo number_format(
                                                        $row1['total_price'],
                                                        2
                                                    ); ?></td>
                                                </tr>
                                                    <?php }
                                                }
                                                ?>
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                        <div class="btn-serve">
                                           <span><a href="cancel-order.php?id=<?php echo $rows[
                                               'id'
                                           ]; ?>" class="cancel"> <button>Cancel Order</button></a></span> 
                                           <span><a href="pos.php?id=<?php echo $rows[
                                               'id'
                                           ]; ?>"> <button>Proccess Payment</button></a></span>
                                        </div>
                                        </div>
                                </div>
                        <?php }
}
?>
       
<script>
    
  $('.cancel').on('click', function(s) {
        s.preventDefault();
        const a = $(this).attr('href')

        Swal.fire({
            title: 'Are You Sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText:'Yes',
        }).then((result) => {
            if (result.value) {
                document.location.href = a;
            }
        })
    });
</script>