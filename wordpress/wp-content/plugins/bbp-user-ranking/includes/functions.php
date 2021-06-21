<?php

// bbPress User post count




add_action ('bbp_theme_after_reply_author_details', 'bur_display_counts_reply');
add_action ('bbp_theme_after_topic_author_details', 'bur_display_counts_topic'); 
add_action( 'bp_before_member_header_meta', 'bur_display_counts_bp_profile'); 
add_action( 'bbp_template_after_user_profile', 'bur_display_counts_bbp_profile'); 
add_shortcode ('rank_display' , 'bur_display_counts_shortcode' ) ;


//main function to display
function bur_display_counts_topic () {
	$topic_id = bbp_get_topic_id() ;
	$bur_id=bbp_get_topic_author_id( $topic_id ) ;
	bur_display_counts ($bur_id, $profile = 'no') ;
}

//main function to display
function bur_display_counts_reply () {
	$reply_id = bbp_get_reply_id() ;
	$bur_id=bbp_get_reply_author_id( $reply_id ) ;
	bur_display_counts ($bur_id, $profile = 'no') ;
}



//display in buddypress profile	
	function bur_display_counts_bp_profile () {
	echo '<div id = "bur_profile">' ;	
	$bur_id = bp_displayed_user_id() ;
	bur_display_counts ($bur_id, $profile = 'yes') ;
	echo '</div>' ;
}

//display in bbpress profile
function bur_display_counts_bbp_profile () {
	echo '<div id = "bur_profile">' ;	
	$bur_id = bbp_get_displayed_user_id() ;
	bur_display_counts ($bur_id, $profile = 'yes') ;
	echo '</div>' ;
}

//display in bbpress profile
function bur_display_counts_shortcode () {
	echo '<div id = "bur_profile">' ;	
	$user = wp_get_current_user();
	$user_id = $user->ID ;
	bur_display_counts ($user_id, $profile = 'no') ;
	echo '</div>' ;
}



function bur_display_counts ($bur_id, $profile) {
		
		global $bur_ranks ;
		global $bur_display ;
		
		$topics  = bbp_get_user_topic_count_raw( $bur_id);
		$replies = bbp_get_user_reply_count_raw( $bur_id);
		
			
		//work out what we are counting and blank the answer if not counting
		if (empty($bur_ranks["count_topics"])) $topics = 0 ;
		if (empty($bur_ranks["count_replies"])) $replies = 0 ;
		$total_count   = (int) $topics + $replies;
		
		
		
			
		//now we set the variables by looping round until we reach $top (ignoring any blank rows )
		
		
		//set the levels
		$top = (!empty($bur_ranks['number_of_levels']) ? $bur_ranks['number_of_levels'] : '2') ;
		$i = 1 ;
		//start loop
		while($i<= $top)   {
		$level = "level".$i ;
		$levelname = "level".$i.'name' ;
		$levelimage = "level".$i.'image' ;
		$levelimage_height = "level".$i.'image_height' ;
		$levelimage_width = "level".$i.'image_width' ;
		$posts = 'level'.$i.'posts' ;
		//if the level 'up to number' is blank, then pass on this level by setting it to zero
		$leveli = (!empty($bur_ranks[$posts]) ? $bur_ranks[$posts] : '0') ;
		//but then set it to 'top' if this is the last row
		if ($i == $top) $leveli = 'top' ;
			
		$star_count = $i ;	
		if ( ($total_count < $leveli)    || ($leveli == 'top') ) {
		$name = (!empty($bur_ranks[$levelname]) ? $bur_ranks[$levelname] : '') ;
		$image = (!empty($bur_ranks[$levelimage]) ? $bur_ranks[$levelimage] : '') ;
		$image_height = (!empty($bur_ranks[$levelimage_height]) ? $bur_ranks[$levelimage_height] : '') ;
		$image_width = (!empty($bur_ranks[$levelimage_width]) ? $bur_ranks[$levelimage_width] : '') ;
		break ; //quit if we've found the level
		} //end of if
				
		
		//increment $i
		$i++ ;
		
		} //end of while
		//now set image according to whether forced
		$checkname = get_user_meta($bur_id, 'force_user_level', true); 
		if (!empty ($checkname)) {
			$level = $checkname ;
			$levelimage = $checkname.'image' ;
			$levelimage_height = $checkname.'image_height' ;
			$levelimage_width = $checkname.'image_width' ;
			$image = (!empty($bur_ranks[$levelimage]) ? $bur_ranks[$levelimage] : '') ;
			$image_height = (!empty($bur_ranks[$levelimage_height]) ? $bur_ranks[$levelimage_height] : '') ;
			$image_width = (!empty($bur_ranks[$levelimage_width]) ? $bur_ranks[$levelimage_width] : '') ;
			$levelname = $checkname.'name' ;
			$name = (!empty($bur_ranks[$levelname]) ? $bur_ranks[$levelname] : '') ;
			$star_count= substr($checkname,5);
		}		
		
		echo '<div class = "bur_display">' ;
		echo '<ul>' ;	
		
		
		//work out the display order, and call the functions in the right order, if order for an item is not set, but the item is set to display then set level 7 for default order
		$i=1 ;
		//set the limit to 6 as we have 6 options for the order
		while($i<=7)   {
		if ((!empty($bur_display["topic_order"]) ? $bur_display["topic_order"] : '7') == $i) bur_topic_count($topics, $bur_id, $profile) ;
		if ((!empty($bur_display["reply_order"]) ? $bur_display["reply_order"] : '7') == $i) bur_replies_count($replies, $bur_id, $profile) ; ;
		if ((!empty($bur_display["total_order"]) ? $bur_display["total_order"] : '7') == $i) bur_total_count($total_count, $bur_id, $profile) ;
		if ((!empty($bur_display["name_order"]) ? $bur_display["name_order"] : '7') == $i) bur_display_name ($name, $level, $bur_id, $profile) ;;
		if ((!empty($bur_display["level_order"]) ? $bur_display["level_order"] : '7') == $i) bur_display_level ($star_count, $bur_id, $profile);
		if ((!empty($bur_display["image_order"]) ? $bur_display["image_order"] : '7') == $i) bur_display_image($image, $image_height, $image_width, $bur_id, $profile) ;
		if ((!empty($bur_display["badge_order"]) ? $bur_display["badge_order"] : '7') == $i) bur_badges_display ($bur_id, $profile);
		//increments $i	
		$i++;	
		}
		echo '</ul>' ;
		echo '</div>' ;
		
}


