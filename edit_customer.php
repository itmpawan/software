<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php 
if(isset($_POST['customer'])){

 $data = [
     'sys_cap'       => $_POST['sys_cap'],
     'sys_no'       => $_POST['sys_no'],
     'products'     => implode(",",$_POST['products']),
     'name'       => $_POST['name'],
     'ins_date'       => $_POST['ins_date'],
     'address'       => $_POST['address'],
     'contact_number'       => $_POST['contact_number'],
     'booking_date'       => implode(",",$_POST['booking_date']),
     'bill_number'       => $_POST['bill_number'],
     'remarks'       => $_POST['remarks'],
     'balance'       => $_POST['balance'],
     'model'       => $_POST['model'],
     'system_type'       => $_POST['system_type'],
     'customer_remark'       => $_POST['customer_remark'],
     'GST'       => $_POST['GST'],
     'status'       => $_POST['status'],
     'name_error'    => '',
     'address_error' => '',
     'contact_number_error'    => '',
     'sys_cap_error'    => '',
     'sys_no_error'    => '',
     'message' => ''

 ];

if(empty($data['sys_cap'])){
    $data['sys_cap_error'] = "SYS. CAP. field is required.";
}
 
if(empty($data['sys_no'])){
    $data['sys_no_error'] = "SYS. No. field is required.";
}

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create directory if it doesn't exist
    }
    // Get file information
    $beforeinstallfile = $_FILES['before_install'];
    $fileName = basename($beforeinstallfile['name']);
    $fileTmpPath = $beforeinstallfile['tmp_name'];
    $fileSize = $beforeinstallfile['size'];
    $fileError = $beforeinstallfile['error'];
    $fileType = $beforeinstallfile['type'];
    $beforeinstallFileName = '';
    // Allowed file types
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Check for errors
    if (isset($_FILES['before_install']) && $fileError === UPLOAD_ERR_OK) {
        // Validate file type
        if (in_array($fileType, $allowedTypes)) {
            // Validate file size (limit to 5MB)
            if ($fileSize <= 5 * 1024 * 1024) {
                // Generate a unique file name to avoid overwriting
                $beforeinstallFileName = uniqid('', true) . '-' . $fileName;
                // Save the file
                $destination = $uploadDir . $beforeinstallFileName;
                if (move_uploaded_file($fileTmpPath, $destination)) {
                } else {
                    echo "Error: Unable to save the file.";
                }
            } else {
                echo "Error: File size exceeds 5MB.";
            }
        } else {
            echo "Error: Invalid file type. Only JPEG, PNG, and GIF are allowed.";
        }
    } else {
        $beforeinstallFileName = $_POST['before_exist'];
        echo "Error: File upload error. Code: $fileError.";
    }

    // Get file information
    $beforeinstallfile = $_FILES['after_install'];
    $fileName = basename($beforeinstallfile['name']);
    $fileTmpPath = $beforeinstallfile['tmp_name'];
    $fileSize = $beforeinstallfile['size'];
    $fileError = $beforeinstallfile['error'];
    $fileType = $beforeinstallfile['type'];
    $afterinstallFileName = '';
    // Allowed file types
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Check for errors
    if (isset($_FILES['after_install']) && $fileError === UPLOAD_ERR_OK) {
        // Validate file type
        if (in_array($fileType, $allowedTypes)) {
            // Validate file size (limit to 5MB)
            if ($fileSize <= 5 * 1024 * 1024) {
                // Generate a unique file name to avoid overwriting
                $afterinstallFileName = uniqid('', true) . '-' . $fileName;
                // Save the file
                $destination = $uploadDir . $afterinstallFileName;
                if (move_uploaded_file($fileTmpPath, $destination)) {
                } else {
                    echo "Error: Unable to save the file.";
                }
            } else {
                echo "Error: File size exceeds 5MB.";
            }
        } else {
            echo "Error: Invalid file type. Only JPEG, PNG, and GIF are allowed.";
        }
    } else {
        $afterinstallFileName = $_POST['after_exist'];
        echo "Error: File upload error. Code: $fileError.";
    }
    /*
        * Submit the system form
    */ 

    if(empty($data['sys_cap_error']) && empty($data['sys_no_error']) && empty($data['name_error']) && empty($data['address_error'])  && empty($data['contact_number_error']) ){
        $dbObject->queryExecute("UPDATE  `customers` SET `sys_cap` = ?, `sys_no` = ?,`products` = ?, `cname` = ?,`caddress` = ?,
         `contact_number` = ?,`bill_number` = ?, `booking_date` =?, `ins_date` = ?,`remarks` = ?, `balance` = ?, `model` = ?,`system_type` = ?,`customer_remark` = ?,`GST` = ?,`before_install` = ?,`after_install` = ?,`status` = ? WHERE id = ?" ,
        [ $data['sys_cap'] , $data['sys_no'], $data['products'], $data['name'],$data['address'] , $data['contact_number'], $data['bill_number'],
         $data['booking_date'] ,$data['ins_date'] , $data['remarks'], $data['balance'],$data['model'],$data['system_type'],$data['customer_remark'],$data['GST'],$beforeinstallFileName, $afterinstallFileName,'Active' , $_REQUEST['cid']]);

        $error = false;
        // Redirect with a success message
        header("Location: " . $_SERVER['PHP_SELF'] . "?cid=".$_REQUEST['cid']."&success=1");
        exit();

        
    }
}
// Display success message if present
if (isset($_GET['success'])) {
    $data['message'] = "<strong>Success!</strong> record has been updated successfully.";  
}
$dbObject->queryExecute("SELECT * FROM customers WHERE id = ?", [$_REQUEST['cid']]);
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

        <title>Edit Customer - SR Enterprises</title>
 
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
                            <h1 class="page-header">Edit Customer</h1>   
                             <p> <div class="text-right">
                          <button onclick='window.location.href="add_customer.php"' type="button" class="btn btn-success">Add New Customer <i class="fa fa-plus fa-fw"></i> </button>
                       </div>  </p>
                        </div>                               
                        <!-- /.col-lg-12 -->
                    </div>
                   
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
                                    Edit Customer Form
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                           
                                            <form role="form" method="post" enctype="multipart/form-data">
                                                <div class="form-group  <?php if(!empty($data['name_error'])): ?> has-error<?php endif; ?>">
                                                    <label>NAME <span style="color:red">*</span></label>
                                                    <input class="form-control" name="name"  placeholder="Enter name here.." value="<?php echo $result->cname;?>">
                                                    <?php if(!empty($data['name_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['name_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                <div class="form-group  <?php if(!empty($data['address_error'])): ?> has-error<?php endif; ?>">
                                                    <label>ADDRESS <span style="color:red">*</span></label>
                                                    <textarea class="form-control" rows="3" name="address" placeholder="Enter address here.."><?php echo $result->caddress;?></textarea>
                                                    <?php if(!empty($data['address_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['address_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                <div class="form-group <?php if(!empty($data['contact_number_error'])): ?> has-error<?php endif; ?>">
                                                    <label>CONTACT NUMBER <span style="color:red">*</span></label>
                                                    <input class="form-control" name="contact_number" placeholder="Enter contact number here.." value="<?php echo $result->contact_number;?>">
                                                    <?php if(!empty($data['contact_number_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['contact_number_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
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
                                               <div class="form-group">
                                                  
                                                    <label>PRODUCTS</label>
                                                    
                                                     <?php
                                                
                                                    $checked_arr = array();
    
                                                
                                                    // Create checkboxes
                                                    $checked_arr = explode(",",$result->products);
                                                    
                                                    $products_arr = array("Solar Water Heater System","Solar Fencing System","Solar Gate & Garden Light","Solar Street Light","Solar Home Light","Solar Power pack","Solar Pump System", "Solar Cooker","Solar inverter", "Electrical Back Up", "Luminarie", "Panel", "Battery", "Filter", "Others");
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
                                                    <label>BILL NUMBER</label>
                                                    <input class="form-control" name="bill_number" placeholder="Enter bill number here.." value="<?php echo $result->bill_number;?>">
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>INS. DATE</label>
                                                    <input class="form-control" id="installdatepicker" name="ins_date" placeholder="Enter installment date here.." value="<?php echo $result->ins_date;?>">
                                               
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label>WARANTY (Years)</label>
                                            
                                                   <select name="booking_date[]" class="form-control" multiple>
                                                        <option <?php if(in_array('0 year', explode(',', $result->booking_date))): ?> selected <?php endif;?> value="0 year">No Waranty</option>
                                                            <option <?php if(in_array('1 year', explode(',', $result->booking_date))): ?> selected <?php endif;?> value="1 year">1 Year</option>
                                                        <?php for($i=2; $i <= 20; $i++){ ?>
                                                            <option <?php if(in_array($i.' years', explode(',', $result->booking_date))): ?> selected <?php endif;?> value="<?php echo $i;?> years"><?php echo $i;?> Years</option>
                                                        <?php } ?>
                                                    </select>
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>BRAND</label>
                                                    <input class="form-control" name="remarks" placeholder="Enter brand here.." value="<?php echo $result->remarks;?>">
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>MODEL</label>
                                            
                                                   <select name="model" class="form-control">
                                                        <option <?php if($result->model == ''): ?> selected <?php endif;?> value="">-- Select One --</option>
                                                        <option <?php if($result->model == 'ETC'): ?> selected <?php endif;?> value="ETC">ETC</option>
                                                        <option <?php if($result->model == 'FPC'): ?> selected <?php endif;?> value="FPC">FPC</option>
                                                        <option <?php if($result->model == 'Manifold'): ?> selected <?php endif;?> value="Manifold">Manifold</option>
                                                    </select>
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>SYSTEM TYPE</label>
                                            
                                                   <select name="system_type" class="form-control">
                                                        <option <?php if($result->system_type == ''): ?> selected <?php endif;?> value="">-- Select One --</option>
                                                        <option <?php if($result->system_type == 'Glass Lined'): ?> selected <?php endif;?> value="Glass Lined">Glass Lined</option>
                                                        <option <?php if($result->system_type == 'Stainless'): ?> selected <?php endif;?> value="Stainless">Stainless</option>
                                                        <option <?php if($result->system_type == 'Galvanised'): ?> selected <?php endif;?> value="Galvanised">Galvanised</option>
                                                        <option <?php if($result->system_type == 'Ceramic'): ?> selected <?php endif;?> value="Ceramic">Ceramic</option>
                                                    </select>
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>REMARKS</label>
                                                    <textarea class="form-control" rows="3" name="customer_remark" placeholder="Enter remark here.."><?php echo $result->customer_remark;?></textarea>
                                                   
                                                </div>
                                                <div class="form-group">
                                                    <label>GST</label>
                                                    <input class="form-control" name="GST" placeholder="Enter GST number here.." value="<?php echo $result->GST;?>">
                                               
                                                </div>
                                                <div class="form-group">
                                                    <?php if($result->before_install){ ?>
                                                    <img src='uploads/<?php echo $result->before_install; ?>' alt='before' height="150" width="150"/><br>
                                                    <?php } ?>
                                                    <label for="image">Choose an image before installation:</label>
                                                    <input type="file" id="image" name="before_install" accept="image/*">
                                                    <input type="hidden" name="before_exist" value="<?php echo htmlspecialchars($result->before_install ?? ''); ?>">
                                                </div>
                                                <div class="form-group">
                                                <?php if($result->after_install){ ?>
                                                    <img src='uploads/<?php echo $result->after_install; ?>' alt='before' height="150" width="150"/><br>
                                                    <?php } ?>
                                                    <label for="image">Choose an image after installation:</label>
                                                    <input type="file" id="image" name="after_install" accept="image/*">
                                                    <input type="hidden" name="after_exist" value="<?php echo htmlspecialchars($result->after_install ?? ''); ?>">
                                                </div>
                                                <?php 
                                                    $dbObject->queryExecute("SELECT * FROM fields WHERE ftype='amount'");
                                                    $allamountRecords = $dbObject->fetchAllRecords();   
                                                    
                                                        foreach($allamountRecords as $amount):
                                                         if($dbObject->queryExecute("SELECT * FROM `customer_meta` WHERE `field_type`=? AND `customer_id` = ? AND `field_name` = ? AND `field_nature` = ?", ['amount', $_REQUEST['cid'], $amount->fname, $amount->nature])){

                                                            if($dbObject->countRows() == 0){
                                                                
                                                            $dbObject->queryExecute("INSERT INTO `customer_meta` ( `customer_id`, `field_name`, `field_nature`,`field_type`, `value`)
                                                            VALUES (?,?,?,?,?)", [$_REQUEST['cid'], $amount->fname, $amount->nature, 'amount', '0.00' ]);
                                                         }  
                                                        
                                                        }  
                                                        endforeach;
     
                                                ?>
                                                 <div class="form-group">
                                                    <label>TOTAL AMOUNT</label>
                                                    <?php 
                                                    $dbObject->queryExecute("SELECT * FROM customer_meta WHERE customer_id = ".$_REQUEST['cid']." AND field_type='amount'");
                                                    $allamountRecords = $dbObject->fetchAllRecords();   
                                                    ?>
                                                    <?php foreach($allamountRecords as $amount):?>
                                                    <p class="help-block"><?php echo $amount->field_name; ?><small> (<?php echo $amount->field_nature; ?>)</small></p>
                                                    
                                                    <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-inr"></i>
                                                    </span>
                                                    <input type="text" data-nature = "<?php echo $amount->field_nature; ?>" data-id = "<?php echo $amount->id; ?>" class="form-control amount" value="<?php echo $amount->value; ?>">
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php 
                                                    $dbObject->queryExecute("SELECT * FROM fields WHERE ftype='receive'");
                                                    $allreceiveRecords = $dbObject->fetchAllRecords();   
                                                    
                                                     foreach($allreceiveRecords as $receive):

                                                        if($dbObject->queryExecute("SELECT * FROM `customer_meta` WHERE `field_type`=? AND `customer_id` = ? AND `field_name` = ? AND `field_nature` = ?", ['receive', $_REQUEST['cid'], $receive->fname, $receive->nature])){

                                                        if($dbObject->countRows() == 0){

                                                            $dbObject->queryExecute("INSERT INTO `customer_meta` ( `customer_id`, `field_name`, `field_nature`,`field_type`, `value`)
                                                             VALUES (?,?,?,?,?)", [$_REQUEST['cid'], $receive->fname, $receive->nature, 'receive', '0.00' ]);
                                                        }
                                                    }
                                                    endforeach;
   
                                                ?>
                                                 <div class="form-group">
                                                    <label>TOTAL RECEIVED</label>
                                                    <?php 
                                                    $dbObject->queryExecute("SELECT * FROM customer_meta WHERE customer_id = ".$_REQUEST['cid']." AND field_type='receive'");
                                                    $allreceiveRecords = $dbObject->fetchAllRecords();   
                                                    ?>
                                                    <?php foreach($allreceiveRecords as $receive):?>
                                                        <p class="help-block"><?php echo $receive->field_name; ?><small> (<?php echo $receive->field_nature; ?>)</small></p>
                                                    
                                                    <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-inr"></i>
                                                    </span>
                                                    <input type="text" data-nature = "<?php echo $receive->field_nature; ?>"data-id="<?php echo $receive->id; ?>" class="form-control receive" value="<?php echo $receive->value; ?>">
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>

                                                <div class="form-group">
                                                    <label>BALANCE  
                                                    <button type="button" id="calculate" class="btn btn-primary">CALCULATE</button>
                                                    <button style="display:none" type="button" id="calculate1" class="btn btn-primary">CALCULATE</button>
                                                    </label>
                                                   
                                                    <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-inr"></i>
                                                    </span>
                                                    <input type="text" id="balance" name="balance" class="form-control"  value="<?php echo $result->balance;?>">
                                                    </div>
                                                </div>
                                                 
                                             
                                                <button type="submit" name="customer" class="btn btn-primary">UPDATE</button>
                                                <button type="reset" class="btn btn-warning">RESET</button>
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
      
        $('#installdatepicker').datepicker({  });

        // AJAX CALL FOR CALCULATOR
        $('#calculate').click(function(){
            var id = '<?php echo $_REQUEST['cid']?>';
            $('#balance').val("Please wait....");
            $.ajax({ // ajax call starts
                type: "POST",
                url: "calculator.php",
                data: "calculate=true"+ "&cid=" + id,
                dataType: 'json', // Choosing a JSON datatype
            }).done(function(data) { // Variable data contains the data we get from serverside
                $('#balance').val(data.balance);
            });
        });

        $('.amount, .receive').change(function(){
            var amount = $(this).val();
            var id = $(this).attr('data-id');
            var nature = $(this).attr('data-nature');
            
            $.ajax({ // ajax call starts
                type: "POST",
                url: "calculator.php",
                data: "amount="+ amount + "&id=" + id + "&nature=" + nature,
                dataType: 'json', // Choosing a JSON datatype
            }).done(function(data) { // Variable data contains the data we get from serverside
                $('#calculate').trigger('click');
            });
        });
    </script>
  
    </body>
</html>