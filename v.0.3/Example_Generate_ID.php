<?php
include('CANG.php');
$CANG = new CANG;
$CANG->SetLength(8);
$CANG->SetType(5);
$return = $CANG->Generate_ID(249996);//You should be able to generate the key by any input ID
print_r($return);
?>
