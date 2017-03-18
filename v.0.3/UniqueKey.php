<?php
class UniqueKey {
	
	public $default_code_length = 1;
	public $default_code_type = 1;
	public $run_default_code = TRUE;
	public $run_random_code = TRUE;
	protected $code_max_type = 8;
	
	public function __construct(){
		set_time_limit(0);
	}
	
	public function SetLength($SetLength=FALSE){
		if(is_numeric($SetLength)){
			$this->default_code_length = $SetLength;
		}
	}
	
	public function SetType($SetType=FALSE){
		if(is_numeric($SetType) AND $this->code_max_type>=$SetType){
			$this->default_code_type = $SetType;
		}
	}
	
	public function CodeCountRange($code_char_range=[]){
		$count_characters = count($code_char_range);
		return pow($count_characters, $this->default_code_length);
	}
	
	public function CodeTypes(){
		
		$CodeTypes[1]['code_name'] = '[A-Z]';
		$CodeTypes[2]['code_name'] = '[a-z]';
		$CodeTypes[3]['code_name'] = '[A-Z,a-z]';
		$CodeTypes[4]['code_name'] = '[0-9]';
		$CodeTypes[5]['code_name'] = '[A-Z,0-9]';
		$CodeTypes[6]['code_name'] = '[a-z,0-9]';
		$CodeTypes[7]['code_name'] = '[A-Z,a-z,0-9]';
		$CodeTypes[8]['code_name'] = '[A-Z,a-z,0-9,-_]';
		
		$CodeTypes[1]['code_style'] = 'Alphabetical -> Simple:Capital letters';
		$CodeTypes[2]['code_style'] = 'Alphabetical -> Simple:Small letters';
		$CodeTypes[3]['code_style'] = 'Alphabetical -> Combi:Capital and small letters';
		$CodeTypes[4]['code_style'] = 'Numerical -> Simple';
		$CodeTypes[5]['code_style'] = 'Alphabetical and Numerical -> Simple:Capital letters(Megaupload.com)';
		$CodeTypes[6]['code_style'] = 'Alphabetical and Numerical -> Simple:Small letters';
		$CodeTypes[7]['code_style'] = 'Alphabetical and Numerical -> Combi:Capital and small letters';
		$CodeTypes[8]['code_style'] = 'Alphabetical and Numerical -> Combi:Capital and small letters plus special chars(Youtube.com)';
		
		$CodeTypes[1]['code_generated_time'] = microtime(TRUE);
		$CodeTypes[2]['code_generated_time'] = microtime(TRUE);
		$CodeTypes[3]['code_generated_time'] = microtime(TRUE);
		$CodeTypes[4]['code_generated_time'] = microtime(TRUE);
		$CodeTypes[5]['code_generated_time'] = microtime(TRUE);
		$CodeTypes[6]['code_generated_time'] = microtime(TRUE);
		$CodeTypes[7]['code_generated_time'] = microtime(TRUE);
		$CodeTypes[8]['code_generated_time'] = microtime(TRUE);
		
		$CodeTypes[1]['code_char_range'] = range('A','Z');
		$CodeTypes[2]['code_char_range'] = range('a','z');
		$CodeTypes[3]['code_char_range'] = array_merge(range('A','Z'), range('a','z'));
		$CodeTypes[4]['code_char_range'] = range(0,9);
		$CodeTypes[5]['code_char_range'] = array_merge(range('A','Z'), range(0,9));
		$CodeTypes[6]['code_char_range'] = array_merge(range('a','z'), range(0,9));
		$CodeTypes[7]['code_char_range'] = array_merge(range('A','Z'), range('a','z'), range(0,9));
		$CodeTypes[8]['code_char_range'] = array_merge(range('A','Z'), range('a','z'), range(0,9),array('-','_'));
		
		$CodeTypes[1]['code_char_count'] = count($CodeTypes[1]['code_char_range']);
		$CodeTypes[2]['code_char_count'] = count($CodeTypes[2]['code_char_range']);
		$CodeTypes[3]['code_char_count'] = count($CodeTypes[3]['code_char_range']);
		$CodeTypes[4]['code_char_count'] = count($CodeTypes[4]['code_char_range']);
		$CodeTypes[5]['code_char_count'] = count($CodeTypes[5]['code_char_range']);
		$CodeTypes[6]['code_char_count'] = count($CodeTypes[6]['code_char_range']);
		$CodeTypes[7]['code_char_count'] = count($CodeTypes[7]['code_char_range']);
		$CodeTypes[8]['code_char_count'] = count($CodeTypes[8]['code_char_range']);
		
		$CodeTypes[1]['code_max_number'] = $this->CodeCountRange($CodeTypes[1]['code_char_range']);
		$CodeTypes[2]['code_max_number'] = $this->CodeCountRange($CodeTypes[2]['code_char_range']);
		$CodeTypes[3]['code_max_number'] = $this->CodeCountRange($CodeTypes[3]['code_char_range']);
		$CodeTypes[4]['code_max_number'] = $this->CodeCountRange($CodeTypes[4]['code_char_range']);
		$CodeTypes[5]['code_max_number'] = $this->CodeCountRange($CodeTypes[5]['code_char_range']);
		$CodeTypes[6]['code_max_number'] = $this->CodeCountRange($CodeTypes[6]['code_char_range']);
		$CodeTypes[7]['code_max_number'] = $this->CodeCountRange($CodeTypes[7]['code_char_range']);
		$CodeTypes[8]['code_max_number'] = $this->CodeCountRange($CodeTypes[8]['code_char_range']);
		
		$this->CodeType = $CodeTypes[$this->default_code_type];
		return $CodeTypes;
	}
	
