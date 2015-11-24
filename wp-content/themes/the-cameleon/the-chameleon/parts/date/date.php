<span class="part-date">
	<?php if ( get_option( 'timezone_string' ) ) :		
		  	date_default_timezone_set( get_option( 'timezone_string' ) );			
		  endif;			
		  echo date( get_option( 'date_format' ), current_time( 'timestamp', get_option( 'gmt_offset' ) ) ); 
	?>
</span> <!-- #date -->