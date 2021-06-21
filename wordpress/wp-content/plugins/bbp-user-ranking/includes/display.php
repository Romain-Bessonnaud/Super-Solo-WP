<?php

//general settings page

function bur_display() {

 ?>
			
						<table class="form-table">
					
					<tr valign="top">
						<th colspan="2">
						
						<h3>
						<?php _e ('Display' , 'bur-user-ranking' ) ; ?>
						</h3>


						
					
	
	<table>
	<tr>
	<th> <?php _e ('RANKS' , 'bbp-user-ranking' ) ; ?>  </th>
	<th> <?php _e ('BADGES' , 'bbp-user-ranking' ) ; ?> </th>
	</tr>
	<tr>
	<td>
	<?php
	//show style image
	 echo '<img src="' . plugins_url( 'images/image1.JPG',dirname(__FILE__)  ) . '" > '; ?>
	 </td>
	 <td>
	 <?php
	 echo '<img src="' . plugins_url( 'images/image2.jpg',dirname(__FILE__)  ) . '" > '; ?>
	 </td>
	 </tr>
	 </table>
	 
<p>
<?php _e ('Use the "Ranks" and "Badges" tabs to set the levels, names and images.  Use this tab to determine what is displayed' , 'bbp-user-ranking' ) ; ?>
</p>

<p>
<?php _e ('DISPLAY SETTINGS - For each item, decide if you wish to display, and labels where required' , 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('DISPLAY ORDER - decide in what order you wish to show items' , 'bbp-user-ranking' ) ; ?>
</p>
<p></p>
<?php global $bur_display ;?>
	
	<Form method="post" action="options.php">
	<?php wp_nonce_field( 'display', 'display-nonce' ) ?>
	<?php settings_fields( 'bur_display' );
	//create a style.css on entry and on saving
	generate_bur_css() ;
	?>	
	<table class="form-table">

	
	<tr><td>  </td></tr>
	<tr><td>  </td></tr>
	<tr><td> 
	<?php _e ('GLOBAL DISPLAY SETTINGS' , 'bbp-user-ranking' ) ; ?>
	</tr><tr><td colspan = "4">
	<?php _e ('Set the items you wish to show - you can exclude displaying items for specific roles or individuals - see "DISPLAY EXCEPTIONS" below' , 'bbp-user-ranking' ) ; ?>
	</td></tr>
	<?php //*************Display post counts************************  ?>
	<tr>
	<td>
	<?php _e ('Display Topic Counts' , 'bbp-user-ranking' ) ; ?>
	</td> 
	<td>
	<?php $value = (!empty($bur_display["topic_count"] ) ? $bur_display["topic_count"] : '') ;  ?>
	<?php echo '<input name="bur_display[topic_count]" id="bur_display[topic_count]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Show topic count';
 	?>
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Topic Count display name' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[topic_name]' ; ?>
	<?php $value = (!empty($bur_display["topic_name"]) ? $bur_display["topic_name"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="medium-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"' ; ?> 
	<br><br>
	<label class="description"><?php _e( 'Enter topic count name eg "Comments" , "Topics" , "Contributions" etc.', 'bbp-user-ranking' ); ?></label></br><br>
	<label class="description"><?php _e( 'Include any delimeter eg Count : Count - ', 'bbp-user-ranking' ) ; ?> </label></br><br>
	<label class="description"><?php _e( 'Leave blank to just display the count'  , 'bbp-user-ranking' ); ?></label></br>
	</td>
	</tr>
	
	
	<tr>
	<td>
	<?php _e ('Display Reply Counts' , 'bbp-user-ranking' ) ; ?>
	</td> 
	<td>
	<?php $value = (!empty($bur_display["reply_count"] ) ? $bur_display["reply_count"] : '') ;  ?>
	<?php echo '<input name="bur_display[reply_count]" id="bur_display[reply_count]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Show reply count';
 	?>
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Reply Count display name' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[reply_name]' ; ?>
	<?php $value = (!empty($bur_display["reply_name"]) ? $bur_display["reply_name"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="medium-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"' ; ?> 
			<br><br>
	<label class="description"><?php _e( 'Enter reply count name eg "Comments" , "Replies" , "Contributions" etc.', 'bbp-user-ranking' ); ?></label></br><br>
	<label class="description"><?php _e( 'Include any delimeter eg Count : Count - ', 'bbp-user-ranking' ) ; ?> </label></br><br>
	<label class="description"><?php _e( 'Leave blank to just display the count'  , 'bbp-user-ranking' ); ?></label></br></td>
	</tr>
	
	<tr>
	<td>
	<?php _e ('Display Total Counts' , 'bbp-user-ranking' ) ; ?>
	</td> 
	<td>
	<?php $value = (!empty($bur_display["total_count"] ) ? $bur_display["total_count"] : '') ;  ?>
	<?php echo '<input name="bur_display[total_count]" id="bur_display[total_count]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Show total count';
 	?>
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Total Count display name' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[total_name]' ; ?>
	<?php $item2='bur_display[image_max]' ; ?>
	<?php $value = (!empty($bur_display["total_name"]) ? $bur_display["total_name"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="medium-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"' ; ?> 
	<br><br>
	<label class="description"><?php _e( 'Enter total count name eg "Comments" , "Totals" , "Contributions" etc.', 'bbp-user-ranking' ); ?></label></br><br>
	<label class="description"><?php _e( 'Include any delimeter eg Count : Count - ', 'bbp-user-ranking' ) ; ?> </label></br><br>
	<label class="description"><?php _e( 'Leave blank to just display the count'  , 'bbp-user-ranking' ); ?></label></br>

	</td>
	</tr>
	
	
	
	
	
	
	<?php //*************Display Level Symbols************************  ?>
	<tr>
	<td style="vertical-align:top">
	<?php _e ('Display Level Symbols' , 'bbp-user-ranking' ) ; ?>
	</td> <td>
	<?php $value = (!empty($bur_display["level_symbol"] ) ? $bur_display["level_symbol"] : '') ;  ?>
	<?php echo '<input name="bur_display[level_symbol]" id="bur_display[level_symbol]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Show Level Symbols';
 	?>
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td></td>
	<td>
	<?php $value = (!empty($bur_display["star_type"] ) ? $bur_display["star_type"] : 'white') ;  ?>
	<?php echo '<input name="bur_display[star_type]" id="bur_display[star_type]" type="radio" value="white" class="code" ' . checked( "white",$value, false ) . ' /> Hollow Stars &#9734;'; ?>
	<?php echo '<input name="bur_display[star_type]" id="bur_display[star_type]" type="radio" value="black" class="code" ' . checked( "black",$value, false ) . ' /> Solid Stars &#9733;'; ?>
	</td>
	
	</tr>
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Symbol Color' , 'bbp-user-ranking' ) ; ?>
	</td>

	
	<td style="vertical-align:top">
	<?php $item='bur_display[symbol_color]' ; ?>
	<?php $value = (!empty($bur_display["symbol_color"]) ? $bur_display["symbol_color"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="bur-color-picker" name="'.$item.'" type="text" value="'.esc_html( $value ).'"' ; ?> 
					
	</td>
	
	</tr>
	
	<?php //*************Display Rank names************************  ?>
	<tr>
	<td style="vertical-align:top">
	<?php _e ('Display Rank Names' , 'bbp-user-ranking' ) ; ?>
	</td> <td>
	<?php $value = (!empty($bur_display["display_names"] ) ? $bur_display["display_names"] : '') ;  ?>
	<?php echo '<input name="bur_display[display_names]" id="bur_display[display_names]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Show rank names';
 	?>
	</td>
	</tr>
	
	
	
	
	<tr>
	<td colspan = "3">
	<?php _e ('If you have opted to display the rank name superimposed on the image, then you do not need to tick "Display Image"' , 'bbp-user-ranking' ) ; ?>
	</tr>
	
	<?php //*************Display Image************************  ?>
	<tr>
	<td style="vertical-align:top">
	<?php _e ('Display Image' , 'bbp-user-ranking' ) ; ?>
	</td> <td>
	<?php $value = (!empty($bur_display["display_image"] ) ? $bur_display["display_image"] : '') ;  ?>
	<?php echo '<input name="bur_display[display_image]" id="bur_display[display_image]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Show Image';
 	?>
	</td>
	</tr>
	
	<?php //*************Display Badges************************  ?>
	<tr>
	<td style="vertical-align:top">
	<?php _e ('Display Badges' , 'bbp-user-ranking' ) ; ?>
	</td> <td>
	<?php $value = (!empty($bur_display["display_badges"] ) ? $bur_display["display_badges"] : '') ;  ?>
	<?php echo '<input name="bur_display[display_badges]" id="bur_display[display_badges]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Show Badges';
		?>
		</td><td>
		<?php _e ('Badges are set for each user within Dashboard>users>user>edit user' , 'bbp-user-ranking' ) ; ?>
	</td>
	</tr>
	
	<tr><td> 
	<tr><td>  </td></tr>
	<tr><td>  </td></tr>
	<tr><td>
	<?php _e ('DISPLAY ORDER' , 'bbp-user-ranking' ) ; ?>
	</td></tr>
	<tr><td colspan = "2">
	<?php _e ('If you wish to change the default order, do this here' , 'bbp-user-ranking' ) ; ?>
	</td></tr>
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Topic Count' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[topic_order]' ; ?>
	<?php $value = (!empty($bur_display["topic_order"]) ? $bur_display["topic_order"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="small-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter the order ie a number from 1 to 7', 'bbp-user-ranking' ); ?></label></br>
			
	</td>
	</tr>
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Reply Count' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[reply_order]' ; ?>
	<?php $value = (!empty($bur_display["reply_order"]) ? $bur_display["reply_order"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="small-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter the order ie a number from 1 to 7', 'bbp-user-ranking' ); ?></label></br>
			
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Total Count' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[total_order]' ; ?>
	<?php $value = (!empty($bur_display["total_order"]) ? $bur_display["total_order"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="small-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter the order ie a number from 1 to 7', 'bbp-user-ranking' ); ?></label></br>
			
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Rank Name' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[name_order]' ; ?>
	<?php $value = (!empty($bur_display["name_order"]) ? $bur_display["name_order"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="small-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter the order ie a number from 1 to 7', 'bbp-user-ranking' ); ?></label></br>
			
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Level Symbol' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[level_order]' ; ?>
	<?php $value = (!empty($bur_display["level_order"]) ? $bur_display["level_order"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="small-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter the order ie a number from 1 to 7', 'bbp-user-ranking' ); ?></label></br>
			
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Image' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[image_order]' ; ?>
	<?php $value = (!empty($bur_display["image_order"]) ? $bur_display["image_order"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="small-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter the order ie a number from 1 to 7', 'bbp-user-ranking' ); ?></label></br>
			
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td style="vertical-align:top">
	<?php _e ('Badges' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td style="vertical-align:top">
	<?php $item='bur_display[badge_order]' ; ?>
	<?php $value = (!empty($bur_display["badge_order"]) ? $bur_display["badge_order"] : '') ; ?>
	<?php echo '<input id="'.$item.'" class="small-text" name="'.$item.'" type="text" value="'.esc_html( $value ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter the order ie a number from 1 to 7', 'bbp-user-ranking' ); ?></label></br>
			
	</td>
	</tr>
	</table>
	<table>
	<tr><td>
	<?php _e ('DISPLAY EXCEPTIONS' , 'bbp-user-ranking' ) ; ?>
	</td></tr>
	<tr><td colspan = "3">
	<?php _e ('You can exclude displaying items for bbpress role types below', 'bbp-user-ranking' ) ; ?>
	</td></tr><tr><td colspan = "4">
	<?php _e ('NOTE !!! You can also exclude displaying individual items for INDIVIDUAL USERS by goings into users>all users and editing a user. You will see options to hide items ', 'bbp-user-ranking' ) ; ?>
	</td></tr>
	<?php $roles = bbp_get_dynamic_roles () ;
	foreach($roles as $role=>$value) { 
			$name = $value['name'] ; 
			$ii = 0 ;
			?>
			<tr><td> <?php 	echo $name; ?> </td>
			<?php //TOPIC COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["topic_count"] ) ? $bur_display["topic_count"] : '') ;  
				if ($value == 1 ) {	 ?>
				<?php $ii++ ;
				if ($ii == 4 ) echo '</tr><tr><td></td>' ; ?>
					 <td>
						<?php
						$checkname = $role.'hide_topic_counts' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Topic Counts', 'bbp-user-ranking' );
						?></select>
					</td>
					<?php } ?>
				
				
				<?php //REPLY COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["reply_count"] ) ? $bur_display["reply_count"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 4 ) echo '</tr><tr><td></td>' ; ?>
					<td>
						<?php
						$checkname = $role.'hide_reply_counts' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Reply Counts', 'bbp-user-ranking' );
						?></select>
					</td>
					
				<?php } ?>
				
				
				<?php //TOTAL COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["total_count"] ) ? $bur_display["total_count"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 4 ) echo '</tr><tr><td></td>' ; ?>
					<td>
						<?php
						$checkname = $role.'hide_total_counts' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Total Counts', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				
				
				<?php //LEVEL SYMBOL - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["level_symbol"] ) ? $bur_display["level_symbol"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 4 ) echo '</tr><tr><td></td>' ; ?>
					<td>
					<?php
						$checkname = $role.'hide_level_symbol' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Level Symbols', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				<?php //RANK NAMES - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["display_names"] ) ? $bur_display["display_names"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 4 ) echo '</tr><tr><td></td>' ; ?>
					<td>
						<?php
						$checkname = $role.'hide_rank_names' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Rank Names', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				<?php //RANK IMAGE - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["display_image"] ) ? $bur_display["display_image"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 4 ) echo '</tr><tr><td></td>' ; ?>
					<td>
						<?php
						$checkname = $role.'hide_rank_image' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Rank Image', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				
	
	<?php
	}
	?>
	
	</table>
	
	<table>
	<tr><td>
	<?php _e ('PROFILE DISPLAY' , 'bbp-user-ranking' ) ; ?>
	</td></tr>
	<?php $ii = 0 ; ?>
	<tr><td colspan = "3">
	<?php _e ('In either bbpress or buddypress profile, the global display items set above will appear', 'bbp-user-ranking' ) ; ?>
	</td></tr><tr><td colspan = "4">
	<?php _e ('With bbPress this may mean that some counts are repeated, and with buddypress this may cause you layout to be longer than desired', 'bbp-user-ranking' ) ; ?>
	</td></tr>
	</td></tr><tr><td colspan = "4">
	<?php _e ('You can therefore hide items in the profile to get an improved display by using the settings below', 'bbp-user-ranking' ) ; ?>
	</td></tr>
	<?php //TOPIC COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["topic_count"] ) ? $bur_display["topic_count"] : '') ;  
				$profile = 'profile' ;
				if ($value == 1 ) {	 ?>
				<?php $ii++ ;
				if ($ii == 5 ) echo '</tr><tr>' ; ?>
					 <td>
						<?php
						$checkname = $profile.'hide_topic_counts' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Topic Counts', 'bbp-user-ranking' );
						?></select>
					</td>
					<?php } ?>
				
				
				<?php //REPLY COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["reply_count"] ) ? $bur_display["reply_count"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 5 ) echo '</tr><tr>' ; ?>
					<td>
						<?php
						$checkname = $profile.'hide_reply_counts' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Reply Counts', 'bbp-user-ranking' );
						?></select>
					</td>
					
				<?php } ?>
				
				
				<?php //TOTAL COUNT - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["total_count"] ) ? $bur_display["total_count"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 5 ) echo '</tr><tr>' ; ?>
					<td>
						<?php
						$checkname = $profile.'hide_total_counts' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Total Counts', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				
				
				<?php //LEVEL SYMBOL - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["level_symbol"] ) ? $bur_display["level_symbol"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 5 ) echo '</tr><tr>' ; ?>
					<td>
					<?php
						$checkname = $profile.'hide_level_symbol' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Level Symbols', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				<?php //RANK NAMES - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["display_names"] ) ? $bur_display["display_names"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 5 ) echo '</tr><tr>' ; ?>
					<td>
						<?php
						$checkname = $profile.'hide_rank_names' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Rank Names', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				<?php //RANK IMAGE - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["display_image"] ) ? $bur_display["display_image"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 5 ) echo '</tr><tr>' ; ?>
					<td>
						<?php
						$checkname = $profile.'hide_rank_image' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Rank Image', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				<?php //Badges - Check and only display hide option if this is set in settings display, so we don't show fields that are not being used
				$value = (!empty($bur_display["display_badges"] ) ? $bur_display["display_badges"] : '') ;  
				if ($value == 1 ) { ?>
				<?php $ii++ ;
				if ($ii == 5 ) echo '</tr><tr>' ; ?>
					<td>
						<?php
						$checkname = $profile.'hide_badges' ;
						$item='bur_display['.$checkname.']' ; 
						$check = (!empty($bur_display[$checkname] ) ? $bur_display[$checkname] : '') ;  
						echo '<input name="'.$item.'" id="ranks" type="checkbox" ' ;
						if( $check == 'on' ) echo 'checked="checked"'; 
						echo ' />' ;
						_e ('Hide Badges', 'bbp-user-ranking' );
						?></select>
					</td>
				<?php } ?>
				
				
	
	</table>
	<?php _e( '<br><br>SHORTCODE', 'bbp-user-ranking' ) ;
	
	_e( '<br><br>You can use the shortcode [rank_display] to show the settings for the logged in user - for instance in a widget', 'bbp-user-ranking' ) ;
	?>
	
	
	
	
		
<!-- save the options -->
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save changes', 'bbp-user-ranking' ); ?>" />
				</p>
				</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->
	
	 
		

<?php

}




