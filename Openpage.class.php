<?php

namespace FreePBX\modules;

use FreePBX_Helpers;
use Ramsey\Uuid\Uuid;
use Exception;

class Openpage extends FreePBX_Helpers
{
	protected $FreePBX;
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

	public function ajaxRequest($command, $setting){
		switch($command){
			case 'getPageGroupsList':
				return true;
			default:
				return false;
		}
	}

	public function ajaxHandler(){
		$command = isset($_REQUEST['command']) ? $_REQUEST['command'] : null;
		switch($command){
			case 'getPageGroupsList':
				return $this->listPageGroups();
			default:
				return false;
		}
	}

	public function showPage(){
		$view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'default';

		switch($view){
			case 'form':
				$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 'new';
				if ( $id !== 'new' ){
					$subhead = _('Edit Page Group');
				} else {
					$subhead = _('Add Page Group');
				}
				$pagegroup = $this->getPageGroup($id);
				$pagegroup['deviceOptions'] = $this->generateDeviceSelectOptions($pagegroup['devices']);
				$pagegroup['announcementOptions'] = $this->getAnnouncementOpts($pagegroup['announcement']);
				$pagegroup['default'] = $this->getDefaultPageGroup() === $id;
				$content = load_view(__DIR__ . '/views/pageGroupForm.php', $pagegroup); 
				break;
			default:
				$subhead = _('Page Groups');
				$content = load_view(__DIR__ . '/views/pageGroupGrid.php', []);
				break;
		}
		echo load_view(__DIR__ . '/views/default.php', [
			'subhead' => $subhead,
			'content' => $content
		]);
	}

	/**
	 * Returns an associative array of default values for a page group.
	 *
	 * @return array<string, mixed>
	 */
	public function getPageGroupDefaults(){
		return [
			'extension' => '',
			'description' => '',
			'devices' => [],
			'announcement' => '',
			'busyHandling' => 'skip',
			'duplex' => false,
			'is_default' => false
		];
	}


	/**
	 * Edits a page group.
	 *
	 * @param string $id The unique ID of the page group. If set to 'new', a new page group will be created and assigned a unique ID.
	 * @param string $extension The extension of the page group.
	 * @param string $description A description of the page group.
	 * @param array<string> $devices An array of device names to include in the page group.
	 * @param string $announcement The announcement to play when paging the group.
	 * @param string $busyHandling The busy handling strategy for the page group.
	 * @param bool $duplex Whether the page group supports duplex communication.
	 *
	 * @return void
	 */
	public function editPageGroup(
		string $id,
		string $extension,
		string $description,
		array $devices,
		string $announcement,
		string $busyHandling,
		bool $duplex){
			if($id === 'new'){
				$id = Uuid::uuid4()->toString();
			}
			$inUseLocal = $this->getExtensionInUse($extension);
			$inuseGlobal = $this->FreePBX->Extensions->checkUsage($extension);
			$blockInUse = false;
			$blockMessage = '';

			if(is_array($inuseGlobal && !empty($inuseGlobal))){
				//Check if we are using it? 
				$isOurs = isset($inuseGlobal['openpage']);
				if(!$isOurs){
					$blockInUse = true;
					$blockMessage = _(sprintf('Extension %s is already in use by another module'), $extension);
				}
			}
			if($inUseLocal && $inUseLocal !== $id){
				$blockInUse = true;
				$blockMessage = _(sprintf('Extension %s is already in use by another page group'), $extension);
			}

			if($blockInUse){
				throw new Exception($blockMessage);
			}

			//TODO: Validate input,
			$devices = json_encode($devices);
			$insert = [
				'id' => $id,
				'extension' => $extension,
				'description' => $description,
				'devices' => $devices,
				'announcement' => $announcement,
				'busyHandling' => $busyHandling,
				'duplex' => $duplex
			];
			$this->setConfig($id, $insert, 'pagegroups');
			$this->setExtensionInUse($extension, $id);
			return $id;
	}

	public function setExtensionInUse(string $extension, string $id){
		$this->setConfig($extension, $id, 'pagegroupextensions');
	}

