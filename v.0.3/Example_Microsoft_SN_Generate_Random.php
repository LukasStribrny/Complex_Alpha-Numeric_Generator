<?php
include('CANG.php');
$CANG = new CANG;
$CANG->SetLength(25);
$CANG->SetType(5);
$return = $CANG->Generate_String();
echo implode('-',str_split($return['code_base'], 5));
?>
