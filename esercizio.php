<?php
	
	// STEP 1: the simplest thing
	// Create a simple String calculator with a method int add(String numbers).
	//
	// The method can take 0, 1 or 2 numbers, and will return their sum (for an empty string it will return 0) 
	// for example "" or "1" or "1,2".
	
	function add_step1($string = ''){
		$subStrings = explode(',', $string);
		
		$sum = 0;
		
		foreach ($subStrings as $subString){
			if ($subString == '') {
				$sum = $sum;
				}
			else {
				$sum = $sum + $subString;
				}
		}
		
		return $sum;
	}
	
	echo "<h3>RISULTATO STEP 1: </h3>";
	$res1 = add_step1();
	echo "Stringa <b>' ':</b> $res1 <br>";
	$res2 = add_step1('1');
	echo "Stringa <b>'1':</b> $res2 <br>";
	$res3 = add_step1('1,2');
	echo "Stringa <b>'1,2':</b> $res3 <br>";
	
	// STEP 2: handle an unknown amount of numbers
	// Allow the add() method to handle an unknown amount of numbers.
	
	function add_step2($string = ''){
		$subStrings = explode(',', $string);
		
		$sum = 0;
		
		foreach ($subStrings as $subString){
			if ($subString == '') {
				$sum = $sum;
				}
			else {
				$sum = $sum + $subString;
				}
		}
		
		return $sum;
	}
	
	echo "<h3>RISULTATO STEP 2: </h3>";
	$res4 = add_step2('1,2,3,4,5,6,7,8,10');
	echo "Stringa <b>'1,2,3,4,5,6,7,8,10':</b> $res4 <br>";
	
	// STEP 3: handle new lines between numbers
	// Allow the add() method to handle new lines between numbers (instead of commas).
	//
	// the following input is ok: "1\n2,3" (will equal 6)
	// the following input is NOT ok: "1,\n" (not need to prove it - just clarifying)
	
	function add_step3($string = ''){
		$subStrings = multiplExplode(array(',','\n'), $string);
		
		$sum = 0;
		
		if(count($subStrings) == 1){
		
			if ($subStrings[0] == '') {
				$sum = $sum;
				}
			else {
				$sum = $sum + $subStrings[0];
				}
			
		}
		else{
		
			foreach ($subStrings as $subString){
				if ($subString == '') {
					return 'Error: the input string is invalid.';
					}
				else {
					$sum = $sum + $subString;
				}
			}
		}
		
		return $sum;
	}
	
	function multiplExplode($delimitersArray = array(),$string = ''){
		
		$stringArray = array();
		
		$stringArray = explode($delimitersArray[0],$string);

		array_shift($delimitersArray);
		
		if($delimitersArray != NULL){
			$split = array();
			foreach($delimitersArray as $delimiter){
				$split = array();
				foreach($stringArray as $stringElement){
					$split = array_merge($split,explode($delimiter,$stringElement));
				}
				$stringArray = $split;
				
			}
			
		}
		
		return $stringArray;
	}
	
	echo "<h3>RISULTATO STEP 3: </h3>";
	$res6 = add_step3('1\n2,3');
	echo "Stringa <b>'1\n2,3':</b> $res6 <br>";
	$res7 = add_step3('1\n,');
	echo "Stringa <b>'1\n,':</b> $res7 <br>";
	
	// STEP 4: support different delimiters
	//
	// Support different delimiters: to change a delimiter, the beginning of the string will contain a 
	// separate line that looks like this:
	//
	// "//[delimiter]\n[numbers...]"
	//
	// For example "//;\n1;2" should return 3 where the default delimiter is ';'.
	//
	// The first line is optional. All existing scenarios should still be supported.
	
	function add_step4($string = ''){
		if(substr($string,0,2) =='//'){
			$delimiter = substr($string,2,1);
			$string = substr($string,5);
			$subStrings = multiplExplode(array(',','\n',$delimiter), $string);
		}
		else{
			$subStrings = multiplExplode(array(',','\n'), $string);
		}
		
		$sum = 0;
		
		if(count($subStrings) == 1){
		
			if ($subStrings[0] == '') {
				$sum = $sum;
				}
			else {
				$sum = $sum + $subStrings[0];
				}
			
		}
		else{
		
			foreach ($subStrings as $subString){
				if ($subString == '') {
					return 'Error: the input string is invalid.';
					}
				else {
					$sum = $sum + $subString;
				}
			}
		}
		
		return $sum;
	}
	
	echo "<h3>RISULTATO STEP 4: </h3>";
	$res8 = add_step4('//;\n1;2');
	echo "Stringa <b>'//;\n1;2':</b> $res8 <br>";
	$res9 = add_step4('1,2');
	echo "Stringa <b>'1,2':</b> $res9 <br>";
	
	// STEP 5: negative numbers
	//
	// Calling add() with a negative number will throw an exception "negatives not allowed" - and the negative that was passed.
	//
	// For example add("1,4,-1") should throw an exception with the message "negatives not allowed: -1".
	//
	// If there are multiple negatives, show all of them in the exception message.
	
	function add_step5($string = ''){
		if(substr($string,0,2) =='//'){
			$delimiter = substr($string,2,1);
			if ($delimiter == '-') return 'The feature "-" is not a valid delimiter.';
			$string = substr($string,5);
			$subStrings = multiplExplode(array(',','\n',$delimiter), $string);
		}
		else{
			$subStrings = multiplExplode(array(',','\n'), $string);
		}
		
		$sum = 0;
		
		if(count($subStrings) == 1){
		
			if ($subStrings[0] == '') {
				$sum = $sum;
				}
			else {
				$sum = $sum + $subStrings[0];
				}
			
		}
		else{
		
			$errorString = 'Error: negatives not allowed';
		
			foreach ($subStrings as $subString){
				
				if ($subString == '') {
					return 'Error: the input string is invalid.';
					}
				elseif (substr($subString,0,1) == '-') {
					$errorString .= ' -'. substr($subString,1,1);
				}		
				else {
					$sum = $sum + $subString;
				}
			}
			
			if($errorString != 'Error: negatives not allowed') return $errorString;
		}
		
		return $sum;
	}
	
	echo "<h3>RISULTATO STEP 5: </h3>";
	$res10 = add_step5('1,4,-1');
	echo "Stringa <b>'1,4,-1':</b> $res10 <br>";
	$res11 = add_step5('1,-4,-1');
	echo "Stringa <b>'1,-4,-1':</b> $res11 <br>";
	
	// STEP 6: ignore big numbers
	//
	// Numbers bigger than 1000 should be ignored, so adding 2 + 1001 = 2
	
	function add($string = ''){
		if(substr($string,0,2) =='//'){
			$delimiter = substr($string,2,1);
			if ($delimiter == '-') return 'The feature "-" is not a valid delimiter.';
			$string = substr($string,5);
			$subStrings = multiplExplode(array(',','\n',$delimiter), $string);
		}
		else{
			$subStrings = multiplExplode(array(',','\n'), $string);
		}
		
		$sum = 0;
		
		if(count($subStrings) == 1){
		
			if ($subStrings[0] == '') {
				$sum = $sum;
				}
			else {
				$sum = $sum + $subStrings[0];
				}
			
		}
		else{
		
			$errorString = 'Error: negatives not allowed';
		
			foreach ($subStrings as $subString){
				
				if ($subString == '') {
					return 'Error: the input string is invalid.';
					}
				elseif (substr($subString,0,1) == '-') {
					$errorString .= ' -'. substr($subString,1,1);
				}
				elseif($subString > 1000) {
					$sum = $sum;
				}		
				else {
					$sum = $sum + $subString;
				}
			}
			
			if($errorString != 'Error: negatives not allowed') return $errorString;
		}
		
		return $sum;
	}
	
	echo "<h3>RISULTATO STEP 6: </h3>";
	$res12 = add('2\n1001');
	echo "Stringa <b>'2\n1001':</b> $res12 <br>";
?>
