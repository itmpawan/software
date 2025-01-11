<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>

<?php 
    if(isset($_POST['id'])){

        $data = [
            'id'        => $_POST['id'],
            'nature'    => $_POST['nature'],
            'amount'    => $_POST['amount']
        ];
        $dbObject->queryExecute("UPDATE `customer_meta` SET `value` = ? WHERE id = ?" ,[$data['amount'], $data['id']]);
        $response['balance'] = '0.00';
        echo json_encode($response);
        exit;
    }

    if(isset($_POST['cid'])){

        $dbObject->queryExecute("SELECT * FROM customer_meta WHERE customer_id = ? AND field_nature = ?", [$_POST['cid'] , 'Credit']);
        $result = $dbObject->fetchAllRecords();
        $add = '';
        foreach($result as $res){
            $add  = floatval($add) + floatval($res->value);
        }
    
        $dbObject->queryExecute("SELECT * FROM customer_meta WHERE customer_id = ? AND field_nature = ?", [$_POST['cid'] , 'Debit']);
        $result = $dbObject->fetchAllRecords();
        $minus = '';
        foreach($result as $res){
            $minus  = floatval($minus) + floatval($res->value);
        }
        $totalBalance = floatval($add) - floatval($minus);

        $dbObject->queryExecute("UPDATE `customers` SET `balance` = ? WHERE id = ?" , [$totalBalance, $_POST['cid']]);
        $response['balance'] = $totalBalance;
        echo json_encode($response);
        exit;
    }
?>