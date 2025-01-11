<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php 
if(isset($_POST['field'])){

 $data = [
     'mname'           => $_POST['mname'],
     'mnature'       => $_POST['mnature'],
     'type'    => 'amount',
     'messageAmount'

 ];


    if(empty($data['sys_cap_error']) && empty($data['sys_no_error']) && empty($data['name_error']) && empty($data['address_error'])  && empty($data['contact_number_error']) ){
        $dbObject->queryExecute("UPDATE  `fields` SET `fname` = ?, `nature` = ? WHERE id = ?" ,
        [ $data['mname'], $data['mnature'] , $_REQUEST['fid']]);

        $error = false;
        $data['messageAmount'] = "<strong>Success!</strong> record has been updated successfully.";  
    }
    


}
$dbObject->queryExecute("SELECT * FROM fields WHERE id = ?", [$_REQUEST['fid']]);
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

        <title>Edit Fields - SR Enterprises</title>
 
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
                            <h1 class="page-header">Edit Fields</h1>                         
                        </div>                               
                        <!-- /.col-lg-12 -->
                    </div>
                          <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Edit Fields
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
                                                <div class="form-group ">
                                                    <label>FIELD NAME <span style="color:red">*</span></label>
                                                    <input class="form-control" name="mname" required placeholder="Enter name here.." value="<?php echo $result->fname;?>">
                                                   
                                                </div>
                                                <div class="form-group">
                                                <label>Nature <span style="color:red">*</span></label>
                                                    <select name="mnature" class="form-control">
                                                        <option <?php if($result->nature == 'Credit'): ?> selected <?php endif;?> value="Credit">Credit</option>
                                                        <option <?php if($result->nature == 'Debit'): ?> selected <?php endif;?> value="Debit">Debit</option>
                                                     
                                                    </select>
                                                </div>
                                             
                                                <button type="submit" name="field" class="btn btn-primary">Update</button>
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

  
    </body>
</html>