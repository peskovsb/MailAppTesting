<div id="wrapper-<?=$formBuild?>">
    <form id="<?=$formBuild?>-delete">
        <input type="hidden" name="dev_id" id="InvDev_id" value="<?=$_GET['id']?>">
        <div class="form-wrapper-main">
            <table class="form-tbl">

                <tr>
                    <td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
                    <td style="position: relative;">
                        <h2>Вы уверены, что хотите удалить это устройство?</h2>
                    </td>
                </tr>
                <tr class="lastrow-tbl">
                    <td></td>
                    <td><input class="btn red" type="submit" value="Удалить устройство" style="margin:0;color: #ffffff;"> <a style="margin-left:20px;" onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a></td>
                </tr>
                <tr class="info-msgs-tbl"><td style="padding:0"></td><td style="padding:0"></td></tr>
            </table>
        </div>
    </form>
</div>