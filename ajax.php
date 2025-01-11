<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php 
if(isset($_POST['sysno'])){
    $response = array();
    $sys = explode(',' , $_POST['sysno']);
    $dbObject->queryExecute("SELECT * FROM systems WHERE sys_no = ".$sys[0]." ");
    $systemRecord = $dbObject->singleRecord();
    if($systemRecord->ins_date){
        $response['ins_date'] = date('m/d/Y', strtotime($systemRecord->ins_date));
    }else{
    $response['ins_date'] = '';
    }
    $response['warranty'] = $systemRecord->warranty;
    $response['brand'] = $systemRecord->brand;
    $response['sys_cap'] = $systemRecord->sys_cap;
    echo json_encode($response);
}

?>