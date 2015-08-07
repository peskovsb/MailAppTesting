<div id="wrapper-<?=$formBuild?>">
    <form id="<?=$formBuild?>-create">
        <div class="form-wrapper-main">
            <table class="form-tbl">
                <?foreach($formArr as $key => $Items){?>
<?switch($key){?>
<?case 'company_id':?>
<tr>
    <td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
    <td style="position: relative;">
        <select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
            <option value="0">-- Компания --</option>
            <?foreach($arrCompany as $cItems){?>
                <option value="<?=$cItems['company_id']?>"><?=$cItems['company_name']?></option>
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
                <option value="<?=$dItems['devtype_id']?>"><?=$dItems['devtype_name']?></option>
            <?}?>
        </select>
    </td>
</tr>
    <?break;?>
<?case 'device_komment':?>
<tr>
    <td style="vertical-align: top;"><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
    <td style="position: relative;">
        <textarea style="resize: vertical; margin-bottom: 0px; border-color: rgb(204, 204, 204);width:100%;" class="field-tpl" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>" rows="6"></textarea>
    </td>
</tr>
    <?break;?>
<?case 'device_status':?>
<tr>
    <td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
    <td style="position: relative;">
        <select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
            <?foreach($arrStatus as $skey => $sItems){?>
                <option value="<?=$skey?>"><?=$sItems?></option>
            <?}?>
        </select>
    </td>
</tr>
<?break;?>
<?}?>
                <?}?>
                <tr class="lastrow-tbl">
                    <td></td>
                    <td><input class="btn green" type="submit" value="Создать устройство" style="margin:0;"> <a style="margin-left:20px;" onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a></td>
                </tr>
                <tr class="info-msgs-tbl"><td style="padding:0"></td><td style="padding:0"></td></tr>
            </table>
        </div>
    </form>
</div>