<?
//DB connect if needed
require '../../../../db.php';
$db = new DatabaseItDept();

if($_POST['dev_id']){

    $sql = 'DELETE FROM devices WHERE device_id = :device_id';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':device_id'=>$_POST['dev_id']));

}
?>
