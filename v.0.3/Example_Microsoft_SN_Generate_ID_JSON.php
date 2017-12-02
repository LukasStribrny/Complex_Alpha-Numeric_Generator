<?php
include('CANG.php');
$CANG = new CANG;
$CANG->SetLength(25);
$CANG->SetType(5);
$return = $CANG->Generate_ID(249996000001111333338888555578963201457);//In 30 seconds you should be able to generate the key by this ID
foreach ($return AS $return_key=>$return_value){
	if($return_key=='code_base'){
		$new_return[$return_key] = implode('-',str_split($return_value, 5));
	}else{
		$new_return[$return_key] = $return_value;
	}
}
header("Content-type:application/json");
echo json_encode($new_return,true);
?>
