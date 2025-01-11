<?php include "init.php"; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php 
    $dbObject->queryExecute("SELECT * FROM systems ORDER BY id DESC");
    $allSystemRecords = $dbObject->fetchAllRecords();   
    $totalRecords = $dbObject->countRows();       
?>
<?php 
$dbObject->queryExecute("SELECT * FROM customers ORDER BY STR_TO_DATE(ins_date,'%m/%d/%Y') DESC , bill_number DESC");
//$dbObject->queryExecute("SELECT * FROM customers ORDER BY id DESC");
$allCustomersRecords = $dbObject->fetchAllRecords();    
$totalCustomersRecords = $dbObject->countRows();       
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Dashboard - SR Enterprises</title>
 
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
                            <h1 class="page-header">Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $totalCustomersRecords;?></div>
                                            <div>Customers</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="customers.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Manage All</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $totalRecords;?></div>
                                            <div>System Stock</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="systems.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Manage All</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                       
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   <strong> Top 50 Customers</strong>
                                   <div class="text-right">
                                          <button onclick='window.location.href="add_customer.php"' type="button" class="btn btn-success">Add New Customer <i class="fa fa-plus fa-fw"></i> </button>
                                   </div> 
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-customers">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>NAME</th>
                                                    <th>ADDRESS</th>
                                                    <th>PRODUCTS</th>
                                                    <th>CONTACT NO.</th>
                                                    <th>SYS. CAP</th>
                                                    <th>SYS. NO.</th>
                                                    <th>INS. DATE</th>
                                                    <th>BILL NO.</th>
                                                    <th>BALANCE</th>               
                                                    <th>BRAND</th>
                                                    <th>MODEL</th>
                                                    <th>SYSTEM TYPE</th>
                                                    <th>REMARKS</th>
                                                    <th>GST NUMBER</th>
                                                    <th>BEFORE INSTALL</th>
                                                    <th>AFTER INSTALL</th>
                                                    <th>WARANTY</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $k = 1; foreach($allCustomersRecords as $customer):
                                                    if($k % 2 == 0){
                                                        $class = 'even';
                                                    }else{
                                                        $class = 'odd';
                                                    }
                                                ?>
                                                    <tr class= "<?php echo $class;?>">
                                                    <td><?php echo $k; ?></td>
                                                    <td><?php echo $customer->cname; ?></td>
                                                    <td><?php echo $customer->caddress; ?></td>
                                                    <td><?php echo $customer->products; ?></td>
                                                    <td><?php echo $customer->contact_number; ?></td>
                                                    <td><?php echo $customer->sys_cap; ?></td>
                                                    <td><?php echo $customer->sys_no; ?></td>
                                                     
                                                    <td><?php echo date("d M, Y",strtotime($customer->ins_date));?></td>
                                                    <td><?php echo $customer->bill_number; ?></td>
                                                    <?php if($customer->balance > 0){
                                                            $color = 'color:red';
                                                        } elseif ($customer->balance < 0) {
                                                            $color = 'color:green';
                                                        }else{
                                                            $color = '';
                                                        }
                                                        ?>
                                                    <td style='<?php echo $color; ?>'><i class="fa fa-inr"></i> <?php echo $customer->balance; ?></td>
                                                    <td><?php echo $customer->remarks; ?></td>
                                                    <td><?php echo $customer->model; ?></td>
                                                    <td><?php echo $customer->system_type; ?></td>
                                                    <td><?php echo $customer->customer_remark; ?></td>
                                                    <td><?php echo $customer->GST; ?></td>
                                                    <td>
                                                    <?php if($customer->before_install){ ?>
                                                        <a data-toggle="modal" data-target="#imgModal<?php echo $k; ?>" href="javascript:void(0);"><img src='uploads/<?php echo $customer->before_install; ?>' alt='before' height="100" width="100"/></a><br>
                                                     <!-- Modal -->
                                                     <div class="modal fade" id="imgModal<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Before installation site</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <img src='uploads/<?php echo $customer->before_install; ?>' alt='before' width='100%'/>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    </td>
                                                    <td>
                                                    <?php if($customer->after_install){ ?>
                                                        <a data-toggle="modal" data-target="#img2Modal<?php echo $k; ?>" href="javascript:void(0);"><img src='uploads/<?php echo $customer->after_install; ?>' alt='before' height="100" width="100"/></a><br>
                                                     <!-- Modal -->
                                                     <div class="modal fade" id="img2Modal<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">After installation site</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <img src='uploads/<?php echo $customer->after_install; ?>' alt='before' width='100%'/>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    </td>
                                                    
                                                    <td><?php 
                                                    
                                                    $system_arr = explode(",", $customer->sys_no);
                                                    $expiredArry = [];
                                                    $underWarrantyArry = [];
                                                    if($system_arr){
                                                        for($i=0; $i < count($system_arr); $i++ ){
                                                            $dbObject->queryExecute("SELECT * FROM systems WHERE sys_no = '".$system_arr[$i]."' ");
                                                            $systemRecord = $dbObject->singleRecord();
                                                            if($systemRecord){
                                                                $futureDate = date('m/d/y', strtotime('+'.$systemRecord->warranty, strtotime($customer->ins_date)) );
                                                                $dateTimestamp1 = strtotime($futureDate); 
                                                                $dateTimestamp2 = strtotime(date('m/d/y'));
                                                                if($dateTimestamp2 > $dateTimestamp1){
                                                                    $expiredArry[] = $futureDate;
                                                                }else{
                                                                    $underWarrantyArry[] = $futureDate;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($expiredArry){
                                                       // if(count($expiredArry) > 1 ){
                                                            echo '<i style="color:red">'. count($expiredArry).':</i>';
                                                        //}
                                                        echo '<i style="color:red">Expired</i><br>';
                                                    }
                                                    if($underWarrantyArry){
                                                        //if(count($underWarrantyArry) > 1 ){
                                                            echo count($underWarrantyArry).':';
                                                        //}
                                                        echo 'Under warranty';
                                                    }
                                                    ?></td>
                                                    <td><a data-toggle="modal" data-target="#customerModal<?php echo $k; ?>" href="javascript:void(0);"><i class="fa fa-eye"></i></a> | <a href="edit_customer.php?cid=<?php echo $customer->id;?>"><i class="fa fa-pencil"></i></a> | <a href="delete_customer.php?del=<?php echo $customer->id;?>" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    <!-- Button trigger modal -->


                                                    <!-- Modal -->
                                                    <div class="modal fade" id="customerModal<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="customerModalLabel"><?php echo $k; ?>. <?php echo $customer->cname; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <strong>BRAND</strong>
                                                                </div>      
                                                                <div class="col-lg-6">     
                                                                    <p><?php echo $customer->remarks; ?></p>
                                                                </div>       
                                                            </div>
                                                            <hr/>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <strong>TOTAL AMOUNT</strong>
                                                                </div>  
                                                                <?php 
                                                                  $dbObject->queryExecute("SELECT * FROM customer_meta WHERE customer_id = ".$customer->id." AND field_type='amount'");
                                                                  $allamountRecords = $dbObject->fetchAllRecords();   
                                                                 ?>
                                                                <?php foreach($allamountRecords as $amount):?>
                                                                <div class="col-lg-6">     
                                                                <p class="help-block"><?php echo $amount->field_name; ?><small> (<strong><?php echo $amount->field_nature; ?></strong>)</small></p>
                                                     
                                                                </div> 
                                                                <div class="col-lg-6">     
                                                                <p class="help-block"><i class="fa fa-inr"></i> <?php echo $amount->value; ?></p>
                                                     
                                                                </div>  
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <hr/>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <strong>TOTAL RECEIVED</strong>
                                                                </div>  
                                                                <?php 
                                                                  $dbObject->queryExecute("SELECT * FROM customer_meta WHERE customer_id = ".$customer->id." AND field_type='receive'");
                                                                  $allreceiveRecords = $dbObject->fetchAllRecords();   
                                                                 ?>
                                                                <?php foreach($allreceiveRecords as $receive):?>
                                                                <div class="col-lg-6">     
                                                                <p class="help-block"><?php echo $receive->field_name; ?><small> (<strong><?php echo $receive->field_nature; ?></strong>)</small></p>
                                                     
                                                                </div> 
                                                                <div class="col-lg-6">     
                                                                <p class="help-block"><i class="fa fa-inr"></i> <?php echo $receive->value; ?></p>
                                                     
                                                                </div>  
                                                                <?php endforeach; ?>
                                                            </div>          

                                                            <hr/>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <strong>BALANCE: <i class="fa fa-inr"></i> <?php echo $customer->balance; ?></strong>
                                                                </div>  
                        
                                                            
                                                            </div>   

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
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
                $('#dataTables-customers, #dataTables-systems').DataTable({
                        responsive: true,
                        "pageLength": 50
                });
            });
        </script>
        <!-- Custom Theme JavaScript -->
        <script src="assets/js/startmin.js"></script>

    </body>
</html>