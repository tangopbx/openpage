<?php
/**
 * Openpage Module
 * 
 * @package   Openpage
 * @author    TangoPBX LLC
 * @license   GNU Affero General Public License v3.0 (AGPL-3.0)
 * @link      https://www.tangopbx.org
 * @since     2025-03-17
 * 
 * Description:
 * This file is part of the Openpage module, developed and maintained by TangoPBX LLC.
 * It provides core functionality for managing Openpage features within the TangoPBX system.
 * 
 * License:
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

namespace FreePBX\modules;

use FreePBX_Helpers;
use BMO;
use Exception;
use DateTime;
use DateTimeZone;
use PDO;

class Openpage extends FreePBX_Helpers implements BMO
{
	const GENERATE_INTERVAL = 1440; // minutes
	protected $FreePBX;
	protected $Database;
	

	/** BMO Methods */
	public function __construct($FreePBX)
	{
		$this->FreePBX = $FreePBX;
		$this->Database = $FreePBX->Database;
	}

	public function install(){
		// Create job to generate call files for scheduled pages. Every minute? Are we doing too much?
		$this->FreePBX->Job->addClass('openpage', 'scheduler', \FreePBX\modules\Openpage\Job::class, '* * * * *');
	}

	public function uninstall(){}

	public function doConfigPageInit($page) {

		if (!isset($_REQUEST['openpage_hook']) || $_REQUEST['openpage_hook'] !== 'paging') {
			return;
		}
		$raw = $_POST;
		$pagenbr = isset($raw['pagenbr']) ? (int)$raw['pagenbr'] : null;
		$enable_scheduler = isset($raw['enable_scheduler']) && strtolower($raw['enable_scheduler']) === 'yes';
		$schedule_start_date = isset($raw['schedule_start_date']) ? trim($raw['schedule_start_date']) : null;
		$schedule_end_date = isset($raw['schedule_end_date']) ? trim($raw['schedule_end_date']) : null;
		$announcement = isset($raw['openpage-announcement']) ? trim($raw['openpage-announcement']) : null;
		$timezone = isset($raw['openpage_timezone']) ? trim($raw['openpage_timezone']) : 'UTC';
		$valet = isset($raw['openpage_valet']) ? trim($raw['openpage_valet']) : 'live';
		$multicast = isset($raw['openpage-multicast']) && is_array($raw['openpage-multicast'])
			? array_map('trim', $raw['openpage-multicast'])
			: [];

		try {
			$schedule_start_date = (new DateTime($schedule_start_date))->format('Y-m-d');
		} catch (Exception $e) {
			$schedule_start_date = null;
		}

		try {
			$schedule_end_date = (new DateTime($schedule_end_date))->format('Y-m-d');
		} catch (Exception $e) {
			$schedule_end_date = null;
		}

		$events = [];

		if (isset($raw['events']) && is_array($raw['events'])) {
			foreach ($raw['events'] as $eventId => $eventData) {
				$time = isset($eventData['time']) ? trim($eventData['time']) : '';
				// Use a neutral date to avoid DST confusion, e.g., 2000-01-01
				$dateTime = new DateTime('2000-01-01 ' . $time, new DateTimeZone($timezone));
				//$dateTime->setTimezone(new DateTimeZone('UTC'));
				$events[] = [
					'days' => isset($eventData['days']) && is_array($eventData['days']) ? array_map('trim', $eventData['days']) : [],
					'comment' => isset($eventData['comment']) ? trim($eventData['comment']) : '',
					'time' => $dateTime->format('H:i:s'),
					'override_announcement' => isset($eventData['override_announcement']) ? trim($eventData['override_announcement']) : '',
				];
			}
		}

		$exclusion_dates = [];
		if (isset($raw['exclusion_dates']) && is_array($raw['exclusion_dates'])) {
			foreach ($raw['exclusion_dates'] as $exclusion) {
				$date = isset($exclusion['exclusion_date']) ? trim($exclusion['exclusion_date']) : null;
				try {
					$date = (new DateTime($date))->format('Y-m-d');
				} catch (Exception $e) {
					$date = null;
				}
				$exclusion_dates[] = [
					'date' => $date,
					'comment' => isset($exclusion['comment']) ? trim($exclusion['comment']) : '',
				];
			}
		}

		if ($enable_scheduler) {
			$this->enableScheduler($pagenbr, $schedule_start_date, $schedule_end_date, $timezone);
		} else {
			$this->disableScheduler($pagenbr);
		}

		$this->updatePageGroupEvents($pagenbr, $events);
		$this->updatePageGroupExclusionDates($pagenbr, $exclusion_dates);
		$this->updatePageGroupSettings($pagenbr, [
			'multicast' => $multicast,
			'announcement' => $announcement,
			'openpage_valet' => $valet
		]);
		//Nuke the cache incase things have changed before expiration.
		$this->FreePBX->Cache->delete('openpage_events');
	}

	public function getActionBar(){}

	public function myConfigPageInits(){
		return ['paging'];
	}

	public function ajaxRequest($command, $setting){
		return false;
	}

	public function ajaxHandler(){
		return false;
	}

	public function myDialplanHooks(){
		return 600;
	}

	public function doDialplanHook(&$ext, $engine, $priority){
		$astman = $this->FreePBX->astman;
		$context = 'ext-valet-page';
		$ext->add($context, '_X.', 'valet_page', new \ext_noop('Starting valet page for group ${EXTEN}'));
		$ext->add($context, '_X.', '', new \ext_setvar('PAGEGROUP', '${EXTEN}'));
		$ext->add($context, '_X.', '', new \ext_setvar('CHANNEL(hangup_handler_push)', 'ext-valet-hangup,${EXTEN},1'));
		$ext->add($context, '_X.', '', new \ext_setvar('RECORDED_FILE', '/var/lib/asterisk/sounds/custom/page_${EPOCH}.wav'));
		$ext->add($context, '_X.', '', new \ext_gotoif('$[${LEN(${EVENTID})}!=0]', 'skiprecord'));
		$ext->add($context, '_X.', '', new \ext_gosub('1', 's', 'sub-valet-record'));
		$ext->add($context, '_X.', '', new \ext_goto('hangup'));
		$ext->add($context, '_X.', 'skiprecord', new \ext_noop('Skipping record'));
		$ext->add($context, '_X.', '', new \ext_setvar('RECORDED_FILE',''));
		$ext->add($context, '_X.', 'hangup', new \ext_hangup());
		$ext->addInclude('from-internal-additional', $context);
		
		$context = 'ext-valet-hangup';
		$ext->add($context, '_X.', 'announcement', new \ext_setvar('ANNOUNCEMENT', '${RECORDED_FILE}'));
		$ext->add($context, '_X.', '', new \ext_noop('Event ID: ${EVENTID}'));
		$ext->add($context, '_X.', '', new \ext_noop('Exten: ${EXTEN}'));
		$ext->add($context, '_X.', '', new \ext_gotoif('$[${LEN(${EVENTID})}!=0]', 'setprependevent', 'setprependexten'));
		$ext->add($context, '_X.', 'pagegroup', new \ext_setvar('PAGE${PAGEGROUP}BUSY${EXTEN}', 'TRUE'));
		$ext->add($context, '_X.', '', new \ext_setvar('SCHEDULED', '1'));
		$ext->add($context, '_X.', '', new \ext_agi('agi://127.0.0.1/page.agi'));
		$ext->add($context, '_X.', '', new \ext_setvar('CONFBRIDGE(user,template)', 'page_user'));
		$ext->add($context, '_X.', '', new \ext_setvar('CONFBRIDGE(user,admin)', 'yes'));
		$ext->add($context, '_X.', '', new \ext_setvar('CONFBRIDGE(user,marked)', 'yes'));
		$ext->add($context, '_X.', 'openpage-page', new \ext_meetme('${PAGE_CONF}',',','admin_menu'));
		$ext->add($context, '_X.', '', new \ext_hangup());
		$ext->add($context, '_X.', '', new \ext_goto('app-pagegroup,h,1'));
		$ext->add($context, '_X.', 'skiprecord', new \ext_setvar('RECORDED_FILE', '${NEWRECORDING}'));
		$ext->add($context, '_X.', '', new \ext_goto('announcement'));
		$ext->add($context, '_X.', '', new \ext_setvar('PAGE${PAGEGROUP}BUSY${EXTEN}', ''));
		$ext->add($context, '_X.', 'busy-hang', new \ext_goto('app-pagegroups,h,1'));
		$ext->add($context, '_X.', '', new \ext_return(''));
		$ext->add($context, '_X.', 'setprependevent', new \ext_noop('Setting prepend event'));
		$ext->add($context, '_X.', '', new \ext_setvar('ANNOUNCEOVERRIDE', '${DB(OPENPAGE/${EVENTID}/annoverride)}'));
		$ext->add($context, '_X.', '', new \ext_setvar('ANNOUNCEPREPEND', '${DB(OPENPAGE/${EVENTID}/prepend)}'));
		$ext->add($context, '_X.', '', new \ext_execif('$["${ANNOUNCEPREPEND}" != ""]', 'Set', 'ANNOUNCEMENT=${ANNOUNCEPREPEND}&${RECORDED_FILE}'));
		$ext->add($context, '_X.', '', new \ext_execif('$["${ANNOUNCEOVERRIDE}" != ""]', 'Set', 'ANNOUNCEMENT=${ANNOUNCEOVERRIDE}&${RECORDED_FILE}'));
		$ext->add($context, '_X.', '', new \ext_goto('pagegroup'));

		$ext->add($context, '_X.', 'setprependexten', new \ext_noop('Setting prepend exten'));
		$ext->add($context, '_X.', '', new \ext_setvar('ANNOUNCEOVERRIDE', '${DB(OPENPAGE/${EXTEN}/annoverride)}'));
		$ext->add($context, '_X.', '', new \ext_setvar('ANNOUNCEPREPEND', '${DB(OPENPAGE/${EXTEN}/prepend)}'));
		$ext->add($context, '_X.', '', new \ext_execif('$["${ANNOUNCEPREPEND}" != ""]', 'Set', 'ANNOUNCEMENT=${ANNOUNCEPREPEND}&${RECORDED_FILE}'));
		$ext->add($context, '_X.', '', new \ext_execif('$["${ANNOUNCEOVERRIDE}" != ""]', 'Set', 'ANNOUNCEMENT=${ANNOUNCEOVERRIDE}&${RECORDED_FILE}'));
		$ext->add($context, '_X.', '', new \ext_goto('pagegroup'));
		$ext->addInclude('from-internal-additional', $context);

		$context = 'sub-valet-record';
		$ext->add($context, 's', '', new \ext_answer());
		$ext->add($context, 's', '', new \ext_background('en/openpage-record-your-page')); // "Record your page after the tone. Press # when finished"
		$ext->add($context, 's', '', new \ext_record('${RECORDED_FILE}'));
		$ext->add($context, 's', '', new \ext_background('en/openpage-your-recording-is')); // "Your page is"
		$ext->add($context, 's', '', new \ext_playback('${RECORDED_FILE}')); // Keep as Playback to ensure uninterrupted playback
		$ext->add($context, 's', '', new \ext_background('en/openpage-to-accept')); // "Press 1 to accept or 2 to re-record"
		$ext->add($context, 's', '', new \ext_read('CHOICE', '', '1')); // Read one digit
		$ext->add($context, 's', '', new \ext_gotoif('$["${CHOICE}" = "1"]', 'accept', 'check_rerecord'));
		$ext->add($context, 's', 'check_rerecord', new \ext_gotoif('$["${CHOICE}" = "2"]', 're_record', 're_record')); // Default to re-record if not 1 or 2
		$ext->add($context, 's', 're_record', new \ext_goto('s', '1'));
		$ext->add($context, 's', 'accept', new \ext_return());
		$ext->addInclude('from-internal-additional', $context);

		$context = 'sub-valet-check';
		$ext->add($context, 's', '', new \ext_noop('Checking valet mode for group ${PAGEGROUP}'));
		$ext->add($context, 's', '', new \ext_setvar('PAGE_MODE', '${PAGE_MODE}')); // Assume PAGE_MODE is set earlier or passed in
		$ext->add($context, 's', '', new \ext_gotoif('$["${PAGE_MODE}" = "force_valet"]', 'valet'));
		$ext->add($context, 's', '', new \ext_gotoif('$["${PAGE_MODE}" = "valet_on_busy"]', 'check_busy'));
		$ext->add($context, 's', '', new \ext_return('')); // If 'live' or no match, return to live paging
		$ext->add($context, 's', 'check_busy', new \ext_setvar('HINT_STATUS', '${EXTENSION_STATE(${PAGEGROUP}@ext-paging)}'));
		$ext->add($context, 's', '', new \ext_gotoif('$["${HINT_STATUS}" = "BUSY"]', 'valet'));
		$ext->add($context, 's', '', new \ext_return(''));
		$ext->add($context, 's', 'valet', new \ext_goto('valet_page', '${PAGEGROUP}', 'ext-valet-page'));
		$ext->addInclude('from-internal-additional', $context);
		$pagegroups = $this->getPagingPageGroups();

		foreach ($pagegroups as $pagegroup) {
			$apppagegroups = 'app-pagegroups';
			$pgSettings = $this->getPageGroupSettings($pagegroup['page_group']);
			$multicast = $pgSettings['multicast'];
			$announcement = $pgSettings['announcement'];
			$mode = isset($pgSettings['openpage_valet']) ? $pgSettings['openpage_valet'] : 'live';
			$ext->splice($apppagegroups, $pagegroup['page_group'], 'agi', new \ext_execif('$[${LEN(${OPENPAGEANNOUNCEMENT})}!=0]','Set', 'ANNOUNCEMENT=${OPENPAGEANNOUNCEMENT}&${ANNOUNCEMENT}'),'openpage-announcement-update');
			$ext->splice($apppagegroups, $pagegroup['page_group'], 'agi', new \ext_noop('OPENPAGEANNOUNCEMENT: ${OPENPAGEANNOUNCEMENT}'));
			$ext->splice($apppagegroups, $pagegroup['page_group'], 'agi', new \ext_execif('$["${CALLERID(name)}" = "OpenpageEvent"]', 'Set', 'EVENTID=${CALLERID(number)}'), 'openpage-event-id',-29);
			$ext->splice($apppagegroups, $pagegroup['page_group'], 'agi', new \ext_set('OPENPAGEANNOUNCEMENT',  $announcement), 'openpage-announcement',-30);
			$ext->splice($apppagegroups, $pagegroup['page_group'], '', new \ext_set('PAGE_MODE', $mode), 'openpage-page-mode');


			if(!empty($multicast)){
				$ext->splice($apppagegroups, $pagegroup['page_group'],'', new \ext_set('MCAST', implode('-', $multicast)), 'mcastpage');
			} 

			if(!empty($announcement)){
				$astman->database_put("OPENPAGE",$pagegroup['page_group']."/prepend", $announcement);
				$astman->database_put("OPENPAGE",$pagegroup['page_group']."/annoverride", $announcement);
			}else{
				$astman->database_del("OPENPAGE", $pagegroup['page_group']."/prepend");
				$astman->database_del("OPENPAGE", $pagegroup['page_group']."/annoverride");
			}

			if ($mode !== 'live') {
				$ext->splice($apppagegroups, $pagegroup['page_group'], 'agi', new \ext_gosub('1', 's', 'sub-valet-check'), 'valet-check');
			}
			$pgGrpupEvents = $this->getPageGroupEvents($pagegroup['page_group']);
			foreach($pgGrpupEvents as $event){
				if(empty($event['override_announcement'])){	
					$astman->database_del('OPENPAGE', $event['id'] . '/annoverride' );
					continue;
				}
				$astman->database_put("OPENPAGE",$event['id']."/prepend",$announcement);
				$astman->database_put("OPENPAGE",$event['id']."/annoverride",$event['override_announcement']);
			}
		}
		$this->generateEvents(true);
	}

	/** END BMO Methods */

	/**Getters */

	/**
	 * Returns an associative array of default values for a page group.
	 *
	 * @return array<string, mixed>
	 */
	public function getPageGroupDefaults(){
		return [
			'openpage_announcement' => '',
			'openpage_multicast' => [],
			'enable_scheduler' => 'no',
			'schedule_start_date' => '',
			'schedule_end_date' => '',
			'events' => [],
			'exclusion_dates' => [],
			'openpage_valet' => 'live',
			'override_announcement' => '',
			'time_zone' => 'UTC'
		];
	}

	/**
	 * Retrieves the scheduler configuration for a specified page group.
	 *
	 * @param string $id The ID of the page group to retrieve the scheduler configuration for.
	 * @return array The scheduler configuration for the page group, or null if not set.
	*/
	public function getScheduler($id): array {
		$sql = 'SELECT * from openpage_schedules WHERE id = ?';
		$stmt = $this->Database->prepare($sql);
		$stmt->execute([$id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row ?: [];
	}

	/**
	 * Returns the settings for a page group.
	 *
	 * @param string $id The ID of the page group to retrieve settings for.
	 * @return array The settings for the page group.
	 */
	public function getPageGroupSettings($id): array {
		return $this->getConfig($id, 'pagegroupsettings') ?? [];
	}

	/**
	 * Gets the page group config settings.
	 * 
	 * @param string $pagegroup
	 * @return array
	 */
	public function getPageGroup($pagegroup){
		$defaults = $this->getPageGroupDefaults();
		$scheduler = $this->getScheduler($pagegroup);

		if( !empty($scheduler) ){
			$defaults['enable_scheduler'] = 'yes';
			$defaults['schedule_start_date'] = $scheduler['schedule_start_date'];
			$defaults['schedule_end_date'] = $scheduler['schedule_end_date'];
			$defaults['time_zone'] = $scheduler['time_zone'];
		}
		$settings = $this->getPageGroupSettings($pagegroup);
		$events = $this->getPageGroupEvents($pagegroup);
		$exclusion_dates = $this->getPageGroupExclusionDates($pagegroup);

		if( !empty($events) ){
			$defaults['events'] = $events;
		}

		if( !empty($exclusion_dates) ){
			$defaults['exclusion_dates'] = $exclusion_dates;
		}

		if( !empty($settings) ){
			$defaults['openpage_announcement'] = $settings['announcement'];
			$defaults['openpage_multicast'] = $settings['multicast'];
			$defaults['openpage_valet'] = $settings['openpage_valet'];
		}
	
		return $defaults;
	}

	/**
	 * Retrieves the events for a given page group.
	 *
	 * @param string $id The page group ID.
	 * @return array The events associated with the page group.
	 */
	public function getPageGroupEvents($id) {
		$sql = "SELECT e.id, e.time, e.comment, e.override_announcement, d.day_of_week 
				FROM openpage_events e
				JOIN openpage_event_days d ON e.id = d.event_id
				WHERE e.schedule_id = ?";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute([$id]);
		$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $events;
	}

	/**
	 * Get the exclusion dates for a given page group.
	 *
	 * @param string $id The page group ID.
	 * @return array The exclusion dates.
	 */
	public function getPageGroupExclusionDates($id) {
		$sql = "SELECT exclusion_date, comment FROM openpage_exclusion_dates WHERE schedule_id = ?";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute([$id]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Generates HTML select options for all announcements in the system.
	 *
	 * @param string $selected The ID of the announcement to pre-select in the generated options.
	 * @return string The generated HTML select options.
	 */
	public function getAnnouncementOpts($selected = '', $as_array = false) {
		$announcements = [
			[
				'id' => 999,
				'displayname' => _('Bell 1'),
				'filename' => 'openpage-bell-1',
				'fcode_lang' => 'en'
			],
			[
				'id' => 998,
				'displayname' => _('Bell 2'),
				'filename' => 'openpage-bell-2',
				'fcode_lang' => 'en'
			],
			[
				'id' => 997,
				'displayname' => _('Bell 3'),
				'filename' => 'openpage-bell-3',
				'fcode_lang' => 'en'
			]
		];
		$announcements = array_merge($announcements, $this->FreePBX->Recordings->getAll());

		if( $as_array ){
			$return = [];
			$selectfound= false;
			foreach ($announcements as $announcement) {
				$return[] = ['value' => $announcement['filename'], 'label'=> $announcement['displayname'], 'selected' => $announcement['filename'] === $selected ? true : false];
				if( $announcement['filename'] === $selected ){
					$selectfound = true;
				}
			}

			array_unshift($return, ['value' => '', 'label' => _('None'), 'selected' => $selectfound === true ? 'selected' : '']);
			return $return;
		}

		$options = '<option value="">'._('None').'</option>';
		foreach ($announcements as $announcement) {
			$filename = $announcement['filename'];
			$filename = !empty($announcement['fcode_lang'] ) ? $announcement['fcode_lang'] . '/' . $filename : $filename;
			$options .= sprintf('<option value="%s" %s>%s</option>', $filename, $filename === $selected ? 'selected' : '', $announcement['displayname']);
		}
		return $options;
	}

	/** End Getters */

	/** UPDATERS/SETTERS */

	/**
	 * Update the settings for the page group with the given $id.
	 *
	 * The settings to be updated are:
	 * - Multicast: an array of IP:PORT strings
	 * - Announcement: a string
	 *
	 * The settings are stored in the pagegroupsettings database table.
	 *
	 * @param int $id The ID of the page group to update.
	 * @param array<string, mixed> $data An associative array of settings to update.
	 *  Must contain the keys 'multicast' and 'announcement'.
	*/
	public function updatePageGroupSettings($id, $data ): void {
		$insert = [
			'multicast' => $data['multicast'],
			'announcement' => $data['announcement'],
			'openpage_valet' => $data['openpage_valet']
		];

		$this->setConfig($id, $insert, 'pagegroupsettings');
	}

	/**
	 * Deletes the settings for a page group.
	 *
	 * @param string $id The ID of the page group for which the settings should be deleted.
	 * @return void
	*/
	public function deletePageGroupSettings($id): void {
		$this->setConfig($id, false, 'pagegroupsettings');
	}
	
	/**
	 * Enables the scheduler for a specified page group.
	 *
	 * @param string $id The ID of the page group for which the scheduler should be enabled.
	 * @param string $start The start date for the scheduler in 'YYYY-MM-DD' format.
	 * @param string $end The end date for the scheduler in 'YYYY-MM-DD' format.
	 * @return void
	 */
	public function enableScheduler($id, $start, $end, $timezone): void {
		$sql = "INSERT INTO openpage_schedules (id, enable_scheduler, schedule_start_date, schedule_end_date, time_zone)
				VALUES (?, 1, ?, ?, ?) 
				ON DUPLICATE KEY UPDATE enable_scheduler = 1, schedule_start_date = ?, schedule_end_date = ?, time_zone = ?";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute([$id, $start, $end, $timezone, $start, $end, $timezone]);
	}

	/**
	 * Disables the scheduler for a specified page group.
	 *
	 * @param string $id The ID of the page group for which the scheduler should be disabled.
	 * @return void
	 */
	public function disableScheduler($id): void {
		$sql = "UPDATE openpage_schedules SET enable_scheduler = 0 WHERE id = ?";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute([$id]);
	}	

	/**
	 * Updates the events for a specified page group.
	 *
	 * @param string $id The ID of the page group to update the events for.
	 * @param array $events An array of event data to associate with the page group.
	 * @return void
	 */
	public function updatePageGroupEvents($id, $events): void {
		// Remove old events
		$deleteEvents = "DELETE FROM openpage_events WHERE schedule_id = ?";
		$stmt = $this->Database->prepare($deleteEvents);
		$stmt->execute([$id]);
		foreach ($events as $event) {
			$sql = "INSERT INTO openpage_events (schedule_id, time, comment, override_announcement) VALUES (?, ?, ?, ?)";
			$stmt = $this->Database->prepare($sql);
			$stmt->execute([$id, $event['time'], $event['comment'], $event['override_announcement']]);

			$eventId = $this->Database->lastInsertId();

			foreach ($event['days'] as $day) {
				$daySql = "INSERT INTO openpage_event_days (event_id, day_of_week) VALUES (?, ?)";
				$dayStmt = $this->Database->prepare($daySql);
				$dayStmt->execute([$eventId, $day]);
			}
		}
	}

	/**
	 * Updates the exclusion dates for a page group.
	 *
	 * @param string $id The ID of the page group to update the exclusion dates for.
	 * @param array $dates An array of dates in the format 'YYYY-MM-DD' to exclude, or an empty array to remove all exclusion dates.
	 * @return void
	 */
	public function updatePageGroupExclusionDates($id, $dates): void {
		// Remove old exclusion dates
		$deleteExclusions = "DELETE FROM openpage_exclusion_dates WHERE schedule_id = ?";
		$stmt = $this->Database->prepare($deleteExclusions);
		$stmt->execute([$id]);

		foreach ($dates as $date) {
			$sql = "INSERT INTO openpage_exclusion_dates (schedule_id, exclusion_date, comment) VALUES (?, ?, ?)";
			$stmt = $this->Database->prepare($sql);
			$stmt->execute([$id, $date['date'], $date['comment']]);
		}
	}

	/**
	 * Deletes the specified page group and all associated configurations.
	 *
	 * This method removes the page group identified by the given ID from
	 * various configuration categories, including general settings, events,
	 * exclusion dates, and scheduler settings.
	 *
	 * @param string $id The ID of the page group to delete.
	 */

	public function deletePageGroup($id): void {
		$this->setConfig($id, false, 'pagegroups');
		$this->setConfig($id, false, 'pagegroups_events');
		$this->setConfig($id, false, 'pagegroups_exclusion_dates');
		$this->setConfig($id, false, 'pagegroupsettings');
		$this->setConfig($id, false, 'pagegroupsscheduler');
	}

	/** END UPDATERS/SETTERS */

	/** HOOKS */

	public function pagingHookForm(): array {
		$extension = isset($_REQUEST['extdisplay']) ? $_REQUEST['extdisplay'] : 'new';
		$openpageVars = $this->getPageGroup($extension);
		$openpageVars['announcementOptions'] = $this->getAnnouncementOpts($openpageVars['openpage_announcement']);
		$openpageVars['announceoverrideopts'] = $this->getAnnouncementOpts('', true);

		return [ 
			[
			'title' => _('Advanced Paging'),
			'rawname' => 'openpage',
			'content' => load_view(__DIR__ . '/views/pagingHook.php', $openpageVars)
			]
		];
	}

	/** END HOOKS */

	/** Utilities */

	/**
	 * Generates call files for all scheduled pages.
	 *
	 * This method generates call files for all scheduled pages and places them in the
	 * spool directory. It is intended to be called from cron or another automated
	 * process.
	 *
	 * @return array An array with a 'status' key indicating the success or failure of the operation	.
	*/
	public function generateEvents($clearcache = false): array {
		if ($this->FreePBX->Cache->contains('openpage_events') && $clearcache == false) {
			return ['status' => 'cached'];
		}

		$cache = $this->FreePBX->Cache;
		$events = $this->getUpcomingEventsInNextXMinutes(self::GENERATE_INTERVAL);
		$cache->save('openpage_events',$events, self::GENERATE_INTERVAL * 60);

		$uniqueScheduleIds = array_unique(array_column($events, 'schedule_id'));
		foreach ($uniqueScheduleIds as $scheduleId) {
			$this->removeCallFilesByPageGroup($scheduleId);
		}
		$this->FreePBX->Cache->save('openpage_events',$events);
		foreach ($events as $event) {
			$this->generateCallFile($event);
		}

		return ['status' => 'ok'];
	}

	/**
	 * Removes call files associated with a specific page group.
	 *
	 * This method searches for and deletes call files in the Asterisk spool directory
	 * that match a specific pattern associated with the given page group ID.
	 * The pattern is constructed using the provided page group ID and targets
	 * files with names following the format 'openpage_{pagegroup}_*.call'.
	 *
	 * @param string $pagegroup The ID of the page group whose call files should be removed.
	 * @return bool True if the operation completes successfully, even if no files are found.
	 */
	public function removeCallFilesByPageGroup($pagegroup): bool {
		$spooldir = $this->FreePBX->Config->get('ASTSPOOLDIR') . '/outgoing/';	
		$pagegroup = (string)$pagegroup;
		$pattern = $spooldir . 'openpage_' . $pagegroup . '_[0-1][0-9]*.call';
		$files = glob($pattern);
		foreach ($files as $file) {
			if (is_file($file)) {
				try {
					unlink($file);
				} catch (\Exception $e) {
					dbug("Failed to remove file $file: " . $e->getMessage());
				}
			}
		}
		return true;
	}

	/**
	 * Generates a single call file for a scheduled page event.
	 *
	 * This method takes an event array with keys 'schedule_id', 'unixtime', 'time', 'time_zone',
	 * and 'day_of_week' and generates a call file in the Asterisk spool directory.
	 * The call file is named openpage_{pagegroup}_{unixtime}.call and contains the
	 * Channel, Context, Extension, and Archive settings for the event. The file is
	 * created in the tmp directory and then moved to the outgoing directory with
	 * the correct timestamp.
	 *
	 * The method also handles converting the event time to UTC and adjusting the
	 * event date if the event is tomorrow within 24 hours.
	 *
	 * @param array $event An array with keys 'schedule_id', 'unixtime', 'time',
	 *                      'time_zone', and 'day_of_week' describing the event.
	 * @return bool True if the call file is created successfully.
	 */
	public function generateCallFile($event): bool {
		$spooldir = $this->FreePBX->Config->get('ASTSPOOLDIR');
		$tmp = $spooldir . '/tmp/';
		$outgoing = $spooldir . '/outgoing/';
		$callfilename = 'openpage_' . $event['schedule_id'] . '_' . $event['unixtime'] . '.call';
		$extension = $event['schedule_id'];

		// Get system and event timezones
		$systemTz = new DateTimeZone(date_default_timezone_get());
		$eventTz = new DateTimeZone($event['time_zone']);

		// Current system time
		$now = new DateTime('now', $systemTz);
		$currentDay = $now->format('D'); // e.g., "Sun"

		// Create event DateTime in its timezone
		$eventTime = $event['time']; // "19:31:00"
		$eventDateTime = new DateTime($now->format('Y-m-d') . ' ' . $eventTime, $eventTz);

		// Adjust date if event is tomorrow within 24 hours
		$timeDiff = $eventDateTime->getTimestamp() - $now->getTimestamp();
		if ($timeDiff < 0 && $timeDiff > -86400) { // Event time is earlier today
			// Check if the day_of_week suggests next day
			$daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
			$currentIndex = array_search($currentDay, $daysOfWeek);
			$eventIndex = array_search($event['day_of_week'], $daysOfWeek);
			if ($eventIndex == ($currentIndex + 1) % 7) {
				$eventDateTime->modify('+1 day');
			}
		}

		// Convert to UTC for Asterisk
		$eventDateTime->setTimezone(new DateTimeZone('UTC'));
		$adjustedUnixtime = $eventDateTime->getTimestamp();

		// Update call filename with adjusted timestamp
		$callfilename = 'openpage_' . $event['schedule_id'] . '_' . $adjustedUnixtime . '.call';

		// Create the call file
		$callfile = "Channel:Local/$extension@app-pagegroups\n";
		$callfile .= "Context:app-pagegroups\n";
		$callfile .= "Extension:$extension\n";
		if(!empty($event['override_announcement'])) {
			$callfile .= sprintf('CallerID:"%s" <%s>' . "\n", "OpenpageEvent", $event['id']);
		}
		$callfile .= "Archive:Yes\n";

		// Write the call file
		file_put_contents($tmp . $callfilename, $callfile);
		touch($tmp . $callfilename, $adjustedUnixtime, $adjustedUnixtime);
		rename($tmp . $callfilename, $outgoing . $callfilename);

		return true;
	}

	/**
	 * Returns an array of events that are scheduled to occur in the next specified number of minutes.
	 *
	 * The returned array contains the ID, time, and comment for each event. If an error occurs while
	 * performing the query, or if the query returns no results, an empty array is returned.
	 *
	 * @param int $minutes The number of minutes in the future to search for events. If not specified,
	 *                     the default is 1440 minutes (24 hours).
	 *
	 * @return array An array of events, or an empty array if no events are found.
	 * 
	 * This may not be the most elegant solution, but I have found there may be discrepancies in the timezones
	 * between mysql, php and the system. We want to allow the user to set the timezone and that may not align with anything.
	 * So we stack some queries to get all the events and then filter them in PHP which I dislike but it works.
	 * If you are smarter than me, please let fix this and earn a gold star and internet points.
	 * If you fail add a tally of failed attempts to this comment.
	*/
	public function getUpcomingEventsInNextXMinutes($minutes = 1440): array {
		try {
			$allEventsQuery = "
				SELECT e.*, s.time_zone, d.day_of_week
				FROM openpage_events e
				JOIN openpage_event_days d ON e.id = d.event_id
				JOIN openpage_schedules s ON e.schedule_id = s.id
				WHERE s.enable_scheduler = 1
				AND s.schedule_start_date <= CURDATE()
				AND s.schedule_end_date >= CURDATE()
				AND NOT EXISTS (
					SELECT 1 FROM openpage_exclusion_dates ex
					WHERE ex.schedule_id = s.id
					AND ex.exclusion_date = CURDATE()
				)
			";
			$stmt = $this->Database->prepare($allEventsQuery);
			$stmt->execute();
			$allEvents = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

			$filteredEvents = [];
			
			foreach ($allEvents as $event) {
				$timeZone = $event['time_zone'];
				$eventTime = $event['time'];

				$tz = new DateTimeZone($timeZone);
				$currentLocal = new DateTime('now', $tz);
				$currentDay = $currentLocal->format('D');

				if ($event['day_of_week'] !== $currentDay) {
					continue;
				}

				$startLocal = clone $currentLocal; // Now
				$endLocal = clone $currentLocal;
				$endLocal->modify("+{$minutes} minutes"); // Now + minutes

				$eventDateTime = DateTime::createFromFormat(
					'Y-m-d H:i:s',
					$currentLocal->format('Y-m-d') . ' ' . $eventTime,
					$tz
				);
				if ($eventDateTime === false) {
					dbug("Failed to create DateTime for " . $eventTime);
					continue;
				}

				if ($eventDateTime >= $startLocal && $eventDateTime <= $endLocal) {
					$eventDateTime->setTimezone(new DateTimeZone('UTC'));
					$event['unixtime'] = $eventDateTime->getTimestamp();
					$filteredEvents[] = $event;
				}
			}

			usort($filteredEvents, function ($a, $b) {
				return strcmp($a['time'], $b['time']);
			});

			return $filteredEvents;

		} catch (PDOException $e) {
			dbug("Database error: " . $e->getMessage());
			return [];
		}
	}

	/**
	 * Gets all page groups and their associated settings from the paging module.
	 *
	 * If the paging module is not installed, an empty array is returned.
	 *
	 * @return array An associative array with the following keys:
	 *               'page_group', 'force_page', 'duplex', 'announcement', 'volume'
	 */
	public function getPagingPageGroups(): array {
		if (!$this->FreePBX->Modules->checkStatus("paging")) {
			return [];
		}
		//The paging module doesn't have a method to just do thid so we have to do it manually
		$sql = "SELECT page_group, force_page, duplex, announcement, volume FROM paging_config";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}	
	/** END Utilities */	
}
