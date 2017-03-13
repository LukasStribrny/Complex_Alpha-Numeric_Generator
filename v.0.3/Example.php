<?php
include('UniqueKey.php');
$UniqueKey = new UniqueKey;
$UniqueKey->SetLength(8);
$UniqueKey->SetType(5);

$UniqueKey->CodeInput();
$return = $UniqueKey->Generate();
print_r($return);

$UniqueKey->CodeInput($return['code_base']);
$return = $UniqueKey->Generate();
print_r($return);
?>
