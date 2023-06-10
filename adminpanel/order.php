<?php include 'parts/menu2.php'; ?>
       
     
            
          
        <div class ="wrapper" id="wrapper">
            <div class="list">
                <p>List of Orders</p>
            </div>
<div class="header">
    <tr>
        <td class="s">Search:</td>
    <td><input type="search" name="search" id="search" class="search-input"></td>
    </tr>
   
</div>       
                <div class ="table-section"  id="myTable1">
          
              
                </div>
           
            
                  
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
      $(document).ready(function()
    {
          $("#myTable1").load("order-table.php");
       setInterval(function(){
          $("#myTable1").load("order-table.php");
         refresh();
        }, 10000);
    
});
</script>