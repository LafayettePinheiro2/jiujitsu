<?php	

/**
 * 	Widget part 
 *
 * @author Goran Petrovic
 * @since 1.0
 * @return html
 *
 **/

global $data;

$sidebar_name = !empty( $data['sidebar'] ) ?  $data['sidebar'] : 'Page Sidebar';

dynamic_sidebar( $sidebar_name ); ?>
