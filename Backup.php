<?php
namespace FreePBX\modules\Openpage;
use FreePBX\modules\Backup as Base;
class Backup Extends Base\BackupBase{
	public function runBackup($id,$transaction){
		$settings = $this->dumpKVStore();
		$this->addConfigs($settings);
	}
}