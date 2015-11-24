<?php
	global $data; 

	$befor  		= '<div class="part-button-content">';
	$after 		   	= '</div>';				
	$button_title  	=  isset( $data ['button_title'] ) ? $data ['button_title'] : '';
	$button_icon   	=  isset( $data ['button_icon'] ) ? $data ['button_icon'] : '';			
	$link 		   	=  isset( $data ['link'] ) ? $data ['link'] : '#';	
	$button_class  	=  isset( $data ['button_class'] ) ? $data ['button_class'] : '';
	$button_align  	=  isset( $data ['button_align'] ) ? $data ['button_align'] : 'left';
	$button_size   	=  isset( $data ['button_size'] ) ? $data ['button_size'] : 'normal';
	$target 	    =  ( $data ['target']=='1' ) ? '_blank'  : "_self";			
	$icon_in_button = ( ! empty( $button_icon ) ) ? '<i class="'. $button_icon . '"></i>&nbsp;': '';	
	$button 		= ! empty( $button_title ) ? '<p class="text-'. $button_align .' button-'. $button_align .'"><a href="'. $link .'" class="'. $button_class .' button_'. $button_size .'"   target="'. $target .'">'. $icon_in_button. $button_title .'</a></p>' : NULL ;

	echo $befor;
		echo $button;
	echo $after;
?>
