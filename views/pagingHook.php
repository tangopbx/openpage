<input type="hidden" name="openpage_hook" value="paging">
<!-- Announcement -->
<div class="element-container">
	<div class="row">
		<div class="form-group">
			<div class="col-md-3">
				<label class="control-label" for="openpage-announcement"><?php echo _("Prepend Announcement") ?></label>
				<i class="fa fa-question-circle fpbx-help-icon" data-for="openpage-announcement"></i>
			</div>
			<div class="col-md-9">
				<select id='openpage-announcement' name='openpage-announcement' class='form-control'>
					<?php echo $announcementOptions; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="openpage-announcement-help" class="help-block fpbx-help-block"><?php echo _("Enter the announcement for the page group. This will be added before to all pages sent to the page group.") ?></span>
		</div>
	</div>
</div>
<!-- End Announcement -->

<!-- RTP Multicast -->
<div class="element-container">
	<div class="row">
		<div class="form-group">
			<div class="col-md-3">
				<label class="control-label" for="openpage-multicast"><?php echo _("Multicast Address"); ?></label>
				<i class="fa fa-question-circle fpbx-help-icon" data-for="openpage-multicast"></i>
			</div>
			<div class="col-md-9">
				<div id="multicast-form">
					<div id="input-rows">
						<div class="input-group mb-2">
							<input type="text" class="form-control" id="openpage-multicast" name="openpage-multicast" placeholder="IP:PORT">
							<div class="input-group-append">
								<button type="button" class="btn btn-danger btn-sm remove-row">×</button>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-success btn-sm" id="add-row"><?php echo _("Add Row"); ?></button>
				</div>
				<button type="button" class="btn btn-secondary btn-sm mt-2" data-toggle="modal" data-target="#rawEditModal">
					<?php echo _("Raw Edit"); ?>
				</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="openpage-multicast-help" class="help-block fpbx-help-block">
				<?php echo _("Enter the multicast address for the page group. In the format IP:PORT. Example: 239.83.100.101:33355. <br/> The range 239.0.0.0 to 239.255.255.255 is reserved for private, administratively scoped multicast addresses."); ?>
			</span>
		</div>
	</div>
</div>
<!-- End RTP Multicast -->

<!-- Modal for Raw Edit -->
<div class="modal fade" id="rawEditModal" tabindex="-1" role="dialog" aria-labelledby="rawEditModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="rawEditModalLabel"><?php echo _("Raw Edit"); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<textarea id="raw-textarea" class="form-control" rows="5"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("Cancel"); ?></button>
				<button type="button" class="btn btn-primary" id="save-raw"><?php echo _("Save"); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal for Raw Edit -->

<!-- Openpage Valet Mode -->
<div class="element-container">
	<div class="row">
		<div class="form-group">
			<div class="col-md-3">
				<label class="control-label" for="openpage-valet"><?php echo _("Valet Mode"); ?></label>
				<i class="fa fa-question-circle fpbx-help-icon" data-for="openpage-valet"></i>
			</div>
			<div class="col-md-9">
				<span class="radioset">
					<input type="radio" name="openpage_valet" id="openpage-valet-live" value="live" <?php echo (!isset($openpage_valet) || $openpage_valet == "live" ? "CHECKED" : ""); ?>>
					<label for="openpage-valet-live"><?php echo _("Live (Normal)"); ?></label>
					<input type="radio" name="openpage_valet" id="openpage-valet-force" value="force_valet" <?php echo ($openpage_valet == "force_valet" ? "CHECKED" : ""); ?>>
					<label for="openpage-valet-force"><?php echo _("Valet"); ?></label>
					<input type="radio" name="openpage_valet" id="openpage-valet-busy" value="valet_on_busy" <?php echo ($openpage_valet == "valet_on_busy" ? "CHECKED" : ""); ?>>
					<label for="openpage-valet-busy"><?php echo _("Force Valet Busy"); ?></label>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="openpage-valet-help" class="help-block fpbx-help-block"><?php echo _("Select the valet mode operation for the page group. Live will act as a normal page with no functionality change. Valet will redirect you to record the page then page when you hangup. Valet on busy will redirect you to record the page when the page group is busy."); ?></span>
		</div>
	</div>
</div>

