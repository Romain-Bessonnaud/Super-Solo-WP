<?php


function bur_settings_page()
{

	?>
	<div class="wrap">
		<div id="upb-wrap" class="upb-help">
			<h2><?php _e('bbp user ranking', ''); ?></h2>
			<?php
			if ( ! isset( $_REQUEST['updated'] ) )
				$_REQUEST['updated'] = false;
			?>
			<?php if ( false !== $_REQUEST['updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Settings saved', 'bbp-user-ranking'); ?> ); ?></strong></p></div>
			<?php endif; ?>
			
			
			<?php 
			if( isset( $_GET[ 'tab' ] ) ) {
				$active_tab = $_GET[ 'tab' ];}
			else { $active_tab= 'ranks';
            } // end if
			
        ?>
		
		<?php // sets up the tabs ?>			
		<h2 class="nav-tab-wrapper">
		
		
		
	
	<a href="?page=bbp-user-ranking&tab=ranks" class="nav-tab <?php echo $active_tab == 'ranks' ? 'nav-tab-active' : ''; ?>"><?php _e('Ranks', 'bbp-user-ranking'); ?></a>	
	<a href="?page=bbp-user-ranking&tab=badges" class="nav-tab <?php echo $active_tab == 'badges' ? 'nav-tab-active' : ''; ?>"><?php _e('Badges', 'bbp-user-ranking'); ?></a>
	<a href="?page=bbp-user-ranking&tab=display" class="nav-tab <?php echo $active_tab == 'display' ? 'nav-tab-active' : ''; ?>"><?php _e('Display', 'bbp-user-ranking'); ?></a>
	<a href="?page=bbp-user-ranking&tab=css" class="nav-tab <?php echo $active_tab == 'css' ? 'nav-tab-active' : ''; ?>"><?php _e('Custom css', 'bbp-user-ranking'); ?></a>
	<a href="?page=bbp-user-ranking&tab=user_management" class="nav-tab <?php echo $active_tab == 'user_management' ? 'nav-tab-active' : ''; ?>"><?php _e('User Management Information', 'bbp-user-ranking'); ?></a>
	</h2>
	<table class="form-table">
			<tr>		
			<td>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="S6PZGWPG3HLEA">
<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
</td>
<td>
<?php _e('If you find this plugin useful, please consider donating just a few dollars to help me develop and maintain it. You support will be appreciated', 'bbp-user-ranking'); ?>


</td>
<td>
</tr>
</table>
<?php
//****  General settings
if ($active_tab == 'display' ) {
bur_display();
}

//****  Rank settings
if ($active_tab == 'ranks' ) {
bur_ranks();
}

//****  badges settings
if ($active_tab == 'badges' ) {
bur_badges();
}

//****  badges settings
if ($active_tab == 'css' ) {
bur_custom_css();
}

//****  user management
if ($active_tab == 'user_management' ) {
bur_user_management ( 'all') ;
}

//end of function bur_settings_page()
}

// register the plugin settings
function bur_register_settings() {

	register_setting( 'bur_display', 'bur_display' );
	register_setting( 'bur_ranks', 'bur_ranks' );
	register_setting( 'bur_badges', 'bur_badges' );
	register_setting( 'bur_css', 'bur_css' );
	
	
	}

	//call register settings function
add_action( 'admin_init', 'bur_register_settings' );

function bur_settings_menu() {

	// add settings page
	add_submenu_page('options-general.php', __('bbp User Ranking', 'bbp-user-ranking'), __('bbp User Ranking', 'bbp-user-ranking'), 'manage_options', 'bbp-user-ranking', 'bur_settings_page');
}
add_action('admin_menu', 'bur_settings_menu');



