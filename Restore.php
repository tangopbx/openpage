<?php
namespace FreePBX\modules\Openpage;
use FreePBX\modules\Backup as Base;
class Restore Extends Base\RestoreBase{
	public function runRestore(){
		$settings = $this->getConfigs();
		$this->importKVStore($settings);
	}

	public function processLegacy($pdo, $data, $tables, $unknownTables){
		//This module didn't exist prior to 15.0.0
		return;
	}
}