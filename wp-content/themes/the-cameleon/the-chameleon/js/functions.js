jQuery(document).ready(function() {
		
	//SEARCH INPUT
	jQuery('input#s').each(function(){
		jQuery(this).attr('placeholder','Search...');
	});

			
	//RESPONSIVE MENU REDIRECT
	jQuery('.responsive-menu select').change(function() {			
		var url = jQuery(this).val();			
		window.location.href = url;				
	});
	

	//MESSAGE	
	jQuery('.message').click(function() {		
		jQuery(this).hide();
	});

		
});