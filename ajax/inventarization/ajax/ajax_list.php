<?
require '../../db.php';
$db = new DatabaseItDept();

//-- Params
$prefix_tbl = 'inv';
if($_POST['page']){
    $pagiPage = $_POST['page'];
}else{
    $pagiPage = 1;
}
$limit = $_POST['limit'];
//$limit = 30;
$pagiPage = ($pagiPage-1) * $limit;
//*** Query to Get Devices
//---------------------------------
if($_POST['loc']==0 AND $_POST['devtype']==0) {
    $sql = 'SELECT devices.*, company.company_pref, devtypes.devtype_name, devtypes.devtype_pref FROM `devices` LEFT JOIN `company` ON company.company_id = devices.company_id LEFT JOIN `devtypes` ON devtypes.devtype_id = devices.devtype_id ORDER by devices.device_num ASC LIMIT '.$pagiPage.','.$limit;
$tb = $db->connection->prepare($sql);
$tb->execute();
}else{
    //$query_string = 'devices.devtype_id = :devtype_id AND devices.company_id = :company_id';
    $arrayQuery = array();
    if($_POST['loc']){$arrayQuery['company_id']=$_POST['loc'];};
    if($_POST['devtype']){$arrayQuery['devtype_id']=$_POST['devtype'];};
    if(count($arrayQuery)>=2){
        $i = 0;
        foreach($arrayQuery as $key => $qItems){
            $i ++;
            if($i == 1){
                $query_string = 'devices.'.$key.'=:'.$key;
            }else{
                $query_string .= ' AND devices.'.$key.'=:'.$key;
            }
        }
    }else{
        $query_string = 'devices.'.key($arrayQuery).'='.':'.key($arrayQuery);
    }
    //echo $query_string;

    $sql = 'SELECT devices.*, company.company_pref, devtypes.devtype_name, devtypes.devtype_pref FROM `devices` LEFT JOIN `company` ON company.company_id = devices.company_id LEFT JOIN `devtypes` ON devtypes.devtype_id = devices.devtype_id WHERE '.$query_string.' ORDER by devices.device_num ASC LIMIT '.$pagiPage.','.$limit;
    //echo $sql;
$tb = $db->connection->prepare($sql);
$tb->execute($arrayQuery);

}
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
	
	/*echo '<pre>';
		print_r($arrAll);
	echo '</pre>';*/
//*****

$i = 0;
if(count($arrAll)>0){
    foreach ($arrAll as $Items) {
        $i++;
        switch($Items['devtype_id']){
            case '1': $colorType = '#3174E4';
                break;
            case '2': $colorType = '#B903B2';
                break;
            case '3': $colorType = '#039EB9';
                break;
            case '4': $colorType = '#B9AC03';
                break;
        }
        $deviceId = '<b style="color:#009999;">'.$Items['company_pref'].'</b> <b style="color:'.$colorType.'">'.$Items['devtype_pref'].'</b> '.$Items['device_num'];
        $deviceStatus = $Items['device_status']==1?'<i style="color:#090" class="fa fa-check"></i>':'<i style="color:#c11;" class="fa fa-times"></i>';
        $deviceKomment = $Items['device_komment'];?>
        <tr class="val <?=$Items['device_status']==0?'red-tbl-color':''?>" data-timeStmp = "<?=strtotime('now')?>" <?=$i=='1'?'id="first-row-drawing"':''?> style="display:none;">
            <td class="<?=$prefix_tbl?>_ElementTbl-1"><?=$deviceId?></td>
            <td class="<?=$prefix_tbl?>_ElementTbl-3"><?=$deviceKomment?></td>
            <td class="<?=$prefix_tbl?>_ElementTbl-2"><?=$deviceStatus?></td>
            <td class="<?=$prefix_tbl?>_ElementTbl-4"><div style="width:77px;margin: auto;"><a style="float: left;margin-right:5px;" data-id="<?=$Items['device_id'];?>" class="btn-correct-tbl corectInv" href="javascript:void(0);"><i class="fa fa-wrench"></i></a> <a style="float: left;" data-id="<?=$Items['device_id'];?>" class="btn-correct-tbl red-color delInv" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a><div style="clear:both"></div></div></td>
        </tr>
    <?}?>
<?}else{?>
<tr class="val" data-timeStmp = "<?=strtotime('now')?>" id="first-row-drawing" style="display:none;">
    <td colspan="4"><b>Очень сильно сожалеем, но ничего не нашлось :(</b></td>
</tr>
<?}?>


