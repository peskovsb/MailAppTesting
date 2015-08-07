<?
//DB connect if needed
require '../../../db.php';
$db = new DatabaseItDept();

require 'ajax_valid_body.php';
echo json_encode($rezArr);
?>
