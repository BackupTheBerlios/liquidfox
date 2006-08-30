<?
if ($lfsupertag<>"") {
			// for the rowsum tag
			$splitted_content = split("\{\[rowsum\]\}" , $lftheme['content']);
			$splt_counter = 1;
			$final_content= $splitted_content['0'];
	
			foreach ($lfsupertag as $supertag) {
				if ($supertag['take']=="part") {
					$parts = split(",", $supertag['rows']);
					foreach ($parts as $tagpart) {
						$values= split(",",$supervalue[$tagpart]);
						foreach ($values as $part_name => $part_value) {
							if ($part_value<>"") {
								if ($final_value[$part_name]=="") {
									$final_value[$part_name] = $part_value;
									}
								else {
									if ($supertag['do']=="*") {
										$final_value[$part_name] *= $part_value;
										}
									elseif ($supertag['do']=="+") {
										$final_value[$part_name] += $part_value;
										}
									elseif ($supertag['do']=="-") {
										$final_value[$part_name] -= $part_value;
										}
									elseif ($supertag['do']=="/") {
										$final_value[$part_name] /= $part_value;
										};
									$final_content .= $final_value[$part_name]. $splitted_content[$splt_counter];
									$splt_counter++;
									};
								}
							};
						
						};
					};
			
				//echo $final_content;
			
				$lftheme['content'] = $final_content;
				if ($final_value<>"") {
					foreach ($final_value as $seconddo_values) {
						// Check for row count
						if ($second_do_value == "") {
							$second_do_value = $seconddo_values;
							}
						else {
							if ($supertag['second_do']=="*") {
								$second_do_value *= $seconddo_values;
								}
							elseif ($supertag['second_do']=="+") {
								$second_do_value += $seconddo_values;
								}
							elseif ($supertag['second_do']=="-") {
								$second_do_value -= $seconddo_values;
								}
							elseif ($supertag['second_do']=="/") {
								$second_do_value /= $seconddo_values;
								}
							};
						};
					};
				if ($supertag['last_do']<>"") {
					if ($supertag['last_do']=="*") {
						$second_do_value *= $supertag['last_num'];
						}
					elseif ($supertag['last_do']=="+") {
						$second_do_value += $supertag['last_num'];
						}
					elseif ($supertag['last_do']=="-") {
						$second_do_value -= $supertag['last_num'];
						}
					elseif ($supertag['last_do']=="/") {
						$second_do_value /= $supertag['last_num'];
						};
					};

				$lftheme['content'] =str_replace($supertag['tag'] , $second_do_value ,$lftheme['content']);
				};
			};
?>