<!-- Enable Scheduler Toggle -->
<div class="element-container">
	<div class="row">
		<div class="form-group">
			<div class="col-md-3">
				<label class="control-label" for="openpage-enable-scheduler"><?php echo _("Enable Scheduler"); ?></label>
				<i class="fa fa-question-circle fpbx-help-icon" data-for="openpage-enable-scheduler"></i>
			</div>
			<div class="col-md-9">
				<span class="radioset">
					<input type="radio" name="enable_scheduler" id="openpage-enable-scheduler-yes" value="yes" <?php echo ($enable_scheduler == "yes" ? "CHECKED" : ""); ?>>
					<label for="openpage-enable-scheduler-yes"><?php echo _("Yes"); ?></label>
					<input type="radio" name="enable_scheduler" id="openpage-enable-scheduler-no" value="no" <?php echo ($enable_scheduler == "no" ? "CHECKED" : ""); ?>>
					<label for="openpage-enable-scheduler-no"><?php echo _("No"); ?></label>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<span id="openpage-enable-scheduler-help" class="help-block fpbx-help-block"><?php echo _("Enable the scheduler for the page group."); ?></span>
		</div>
	</div>
</div>

<!-- Scheduler Inputs -->
<div id="scheduler-inputs" style="display: <?php echo ($enable_scheduler == "yes" ? "block" : "none"); ?>;">
	<!-- Schedule Range -->
	<div class="element-container">
		<h5><?php echo _("Schedule Range"); ?></h5>
		<div class="row">
			<div class="col-md-6">
				<label for="schedule_start_date"><?php echo _("Start Date"); ?></label>
				<input type="date" id="schedule_start_date" name="schedule_start_date" class="form-control" value="<?php echo htmlspecialchars($schedule_start_date); ?>">
			</div>
			<div class="col-md-6">
				<label for="schedule_end_date"><?php echo _("End Date"); ?></label>
				<input type="date" id="schedule_end_date" name="schedule_end_date" class="form-control" value="<?php echo htmlspecialchars($schedule_end_date); ?>">
			</div>
		</div>
	</div>
	<!-- Timezone -->
	<div class="element-container">
		<h5><?php echo _("Timezone"); ?></h5>
		<div class="row">
			<div class="col-md-12">
				<label for="openpage_timezone"><?php echo _("Select Timezone"); ?></label>
				<select id="openpage_timezone" name="openpage_timezone" class="form-control">
					<?php
					$default_timezone = date_default_timezone_get();
					$timezones = timezone_identifiers_list();

					// Determine the selected timezone (prioritize $openpage_timezone if set and valid)
					$selected_timezone_to_use = $default_timezone;
					if (isset($openpage_timezone) && in_array($openpage_timezone, $timezones)) {
						$selected_timezone_to_use = $openpage_timezone;
					}

					// Group timezones by continent/region
					$grouped_timezones = [];
					foreach ($timezones as $timezone) {
						$parts = explode('/', $timezone, 2); // Split into Region/Location
						$region = $parts[0];
						$location = isset($parts[1]) ? str_replace('_', ' ', $parts[1]) : ''; // Handle cases with only a region

						if (!isset($grouped_timezones[$region])) {
							$grouped_timezones[$region] = [];
						}
						$grouped_timezones[$region][$timezone] = $location;
					}

					// Output the optgroups and options
					foreach ($grouped_timezones as $region => $locations) {
						echo "<optgroup label=\"" . htmlspecialchars($region) . "\">";
						foreach ($locations as $timezone => $location) {
							$selected = ($timezone == $selected_timezone_to_use) ? 'selected="selected"' : '';
							$display_name = empty($location) ? htmlspecialchars($region) : htmlspecialchars($location); // Display region if no location
							$display_name = $location ?  htmlspecialchars($region . '/' . $location ): htmlspecialchars($region);

							echo "<option value=\"{$timezone}\" {$selected}>{$display_name}</option>";
						}
						echo "</optgroup>";
					}
					?>
				</select>
			</div>
		</div>
	</div>

	<!-- Events -->
	<div id="events-container">
		<div class="row mb-2">
			<div class="col-md-12"><h3><?php echo _("Events"); ?></h3></div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><strong>Days</strong></div>
			<div class="col-md-3"><strong>Comment</strong></div>
			<div class="col-md-2"><strong>Time</strong></div>
			<div class="col-md-2"><strong>Announcement Override (optional)</strong></div>
			<div class="col-md-1"></div>
		</div>
		<?php
		$eventsById = [];
		foreach ($events as $event) {
			// Existing PHP code for grouping events
			if (!isset($eventsById[$event['id']])) {
				$eventsById[$event['id']] = [
					'comment' => $event['comment'],
					'time' => $event['time'],
					'days' => [],
					'override_announcement' => $event['override_announcement'] ?? ''
				];
			}
			$eventsById[$event['id']]['days'][] = $event['day_of_week'];
		}
		echo '<script>var announceoverrideopts = ' . json_encode($announceoverrideopts) . ';</script>';
		foreach ($eventsById as $eventId => $eventData):
		?>
				<div class="event-row">
					<div class="row mb-2">
						<div class="col-md-4">
							<div class="btn-group btn-group-toggle days-group" data-toggle="buttons">
								<?php foreach (["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"] as $day): ?>
									<label class="btn btn-outline-primary btn-sm <?php echo in_array($day, $eventData['days']) ? 'active' : ''; ?>">
										<input type="checkbox" autocomplete="off" name="events[<?php echo $eventId; ?>][days][]" value="<?php echo $day; ?>" <?php echo in_array($day, $eventData['days']) ? 'checked' : ''; ?>>
										<?php echo $day ?>
									</label>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="col-md-3">
							<input type="text" name="events[<?php echo $eventId; ?>][comment]" class="form-control" value="<?php echo htmlspecialchars($eventData['comment']); ?>" placeholder="<?php echo _("Comment"); ?>">
						</div>
						<div class="col-md-2">
							<input type="time" name="events[<?php echo $eventId; ?>][time]" class="form-control" value="<?php echo htmlspecialchars($eventData['time']); ?>">
						</div>
						<div class="col-md-2">
							<select name="events[<?php echo $eventId; ?>][override_announcement]" class="form-control">
								<?php foreach ($announceoverrideopts as $option): ?>
									<option value="<?php echo $option['value']; ?>" 
										<?php echo $eventData['override_announcement'] === $option['value'] ? 'selected' : ''; ?>>
										<?php echo htmlspecialchars($option['label']); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-1 text-right">
							<button type="button" class="btn btn-danger btn-sm remove-event" data-event-id="<?php echo $eventId; ?>"><i class="fa fa-trash"></i></button>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<button type="button" id="add-event" class="btn btn-success btn-sm"><?php echo _("Add Event"); ?></button>
	</div>
	<br/>
	<!-- Exclusion Dates -->
	<div class="element-container">
		<h5><?php echo _("Exclusion Dates");?></h5>
		<div id="exclusion-dates-container">
			<?php foreach ($exclusion_dates as $key => $exclusion):?>
				<div class="row mb-2 exclusion-row" data-key="<?php echo $key;?>">
					<div class="col-md-5">
						<input type="date" name="exclusion_dates[<?php echo $key;?>][exclusion_date]" class="form-control" value="<?php echo htmlspecialchars($exclusion['exclusion_date']);?>">
					</div>
					<div class="col-md-5">
						<input type="text" name="exclusion_dates[<?php echo $key;?>][comment]" class="form-control" value="<?php echo htmlspecialchars($exclusion['comment']);?>" placeholder="<?php echo _("Comment");?>">
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-danger btn-sm remove-exclusion"><i class="fa fa-trash"></i></button>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<button type="button" id="add-exclusion-date" class="btn btn-success btn-sm"><?php echo _("Add Exclusion");?></button>
	</div>
</div>
<!-- End Scheduler Inputs -->

<!-- Openpage js code -->

<div id="events-container" data-event-index="<?php echo count($events); ?>"></div>
<div id="exclusion-dates-container" data-exclusion-index="<?php echo count($exclusion_dates); ?>"></div>
<div id="multicast-container" data-multicast='<?php echo json_encode($openpage_multicast); ?>'></div>
<div id ="announceoverrideopts" data-announceoverrideopts='<?php echo json_encode($announceoverrideopts); ?>'></div>
<script src="/admin/modules/openpage/assets/js/openpage.js"></script>