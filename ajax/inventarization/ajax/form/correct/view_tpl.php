<div id="wrapper-<?=$formBuild?>">
    <form id="<?=$formBuild?>-correct">
        <input type="hidden" value="<?=$arrDevice['device_num']?>" name="prev_num">
        <input type="hidden" value="<?=$_GET['id']?>" name="RealDev_id">
        <input type="hidden" value="correct" name="type_form">
        <div class="form-wrapper-main">
            <table class="form-tbl">
                <?foreach($formArr as $key => $Items){?>
<?switch($key){?>
<?case 'device_num':?>
<tr>
    <td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
    <td style="position: relative;">
        <input type="text" class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>" value="<?=$arrDevice['device_num']?>">
    </td>
</tr>
    <?break;?>
<?case 'company_id':?>
<tr>
    <td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
    <td style="position: relative;">
        <select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
            <option value="0">-- Компания --</option>
            <?foreach($arrCompany as $cItems){?>
                <option <?=$arrDevice['company_id']==$cItems['company_id']?'selected':''?> value="<?=$cItems['company_id']?>"><?=$cItems['company_name']?></option>
            <?}?>
        </select>
    </td>
</tr>
    <?break;?>
<?case 'devtype_id':?>
<tr>
    <td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
    <td style="position: relative;">
        <select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
            <option value="0">-- Тип устройства --</option>
            <?foreach($arrDevTypes as $dItems){?>
                <option <?=$arrDevice['devtype_id']==$dItems['devtype_id']?'selected':''?> value="<?=$dItems['devtype_id']?>"><?=$dItems['devtype_name']?></option>
            <?}?>
        </select>
    </td>
</tr>
    <?break;?>
<?case 'device_komment':?>
<tr>
    <td style="vertical-align: top;"><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
    <td style="position: relative;">
        <textarea style="resize: vertical; margin-bottom: 0px; border-color: rgb(204, 204, 204);width:100%;" class="field-tpl" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>" rows="6"><?=$arrDevice['device_komment']?></textarea>
    </td>
</tr>
    <?break;?>
<?case 'device_status':?>
<tr>
    <td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
    <td style="position: relative;">
        <select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
            <?foreach($arrStatus as $skey => $sItems){?>
                <option <?=$arrDevice['device_status']==$skey?'selected':''?> value="<?=$skey?>"><?=$sItems?></option>
            <?}?>
        </select>
    </td>
</tr>
<?break;?>
<?}?>
                <?}?>
                <tr class="lastrow-tbl">
                    <td></td>
                    <td><input class="bluebtn" name="<?=$prefix?>_SubmBtn" type="submit" value="Сохранить" style="margin:0;"> <a style="margin-left:20px;" onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a></td>
                </tr>
                <tr class="info-msgs-tbl"><td style="padding:0"></td><td style="padding:0"></td></tr>
            </table>
        </div>
    </form>
</div>