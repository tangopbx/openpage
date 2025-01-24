<form action="" method="post" class="fpbx-submit" id="pagegroupform" name="pagegroupform" data-fpbx-delete="config.php?display=pagegroup&action=delete&id=<?php echo $_REQUEST['id'] ?? 'new'; ?>">
	<input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?? 'new'; ?>">
	<input type="hidden" name="action" value="<?php echo isset($_REQUEST['id']) && $_REQUEST['id'] !== 'new' ? 'edit' : 'add'; ?>">

	<!-- Extension -->
	<div class="element-container">
		<div class="row">
			<div class="form-group">
				<div class="col-md-3">
					<label class="control-label" for="extension"><?php echo _("Extension") ?></label>
					<i class="fa fa-question-circle fpbx-help-icon" data-for="extension"></i>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control" id="extension" name="extension" value="<?php echo $extension ?? ''; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span id="extension-help" class="help-block fpbx-help-block"><?php echo _("Enter the extension for the page group.") ?></span>
			</div>
		</div>
	</div>

	<!-- Description -->
	<div class="element-container">
		<div class="row">
			<div class="form-group">
				<div class="col-md-3">
					<label class="control-label" for="description"><?php echo _("Description") ?></label>
					<i class="fa fa-question-circle fpbx-help-icon" data-for="description"></i>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control" id="description" name="description" value="<?php echo $description ?? ''; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span id="description-help" class="help-block fpbx-help-block"><?php echo _("Enter a description for the page group.") ?></span>
			</div>
		</div>
	</div>

	<!-- Devices -->
	<div class="element-container">
		<div class="row">
			<div class="form-group">
				<div class="col-md-3">
					<label class="control-label" for="devices"><?php echo _("Devices") ?></label>
					<i class="fa fa-question-circle fpbx-help-icon" data-for="devices"></i>
				</div>
				<div class="col-md-9">
					<select id='devices'  name='devices' multiple='multiple' class = 'form-control chosen-select'>
						<?php echo $deviceOptions; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span id="devices-help" class="help-block fpbx-help-block"><?php echo _("Enter a comma-separated list of devices.") ?></span>
			</div>
		</div>
	</div>

	<!-- Announcement -->
	<div class="element-container">
		<div class="row">
			<div class="form-group">
				<div class="col-md-3">
					<label class="control-label" for="announcement"><?php echo _("Announcement") ?></label>
					<i class="fa fa-question-circle fpbx-help-icon" data-for="announcement"></i>
				</div>
				<div class="col-md-9">
					<select id='announcement' name='announcement' class = 'form-control'>
						<?php echo $announcementOptions; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span id="announcement-help" class="help-block fpbx-help-block"><?php echo _("Enter the announcement for the page group.") ?></span>
			</div>
		</div>
	</div>

	<!-- Busy Extensions -->
	<div class="element-container">
		<div class="row">
			<div class="form-group">
				<div class="col-md-3">
					<label class="control-label" for="busyHandling"><?php echo _("Busy Extensions") ?></label>
					<i class="fa fa-question-circle fpbx-help-icon" data-for="busyHandling"></i>
				</div>
				<div class="col-md-9">
					<span class="radioset">
						<input type="radio" name="busyHandling" id="busySkip" value="skip" <?php echo isset($busyHandling) && $busyHandling === "skip" ? 'CHECKED' : ''; ?>>
						<label for="busySkip"><?php echo _("Skip"); ?></label>
						<input type="radio" name="busyHandling" id="busyForce" value="force" <?php echo isset($busyHandling) && $busyHandling === "force" ? 'CHECKED' : ''; ?>>
						<label for="busyForce"><?php echo _("Force"); ?></label>
						<input type="radio" name="busyHandling" id="busyWhisper" value="whisper" <?php echo isset($busyHandling) && $busyHandling === "whisper" ? 'CHECKED' : ''; ?>>
						<label for="busyWhisper"><?php echo _("Whisper"); ?></label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span id="busyHandling-help" class="help-block fpbx-help-block"><?php echo _("Select how to handle busy extensions.") ?></span>
			</div>
		</div>
	</div>

	<!-- Duplex -->
	<div class="element-container">
		<div class="row">
			<div class="form-group">
				<div class="col-md-3">
					<label class="control-label" for="duplex"><?php echo _("Duplex") ?></label>
					<i class="fa fa-question-circle fpbx-help-icon" data-for="duplex"></i>
				</div>
				<div class="col-md-9">
					<span class="radioset">
						<input type="radio" name="duplex" id="duplexyes" value="yes" <?php echo isset($duplex) && $duplex ? 'CHECKED' : ''; ?>>
						<label for="duplexyes"><?php echo _("Yes"); ?></label>
						<input type="radio" name="duplex" id="duplexno" value="no" <?php echo isset($duplex) && !$duplex ? 'CHECKED' : ''; ?>>
						<label for="duplexno"><?php echo _("No"); ?></label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span id="duplex-help" class="help-block fpbx-help-block"><?php echo _("Specify if the page group supports duplex communication.") ?></span>
			</div>
		</div>
	</div>

	<!-- Default -->
	<div class="element-container">
		<div class="row">
			<div class="form-group">
				<div class="col-md-3">
					<label class="control-label" for="default"><?php echo _("Default") ?></label>
					<i class="fa fa-question-circle fpbx-help-icon" data-for="default"></i>
				</div>
				<div class="col-md-9">
					<span class="radioset">
						<input type="radio" name="default" id="defaultyes" value="1" <?php echo isset($default) && $default ? 'CHECKED' : ''; ?>>
						<label for="defaultyes"><?php echo _("Yes"); ?></label>
						<input type="radio" name="default" id="defaultno" value="0" <?php echo isset($default) && !$default ? 'CHECKED' : ''; ?>>
						<label for="defaultno"><?php echo _("No"); ?></label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<span id="default-help" class="help-block fpbx-help-block"><?php echo _("Specify if this is the default page group.") ?></span>
			</div>
		</div>
	</div>
</form>
