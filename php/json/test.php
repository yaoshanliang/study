<?php
$data[0]['name'] = 'iat';
$data[0]['tel'] = 'xxx';
$data[1]['name'] = 'weitong';
$data[1]['tel'] = 'dashen';
$data_json = json_encode($data);//这就是吐出的json
// var_dump($data_json);
$data = json_decode($data_json, true);//json数据转为数组（对象）
// var_dump($data);
?>
<table>
	<tr>
		<th>name</th>
		<th>tel</th>
	</tr>
	<?php foreach($data as $key => $value) {
	?>
	<tr>
		<td><?php echo $value['name'];?></td>
		<td><?php echo $value['tel'];?></td>
	</tr>
	<?php
	}?>
</table>
