jQuery(function($) {
	
	$('#uudised .more-link').attr('data-open','lft-modal');

	$('[data-open="lft-modal"]').click(function(e) {
		e.preventDefault();
		$("#lft-modal-content").empty();
		$("#lft-modal-loading").show();
		$('#lft-modal').modal();
		var url = $(this).attr('href');
		$("#lft-modal-content").load(url+" #primary", function() {
			$("#lft-modal-loading").hide();
		});
		return false;
	});

	$('#anchors-menu').hide();
	$('#anchors-menu-toggle').show();
	$('#anchors-menu-toggle').click(function() {
		$('#anchors-menu').show();
	});
	$('#anchors-menu a').click(function() {
		$('#anchors-menu').hide();
		return true;
	});


});