	public function CodeInput($CodeInput=''){
		if(!empty($CodeInput)){
			$this->run_default_code = FALSE;
			$this->CodeInputOld = $CodeInput;
		}else{
			$this->run_random_code = FALSE;
		}
	}
	
	public function Search($Value,$In_Array){
		foreach($In_Array AS $KeyNumber=>$KeyString){
			if("$KeyString"=="$Value"){
				return $KeyNumber;
				break;
			}
			
		}
	}
	
	public function CodeCreateNext(){
	$code_char_count = $this->CodeType['code_char_count'];
	$code_char_range = $this->CodeType['code_char_range'];
	$code_char_range_start = reset($code_char_range);
	$code_char_range_end = end($code_char_range);
	
	$code_str_split = str_split($this->CodeInputOld);
	
	// Starts a search for the next incrementable character, ie, other than code_char_range_end
	// Note that it starts from the last character for the first character
		for($i = count($code_str_split)-1;$i>-1;$i--){
			if("$code_str_split[$i]" == "$code_char_range_end"){
				if($i==0){
				// If it is equal to code_char_range_end and is the first character, then it increases the length and zera
				$code_str_split = array_fill(0,count($code_str_split) + 1,$code_char_range_start);
				return $code_str_split;
				}else{
					$n = $i-1;
					$code_str_pos = $this->Search("$code_str_split[$n]",$code_char_range);
					if("$code_str_split[$n]" != "$code_char_range_end"){
					// If the previous character is different from code_char_range_end, it increments it and clears the current and subsequent characters
					// If the previous character is the first one, it also works, because it increments it and zeroes the others
					$code_str_split[$n] = $code_char_range[$code_str_pos + 1];
						for($j = $i; $j < count($code_str_split); $j++){
							$code_str_split[$j] = $code_char_range_start;
						}
					return $code_str_split;
					}
				}
			}else{
				$code_str_pos = $this->Search("$code_str_split[$i]",$code_char_range);
			// calculates the next character, ie, increments the current character
			$code_str_split[$i] = $code_char_range[$code_str_pos + 1];
				if($i == 0){
					// If it is the first character, it means that the others are code_char_range_end
					// That is, he zeroes them
					$novo_array = array_fill(0,count($code_str_split),$code_char_range_start);
					$novo_array[0] = $code_str_split[$i];
					$code_str_split = $novo_array;
				}
			return $code_str_split;
			}
		}
	}
	
	public function CodeCreate(){
		
		$code_char_count = $this->CodeType['code_char_count'];
		$code_char_range = $this->CodeType['code_char_range'];
		$code_char_range_start = reset($code_char_range);
		$code_char_range_end = end($code_char_range);
		//print_r($code_char_range);
		$this->code_char_base = [];
		if($this->run_default_code){
			for($n=1;$this->default_code_length>=$n;$n++){
				if($this->run_random_code){
					$this->code_char_base[] = $code_char_range[mt_rand(0,($code_char_count-1))];
				}else{
					$this->code_char_base[] = $code_char_range_start;
				}
			}
		}else{
			$this->code_char_base = $this->CodeCreateNext();
		}
	}
	
	public function CodeCountNumber() {
		$code_char_count = $this->CodeType['code_char_count'];
		$code_char_range = $this->CodeType['code_char_range'];
		
        $character_keys = array_flip($code_char_range);
        $code_characters = $this->code_char_base;
 
        $number = 0;
        for ($i = 0; $i < count($code_characters); $i++) {
                $number = $number * $code_char_count + $character_keys[$code_characters[$i]];
        }
        $this->code_pos_num = ($number+1);
	}
	
	public function Generate_String(){
		$this->CodeTypes();
		$this->CodeCreate();
		$this->CodeCountNumber();
		$code_base = implode($this->code_char_base);
		return array(
					'code_base'=>$code_base,
					'code_base_md5'=>md5($code_base),
					'code_base_sha1'=>sha1($code_base),
					'code_base64_encode'=>base64_encode($code_base),
					'code_max_number'=>$this->CodeType['code_max_number'],
					'code_pos_num'=>$this->code_pos_num,
					'code_time'=>$this->CodeType['code_generated_time'],
					'code_message'=>'',
					'code_style'=>$this->CodeType['code_style'],
					'code_name'=>$this->CodeType['code_name'],
					'code_type'=>$this->default_code_type,
					'code_max_type'=>$this->code_max_type,
					'code_length'=>$this->default_code_length
					);
	}
	
	public function Generate_ID($GenerateID){
		is_numeric($GenerateID) OR die('The ID must be numberic!');
		$this->CodeInput();
		for($i=1;$i<=$GenerateID;$i++){
			$CodeArray = $this->Generate_String();
			$this->CodeInput($CodeArray['code_base']);
			if($GenerateID>$CodeArray['code_max_number']){
				$Minus_How_Much = ($GenerateID-$CodeArray['code_max_number']);
				$CorrectID = ($GenerateID-$Minus_How_Much);
				if($CodeArray['code_pos_num']==$CorrectID){
					return $CodeArray;
					break;
				}
			}else{
				if($CodeArray['code_pos_num']==$GenerateID){
					return $CodeArray;
				}
			}
		}
	}
}
?>
