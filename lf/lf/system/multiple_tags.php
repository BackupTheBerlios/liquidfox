<?
	$tagged = show_tag ($lftheme,  $tagquery['tag'],$tagquery['num'], $tagquery, "theme");
	while ($lftheme['content']<>$tagged['content']) {
		$lftheme['content'] = $tagged['content'];
		$tagged = show_tag ($lftheme,  $tagquery['tag'],$tagquery['num'], $tagquery, "theme");
		}

?>