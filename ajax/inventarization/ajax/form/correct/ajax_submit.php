<?
//DB connect if needed
require '../../../../db.php';
$db = new DatabaseItDept();

//-- MAIN validation CORE
require '../ajax_valid_body.php';

if($mistake == 0){

    /*$sql = 'INSERT INTO devices (devtype_id,company_id,device_num,device_komment,device_status) VALUES (:devtype_id,:company_id,:device_num,:device_komment,:device_status)';*/

    $sql = 'UPDATE devices SET devtype_id = :devtype_id, company_id = :company_id, device_num = :device_num,device_komment = :device_komment, device_status = :device_status WHERE device_id = :device_id';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':device_id'=>$_POST['RealDev_id'],':devtype_id'=>$_POST[$formArr['devtype_id']['name']],':company_id'=>$_POST[$formArr['company_id']['name']],':device_num'=>$_POST[$formArr['device_num']['name']],':device_komment'=>strip_tags($_POST[$formArr['device_komment']['name']]),':device_status'=>$_POST[$formArr['device_status']['name']]));

    echo 'Запись изменена';
}
?>
