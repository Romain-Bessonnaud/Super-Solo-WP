<?php

// edit hook for amend others
add_action( 'edit_user_profile_update', 'bbp_edit_user_bur' );
add_action( 'edit_user_profile', 'bur_user_profile_field', 50,2 )  ;

//allow admins to amend their own settings
add_action('show_user_profile', 'show_admin_bur_profile_fields');
add_action('personal_options_update', 'update_admin_bur_profile_fields');
 
function show_admin_bur_profile_fields() {
     if ( current_user_can('administrator'))
          bur_user_profile_field() ;
 }


function update_admin_bur_profile_fields() {
	 if ( current_user_can('administrator')) {
			if (isset($_REQUEST['user_id'])) {
			$user_id = $_REQUEST['user_id'];
			} else {
				$user_id = $current_user->ID;
			}
		bbp_edit_user_bur($user_id) ;
	}
 }
 
 
 
 
function bur_user_profile_field() {
	 global $current_user;
	 global $bur_groups ;
	 global $bur_display ;
	 
		
		
	 if (isset($_REQUEST['user_id'])) {
		$user_id = $_REQUEST['user_id'];
	 } else {
		$user_id = $current_user->ID;
	 }
		?>
	 <table class="form-table">
			<tbody>
				<tr>
				
					<th><label for="bbp-user-ranking"><?php esc_html_e( 'Ranks', 'bbp-user-ranking' ); ?></label></th>
				</tr>
				
				<?php //Force user to ranking
				global $bur_ranks ; 
				$top = (!empty($bur_ranks["number_of_levels"]) ? $bur_ranks["number_of_levels"] : 0) ;
				$checkname = 'force_user_level' ;
					$check = get_user_meta($user_id, $checkname, true); 
					echo $check ;
				if (!empty ($top)) {
				
				
				?>
					<tr valign="top">  
					<th><?php _e ('Force user to level' , 'bbp-user-ranking' ) ; ?> </th>
					<td>
						<select name="force_user_level">
					<option value=""><?php _e( 'Select Rank' , 'bbp-user-ranking' ); ?></option>
					<option value="norank"> <?php _e( 'Use calculated rank (default)' , 'bbp-user-ranking') ?></option>
					
					<?php
					//sets up the ranks as a list
					$i=1 ; 
					$checkname = 'force_user_level' ;
					$check = get_user_meta($user_id, $checkname, true); 
						while($i<= $top)   {
						$name = __('level', 'bbp-user-ranking').$i ;
							$area2='name' ;
							$item2="bur_ranks[".$name.$area2."]" ;
							$value2 = (!empty($bur_ranks[$name.$area2]) ? $bur_ranks[$name.$area2] : '') ;
							$g=$i+1 ;
						$name="level".$g ;
						$name2="level".$g.'name' ;
						$item=$name.'  '.$bur_ranks[$name2] ;
						$display=__( 'Level', 'bbp-user-ranking' ).$g.'  '.$bur_ranks[$name2]  ;
						
						
						if ($check == $name){?>
						<option selected value="<?php echo $name ?>"><?php echo $display ?></option>
						<?php	
						}
						else {
							?>
						<option value="<?php echo $name ?>"><?php echo $display ?></option>
						<?php
						}
						$i++;							
						}
						
			?>
				</select>
				<?php _e ('<p>If you want to override this user\'s calculated rank -  set a fixed rank here, otherwise ignore', 'bbp-private-groups' ); ?>
					</td>
					</tr>	
				<?php } ?>
				
				
				<?php //TOPIC COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["topic_count"] ) ? $bur_display["topic_count"] : '') ;  
				if ($value == 1 ) { ?>
					<tr valign="top">  
					<th><?php _e ('Hide Topic Counts' , 'bbp-user-ranking' ) ; ?> </th>
					<td>
						<?php
						$checkname = 'hide_topic_counts' ;
						$check = get_user_meta($user_id, $checkname, true); 
						echo '<input name="'.$checkname.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Click to hide', 'bbp-user-ranking' );
						?></select>
					</td>
					</tr>	
				<?php } ?>
				
				
				<?php //REPLY COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["reply_count"] ) ? $bur_display["reply_count"] : '') ;  
				if ($value == 1 ) { ?>
					<tr valign="top">  
					<th><?php _e ('Hide Reply Counts' , 'bbp-user-ranking' ) ; ?> </th>
					<td>
						<?php
						$checkname = 'hide_reply_counts' ;
						$check = get_user_meta($user_id, $checkname, true); 
						echo '<input name="'.$checkname.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Click to hide', 'bbp-user-ranking' );
						?></select>
					</td>
					</tr>	
				<?php } ?>
				
				
				<?php //TOTAL COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["total_count"] ) ? $bur_display["total_count"] : '') ;  
				if ($value == 1 ) { ?>
					<tr valign="top">  
					<th><?php _e ('Hide Total Counts' , 'bbp-user-ranking' ) ; ?> </th>
					<td>
						<?php
						$checkname = 'hide_total_counts' ;
						$check = get_user_meta($user_id, $checkname, true); 
						echo '<input name="'.$checkname.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Click to hide', 'bbp-user-ranking' );
						?></select>
					</td>
					</tr>	
				<?php } ?>
				
				
				
				<?php //LEVEL SYMBOL - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["level_symbol"] ) ? $bur_display["level_symbol"] : '') ;  
				if ($value == 1 ) { ?>
					<tr valign="top">  
					<th><?php _e ('Hide Level Symbols' , 'bbp-user-ranking' ) ; ?> </th>
					<td>
						<?php
						$checkname = 'hide_level_symbol' ;
						$check = get_user_meta($user_id, $checkname, true); 
						echo '<input name="'.$checkname.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Click to hide', 'bbp-user-ranking' );
						?></select>
					</td>
					</tr>	
				<?php } ?>
				
				<?php //RANK NAMES - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["display_names"] ) ? $bur_display["display_names"] : '') ;  
				if ($value == 1 ) { ?>
					<tr valign="top">  
					<th><?php _e ('Hide Rank Names' , 'bbp-user-ranking' ) ; ?> </th>
					<td>
						<?php
						$checkname = 'hide_rank_names' ;
						$check = get_user_meta($user_id, $checkname, true); 
						echo '<input name="'.$checkname.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Click to hide', 'bbp-user-ranking' );
						?></select>
					</td>
					</tr>	
				<?php } ?>
				
				<?php //RANK IMAGE - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["display_image"] ) ? $bur_display["display_image"] : '') ;  
				if ($value == 1 ) { ?>
					<tr valign="top">  
					<th><?php _e ('Hide Rank Image' , 'bbp-user-ranking' ) ; ?> </th>
					<td>
						<?php
						$checkname = 'hide_rank_image' ;
						$check = get_user_meta($user_id, $checkname, true); 
						echo '<input name="'.$checkname.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Click to hide', 'bbp-user-ranking' );
						?></select>
					</td>
					</tr>	
				<?php } ?>
				
				
				
				
				
				<tr>
				
					<th><label for="bbp-user-ranking"><?php esc_html_e( 'Badges', 'bbp-user-ranking' ); ?></label></th>
					<td>

						<?php global $bur_badges ;
							if (empty( $bur_badges ) ) : ?>
							
							<option value=""><?php esc_html_e( '&mdash; No badges yet set up &mdash;', 'bbp-user-ranking' ); ?></option>

							<?php else : ?>
							
						
							
					<?php $badges = get_user_meta($user_id, 'bur_badges', true); 
					$name="number_of_badges" ;
					$item1="bur_badges[".$name."]" ;
					$number = (!empty($bur_badges[$name]) ? $bur_badges[$name] : '2') ;
					
					 $i=1 ; //*************START OF badges LOOP************************  
					while($i<= $number)   { ?>
					
						<tr valign="top">  
						
						<?php $badge=__('Badge ','bbp-user-ranking').$i ; 
						$name = 'badge'.$i.'name' ; 
						$badgename=(!empty($bur_badges[$name]) ? $bur_badges[$name] : '') ; ?>
						<th><?php echo $badge." ".$badgename ; ?></th>
						<?php
						$image = (!empty($bur_badges['badge'.$i.'image']) ? $bur_badges['badge'.$i.'image'] : '') ;
						$image_height = (!empty($bur_badges['badge'.$i.'image_height']) ? $bur_badges['badge'.$i.'image_height'] : '') ;
						$image_width = (!empty($bur_badges['badge'.$i.'image_width']) ? $bur_badges['badge'.$i.'image_width'] : '') ;
						if (!empty($bur_badges['badge'.$i.'image'])) {
						echo '<td><img src = "'.$image.'" height="'.$image_height.'" width="'.$image_width.'" ></td>' ;
						} ?>					
						<td>
						<?php
						$checkname= 'bur_'.$name ;
						$check = get_user_meta($user_id, $checkname, true); 
						echo '<input name="'.$checkname.'" id="badge" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Click to add this badge', 'bbp-user-ranking' );
						?></select>
						</td>
					</tr>
						
					
			
		<?php
	//increments $i	
		$i++; ?>
			
	<?php } ?>
		<?php //*************END OF badges LOOP************************  ?>
	</tbody>
	</table>	
	<?php
	endif ;
}	
		

		
function bbp_edit_user_bur ($user_id ) {
	
	$checkname = 'force_user_level' ;
	if (isset($_POST[$checkname]) && $_POST[$checkname] !='norank') {
		update_user_meta( $user_id, $checkname, $_POST[$checkname]);
		}
		else {
		update_user_meta( $user_id, $checkname, '');
		}
	
	$checkname = 'hide_topic_counts' ;
	if (isset($_POST[$checkname])) {
		update_user_meta( $user_id, $checkname, $_POST[$checkname]);
		}
		else {
		update_user_meta( $user_id, $checkname, '');
		}
	$checkname = 'hide_reply_counts' ;
	if (isset($_POST[$checkname])) {
		update_user_meta( $user_id, $checkname, $_POST[$checkname]);
		}
		else {
		update_user_meta( $user_id, $checkname, '');
		}
		
		$checkname = 'hide_total_counts' ;
	if (isset($_POST[$checkname])) {
		update_user_meta( $user_id, $checkname, $_POST[$checkname]);
		}
		else {
		update_user_meta( $user_id, $checkname, '');
		}
		
		$checkname = 'hide_level_symbol' ;
	if (isset($_POST[$checkname])) {
		update_user_meta( $user_id, $checkname, $_POST[$checkname]);
		}
		else {
		update_user_meta( $user_id, $checkname, '');
		}
		
		$checkname = 'hide_rank_names' ;
	if (isset($_POST[$checkname])) {
		update_user_meta( $user_id, $checkname, $_POST[$checkname]);
		}
		else {
		update_user_meta( $user_id, $checkname, '');
		}
		
		$checkname = 'hide_rank_image' ;
	if (isset($_POST[$checkname])) {
		update_user_meta( $user_id, $checkname, $_POST[$checkname]);
		}
		else {
		update_user_meta( $user_id, $checkname, '');
		}
		
	global $bur_badges ;
	if (empty( $bur_badges ) ) return ;
	$name="number_of_badges" ;	
		$number = (!empty($bur_badges[$name]) ? $bur_badges[$name] : '2') ;
			
		$i=1 ; //*************START OF user update badges LOOP************************  
		while($i<= $number)   { 
		$name = 'badge'.$i.'name' ;
		$checkname= 'bur_'.$name ;
		if (isset($_POST[$checkname])) {
		update_user_meta( $user_id, $checkname, $_POST[$checkname]);
		}
		else {
		update_user_meta( $user_id, $checkname, '');
		}
		//increments $i	
		$i++; 
		}
}






