<?php
session_start();
//insert.php
require_once ('connect.php');
$inv_date=$inv_num=$item_name=$item_code=$item_desc=$item_price=$items="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $inv_date = $_POST['inv_date'];
    $inv_num = $_POST['inv_num'];
    /* $item_name = $_POST['item_name'][$x];
    $item_code = $_POST['item_code'][$x];
    $item_desc = $_POST['item_description'][$x];
    $item_price = $_POST['item_price'][$x];*/

    $query = "INSERT INTO invtran (inv_date, inv_num) VALUES ('$inv_date', '$inv_num')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(isset($_POST['item_name'])){

        /* $items = array(
            $item_name, $item_code, $item_desc, $item_price

        );*/

        foreach ($_POST['item_name'] as $row => $value){

            $item_name = $_POST['item_name'][$row];
            $item_code = $_POST['item_code'][$row];
            $item_desc = $_POST['item_description'][$row];
            $item_price = $_POST['item_price'][$row];


            $query ="INSERT INTO item (item_name, item_code, item_description, item_price) 
   VALUES('".$item_name."', '".$item_code."', '".$item_desc."', '".$item_price."')";   

            $result = mysqli_multi_query($conn, $query) or die(mysqli_error($conn));

        }


        if ($result){
            echo 'Item Data Inserted';
        }else
        {
            echo 'Error';
        }


    }

}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Multiple Inline Insert into Mysql using Ajax JQuery in PHP</title>
        <script src="../myhome-demo/bower_components/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="../myhome-demo/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="../myhome-demo/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    </head>
    <body>
        <br /><br />
        <div class="container">
            <br />
            <h2 align="center">Multiple Inline Insert into Mysql using Ajax JQuery in PHP</h2>
            <br />

            <form class="form-vertical" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group row">
                    <label for="inv_date" >Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" autocomplete="off"  id="inv_date" name="inv_date" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inv_num" >Inv Number</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" autocomplete="off"  id="inv_num" name="inv_num" required>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="crud_table">
                        <tr>
                            <th width="30%">Item Name</th>
                            <th width="10%">Item Code</th>
                            <th width="45%">Description</th>
                            <th width="10%">Price</th>
                            <th width="5%"></th>
                        </tr>

                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="item_name" name="item_name[]" >
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="item_code" name="item_code[]" >
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="item_description" name="item_description[]" >
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="item_price" name="item_price[]" >
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align:right;">
                                    <div class="form-group">
                                        <input type="number" class= "totalPrice" id="totalPrice" name="total" value="0.00" readonly>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div align="right">
                        <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
                    </div>
                    <div align="center">
                        <button type="submit" name="save" id="save" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function(){
                var count = 1;
                $('#add').click(function(){
                    count = count + 1;
                    var html_code = "<tr id='row"+count+"'>";
                    html_code += "<td><input tyep='text' id='item_name' name='item_name[]'> </td>";
                    html_code += "<td><input tyep='text' id='item_code' name='item_code[]'></td>";
                    html_code += "<td><input tyep='text' id='item_description' name='item_description[]'></td>";
                    html_code += "<td><input tyep='text' id='item_price' name='item_price[]'class='totalPrice'></td>";
                    html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
                    html_code += "</tr>";  
                    $('#crud_table').append(html_code);
                });

                $(document).on('click', '.remove', function(){
                    var delete_row = $(this).data("row");
                    $('#' + delete_row).remove();
                });

                /*$('#save').click(function(){

                    var item_name = [];
                    var item_code = [];
                    var item_desc = [];
                    var item_price = [];

                    $('.item_name').each(function(){
                        item_name.push($(this).text());
                    });
                    $('.item_code').each(function(){
                        item_code.push($(this).text());
                    });
                    $('.item_desc').each(function(){
                        item_desc.push($(this).text());
                    });
                    $('.item_price').each(function(){
                        item_price.push($(this).text());
                    });
                    $.ajax({
                        url:"insert.php",
                        method:"POST",
                        data:{item_name:item_name,item_code:item_code, item_desc:item_desc, item_price:item_price},
                        success:function(data){
                            alert(data);
                            $("td[contentEditable='true']").text("");
                            for(var i=2; i<= count; i++)
                            {
                                $('tr#'+i+'').remove();
                            }

                        }
                    });
                });*/


            });
        </script>

        <script>
            function calculateSum() {
                var t = 0,     
                    e = 0,     
                    p = 0;    

                    $(".total_price").each(function() {
                    isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
                }), 

                    e = t.toFixed(2),  

                    $("#grandTotal").val(e)
            }
        </script>
    </body>
</html>


