<?php
 
  
 //********************************************start of user management

	 
	function bur_user_management($level) {
		$filterlevel = $level ;
		global $user_ID;
		global $bur_ranks ;
		$levels = $bur_ranks['number_of_levels']	;			
		//from settings.php we enter this with $group = 'all' so unless changed it will show all users
		
		//then check if action  has a post, and if so extract the level from action 2 which will have levelxname
		if ((!empty($_POST['action'])) && 'level' == (substr($_POST['action'],0,5)) ) :
			$level=substr($_POST['action'],5,1) ;
			$name2="level".$level.'name' ;
			$filterlevel = $bur_ranks[$name2] ;
		endif;
		
		
		
		$users= get_users () ;
		
			
		?>

		<div class="icon32" id="icon-users"><br></div>
		
		<form method="post">

			<?php wp_nonce_field( 'confirm-bulk-action', 'confirm-bulk-action-nonce' ) ?>

			<div class="tablenav top">
				<select name="action">
					<option value=""><?php _e( 'Filter users by rank' , 'bbp-user-ranking' ); ?></option>
					<option value="filterallgroups"> <?php _e( 'All Ranks' , 'bbp-user-ranking') ?></option>
					
					<?php
					//sets up the groups as actions
						for ($i = 0 ; $i < $levels ; ++$i) {
						$g=$i+1 ;
						$name="level".$g ;
						$name2="level".$g.'name' ;
						$item=$name.'  '.$bur_ranks[$name2] ;
						$display=__( 'Level', 'bbp-user-ranking' ).$g.'  '.$bur_ranks[$name2]  ;
						?>
						<option value="<?php echo $name ?>"><?php echo $display ?></option>
						<?php			
						}
			?>
				</select>
				<input type="submit" value="<?php _e( 'Filter' , 'bbp-user-ranking' ); ?>" class="button action doaction" name="" >
			
				
				
				
			</div>

			<table class="widefat">
				<thead>
					<tr>
						<th id="gravatar"><?php _e( 'Gravatar', 'bbp-user-ranking' ); ?></th>
						<th id="display_name"><?php _e( 'Name', 'bbp-user-ranking' ); ?></th>
						<th id="level"><?php _e( 'Level', 'bbp-user-ranking' ); ?></th>
						<th id="rank"><?php _e( 'Rank Total', 'bbp-user-ranking' ); ?></th>
						<th id="topics"><?php _e( 'Topics', 'bbp-user-ranking' ); ?></th>
						<th id="replies"><?php _e( 'Replies', 'bbp-user-ranking' ); ?></th>
						
						
						
					</tr>
				</thead>
				<tbody>
					<?php
					if ( $users ) :
						$i = 1;
						foreach ( $users as $user ) :
							$class = ( $i % 2 == 1 ) ? 'alternate' : 'default';
							$user_data = get_userdata( $user->ID );
							$user_registered = mysql2date(get_option('date_format'), $user->user_registered);
							
							//WHICH USERS TO SHOW?
											
								$topics  = bbp_get_user_topic_count_raw( $user->ID);
								$replies = bbp_get_user_reply_count_raw( $user->ID);
								//work out what we are counting and blank the answer if not counting
								if (empty($bur_ranks["count_topics"])) $topics = 0 ;
								if (empty($bur_ranks["count_replies"])) $replies = 0 ;
								$total_count   = (int) $topics + $replies;
								//set the levels
								$top = (!empty($bur_ranks['number_of_levels']) ? $bur_ranks['number_of_levels'] : '2') ;
								$ii = 1 ;
								//start loop
									while($ii<= $top)   {
									$level = "level".$ii ;
									$levelname = "level".$ii.'name' ;
									$posts = 'level'.$ii.'posts' ;
									//if the level 'up to number' is blank, then pass on this level by setting it to sero
									$leveli = (!empty($bur_ranks[$posts]) ? $bur_ranks[$posts] : '0') ;
									//but then set it to 'top' if this is the last row
									if ($ii == $top) $leveli = 'top' ;
										
									if ( ($total_count < $leveli)    || ($leveli == 'top') ) {
									$name = (!empty($bur_ranks[$levelname]) ? $bur_ranks[$levelname] : '') ;
									break ; //quit if we've found the level
									} //end of if
																	
									//increment $ii
									$ii++ ;
									
									} //end of while 
							
							//don't display if this user isn't at this level
							
							if ($filterlevel != 'all' && $name != $filterlevel) continue ;
							
							
							?>
							<tr id="user-<?php echo $user->ID ?>" class="<?php echo $class ?>">
								<td><img class="gravatar" src="http://www.gravatar.com/avatar/<?php echo md5( $user->user_email ) ?>?s=32"></td>
								<td>
									<a href="user-edit.php?user_id=<?php echo $user->ID ?>"><?php echo $user->display_name ?></a>
									<div class="row-actions">
										<?php if ( current_user_can( 'edit_user',  $user->ID ) ) : ?>
											<span class="edit"><a href="<?php echo admin_url( 'user-edit.php?user_id=' . $user->ID  ) ?>"><?php _e( 'Edit', 'bbp-user-ranking' ); ?></a>
										<?php endif; ?>
										<?php if ( current_user_can( 'edit_user',  $user->ID ) && current_user_can( 'delete_user', $user->ID ) && $user_ID != $user->ID ) : ?>
											&nbsp;|&nbsp;</span>
										<?php endif; ?>
										<?php if ( current_user_can( 'delete_user', $user->ID ) && $user_ID != $user->ID ) : ?>
											<span class="delete"><a href="<?php echo admin_url( 'users.php?action=delete&user=' . $user->ID . '&_wpnonce=' . wp_create_nonce( 'bulk-users' ) ) ?>"><?php _e( 'Delete' ); ?></a></span>
										<?php endif; ?>
									</div>
								</td>
								
								<td>
								
														
								<?php echo $name; 	?>
								</td>
								
								
								<td>
									<?php echo $total_count ; ?>
								</td>
								
								<td>
									<?php echo $topics ; ?>
								</td>
								
								<td>
									<?php echo $replies ; ?>
								</td>
								
								
								
							</tr>
							<?php
							$i++;
						endforeach;

					else :

						?>
						<tr>
							<td colspan="6"><strong><?php _e( 'No Users found', 'bbp-user-ranking' ); ?></strong></td>
						</tr>
						<?php

					endif;
					?>
				</tbody>
			</table>

		</form>
		<?php
}



	