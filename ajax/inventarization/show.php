<?
require '../db.php';
$db = new DatabaseItDept();

//-- Params
$prefix_tbl = 'inv';

//*** Query to Get Devices
//---------------------------------
$sql = 'SELECT devices.*, company.company_pref, devtypes.devtype_name, devtypes.devtype_pref FROM `devices` LEFT JOIN `company` ON company.company_id = devices.company_id LEFT JOIN `devtypes` ON devtypes.devtype_id = devices.devtype_id WHERE devices.devtype_id = 1 ORDER by devices.device_num ASC';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM devtypes';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrDevTypes = $tb->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM company';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrDevCompany = $tb->fetchAll(PDO::FETCH_ASSOC);

/*echo '<pre>';
print_r($arrAll);
echo '</pre>';*/
?>
<style>
    .table-tpl .<?=$prefix_tbl?>_ElementTbl-1{width:30%}
    .table-tpl .<?=$prefix_tbl?>_ElementTbl-2{width:10%; text-align: center;}
    .table-tpl .<?=$prefix_tbl?>_ElementTbl-3{width:45%}
    .table-tpl .<?=$prefix_tbl?>_ElementTbl-4{width:15%}
</style>










<div class="round-wrapper" style="max-width:1210;min-width:600px;">
    <a class="btn green" id="newdeviceInv" style="margin-bottom:10px;float:left;margin-right: 10px;" href="javascript:void(0);">Новое устройство</a>
    <select id="devTypeSel" class="select-tpl">
        <option value="0">-- Тип устройства --</option>
        <?foreach($arrDevTypes as $tItems){?>
            <option value="<?=$tItems['devtype_id']?>"><?=$tItems['devtype_name']?></option>
        <?}?>
    </select>
    <select name="devCompLoc" id="devCompLoc" class="select-tpl">
        <option value="0">-- Компания --</option>
        <?foreach($arrDevCompany as $cItems){?>
            <option value="<?=$cItems['company_id']?>"><?=$cItems['company_name']?></option>
        <?}?>
    </select>
    <table class="table-tpl" border="1" bordercolor="#ccc">
        <thead>
        <tr>
            <th class="<?=$prefix_tbl?>_ElementTbl-1">Устройство</th>
            <th class="<?=$prefix_tbl?>_ElementTbl-3">Комментарий</th>
            <th class="<?=$prefix_tbl?>_ElementTbl-2">Актив</th>
            <th class="<?=$prefix_tbl?>_ElementTbl-4" style="text-align: center;">Действие</th>
        </tr>
        </thead>
        <tbody>
        <tr id="start-tr" style="opacity:0;">
            <td class="<?=$prefix_tbl?>_ElementTbl-1">BL WS 000001</td>
            <td class="<?=$prefix_tbl?>_ElementTbl-3">Aaaaaaa</td>
            <td class="<?=$prefix_tbl?>_ElementTbl-2">1</td>
            <td class="<?=$prefix_tbl?>_ElementTbl-4"><div style="width:77px;margin: auto;"><a style="float: left;margin-right:5px;" data-id="0" class="btn-correct-tbl corectInv" href="javascript:void(0);"><i class="fa fa-wrench"></i></a> <a style="float: left;" data-id="0" class="btn-correct-tbl red-color delInv" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></div></td>
        </tr>
        </tbody>
    </table>
</div>
<script>
    $('#companydevselect').change(function(){
        alert('1123');
    });
</script>