<?php
/**
    Usage: php csv_mapper.php -f <input_filename> <output_filename>
*/	
	$readfile = getcwd()."/".$argv[2]; 
	$writefile = getcwd()."/".$argv[3];
	
	///Enter your search (array key) & replace values into the $crosswalk array	
	$crosswalk =  array (	"abc" => "XYZ",
							"def" => "LMNOP",
							333 => "abcd e",
							444 => "ds sd"
						);
						
	$delimiter = chr(9);    // Use chr(9) for TAB for maximum compatibility. 
							// Some versions of PHP only accept 1 character.
							
	$match_column = 0;		// Column # to do search/replace on. Start at 0.
						
						
	$fp = fopen($writefile, 'w');
	if (($handle = fopen($readfile, "r")) !== FALSE) {
	    while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
			if (array_key_exists($row[$match_column], $crosswalk ) ) {
				$row[$match_column] = $crosswalk[$row[$match_column]];
			}
			$translated_array[] = $row;
			fputcsv($fp, $row, $delimiter, '"');
	    }
	    fclose($handle);
	}	
	fclose($fp);	
	print "Output matching file to $writefile\n";

?>