	/**
	 * Retrieves the ID of the page group that has the given extension.
	 *
	 * @param string $extension The extension to look up.
	 * @return string|null The ID of the page group, or null if no page group has the given extension.
	 */
	public function getExtensionInUse(string $extension){
		$id = $this->getConfig($extension, 'pagegroupextensions');
		if(empty($id)){
			return null;
		}
		return $id;
	}

	/**
	 * List all page groups.
	 *
	 * @return array<string, array<string, mixed>> An associative array of page groups, where each key is the page group ID and the value is an associative array containing the page group's properties.
	 */
	public function listPageGroups(){
		$pagegroups = $this->getAll('pagegroups');
		foreach ($pagegroups as $key => $value) {
			$pagegroups[$key]['devices'] = json_decode($value['devices'], true);
			$pagegroups[$key]['is_default'] = $this->getDefaultPageGroup() === $key;
		}
		return $pagegroups;
	}

	/**
	 * Retrieve a page group by its ID.
	 *
	 * If the page group does not exist, return default values for a new page group with the ID set to 'new'.
	 *
	 * @param string $id The unique ID of the page group to retrieve.
	 * @return array<string, mixed> An associative array representing the page group, including its properties.
	 */
	public function getPageGroup(string $id){
		$pagegroup = $this->getConfig($id, 'pagegroups');
		if(empty($pagegroup)){
			$pagegroup = $this->getPageGroupDefaults();
			$pagegroup['id'] = 'new';
			return $pagegroup;
		}
		$pagegroup['devices'] = json_decode($pagegroup['devices'], true);
		$pagegroup['is_default'] = $this->getDefaultPageGroup() === $id;
		return $pagegroup;
	}

	/**
	 * Delete a page group by its ID.
	 *
	 * @param string $id The unique ID of the page group to delete.
	 * @return void
	 */
	public function deletePageGroup(string $id){
		$this->deleteConfig($id, 'pagegroups');
	}

	/**
	 * Sets the default page group for the module.
	 *
	 * @param string $id The unique ID of the page group to set as the default.
	 * @return void
	 */
	public function setDefaultPageGroup(string $id){
		$this->setConfig('defaultPageGroup', $id);
	}

	/**
	 * Retrieve the default page group ID for the module.
	 *
	 * @return string|null The unique ID of the default page group, or null if not set.
	 */
	public function getDefaultPageGroup(){
		return $this->getConfig('defaultPageGroup');
	}

	/**
	 * Retrieves a list of all PJSIP devices on the system.
	 *
	 * @return array A list of all PJSIP devices, with each device represented as an associative array containing the keys 'id', 'dial', and 'description'.
	 */
	public function getDevices(): array {
		$allDevices = $this->FreePBX->Core->getAllDevicesByType('pjsip');
		$devices = array_map(function (array $device): array {
			return [
				'id' => $device['id'],
				'dial' => $device['dial'],
				'description' => $device['description'],
			];
		}, $allDevices);
		return $devices;
	}

	/**
	 * Generate HTML select options for all PJSIP devices in the system.
	 *
	 * @param array $selectedDevices An array of device IDs to pre-select in the generated options.
	 * @return string The generated HTML select options.
	 */
	public function generateDeviceSelectOptions($selectedDevices = []){
		$devices = $this->getDevices();
		$options = '';
		foreach ($devices as $device) {
			$options .= sprintf('<option value="%s" %s>%s</option>', $device['id'], in_array($device['id'], $selectedDevices) ? 'selected' : '', $device['description']);
		}
		return $options;
	}

	/**
	 * Generates HTML select options for all announcements in the system.
	 *
	 * @param string $selected The ID of the announcement to pre-select in the generated options.
	 * @return string The generated HTML select options.
	 */
	public function getAnnouncementOpts($selected = ''){
		$announcements = $this->FreePBX->Announcement->getAnnouncements();
		$options = '<option value="">'._('None').'</option>';
		foreach ($announcements as $announcement) {
			$options .= sprintf('<option value="%s" %s>%s</option>', $announcement['id'], $announcement['id'] === $selected ? 'selected' : '', $announcement['description']);
		}
		return $options;
	}
}