function bur_topic_count($topics, $bur_id, $profile) {
		//display topics count
		global $bur_display ;
		//check for profile, and bail if set to hidden
		if  ($profile == 'yes' && !empty($bur_display['profilehide_topic_counts']) ) return ;
		//check for individual
		$checkname = 'hide_topic_counts' ;
		$check = get_user_meta($bur_id, $checkname, true); 
		//check for role exception
		$role = bbp_get_user_role( $bur_id );
		$checkname2 = $role.$checkname ;
		$check2 = (!empty($bur_display[$checkname2] ) ? $bur_display[$checkname2] : '') ; 
		//set to show in settings display, and not set to hide in user profile, and not set to hide in role
		if (!empty($bur_display["topic_count"]) && empty ($check) && empty ($check2) ) {
		echo '<li class="bur_topic">' ;
		echo (!empty($bur_display["topic_name"]) ? $bur_display["topic_name"] : '');
		echo $topics ;
		echo '</li>' ;
		}
}


	
		
		
function bur_replies_count($replies, $bur_id, $profile) {
		//display replies count
		global $bur_display ;
		//check for profile, and bail if set to hidden
		if  ($profile == 'yes' && !empty($bur_display['profilehide_reply_counts']) ) return ;
		$checkname = 'hide_reply_counts' ;
		$check = get_user_meta($bur_id, $checkname, true);
		//check for role exception
		$role = bbp_get_user_role( $bur_id );
		$checkname2 = $role.$checkname ;
		$check2 = (!empty($bur_display[$checkname2] ) ? $bur_display[$checkname2] : '') ; 
		//set to show in settings display, and not set to hide in user profile, and not set to hide in role
			if (!empty($bur_display["reply_count"]) && empty ($check)  && empty ($check2) ) {
			echo '<li class="bur_reply">' ;
			echo (!empty($bur_display["reply_name"]) ? $bur_display["reply_name"] : '');
			echo $replies ;
			echo '</li>' ;
			}
}
		
