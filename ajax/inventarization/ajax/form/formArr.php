<?
//-- params
$formId = 'invForm';
$prefix = 'inv';
$formBuild = $prefix.'_'.$formId;

$formArr = array(
	'device_num' =>
		array(
			'name' => $prefix.'_device_num',
			'title' => 'Номер устройства'
		),
	'company_id' =>
		array(
			'name' => $prefix.'_company_id',
			'title' => 'Компания'
		),
	'devtype_id' =>
		array(
			'name' => $prefix.'_devtype_id',
			'title' => 'Тип устройства'
		),
	'device_komment' =>
		array(
			'name' => $prefix.'_device_komment',
			'title' => 'Комментарий'
		),
	'device_status' =>
		array(
			'name' => $prefix.'_device_status',
			'title' => 'Статус устройства'
		)
);
?>