jQuery(document).ready(function($)
	{

	$(document).on('click', '.qa_start_migration', function() {		
			
			var paged 		= parseInt( $(this).attr('paged') );
			var total_page 	= $(this).attr('total_page');
			var ppp 		= $(this).attr('ppp');
			// total_page 	= 500;
	
			if( paged > total_page ) return;
			
			$(this).text('Please wait...');
			
			$('#myProgress').fadeIn();
			
			$.ajax(
				{
			type: 'POST',
			context: this,
			url:qa_iq2a_ajax.qa_iq2a_ajaxurl,
			data: {
				"action": "qa_iq2a_ajax_migration",
				"paged": paged,
				"ppp": ppp,
			},
			success: function(data) {
			
				
				
				width = paged * 100 / total_page;
				$('#myBar').css( 'width', width + '%' );
				$('#myBar').text( width.toFixed(2) + '%' );				
				
				paged++;
				
				$(this).attr( 'paged',  paged );
				
				
				$(this).trigger('click');
			},
	
			
				});
			
			
			
		})	



	});	







