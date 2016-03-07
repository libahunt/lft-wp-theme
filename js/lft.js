jQuery(function($) {
	
	/*Opening content in modal windows*/
	$('#uudised .more-link').attr('data-open','lft-modal');

	$('[data-open="lft-modal"]').click(function(e) {
		e.preventDefault();
		$("#lft-modal-content").empty();
		$("#lft-modal-loading").show();
		$('#lft-modal').modal();
		var url = $(this).attr('href');
		$("#lft-modal-content").load(url+" #primary", function() {
			$("#lft-modal-loading").hide();
			$("#lft-modal .close").on('touchstart', function() {
				$('#lft-modal').modal('hide');
			});
		});
		return false;
	});

	/*Anchors menu*/
	$('#anchors-menu').hide();
	$('#anchors-menu-toggle').show();
	$('#anchors-menu-toggle').click(function() {
		$('#anchors-menu').show();
	});
	$('#anchors-menu a').click(function() {
		$('#anchors-menu').hide();
		return true;
	});

	/*Arrow button scrolling down*/
	$('#scrollarrow').click(function() {
		var x = $(document).scrollTop() + $(window).height() * 0.9;
		$("html,body").animate({ scrollTop: x }, 300);
	});
	

	/*Sorting the events into time order*/
	$('.day .event-item').addClass('hidden');
	$('.day').each(function() {
		var dayDiv = $(this);
		dayDiv.find('.event-item.hidden').each(function() {
			if (dayDiv.find('.event-item.shown').length > 0) {
				var theElement = $(this);
				var time = $(this).attr('data-time');
				var done = false;
				dayDiv.find('.event-item.shown').each(function() {
					if ( time < $(this).attr('data-time') ) {
						theElement.insertBefore($(this));
						done = true;
						return false;
					}
				});
				if (!done) {
					theElement.appendTo(dayDiv);
				}
			}
			$(this).removeClass('hidden').addClass('shown');
		});
	});


});


