<?php
include('UniqueKey.php');
$UniqueKey = new UniqueKey;
$UniqueKey->SetLength(8);
$UniqueKey->SetType(5);
$return = $UniqueKey->Generate_ID(249996);//In 30 seconds you should be able to generate the key by this ID
print_r($return);
?>
