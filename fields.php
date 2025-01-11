<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php 
if(isset($_POST['amount'])){

 $data = [
     'mname'           => $_POST['mname'],
     'mnature'       => $_POST['mnature'],
     'type'    => 'amount',
     'messageAmount'

 ];

    /*
    * Submit the system form
    */ 
    if($dbObject->queryExecute("SELECT * FROM fields WHERE fname = ? AND nature = ?  AND ftype = ?",
    [ $data['mname'] , $data['mnature'] , $data['type'] ])){
            if($dbObject->countRows() == 0){
               
                $dbObject->queryExecute("INSERT INTO `fields` ( `fname`, `nature`, `ftype`)
                 VALUES (?,?,?)", [ $data['mname'], $data['mnature'], $data['type'] ]);

                $error = false;
                $data['messageAmount'] = "<strong>Success!</strong> record has been added successfully.";  
            }else{

                $error = true;
                $data['messageAmount'] = "<strong>Sorry!</strong> record already exist.";  
            }
        }

}

if(isset($_POST['receive'])){

    $data = [
        'name'           => $_POST['name'],
        'nature'       => $_POST['nature'],
        'type'    => 'receive',
        'messageReceive'
   
    ];
   
       /*
       * Submit the system form
       */ 
       if($dbObject->queryExecute("SELECT * FROM fields WHERE fname = ? AND nature = ?  AND ftype = ?",
       [ $data['name'] , $data['nature'] , $data['type'] ])){
               if($dbObject->countRows() == 0){
                  
                   $dbObject->queryExecute("INSERT INTO `fields` ( `fname`, `nature`, `ftype`)
                    VALUES (?,?,?)", [ $data['name'], $data['nature'], $data['type'] ]);
   
                   $error = false;
                   $data['messageReceive'] = "<strong>Success!</strong> record has been added successfully.";  
               }else{
   
                   $error = true;
                   $data['messageReceive'] = "<strong>Sorry!</strong> record already exist.";  
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

        <title>Manage Fields - SR Enterprises</title>
 
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
                            <h1 class="page-header">Manage Fields</h1>                         
                        </div>                               
                        <!-- /.col-lg-12 -->
                    </div>
                          <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Total Amount Form
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php if(!empty($data['messageAmount'])): ?>
                                            <div class="alert <?php if($error == false): ?> alert-success <?php endif; ?> <?php if($error == true): ?> alert-danger<?php endif; ?> alert-dismissible fade in">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $data['messageAmount']; ?>
                                            </div>                                
                                            <?php endif; ?>
                                            <form role="form" method="post">
                                                <div class="form-group  <?php if(!empty($data['name_error'])): ?> has-error<?php endif; ?>">
                                                    <label>FIELD NAME <span style="color:red">*</span></label>
                                                    <input class="form-control" name="mname" required placeholder="Enter name here.." value="<?php echo $data['mname'];?>">
                                                    <?php if(!empty($data['name_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['name_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                <label>Nature <span style="color:red">*</span></label>
                                                    <select name="mnature" class="form-control">
                                                        <option <?php if($data['mnature'] == 'Credit'): ?> selected <?php endif;?> value="Credit">Credit</option>
                                                        <option <?php if($data['mnature'] == 'Debit'): ?> selected <?php endif;?> value="Debit">Debit</option>
                                                     
                                                    </select>
                                                </div>
                                             
                                                <button type="submit" name="amount" class="btn btn-primary">Submit</button>
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

                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Total Receive Form
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php if(!empty($data['messageReceive'])): ?>
                                            <div class="alert <?php if($error == false): ?> alert-success <?php endif; ?> <?php if($error == true): ?> alert-danger<?php endif; ?> alert-dismissible fade in">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $data['messageReceive']; ?>
                                            </div>                                
                                            <?php endif; ?>
                                            <form role="form" method="post">
                                                <div class="form-group  <?php if(!empty($data['name_error'])): ?> has-error<?php endif; ?>">
                                                    <label>FIELD NAME <span style="color:red">*</span></label>
                                                    <input class="form-control" name="name" required placeholder="Enter name here.." value="<?php echo $data['name'];?>">
                                                    <?php if(!empty($data['name_error'])): ?>
                                                        <label class="control-label" for="inputError"><?php echo $data['name_error']; ?></label>
                                                      <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                <label>Nature <span style="color:red">*</span></label>
                                                    <select name="nature" class="form-control">
                                                        <option <?php if($data['nature'] == 'Credit'): ?> selected <?php endif;?> value="Credit">Credit</option>
                                                        <option <?php if($data['nature'] == 'Debit'): ?> selected <?php endif;?> value="Debit">Debit</option>
                                                     
                                                    </select>
                                                </div>
                                             
                                                <button type="submit" name="receive" class="btn btn-primary">Submit</button>
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
                        <!-- /.col-lg-6 -->
                    </div>
                 <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   <strong> Total Amount Fields</strong>
                                 
                                </div>
                                <!-- /.panel-heading -->
                                <?php 
                                $dbObject->queryExecute("SELECT * FROM fields WHERE ftype = 'amount' ORDER BY id DESC");
                                $allAmountRecords = $dbObject->fetchAllRecords();         
                                ?>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-amount">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>NAME</th>
                                                    <th>NATURE</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $k = 1; foreach($allAmountRecords as $amount):
                                                    if($k % 2 == 0){
                                                        $class = 'even';
                                                    }else{
                                                        $class = 'odd';
                                                    }
                                                ?>
                                                    <tr class= "<?php echo $class;?>">
                                                    <td><?php echo $k; ?></td>
                                                    <td><?php echo $amount->fname; ?></td>
                                                    <td><?php echo $amount->nature; ?></td>
                                                  
                                                    <td><a href="edit_field.php?fid=<?php echo $amount->id;?>"><i class="fa fa-pencil"></i></a> | <a href="delete_field.php?del=<?php echo $amount->id;?>" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></a></td>
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
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   <strong> Total Received Fileds</strong>
                                  
                                </div>
                                <!-- /.panel-heading -->
                                <?php 
                                $dbObject->queryExecute("SELECT * FROM fields WHERE ftype = 'receive' ORDER BY id DESC");
                                $allReceiveRecords = $dbObject->fetchAllRecords();         
                                ?>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-recieve">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>NAME</th>
                                                    <th>NATURE</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $k = 1; foreach($allReceiveRecords as $receive):
                                                    if($k % 2 == 0){
                                                        $class = 'even';
                                                    }else{
                                                        $class = 'odd';
                                                    }
                                                ?>
                                                    <tr class= "<?php echo $class;?>">
                                                    <td><?php echo $k; ?></td>
                                                    <td><?php echo $receive->fname; ?></td>
                                                    <td><?php echo $receive->nature; ?></td>
                                                  
                                                    <td><a href="edit_field.php?fid=<?php echo $receive->id;?>"><i class="fa fa-pencil"></i></a> | <a href="delete_field.php?del=<?php echo $receive->id;?>" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></a></td>
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
                $('#dataTables-amount, #dataTables-recieve').DataTable({
                        responsive: true
                });
            });
        </script>
     
    </body>
</html>