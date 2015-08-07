<?
$db = new DatabaseItDept();

$sql = 'SELECT * FROM company';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrCompany = $tb->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM devtypes';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrDevTypes = $tb->fetchAll(PDO::FETCH_ASSOC);

$arrStatus = array(
    '1' => 'Активное',
    '0' => 'Неактивное'
);

if($_GET['id']){
    $sql = 'SELECT * FROM devices WHERE device_id = :device_id';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':device_id'=>$_GET['id']));
    $arrDevice = $tb->fetch(PDO::FETCH_ASSOC);
}
?>
