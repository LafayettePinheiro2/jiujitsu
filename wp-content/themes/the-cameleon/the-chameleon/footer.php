<?php get_template_part( '/thechameleon/templates/footer/footer' );  ?>

	<div class="col100">
	<?php
		/* Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */
		wp_footer();
	?>
	</div>	
</body>
</html>
