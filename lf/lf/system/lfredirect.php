<?
include "redirects.php";
foreach ($lfredirect_set as $redir) {
	if (($redir['name'] == $_POST['lfredirect']) OR ($redir['name'] == $_GET['lfredirect'])) {
		$values_array=split(",",$redir['values']);
		$step="1";
		foreach ($values_array as $value) {
			if ($step == "3" ) { $step="1"; };
			if ($step == "1" ) {
				$redir['url'] = $redir['url']."&". $value."=";
				}
			else {
				$redir['url'] = $redir['url']. $value;
				};
			$step=$step+1;
			};
		header ("Location: ../". $redir['url']);
		};
	}
?>