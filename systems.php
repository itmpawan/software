<?php include "init.php"; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php 
$dbObject->queryExecute("SELECT * FROM systems ORDER BY STR_TO_DATE(ins_date,'%d-%m-%Y') DESC");
$allSystemRecords = $dbObject->fetchAllRecords();      

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Systems - SR Enterprises</title>
 
        <link rel="icon" href="assets/img/SR-logo.png" type="image/png" sizes="16x16">

        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="assets/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="assets/css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    </head>
    <body>

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
              

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"><i class="fa fa-home fa-fw"></i>SR Enterprises</a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">
                 
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> Admin <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                  <!-- /.navbar-top-links -->
                  <?php include('left_sidebar.php');?>
                
            </nav>

            <div id="page-wrapper" style="margin-top:50px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Manage System Stock</h1>                         
                        </div>                               
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button onclick='window.location.href="add_system.php"' type="button" class="btn btn-success">Add New System <i class="fa fa-plus fa-fw"></i> </button>
                        </div>                              
                        <!-- /. col-lg-12 -->
                    </div>
              
                    <div class="row" style="margin-top:10px;">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   <strong>All Systems</strong>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-customers">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                     <th>PRODUCTS</th>
                                                    <th>SYS. CAP</th>
                                                    <th>SYS. NO.</th>
                                                    <th>ARIVAL DATE</th>
                                                    <th>DELIVERY DATE</th>
                                                   
                                                     <th>DEALER NAME</th>
                                                    <th>FIRM NAME</th>
                                                    <th>WARRANTY</th>
                                                    <th>PLACE</th>
                                                    <th>BRAND</th>
                                                    <th>REMARKS</th>               
                                                
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $k = 1; foreach($allSystemRecords as $system):
                                                    if($k % 2 == 0){
                                                        $class = 'even';
                                                    }else{
                                                        $class = 'odd';
                                                    }
                                                    
                                                ?>
                                                
                                                    <tr class= "<?php echo $class;?>">
                                                    <td><?php echo $k; ?></td>
                                                    <td><?php echo $system->products; ?></td>
                                                    <td><?php echo $system->sys_cap; ?></td>
                                                    <?php 
                                                    
                                                        $dbObject->queryExecute("SELECT id FROM customers WHERE CONCAT(',', sys_no, ',') LIKE '%,{$system->sys_no},%'");
                                                        $customer = $dbObject->singleRecord(); 
                                    
                                                         if($dbObject->countRows() != 0){        
                                                    ?>
                                                     <td><a href="./edit_customer.php?cid=<?php echo $customer->id; ?>"><?php echo $system->sys_no; ?></a></td>
                                                    <?php }else{ ?>
                                                    <td><?php echo $system->sys_no; ?></td>
                                                    <?php } ?>
                                                <td><?php 
                                                if($system->arival_date){
                                                echo date('d M, Y', strtotime($system->arival_date)); ?>
                                                <?php }else{ ?>
                                                 ----
                                                 
                                                <?php  }  ?> 
                                                </td>
                                                
                                                <td><?php 
                                                if($system->ins_date){
                                                echo date('d M, Y', strtotime($system->ins_date)); ?>
                                                <?php }else{ ?>
                                                 ----
                                                
                                                <?php  }  ?> 
                                               </td>
                                                    <td><?php echo $system->dealer; ?></td>
                                                      <td><?php echo $system->firmname; ?></td>
                                                    <td><?php echo $system->warranty; ?></td>
                                                    <td><?php echo $system->place; ?></td>
                                                     <td><?php echo $system->brand; ?></td>
                                                    <td><?php echo $system->remarks; ?></td>
                                                   
                                                    <td><a href="edit_system.php?sid=<?php echo $system->id;?>"><i class="fa fa-pencil"></i></a> | <a href="delete_system.php?del=<?php echo $system->id;?>" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                <?php $k++; endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->


                     

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="assets/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>


        <!-- DataTables JavaScript -->
        <script src="assets/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.min.js"></script>

    

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-customers').DataTable({
                        responsive: true,
                        "pageLength": 50
                });
            });
        </script>
        <!-- Custom Theme JavaScript -->
        <script src="assets/js/startmin.js"></script>

    </body>
</html>