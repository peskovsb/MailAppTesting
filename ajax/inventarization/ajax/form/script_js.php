<script type="text/javascript">

function validFunction(fieldstatus,fieldname,msg){
    if(fieldstatus == 'mistake') {
        $('#'+fieldname).css({'border-color': '#c11'});
        $('.info-msgs-tbl').before('<tr class="msg-error-cover"><td></td><td><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;">'+msg+'</div></td></tr>');
        return mistake = 1;
    }
}


$('#wrapper-<?=$formBuild?>').on('submit','#<?=$formBuild?>-create,#<?=$formBuild?>-correct',function(){
    dataForm = $(this).serialize();
    formType = $(this).attr('id');
    //alert(formType);

    mistake = 0;

    $('.msg-error-cover').remove();

    //--Validation CHECK *SUBMIT
$.ajax({
    dataType: "json",
    data: dataForm,
    type: "POST",
    url : "ajax/inventarization/ajax/form/ajax_valid.php",
    success : function (data) {
        $.each( data, function( key, val ) {
<?foreach($formArr as $key => $Items){?>
<?switch($key){?>
<?case 'device_num':?>
if(formType == '<?=$formBuild?>-correct') {
    validFunction(val.<?=$key?>.mistakeIU,'<?=$Items["name"]?>',val.<?=$key?>.msg);
}
<?break;?>
<?case 'company_id':?>
<?case 'devtype_id':?>
    validFunction(val.<?=$key?>.mistakeIU,'<?=$Items["name"]?>',val.<?=$key?>.msg);
<?break;?>
<?}?>
<?}?>
        });
        if(mistake == 0 ){
            if(formType == '<?=$formBuild?>-create') {
                $('.msg-error-cover').remove();
                $('.msg-success-cover').remove();
                $.ajax({
                    dataType: "HTML",
                    data: dataForm,
                    type: "POST",
                    url: "ajax/inventarization/ajax/form/create/ajax_submit.php",
                    success: function (data) {
                        $('.info-msgs-tbl').before('<tr class="msg-success-cover"><td></td><td><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;">' + data + '</div></td>');
                        //--take major params
                        TypeSel = $('#devTypeSel').val();
                        TypeComp = $('#devCompLoc').val();

                        drawTable('inventarization','','',TypeComp,TypeSel,'30');
                    }
                });
            }else if(formType == '<?=$formBuild?>-correct'){
                $('.msg-error-cover').remove();
                $('.msg-success-cover').remove();
                if($('#<?=$prefix?>_device_status').val() == '0'){
                    if (confirm("Подтвердив, устройство в статусе нективное!")) {
                        confirmForm = 1;
                    } else {
                        confirmForm = 0;
                    }
                }else{
                    confirmForm = 1;
                }
                if(confirmForm == 1){
                    $.ajax({
                        dataType: "HTML",
                        data: dataForm,
                        type: "POST",
                        url: "ajax/inventarization/ajax/form/correct/ajax_submit.php",
                        success: function (data) {
                            $('.info-msgs-tbl').before('<tr class="msg-success-cover"><td></td><td><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;">' + data + '</div></td>');
                            //--take major params
                            TypeSel = $('#devTypeSel').val();
                            TypeComp = $('#devCompLoc').val();

                            drawTable('inventarization','','',TypeComp,TypeSel,'30');
                        }
                    });
                }
            }
        }
    }
});
    return false;
});

<?foreach($formArr as $key => $Items){?>
<?switch($key){?>
<?case 'device_num':?>
$('#wrapper-<?=$formBuild?>').on('blur','#<?=$Items["name"]?>',function(){
    $('.msg-error-cover').remove();
    dataForm = $('#<?=$formBuild?>-correct').serialize();
    $.ajax({
        dataType: "json",
        data: dataForm,
        type: "POST",
        url : "ajax/inventarization/ajax/form/ajax_valid.php",
        success : function (data) {
            $.each(data, function (key, val) {
                validFunction(val.<?=$key?>.mistakeIU, '<?=$Items["name"]?>', val.<?=$key?>.msg);
            });
        }
    });
});
$('#wrapper-<?=$formBuild?>').on('keyup','#<?=$Items["name"]?>',function() {
    $('.msg-error-cover').remove();
    $(this).css({'border-color':'#ccc'});
});
<?break;?>
<?}?>
<?}?>
$('#wrapper-<?=$formBuild?>').on('submit','#<?=$formBuild?>-delete',function(){
    dataForm = $(this).serialize();
    $.ajax({
        dataType: "HTML",
        data: dataForm,
        type: "POST",
        url : "ajax/inventarization/ajax/form/delete/ajax_submit.php",
        success : function (data) {
            $.fancybox({ closeClick  : true});
            //--take major params
            TypeSel = $('#devTypeSel').val();
            TypeComp = $('#devCompLoc').val();

            drawTable('inventarization','','',TypeComp,TypeSel,'30');


        }
    });
    return false;
});
</script>
