<?php

function generate_bur_css() {
	ob_start(); // Capture all output (output buffering)
	require (BUR_PLUGIN_DIR . '/includes/styles.php');
	$css = ob_get_clean(); // Get generated CSS (output buffering)
	file_put_contents(BUR_PLUGIN_DIR . '/css/user-ranking.css', $css, LOCK_EX ); // Save it
	
	wp_enqueue_style( 'bur');
	}

function ur_enqueue_css() {
wp_register_style('bur', plugins_url('css/user-ranking.css',dirname(__FILE__) ), 'bbpress');
wp_enqueue_style( 'bur');
}
add_action('wp_print_styles', 'ur_enqueue_css');

add_action( 'admin_enqueue_scripts', 'bur_enqueue_color_picker' );

function bur_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle2', plugins_url('js/bur.js',dirname( __FILE__ )), array( 'wp-color-picker' ), false, true );
}





