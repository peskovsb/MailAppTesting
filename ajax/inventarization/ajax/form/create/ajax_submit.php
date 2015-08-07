<?
//DB connect if needed
require '../../../../db.php';
$db = new DatabaseItDept();

//-- MAIN validation CORE
require '../ajax_valid_body.php';

if($mistake == 0){
    //--Algorithm FIND free Field--

    $sql = 'SELECT devices.*, company.company_pref, devtypes.devtype_name, devtypes.devtype_pref FROM `devices` LEFT JOIN `company` ON company.company_id = devices.company_id LEFT JOIN `devtypes` ON devtypes.devtype_id = devices.devtype_id WHERE devices.devtype_id = :devtype ORDER by devices.device_num ASC';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':devtype'=>$_POST[$formArr['devtype_id']['name']]));
    $arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);

        $devNum = 1;
        foreach ($arrAll as $Items) {
            if ($devNum != $Items['device_num']) {
                //--AddingToTheDB
                break;
            }
            $devNum = $Items['device_num']+1;
        }
    //echo $devNum;
    $sql = 'INSERT INTO devices (devtype_id,company_id,device_num,device_komment,device_status) VALUES (:devtype_id,:company_id,:device_num,:device_komment,:device_status)';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':devtype_id'=>$_POST[$formArr['devtype_id']['name']],':company_id'=>$_POST[$formArr['company_id']['name']],':device_num'=>$devNum,':device_komment'=>strip_tags($_POST[$formArr['device_komment']['name']]),':device_status'=>$_POST[$formArr['device_status']['name']]));
    //--END ALGORITHM

    $sql = 'SELECT * FROM company WHERE company_id = :company_id';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':company_id'=>$_POST[$formArr['company_id']['name']]));
    $arrCompany = $tb->fetch(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM devtypes WHERE devtype_id = :devtype_id';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':devtype_id'=>$_POST[$formArr['devtype_id']['name']]));
    $arrDevTypes = $tb->fetch(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM devices WHERE device_num = :device_num';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':device_num'=>$devNum));
    $arrDevices = $tb->fetch(PDO::FETCH_ASSOC);

    echo 'Устройство '.$arrCompany['company_pref'].$arrDevTypes['devtype_pref'].$arrDevices['device_num'].' успешно добавлено';
}
?>
