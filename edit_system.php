<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php 
if(isset($_POST['system'])){

 $data = [
     'sys_cap'       => $_POST['sys_cap'],
     'sys_no'       => $_POST['sys_no'],
     'firmname'       => $_POST['firmname'],
     'ins_date'       => $_POST['ins_date'],
      'arival_date'       => $_POST['arival_date'],
     'dealer'       => $_POST['dealer'],
     'warranty'       => $_POST['warranty'],
     'place'       => $_POST['place'],
     'brand'       => $_POST['brand'],
     'remarks'       => $_POST['remarks'],
     'status'       => $_POST['status'],
     'products'     => implode(",",$_POST['products']),
     'sys_cap_error'    => '',
     'sys_no_error'    => '',
     'model_error'    => '',
     'message' => ''

 ];

if(empty($data['sys_cap'])){
    $data['sys_cap_error'] = "SYS. CAP. field is required.";
}
 
if(empty($data['sys_no'])){
    $data['sys_no_error'] = "SYS. No. field is required.";
}

    /*
        * Submit the system form
    */ 

    if(empty($data['sys_cap_error']) && empty($data['sys_no_error'])  ){
        $dbObject->queryExecute("UPDATE  `systems` SET `sys_cap` = ?, `sys_no` = ?, `firmname` = ?,`arival_date` = ?, `ins_date` = ?, `dealer` = ?, `warranty` = ?,
        `place` = ?,`brand` = ?, `products` = ?, `remarks` = ?, `status` = ? WHERE id = ?" , [ $data['sys_cap'] , $data['sys_no'], $data['firmname'],
        $data['arival_date'] , $data['ins_date'] ,$data['dealer'], $data['warranty'], $data['place'] ,$data['brand'] ,$data['products'] , $data['remarks'], "Active" ,$_REQUEST['sid']]);

        $error = false;
        $data['message'] = "<strong>Success!</strong> record has been updated successfully.";  
    }


}
$dbObject->queryExecute("SELECT * FROM systems WHERE id = ?", [$_REQUEST['sid']]);
$result = $dbObject->singleRecord();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Edit System - SR Enterprises</title>
 
        <link rel="icon" href="assets/img/SR-logo.png" type="image/png" sizes="16x16">

        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/css/startmin.css" rel="stylesheet">
      
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
                            <h1 class="page-header">Edit System</h1>    
                             <p> <div class="text-right">
                            <button onclick='window.location.href="add_system.php"' type="button" class="btn btn-success">Add New System <i class="fa fa-plus fa-fw"></i> </button>
                        </div></p>
                        </div>                               
                        <!-- /.col-lg-12 -->
                    </div>
                          <!-- /.row -->
                          <div class="row">
                        <div class="col-lg-12">

                        <?php if(!empty($data['message'])): ?>
                            <div class="alert <?php if($error == false): ?> alert-success <?php endif; ?> <?php if($error == true): ?> alert-danger<?php endif; ?> alert-dismissible fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $data['message']; ?>
                            </div>                                
                        <?php endif; ?>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    System Stock Form
                                </div>
                              

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="post">
                                               
                                                <div class="form-group <?php if(!empty($data['sys_cap_error'])): ?> has-error<?php endif; ?>">
                                                    <label>SYS. CAP. <span style="color:red">*</span></label>
                                                    <input class="form-control" name="sys_cap" placeholder="Enter SYS CAP here.." value="<?php echo $result->sys_cap;?>">
                                                    <?php if(!empty($data['sys_cap_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['sys_cap_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                <div class="form-group <?php if(!empty($data['sys_no_error'])): ?> has-error<?php endif; ?>">
                                                    <label>SYS. NO. <span style="color:red">*</span></label>
                                                    <input class="form-control" name="sys_no" placeholder="Enter SYS number here.." value="<?php echo $result->sys_no;?>">
                                                    <?php if(!empty($data['sys_no_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['sys_no_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                            
                                                <div class="form-group <?php if(!empty($data['model_error'])): ?> has-error<?php endif; ?>">
                                                    <label>FIRM NAME  <span style="color:red">*</span></label>
                                                    <input class="form-control" name="firmname" placeholder="Enter model here.." value="<?php echo $result->firmname;?>">
                                                    <?php if(!empty($data['model_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['model_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                  <div class="form-group">
                                                    <label>ARIVAL DATE</label>
                                                    <input class="form-control" id="arival_datepicker" name="arival_date" placeholder="Enter arival date here.." value="<?php echo $result->arival_date;?>">
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>DELIVERY DATE</label>
                                                    <input class="form-control" id="installdatepicker" name="ins_date" placeholder="Enter installment date here.." value="<?php echo $result->ins_date;?>">
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>DEALER NAME</label>
                                                    <input class="form-control" name="dealer" placeholder="Enter dealer here.."  value="<?php echo $result->dealer;?>">
                                               
                                                </div>
                                             <div class="form-group">
                                                  
                                                    <label>PRODUCTS</label>
                                                    
                                                     <?php
                                                
                                                    $checked_arr = array();
    
                                                
                                                    // Create checkboxes
                                                    $checked_arr = explode(",",$result->products);
                                                    
                                                    $products_arr = array("Solar Water Heater System","Solar Fencing System","Solar Gate & Garden Light","Solar Street Light","Solar Home Light","Solar Power pack","Solar Pump System", "Solar Cooker", "Solar inverter", "Electrical Back Up", "Luminarie", "Panel", "Battery", "Filter", "Others");
                                                    foreach($products_arr as $product){
                                                
                                                      $checked = "";
                                                      if(in_array($product,$checked_arr)){
                                                        $checked = "checked";
                                                      }
                                                      echo ' <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="'.$product.'" '.$checked.' name="products[]">'.$product.'</label>
                                                    </div>';
                                                    }
                                                    ?>
                                                 
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>PLACE</label>
                                                    <input class="form-control" name="place" placeholder="Enter place here.."  value="<?php echo $result->place;?>">
                                               
                                                </div>
                                                 <div class="form-group">
                                                    <label>BRAND</label>
                                                    <input class="form-control" name="brand" placeholder="Enter brand here.."  value="<?php echo  $result->brand;;?>">
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>WARANTY (Years)</label>
                                            
                                                    <select name="warranty" class="form-control">
                                                          <option <?php if($result->warranty == '0 year'): ?> selected <?php endif;?> value="0 year">No Waranty</option>
                                                        <option <?php if($result->warranty  == '1 year'): ?> selected <?php endif;?> value="1 year">1 Year</option>
                                                        <option <?php if($result->warranty == '2 years'): ?> selected <?php endif;?> value="2 years">2 Years</option>
                                                   <option <?php if($result->warranty == '3 years'): ?> selected <?php endif;?> value="3 years">3 Years</option>
                                                    <option <?php if($result->warranty  == '4 years'): ?> selected <?php endif;?> value="4 years">4 Years</option>
                                                     <option <?php if($result->warranty  == '5 years'): ?> selected <?php endif;?> value="5 years">5 Years</option>
                                                      <option <?php if($result->warranty  == '6 years'): ?> selected <?php endif;?> value="6 years">6 Years</option>
                                                      <option <?php if($result->warranty  == '7 years'): ?> selected <?php endif;?> value="7 years">7 Years</option>
                                                      
                                                        <option <?php if($result->warranty  == '8 years'): ?> selected <?php endif;?> value="8 years">8 Years</option>
                                                      
                                                        <option <?php if($result->warranty  == '9 years'): ?> selected <?php endif;?> value="9 years">9 Years</option>
                                                      
                                                        <option <?php if($result->warranty  == '10 years'): ?> selected <?php endif;?> value="10 years">10 Years</option>
                                                        <option <?php if($result->warranty  ==  '11 years'): ?> selected <?php endif;?> value="11 years">11 Years</option>
                                                        <option <?php if($result->warranty  == '12 years'): ?> selected <?php endif;?> value="12 years">12 Years</option>
                                                        <option <?php if($result->warranty  ==  '13 years'): ?> selected <?php endif;?> value="13 years">13 Years</option>
                                                        <option <?php if($result->warranty  ==  '14 years'): ?> selected <?php endif;?> value="14 years">14 Years</option>
                                                        <option <?php if($result->warranty  ==  '15 years'): ?> selected <?php endif;?> value="15 years">15 Years</option>
                                                        <option <?php if($result->warranty  ==  '16 years'): ?> selected <?php endif;?> value="16 years">16 Years</option>
                                                        <option <?php if($result->warranty  ==  '17 years'): ?> selected <?php endif;?> value="17 years">17 Years</option>
                                                        <option <?php if($result->warranty  ==  '18 years'): ?> selected <?php endif;?> value="18 years">18 Years</option>
                                                        <option <?php if($result->warranty  ==  '18 years'): ?> selected <?php endif;?> value="19 years">19 Years</option>
                                                        <option <?php if($result->warranty  ==  '20 years'): ?> selected <?php endif;?> value="20 years">20 Years</option>
                                                    </select>
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>REMARKS</label>
                                                    <input class="form-control" name="remarks" placeholder="Enter remark here.." value="<?php echo $result->remarks;?>">
                                               
                                                </div>
                                              
                                                <button type="submit" name="system" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning">Reset</button>
                                            </form>
                                        </div>
                                    
                                    </div>
                                    <!-- /.row (nested) -->
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

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

          <script>
      
        $('#installdatepicker, #arival_datepicker').datepicker({ dateFormat: 'dd-mm-yy'  });
    </script>
  
    </body>
</html>