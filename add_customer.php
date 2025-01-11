<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php 
if(isset($_POST['customer'])){

 $data = [
     'name'           => $_POST['name'],
     'address'       => $_POST['address'],
     'contact_number'       => $_POST['contact_number'],
     'booking_date'       => $_POST['booking_date'],
     'bill_number'       => $_POST['bill_number'],
     'ins_date'       => $_POST['ins_date'],
     'remarks'       => $_POST['remarks'],
     'status'       => $_POST['status'],
     'sys_cap'       => $_POST['sys_cap'],
     'sys_no'       =>implode(",",$_POST['sys_no']),
     'products'     => implode(",",$_POST['products']),
     'name_error'    => '',
     'address_error' => '',
     'contact_number_error'    => '',
     'sys_cap_error'    => '',
     'sys_no_error'    => ''

 ];

 if(empty($data['name'])){
  $data['name_error'] = "Name field is required.";
 }

 if(empty($data['address'])){
  $data['address_error'] = "Address field is required.";
 }

if(empty($data['sys_cap'])){
    $data['sys_cap_error'] = "SYS. CAP. field is required.";
}
 
if(empty($data['sys_no'])){
    $data['sys_no_error'] = "SYS. No. field is required.";
}
/*
        * Submit the system form
    */ 

    if(empty($data['name_error']) && empty($data['address_error']) && empty($data['sys_cap_error']) ){

        if($dbObject->queryExecute("SELECT * FROM customers WHERE sys_no = ?",
    [$data['sys_no'] ])){
            if($dbObject->countRows() == 0){
                $date = date('Y-m-d H:i:s');
                $dbObject->queryExecute("INSERT INTO `customers` ( `cname`, `caddress`, `contact_number`,`sys_cap`, `sys_no`, `products`,
                `booking_date`,`bill_number`,`ins_date`, `remarks`, `created_at`, `status`)
                 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", [ $data['name'], $data['address'], $data['contact_number'] ,$data['sys_cap'] , $data['sys_no'], $data['products'],
                  $data['booking_date'], $data['bill_number'] ,$data['ins_date'] ,  $data['remarks'], $date, 'Active' ]);

                $error = false;
                $data['message'] = "<strong>Success!</strong> record has been added successfully.";  
            }else{

                $error = true;
                $data['message'] = "<strong>Sorry!</strong> SYS. NO. already exist.";  
            }
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Add Customer - SR Enterprises</title>
 
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
                            <h1 class="page-header">Add New Customer</h1> 
                             <p> <div class="text-right">
                          <button onclick='window.location.href="add_customer.php"' type="button" class="btn btn-success">Add New Customer <i class="fa fa-plus fa-fw"></i> </button>
                       </div>  </p>
                        </div>                               
                        <!-- /.col-lg-12 -->
                    </div>
                          <!-- /.row -->
                          <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Installation Form
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php if(!empty($data['message'])): ?>
                                            <div class="alert <?php if($error == false): ?> alert-success <?php endif; ?> <?php if($error == true): ?> alert-danger<?php endif; ?> alert-dismissible fade in">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $data['message']; ?>
                                            </div>                                
                                            <?php endif; ?>
                                            <form role="form" method="post">
                                                <div class="form-group  <?php if(!empty($data['name_error'])): ?> has-error<?php endif; ?>">
                                                    <label>NAME <span style="color:red">*</span></label>
                                                    <input class="form-control" name="name"  placeholder="Enter name here.." value="<?php echo $data['name'];?>">
                                                    <?php if(!empty($data['name_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['name_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                <div class="form-group  <?php if(!empty($data['address_error'])): ?> has-error<?php endif; ?>">
                                                    <label>ADDRESS <span style="color:red">*</span></label>
                                                    <textarea class="form-control" rows="3" name="address" placeholder="Enter address here.."><?php echo $data['address'];?></textarea>
                                                    <?php if(!empty($data['address_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['address_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                <div class="form-group <?php if(!empty($data['contact_number_error'])): ?> has-error<?php endif; ?>">
                                                    <label>CONTACT NUMBER <span style="color:red">*</span></label>
                                                    <input class="form-control" name="contact_number" placeholder="Enter contact number here.." value="<?php echo $data['contact_number'];?>">
                                                    <?php if(!empty($data['contact_number_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['contact_number_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                 <div class="form-group <?php if(!empty($data['sys_no_error'])): ?> has-error<?php endif; ?>">
                                                    <label>SYS. NO. <span style="color:red">*</span></label>
                                                    <?php 
                                                    $dbObject->queryExecute("SELECT sys_no FROM systems ORDER BY sys_no ASC");
                                                    $allSystemRecords = $dbObject->fetchAllRecords();         
                                                    ?>
                                                    
                                                    
                                                     
                                                      <select name="sys_no[]" class="form-control sys_no" multiple>
                                                    
                                                     <?php foreach($allSystemRecords as $system): ?>
                                                      <?php 
                                                         $dbObject->queryExecute("SELECT id FROM customers WHERE FIND_IN_SET('$system->sys_no', `sys_no`)");
                                                          
                                                         if($dbObject->countRows() == 0){ 
                                                           
                                                    ?>
                                                          <option  value="<?php echo $system->sys_no;?>"><?php echo $system->sys_no;?></option>
                                                       
                                                     <?php } endforeach;?>
                                                     
                                                     </select>
                                                   
                                                </div>
                                                
                                                
                                                <div class="form-group <?php if(!empty($data['sys_cap_error'])): ?> has-error<?php endif; ?>">
                                                    <label>SYS. CAP. <span style="color:red">*</span></label>
                                                    <input class="form-control" name="sys_cap" id="sys_cap" placeholder="Enter SYS CAP here.." value="<?php echo $data['sys_cap'];?>">
                                                    <?php if(!empty($data['sys_cap_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['sys_cap_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                               
                                               <div class="form-group">
                                                  
                                                    <label>PRODUCTS</label>
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar Water Heater System" name="products[]">Solar Water Heater System
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar Fencing System"  name="products[]">Solar Fencing System
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar Gate & Garden Light"  name="products[]">Solar Gate & Garden Light
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar Street Light"  name="products[]">Solar Street Light
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar Home Light"  name="products[]">Solar Home Light
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar Power pack"  name="products[]">Solar Power pack
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Energy Saving Heat Pump"  name="products[]">Energy Saving Heat Pump
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar Pump System"  name="products[]">Solar Pump System
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar Cooker"  name="products[]">Solar Cooker
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Solar inverter"  name="products[]">Solar inverter
                                                        </label>
                                                    </div>
                                                    
                                                  <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Electrical Back Up"  name="products[]">Electrical Back Up
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Luminarie"  name="products[]">Luminarie
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Panel"  name="products[]">Panel
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Battery"  name="products[]">Battery
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Filter"  name="products[]">Filter
                                                        </label>
                                                    </div>
                                                     <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="Others"  name="products[]">Others
                                                        </label>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>BILL NUMBER</label>
                                                    <input class="form-control" name="bill_number" placeholder="Enter bill number here.." value="<?php echo $data['bill_number'];?>">
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>INS. DATE</label>
                                                    <input class="form-control" id="installdatepicker" name="ins_date" placeholder="Enter installment date here.." value="<?php echo $data['ins_date'];?>">
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>WARRANTY (Years)</label>
                                             <!-- <input class="form-control" id="warranty" name="booking_date"  value="<?php echo $data['booking_date'];?>">-->
                                               
                                                   <select name="booking_date[]" id="warranty" class="form-control" multiple>
                                                          <option <?php if($data['booking_date'] == '0 year'): ?> selected <?php endif;?> value="0 year">No Waranty</option>
                                                        <option <?php if($data['booking_date'] == '1 year'): ?> selected <?php endif;?> value="1 year">1 Year</option>
                                                        <option <?php if($data['booking_date'] == '2 years'): ?> selected <?php endif;?> value="2 years">2 Years</option>
                                                   <option <?php if($data['booking_date'] == '3 years'): ?> selected <?php endif;?> value="3 years">3 Years</option>
                                                    <option <?php if($data['booking_date'] == '4 years'): ?> selected <?php endif;?> value="4 years">4 Years</option>
                                                     <option <?php if($data['booking_date'] == '5 years'): ?> selected <?php endif;?> value="5 years">5 Years</option>
                                                      <option <?php if($data['booking_date'] == '6 years'): ?> selected <?php endif;?> value="6 years">6 Years</option>
                                                                       <option <?php if($data['booking_date'] == '7 years'): ?> selected <?php endif;?> value="7 years">7 Years</option>
                                                      
                                                        <option <?php if($data['booking_date'] == '8 years'): ?> selected <?php endif;?> value="8 years">8 Years</option>
                                                      
                                                        <option <?php if($data['booking_date'] == '9 years'): ?> selected <?php endif;?> value="9 years">9 Years</option>
                                                      
                                                        <option <?php if($data['booking_date'] == '10 years'): ?> selected <?php endif;?> value="10 years">10 Years</option>
                                                        <option <?php if($data['booking_date'] == '11 years'): ?> selected <?php endif;?> value="11 years">11 Years</option>
                                                        <option <?php if($data['booking_date'] == '12 years'): ?> selected <?php endif;?> value="12 years">12 Years</option>
                                                        <option <?php if($data['booking_date'] == '13 years'): ?> selected <?php endif;?> value="13 years">13 Years</option>
                                                        <option <?php if($data['booking_date'] == '14 years'): ?> selected <?php endif;?> value="14 years">14 Years</option>
                                                        <option <?php if($data['booking_date'] == '15 years'): ?> selected <?php endif;?> value="15 years">15 Years</option>
                                                        <option <?php if($data['booking_date'] == '16 years'): ?> selected <?php endif;?> value="16 years">16 Years</option>
                                                        <option <?php if($data['booking_date'] == '17 years'): ?> selected <?php endif;?> value="17 years">17 Years</option>
                                                        <option <?php if($data['booking_date'] == '18 years'): ?> selected <?php endif;?> value="18 years">18 Years</option>
                                                        <option <?php if($data['booking_date'] == '19 years'): ?> selected <?php endif;?> value="19 years">19 Years</option>
                                                        <option <?php if($data['booking_date'] == '20 years'): ?> selected <?php endif;?> value="20 years">20 Years</option>

                                                    </select>
                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>BRAND</label>
                                                    <input class="form-control" id ="brand" name="remarks" placeholder="Enter Brand here.." value="<?php echo $data['remarks'];?>">
                                               
                                                </div>
                                             
                                                <button type="submit" name="customer" class="btn btn-primary">Submit</button>
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
      
        $('#installdatepicker').datepicker({ });
        
        $(document).ready(function(){
            $('.sys_no').click(function(){
               var sysno = $(this).val(); 
               $.ajax({
               type: "POST", 
               dataType: "json", 
               url: "ajax.php", 
               data: "&sysno=" + sysno,
               success: function(response){
                  $('#installdatepicker').val(response.ins_date);
                   $('#warranty').val(response.warranty);
                    $('#brand').val(response.brand);
                    $('#sys_cap').val(response.sys_cap);
               }
            });
            });
        });
    </script>
  
    </body>
</html>