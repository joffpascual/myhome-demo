<?php 
//Start the Session
session_start();
require_once('../connect.php');

$branch=$alertMessage="";
//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    //Assigning posted values to variables.
    $customers_lname = test_input($_POST['customer_lname']);
    $customers_fname = test_input($_POST['customer_fname']);
    $customers_contact = test_input($_POST['customer_contact']);
    $customers_email = test_input($_POST['customer_email']);
    $customers_address = test_input($_POST['customer_address']);


    //Checking the values are existing in the database or not
    $query = "INSERT INTO customers (customer_lname, customer_fname,customer_contact,customer_email,customer_address) VALUES ('$customers_lname','$customers_fname','$customers_contact','$customers_email','$customers_address')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
   
    if($result){
         $alertMessage = "<div class='alert alert-success' role='alert'>
  New Branch Successfully Added in Database.
</div>";
    }else {
        $alertMessage = "<div class='alert alert-danger' role='alert'>
  Error Adding data in Database.
</div>";
    }
    }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <?php include ('../template/head.php'); ?>
    </head>
    <!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
    <body class="hold-transition skin-green-light sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">
                <?php include ('../template/main-header.php'); ?>
            </header>

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <?php include('../template/sidebar.php'); ?>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Page Header
                        <small>Optional description</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                        <li class="active">Here</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content container-fluid">

                    <!--------------------------
| Your Page Content Here |
-------------------------->
                   <?php echo $alertMessage; ?>
                    <div class="box box-success">
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="customer_lname">Lastname:</label>
                                    <input type="text" class="form-control" id="customer_lname" placeholder="Customer Lastname" name="customer_lname">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="customer_fname">Firstname:</label>
                                    <input type="text" class="form-control" id="customer_fname" placeholder="Customer Firstname" name="customer_fname">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="customer_contact">Contact Number:</label>
                                    <input type="number" class="form-control" id="customer_contact" placeholder="Contact Number" name="customer_contact">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="customer_email">Email:</label>
                                    <input type="email" class="form-control" id="customer_email" placeholder="example@domain.com" name="customer_email">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="customer_address">Address:</label>
                                    <input type="text" class="form-control" id="customer_address" placeholder="Customer Address" name="customer_address">
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </section>
                <!-- /.content -->

            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <?php include('../template/footer.php'); ?>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <?php include ('../template/control-sidebar.php'); ?>
                <!-- /.control-sidebar-menu -->

            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
Both of these plugins are recommended to enhance the
user experience. -->
   <?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>
    </body>
</html>