function bur_total_count($total_count, $bur_id, $profile) {
		//display total count
		global $bur_display ;
		//check for profile, and bail if set to hidden
		if  ($profile == 'yes' && !empty($bur_display['profilehide_total_counts']) ) return ;
		$checkname = 'hide_total_counts' ;
		$check = get_user_meta($bur_id, $checkname, true); 
		$check = get_user_meta($bur_id, $checkname, true);
		//check for role exception
		$role = bbp_get_user_role( $bur_id );
		$checkname2 = $role.$checkname ;
		$check2 = (!empty($bur_display[$checkname2] ) ? $bur_display[$checkname2] : '') ; 
		//set to show in settings display, and not set to hide in user profile, and not set to hide in role
			if (!empty($bur_display["total_count"]) && empty ($check) && empty ($check2 )) {
			echo '<li class = "bur_total">' ;
			echo (!empty($bur_display["total_name"]) ? $bur_display["total_name"] : '');
			echo $total_count ;
			echo '</li>' ;
			}
}
		
function bur_display_name($name, $level, $bur_id, $profile) {
		//display name
		global $bur_display ;
		global $bur_ranks ;
		//check for profile, and bail if set to hidden
		if  ($profile == 'yes' && !empty($bur_display['profilehide_rank_names']) ) return ;
		$checkname = 'hide_rank_names' ;
		$check = get_user_meta($bur_id, $checkname, true); 
		//check for role exception
		$role = bbp_get_user_role( $bur_id );
		$checkname2 = $role.$checkname ;
		$check2 = (!empty($bur_display[$checkname2] ) ? $bur_display[$checkname2] : '') ; 
				
		//set to show in settings display, and not set to hide in user profile, and not set to hide in role
			if (!empty($bur_display["display_names"])&& empty ($check) && empty ($check2) ) {
			echo '<li>' ;
			echo '<div id = "'.$level.'">' ;
			echo $name ;
			echo '</div>' ;			
			echo '</li>' ;
			}
}
		
function bur_display_level($star_count, $bur_id, $profile) {
		//display stars
		global $bur_display ;
		//check for profile, and bail if set to hidden
		if  ($profile == 'yes' && !empty($bur_display['profilehide_level_symbol']) ) return ;
		$checkname = 'hide_level_symbol' ;
		$check = get_user_meta($bur_id, $checkname, true); 
		$check = get_user_meta($bur_id, $checkname, true);
		//check for role exception
		$role = bbp_get_user_role( $bur_id );
		$checkname2 = $role.$checkname ;
		$check2 = (!empty($bur_display[$checkname2] ) ? $bur_display[$checkname2] : '') ; 
		//set to show in settings display, and not set to hide in user profile, and not set to hide in role
		if (!empty($bur_display["level_symbol"])&& empty ($check) && empty ($check2) ) {
			$star_per_line = 9 ;
			$n = (int) ($star_count / $star_per_line);
			$r = ($star_count % $star_per_line) ;
			//set stars
			if ($bur_display["star_type"] == 'white' )  $star = '☆' ;
			if ($bur_display["star_type"] == 'black' )  $star = '★' ;
			$stars_full = $star.$star.$star.$star.$star.$star.$star.$star.$star ;
			echo '<div class = "ur-symbol">' ;
				//display full lines
				$i = 1 ;
				while($i<= $n)   {
				echo '<li class = "bur_stars1">' ;
				echo $stars_full ;
				echo '</li>' ;
				
				$i++ ;
				}
				//display remainder
				echo '<li class = "bur_stars2">' ;
				$i = 1 ;
				while($i<= $r)   {
				echo $star ;
				$i++ ;
				}
				echo '</li>' ;
			echo '</div>' ;
		}
}
		
		function bur_display_image($image, $image_height, $image_width, $bur_id, $profile) {
		//display image
		global $bur_display ;
		//check for profile, and bail if set to hidden
		if  ($profile == 'yes' && !empty($bur_display['profilehide_rank_image']) ) return ;
		$checkname = 'hide_rank_image' ;
		$check = get_user_meta($bur_id, $checkname, true); 
		$check = get_user_meta($bur_id, $checkname, true);
		//check for role exception
		$role = bbp_get_user_role( $bur_id );
		$checkname2 = $role.$checkname ;
		$check2 = (!empty($bur_display[$checkname2] ) ? $bur_display[$checkname2] : '') ; 
		//set to show in settings display, and not set to hide in user profile, and not set to hide in role
			if (!empty($bur_display["display_image"])&& empty ($check) && empty ($check2) ) {
			echo '<li>' ;
			echo '<img src = "'.$image.'" height="'.$image_height.'" width="'.$image_width.'" >' ;	
			echo '</li>' ;
			}
		}
		
		
