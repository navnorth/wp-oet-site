var ajaxExecuting = false;
jQuery(function($){
  	if (typeof nalrc_object != 'undefined')
    	nalrc_object.ajaxurl = 'https://oese.ed.gov/wp-content/plugins/wp-usahtmlmap-3.2.9/ajax.php';

	function narlc_searchResources(){
		$('.oer_resource_posts').html('');
		var loader = '<div class="resource-loader"><img src="'+nalrc_object.plugin_url +'/images/load.gif" /></div>';
		$('.oer_resource_posts').html(loader);
		var data = {
			action: 'search_resources',
		}
		if ($('.nalrc-search-filters #keyword').val()!=='')
			data.keyword = $('.nalrc-search-filters #keyword').val();
		if ($('.nalrc-search-filters #gradeLevel').val()!=='')
			data.gradeLevel = $('.nalrc-search-filters #gradeLevel').val();
		if ($('.nalrc-search-filters #product').val()!=='')
			data.product = $('.nalrc-search-filters #product').val();
		
		if (!ajaxExecuting){
			ajaxExecuting = true;
			$.ajax({
				type: "POST",
				url: nalrc_object.ajaxurl,
				data: data,
				success: function(msg){
					$('.oer_resource_posts').html(msg);
					ajaxExecuting = false;
				}
			});
		}
	}

	$('.nalrc-search-button').off('click').on('click', narlc_searchResources);

	$('.nalrc-search-keyword #keyword').on('keydown', function(e){
		var code = e.keyCode || e.which;
		if (code==13){
			narlc_searchResources();
		}
	});
});