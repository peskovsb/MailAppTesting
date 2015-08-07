<?
require 'formArr.php';

//-- Params
$mistake = 0;

foreach ($formArr as $key => $Items) {
switch($key) {
case 'device_num':
    if(preg_match("/[^0-9]/", $_POST[$Items['name']])){
        $rezArr[0][$key]['mistakeIU'] = 'mistake';
        $rezArr[0][$key]['msg'] = 'Ошибка в поле: "'.$Items['title'].'": Только цифры!';
        $mistake = 1;
    }else{
        if($_POST['type_form'] == 'correct'){
           if(strlen($_POST[$Items['name']])!=6){
               $rezArr[0][$key]['mistakeIU'] = 'mistake';
               $rezArr[0][$key]['msg'] = 'Ошибка: Должно быть 6 цифр в поле: "'.$Items['title'].'"';
               $mistake = 1;
           }else{
               $sql = 'SELECT * FROM devices WHERE devtype_id = :devtype_id AND device_num = :device_num';
               $tb = $db->connection->prepare($sql);
               $tb->execute(array(':devtype_id'=>$_POST[$formArr['devtype_id']['name']],':device_num'=>$_POST[$formArr['device_num']['name']]));
               $DevId = $tb->fetch(PDO::FETCH_ASSOC);
               //echo $DevId['device_id'];
               if($DevId['device_id'] AND $_POST[$formArr['device_num']['name']] != $_POST['prev_num']){
                   $rezArr[0][$key]['mistakeIU'] = 'mistake';
                   $rezArr[0][$key]['msg'] = 'Ошибка! Такое устройство уже существует!';
                   $mistake = 1;
               }else{
                   $rezArr[0][$key]['mistakeIU'] = 'nomistake';
               }
           }
        }else{
            $rezArr[0][$key]['mistakeIU'] = 'nomistake';
        }
    }
break;
case 'company_id':
case 'devtype_id':
    if($_POST[$Items['name']]==0) {
        $rezArr[0][$key]['mistakeIU'] = 'mistake';
        $rezArr[0][$key]['msg'] = 'Не выбрано поле: "'.$Items['title'].'"';
        $mistake = 1;
    }else{
        $rezArr[0][$key]['mistakeIU'] = 'nomistake';
    }
break;
}
}
?>
