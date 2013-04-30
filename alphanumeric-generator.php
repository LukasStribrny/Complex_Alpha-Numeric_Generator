<?php

function anderson_makiyama_get_next_alphanumeric($code){
	
	$chars = str_split("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
	
	$code_array = str_split($code);
	
	//Inicia uma busca pelo próximo caractere passível de incremento, ou seja, diferente de Z
	//Note que inicia do último caractere para o primeiro
	for($i = count($code_array)-1;$i>-1;$i--){
		
		if($code_array[$i] == "Z"){
		
			if($i==0){
				//Se for igual a Z e for o primeiro caractere, então aumenta o comprimento e zera
				
				$code_array = array_fill(0,count($code_array) + 1,0);
				
				return implode("",$code_array);
			
			}else{
				
				
				if($code_array[$i -1] != 'Z'){
					//Se o caractere anterior for diferente de Z, incrementa-o e zera o atual e os subsequentes
					//Se o caractere anterior for o primeiro, também funciona, pois incrementa ele e zera os demais
					
					$code_array[$i -1] = $chars[array_search($code_array[$i -1],$chars) + 1];
					
					for($j = $i; $j < count($code_array); $j++){
					
						$code_array[$j] = 0;
						
					}
					
					return implode("",$code_array);
					
				}
				
			}
		
		}else{
				//calcula o próximo caractere, ou seja, incrementa o atual
				
				$code_array[$i] = $chars[array_search($code_array[$i],$chars) + 1];

				if($i == 0){
					//Se for o primeiro caractere, significa que os demais são z
					//Ou seja, zera eles
					
					$novo_array = array_fill(0,count($code_array),0);
					
					$novo_array[0] = $code_array[$i];
					
					$code_array = $novo_array;
				
				}
				
				return implode("",$code_array);
			
		}
		
	}

}

?>














