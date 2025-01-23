<?php

namespace FreePBX\modules;

use FreePBX_Helpers;

class Openpage extends FreePBX_Helpers
{
	protected $FreePBX
	protected $db;

	public function __construct($FreePBX)
	{
		$this->FreePBX = $FreePBX;
		$this->db = $FreePBX->Database;
	}

	public function install(){}

	public function uninstall(){}

	public function doConfigPageInit($page){}

	public function getActionBar(){}

	public function ajaxRequest($command, &$setting){
		return false;
	}

	public function ajaxHandler(){}

	public function showPage(){
		$subhead = 'Openpage';
		$content = 'Coming soon...';
		echo load_view(__DIR__ . '/views/default.php', [
			'subhead' => $subhead,
			'content' => $content
		]);
	}

}