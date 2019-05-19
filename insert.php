<?php
session_start();
//insert.php
require_once ('connect.php');

if(isset($_POST['submit'])){
    $inv_date = $_POST['inv_date'];
    $inv_num = $_POST['inv_num'];

    $query = "INSERT INTO invtran (inv_date, inv_num) VALUES ('$inv_date', '$inv_num')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if($result){

        /*if(isset($_POST['item_name']))
        {

            foreach ($POST['item_name'] as $row => $value){
                $item_name = $_POST['item_name'][$row];
                $item_code = $_POST['item_code'][$row];
                $item_desc = $_POST['item_desc'][$row];
                $item_price = $_POST['item_price'][$row];
                
                $query ='
   INSERT INTO item (item_name, item_code, item_description, item_price) 
   VALUES("'.$item_name_clean.'", "'.$item_code_clean.'", "'.$item_desc_clean.'", "'.$item_price_clean.'");
   ';   } } */
                
                if (mysqli_query($conn, $query)){
                    echo 'Item Data Inserted';
                }else
                {
                    echo 'Error';
                }
                
                

            

           

       

    }



}
?>