<?php 

function openpage_check_extensions($extension = true){
	$openpage = FreePBX::Openpage();
	$extensions = [];
	if(empty($extension)){
		return $extensions;
	}
	$pagegroups = $openpage->listPageGroups();
	foreach($pagegroups as $pagegroup){
		$extensions[$pagegroup['extension']] = [
			'description' => sprintf(_("Page Group %s"), $pagegroup['extension']),
			'status' => 'INUSE',
			'edit_url' => 'config.php?display=openpage&view=form&id='.$pagegroup['id']
		];
	}
	return $extensions;
}
