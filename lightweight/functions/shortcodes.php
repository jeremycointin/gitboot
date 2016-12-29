<?

function display_menu( $atts ){

	extract( shortcode_atts( array(
		'name' => '',
	), $atts ) );


    $defaults = array(
	'theme_location'  => '',
	'menu'            => $name,
	'container'       => 'div',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => '',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => '',
);

ob_start();
wp_nav_menu($defaults);
$output = ob_get_contents();
ob_end_clean();
    

	return $output;
}

add_shortcode( 'display_menu', 'display_menu' );



function current_date( $atts ){

	return date('Y', time());
}

add_shortcode( 'current_date', 'current_date' );


function tag_me( $atts, $content ) {
	extract( shortcode_atts( array(
	    'tag'   => 'div',
		'name'  => '',
		'class' => '',
		'id'    => '',
		'data'  => '',
	), $atts ) );
	
	$output .= "<$tag id='' class='' $data>";
	$output .= $content;
	$output .= "</$tag>";
	
	return $output;
	
}

add_shortcode( 'tag_me', 'tag_me' );


function display_sidebar( $atts ) {
	extract( shortcode_atts( array(
		'name'    => ''
	), $atts ) );
	
    $lw_sidebars   = get_option( 'lw_sidebars' );
    
ob_start();
echo do_shortcode(stripslashes($lw_sidebars[$name]));
$output = ob_get_contents();
ob_end_clean();	
	
	return $output;
	
}

add_shortcode( 'display_sidebar', 'display_sidebar' );


function display_widget( $atts ) {
	extract( shortcode_atts( array(
		'name'    => ''
	), $atts ) );
	
ob_start();
dynamic_sidebar($name);
$output = ob_get_contents();
ob_end_clean();
	
	return $output;
	
}

add_shortcode( 'display_widget', 'display_widget' );

function display_date( $atts ) {
	
	
	return date('Y');
	
}

add_shortcode( 'date', 'display_date' );



function drop( $atts ) {
	extract( shortcode_atts( array(
	    'tag'   => 'div',
		'name'  => '',
		'class' => '',
		'id'    => '',
		'data'  => '',
	), $atts ) );
	
	$output .= "<$tag id='$id' class='$class' $data>";
	
	return $output;
	
}

add_shortcode( 'drop', 'drop' );








