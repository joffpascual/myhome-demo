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

            <form class="form-vertical" name="save" id="save" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
                            <td contenteditable="true" class="item_name"></td>
                            <td contenteditable="true" class="item_code"></td>
                            <td contenteditable="true" class="item_desc"></td>
                            <td contenteditable="true" class="item_price"></td>
                            <td></td>
                        </tr>
                    </table>
                    <div align="right">
                        <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
                    </div>
                    <div align="center">
                        <button type="submit" name="save" id="save" class="btn btn-info">Save</button>
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
                    html_code += "<td contenteditable='true' class='item_name'></td>";
                    html_code += "<td contenteditable='true' class='item_code'></td>";
                    html_code += "<td contenteditable='true' class='item_desc'></td>";
                    html_code += "<td contenteditable='true' class='item_price' ></td>";
                    html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
                    html_code += "</tr>";  
                    $('#crud_table').append(html_code);
                });

                $(document).on('click', '.remove', function(){
                    var delete_row = $(this).data("row");
                    $('#' + delete_row).remove();
                });

                $('#save').click(function(){

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
                });


            });
        </script>
    </body>
</html>


