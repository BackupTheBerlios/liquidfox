<?
// tips
//count how many tips there are
$q_tip = "SELECT COUNT(*) FROM tips";
$query_tip = lfquery($q_tip);
if ($query_tip<>"") {
	$tip_result = mysql_fetch_row($query_tip);
	};
$counted_tips=$tip_result['0'];

// Random Tip
$_GET['tipid']=rand(1, $counted_tips);


// product of the week
$_GET['prodid']="1";
?>