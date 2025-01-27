$(document).ready(function () {
	// Elements
	var formContainer = $("#input-rows");
	var rawTextarea = $("#raw-textarea");
	var formContainer = $("#input-rows");
	var rawTextarea = $("#raw-textarea");
	var multicastData = $("#multicast-container").data("multicast");
	var announceoverrideopts= $("#announceoverrideopts").data("announceoverrideopts");
	var schedulerInputs = $("#scheduler-inputs");
	var toggleYes = $("#openpage-enable-scheduler-yes");
	var toggleNo = $("#openpage-enable-scheduler-no");
	var exclusionIndex = $("#exclusion-dates-container.row").length;

	function renderRows() {
		formContainer.empty();
		multicastData.forEach(addRow);
	}

	function addRow(value = "") {
		console.debug("Adding row with value", value);
		var newRow = $("<div class='input-group mb-2'></div>").append(
			$("<input type='text' class='form-control' name='openpage-multicast[]' placeholder='IP:PORT'>").val(value),
			$("<div class='input-group-append'></div>").append(
				$("<button type='button' class='btn btn-danger btn-sm remove-row'><i class='fa fa-trash'></i></button>").on("click", function() {
					$(this).closest('.input-group').remove();
					updateArrayFromInputs();
				})
			)
		);
		formContainer.append(newRow);
	}

	function updateArrayFromInputs() {
		multicastData = formContainer.find("input[name='openpage-multicast[]']")
			.map(function() { return $(this).val(); })
			.get();
	}

	$("#add-row").on("click", function() {
		addRow();
	});

	$("#rawEditModal").on("show.bs.modal", function() {
		updateArrayFromInputs();
		rawTextarea.val(multicastData.join("\n"));
	});

	$("#save-raw").on("click", function() {
		multicastData = rawTextarea.val().split("\n").map(v => v.trim()).filter(Boolean);
		renderRows();
		$("#rawEditModal").modal("hide");
	});

	renderRows();

	function toggleScheduler() {
		schedulerInputs.css('display', toggleYes.is(':checked') ? 'block' : 'none');
	}

	toggleYes.on("change", toggleScheduler);
	toggleNo.on("change", toggleScheduler);

	$('[data-toggle="buttons"] .btn').on('click', function() {
		var $checkbox = $(this).find('input[type="checkbox"]');
		$checkbox.prop('checked', !$checkbox.prop('checked'));
	});

	$("#add-event").on("click", function() {
		var eventsContainer = $("#events-container");
		let highestId = 0;
		$(".event-row").each(function() {
			const rowId = parseInt($(this).find("input[name*='[days]']").attr("name").match(/\[(\d+)\]/)[1]);
			highestId = Math.max(highestId, rowId);
		});
		var newEventId = highestId + 1;
		var newEvent = $("<div class='event-row'></div>").append(
			$("<div class='row mb-2'></div>").append(
				$("<div class='col-md-4'></div>").append(
					$("<div class='btn-group btn-group-toggle days-group' data-toggle='buttons'></div>").append(
						$.map(["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"], function(day) {
							return $("<label class='btn btn-outline-primary btn-sm'></label>").append(
								$("<input type='checkbox' autocomplete='off' name='events[" + newEventId + "][days][]' value='" + day + "'>"),
								day
							);
						})
					)
				),
				$("<div class='col-md-3'></div>").append($("<input type='text' class='form-control' name='events[" + newEventId + "][comment]' placeholder='Comment'>")),
				$("<div class='col-md-2'></div>").append($("<input type='time' class='form-control' name='events[" + newEventId + "][time]'>")),
				$("<div class='col-md-2'></div>").append(
					$("<select class='form-control' name='events[" + newEventId + "][override_announcement]'></select>").append(
						$.map(announceoverrideopts, function(option) {
							var $option = $("<option></option>")
								.val(option.value)
								.text(option.label);
							if (option.value === "") {
								$option.prop("selected", true);
							}
							return $option;
						})
					)
				),
				$("<div class='col-md-1 text-right'></div>").append(
					$("<button type='button' class='btn btn-danger btn-sm remove-event'><i class='fa fa-trash'></i></button>")
				)
			)
		);
		eventsContainer.append(newEvent);
	});

	// Add this separate event delegation handler
	$("#events-container").on("click", ".remove-event", function() {
		$(this).closest('.event-row').remove();
	});

	$("#add-exclusion-date").on("click", function() {
		let highestId = 0;
		$(".exclusion-row").each(function() {
			const rowId = parseInt($(this).data("key"));
			highestId = Math.max(highestId, rowId);
		});
		var exclusionsContainer = $("#exclusion-dates-container");
		var newKey = highestId + 1;
		var newExclusion = $("<div class='row mb-2 exclusion-row' data-key='" + newKey + "'></div>").append(
			$("<div class='col-md-5'></div>").append($("<input type='date' class='form-control' name='exclusion_dates[" + newKey + "][exclusion_date]'>")),
			$("<div class='col-md-5'></div>").append($("<input type='text' class='form-control' name='exclusion_dates[" + newKey + "][comment]' placeholder='Comment'>")),
			$("<div class='col-md-2'></div>").append(
				$("<button type='button' class='btn btn-danger btn-sm remove-exclusion'><i class='fa fa-trash'></i></button>")
			)
		);
		exclusionsContainer.append(newExclusion);
	});

	$("#exclusion-dates-container").on("click", ".remove-exclusion", function() {
		$(this).closest('.exclusion-row').remove();
	});

	function validateExclusionDates() {
		var startDate = new Date($('#schedule_start_date').val());
		var endDate = new Date($('#schedule_end_date').val());
		$('#exclusion-dates-container input[type="date"]').each(function() {
			var exclusionDate = new Date($(this).val());
			if (exclusionDate < startDate || exclusionDate > endDate) {
				$(this).addClass('is-invalid');
				$(this).parent().append('<div class="invalid-feedback">Must be within the schedule range.</div>');
			} else {
				$(this).removeClass('is-invalid');
				$(this).siblings('.invalid-feedback').remove();
			}
		});
	}

	$('form').on('submit', function(e) {
		validateExclusionDates();
		if ($('#exclusion-dates-container .is-invalid').length) {
			e.preventDefault();
			alert("Please correct the exclusion dates to be within the schedule range.");
		}
	});

	$('#exclusion-dates-container').on('change', 'input[type="date"]', validateExclusionDates);
	$('#schedule_start_date, #schedule_end_date').on('change', validateExclusionDates);

	toggleScheduler();

	$("#openpage_timezone").chosen({
		width: "100%",
		allow_single_deselect: true, 
		no_results_text: `_('No results match')`,
		search
	});
});