function bur_badges_display ($bur_id, $profile) {
	global $bur_display ;
	//check for profile, and bail if set to hidden
	if  ($profile == 'yes' && !empty($bur_display['profilehide_display_badges']) ) return ;
	if (!empty($bur_display["display_badges"])) {
		global $reply_id ;
		global $bur_badges ;
		if (empty( $bur_badges ) ) return ;
			$name="number_of_badges" ;	
			$number = (!empty($bur_badges[$name]) ? $bur_badges[$name] : '2') ;
			$i=1 ; //*************START OF user display badges LOOP************************  
				while($i<= $number)   { 
					$name = 'badge'.$i.'name' ;
					$checkname= 'bur_'.$name ;
					$display = get_user_meta( $bur_id, $checkname, true) ;
						if ($display == 'on' )  {  
						//we need to display this badge 
						$badgetype = 'badge'.$i.'type' ;
						$badgetype =  (!empty($bur_badges[$badgetype]) ? $bur_badges[$badgetype] : '2');
							if ($badgetype == 1 ) badgetype1 ($i) ;
							if ($badgetype == 2)  badgetype2 ($i) ;
							if ($badgetype == 3 ) badgetype2 ($i) ;
							if ($badgetype == 4 ) {
							badgetype1 ($i) ;
							badgetype2 ($i) ;
							}
						}
				//increments $i	
				$i++; 
				}
	}
}

function badgetype1 ($i) {
	//just an image
	global $bur_badges ;
	$image = (!empty($bur_badges['badge'.$i.'image']) ? $bur_badges['badge'.$i.'image'] : '') ;
	$image_height = (!empty($bur_badges['badge'.$i.'image_height']) ? $bur_badges['badge'.$i.'image_height'] : '') ;
	$image_width = (!empty($bur_badges['badge'.$i.'image_width']) ? $bur_badges['badge'.$i.'image_width'] : '') ;
	$tooltiptext = (!empty($bur_badges['badge'.$i.'tooltip_text']) ? $bur_badges['badge'.$i.'tooltip_text'] : '') ;
	$burtooltiptext = 'bur-tooltiptext'.$i ;
	if (empty($bur_badges['show_in_rows'])) {
		echo '<li>' ;
		echo '<div id = "badgeimage'.$i.'">' ;
	}
	if (!empty ($tooltiptext)) {
	echo '<div class="bur-tooltip"><img src = "'.$image.'" height="'.$image_height.'" width="'.$image_width.'" >' ;
	echo '<span class="'.$burtooltiptext.'">'.$tooltiptext.'</span></div>' ;
	}
	else {
		echo '<img src = "'.$image.'" height="'.$image_height.'" width="'.$image_width.'" >' ;
	}
	if (empty($bur_badges['show_in_rows'])) {
		echo '</div>' ;	
		echo '</li>' ;
	}
}

	
function badgetype2 ($i) {
	//text (with either background color if specified or image - styles.php checks which is required)
	global $bur_badges ;
	$text = (!empty($bur_badges['badge'.$i.'name']) ? $bur_badges['badge'.$i.'name'] : '') ;
	$tooltiptext = (!empty($bur_badges['badge'.$i.'tooltip_text']) ? $bur_badges['badge'.$i.'tooltip_text'] : '') ;
	$burtooltiptext = 'bur-tooltiptext'.$i ;
	if (empty($bur_badges['show_in_rows'])) {
	echo '<li>' ;
	echo '<div id = "badgetext'.$i.'">' ;
	}
	if (!empty ($tooltiptext)) {
		echo '<div class="bur-tooltip">'.$text ;
		echo '<span class="'.$burtooltiptext.'">'.$tooltiptext.'</span></div>' ;
	}
	else {
		echo $text ;
	}
	if (empty($bur_badges['show_in_rows'])) {
	echo '</div>' ;
	echo '</li>' ;
	}
	}	
	
	
	


?>
