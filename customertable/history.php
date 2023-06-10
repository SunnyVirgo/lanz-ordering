<?php
include 'include.php';
$table = $_SESSION['table'];

$sql="SELECT * FROM orders WHERE `table`='$table' AND status=0 order by id DESC LIMIT 1";
$res=mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if($count > 0)
{
    while($row=mysqli_fetch_assoc($res))
    {
        $id=$row['id'];
        $name=$row['name'];
    }
    
    
    
    
    
    ?>
    <div class="wrapper2">
    <h1 style="text-align:center;"><?php echo $name; ?>'s Order History</h1>
    <div class="cont1">
        
    <table class="t1">
    
    <thead>
        <tr>
        <th>Food Name</th>
        <th>Size</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
    
        </tr>
    </thead>
    
    <tbody>
    <?php  
    $sql2 = "SELECT m.*, c.food_name as `food_name`, c.price as `price`,c.size as size from `order_details` m inner join tbl_food c on m.food_id = c.id where m.order_id = '$id'";
    $res3=mysqli_query($conn, $sql2);
    while($row1=mysqli_fetch_assoc($res3))
    {
        ?>
    
    <tr>
    <td><?php echo $row1['food_name']; ?></td>
    <td><?php echo $row1['size']; ?></td>
    <td>₱ <?php echo number_format($row1['price'],2); ?></td>
    <td><?php echo $row1['qnty']; ?></td>
    <td>₱ <?php echo number_format($row1['total_price'],2); ?></td>
        
    </tr>
    <?php
    }
    ?>
    
    </tbody>
    
    
    
    
    </table>
    <?php if (isset($_GET['page2'])): ?>
                        <div class="flash-data1" data-flashdata="<? = $_GET['page2']; ?>"></div>
                    <?php endif; ?>
    <div class="btns">
        <?php 
        $sql3="SELECT SUM(total_price) as sum FROM order_details WHERE order_id='$id'";
        $res4=mysqli_query($conn, $sql3);
        $row2=mysqli_fetch_assoc($res4);
        ?>
    <h2>Total Amount: ₱ <?php echo number_format($row2['sum'],2); ?></h2> 
    <a href="cancel.php?id=<?php echo $id; ?>" class="cancel"><button>Cancel Order</button></a>
    </div>
    
    </div>
    
    
    
    
    
    
    
    </div>
    <?php
}
else
{
    ?>
<div style="font-size:5rem;position:absolute;text-align:center;top:50%;left:50%;transform:translate(-50%,-50%);color:gainsboro;"><i> You have no order's yet!</i></div>
    <?php
}
?>


<script>


const flashdata1 = $('.flash-data1').data('flashdata')
     if (flashdata1) {
        Swal.fire({
            type: 'success',
            title: 'Order Cancelled!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "home.php";
        })

     }


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