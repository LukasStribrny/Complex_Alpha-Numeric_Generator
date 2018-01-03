<?php
include_once('CANG.php');
class MS_G extends CANG {
	
	public function __construct(){
		parent::__construct();
		$this->SetLength(25);
		$this->SetType(5);
	}
	
	public function byID($NUM_ID){
		foreach ($this->Generate_ID($NUM_ID) AS $return_key=>$return_value){
			if($return_key=='code_base'){
				$new_return[$return_key] = implode('-',str_split($return_value, 5));
			}elseif($return_key=='code_description'){
				$new_return[$return_key] = str_replace('Megaupload','Microsoft',$return_value);
			}else{
				$new_return[$return_key] = $return_value;
			}
		}
		return $new_return;
	}
	
	public function byRAND(){
		foreach($this->Generate_String() AS $return_key=>$return_value){
			if($return_key=='code_base'){
				$new_return[$return_key] = implode('-',str_split($return_value, 5));
			}elseif($return_key=='code_description'){
				$new_return[$return_key] = str_replace('Megaupload','Microsoft',$return_value);
			}else{
				$new_return[$return_key] = $return_value;
			}
		}
		return $new_return;
	}
	
	public function bySTRING($STRING=''){
		if($STRING){
			$Input = str_replace('-','',$STRING);
		}else{
			$Input = '';
		}
		$this->CodeInput($Input);
		foreach($this->Generate_String() AS $return_key=>$return_value){
			if($return_key=='code_base'){
				$new_return[$return_key] = implode('-',str_split($return_value, 5));
			}elseif($return_key=='code_description'){
				$new_return[$return_key] = str_replace('Megaupload','Microsoft',$return_value);
			}else{
				$new_return[$return_key] = $return_value;
			}
		}
		return $new_return;
	}
}
?>
