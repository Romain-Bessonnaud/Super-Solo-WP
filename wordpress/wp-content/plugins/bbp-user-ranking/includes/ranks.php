<?php

//ranks settings page

function bur_ranks() {

 ?>
			
						<table class="form-table">
					
					<tr valign="top">
						<th colspan="2">
						
						<h3>
						<?php _e ('Ranks' , 'bur-user-ranking' ) ; ?>
						</h3>


						
					
<p>
<?php _e ('DO NOT FORGET TO CONFIGURE THE SETTINGS IN THE DISPLAY TAB TO ENSURE RANKS ARE SHOWN', 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('You can set as many levels as you wish' , 'bbp-user-ranking' ) ; ?>
</p>

<p>
<?php _e ('RANKING CALCULATIONS - Decide what counts as a item for ranking calculations' , 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('"Up to number" will be the number of "topics", "replies"  or "topics & replies" dependant on your setting in the Ranking Calculations' , 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('WARNING if you leave any "Up to number" blank that level will be ignored' , 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('Set the name if you are displaying names as set in the Display tab' , 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('Set the image if you are displaying images as set in the Display tab' , 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('You can optionally set the size of each image if required' , 'bbp-user-ranking' ) ; ?>
</p>
<p></p>
<?php global $bur_ranks ;?>
	
	<Form method="post" action="options.php">
	<?php wp_nonce_field( 'ranks', 'ranks-nonce' ) ?>
	<?php settings_fields( 'bur_ranks' );
	//create a style.css on entry and on saving
	generate_bur_css() ;
	?>	
	<table class="form-table">
	
		<tr><td> 
	<?php _e ('Ranking Calculations' , 'bbp-user-ranking' ) ; ?>
	</td></tr>
	<tr>
	<td style="vertical-align:top">
	<?php _e ('Ranking levels' , 'bbp-user-ranking' ) ; ?>
	</td>
	<td colspan = "2">
	<?php $value = (!empty($bur_ranks["count_topics"] ) ? $bur_ranks["count_topics"] : '') ;  ?>
	<?php echo '<input name="bur_ranks[count_topics]" id="bur_ranks[count_topics]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Include no. topics in ranking calculations';
 	?>
	</td>
	</tr>
	
	<tr>
	<td style="vertical-align:top">
	</td>
	<td colspan = "2">
	<?php $value = (!empty($bur_ranks["count_replies"] ) ? $bur_ranks["count_replies"] : '') ;  ?>
	<?php echo '<input name="bur_ranks[count_replies]" id="bur_ranks[count_replies]" type="checkbox" value="1" class="code" ' . checked( 1,$value, false ) . ' /> Include no. replies in ranking calculations';
 	?>
	</td>
	</tr>
	
	<tr>
	<td> 
	<?php _e ('Number of levels' , 'bbp-user-ranking' ) ; ?>
	</td>
	<?php
	$name="number_of_levels" ;
	$item1="bur_ranks[".$name."]" ;
	$top = (!empty($bur_ranks[$name]) ? $bur_ranks[$name] : '2') ;
	?>
	
	<td colspan = "4" style="vertical-align:top">
	<?php echo '<input id="'.$item1.'" class="small-text" name="'.$item1.'" type="text" value="'.esc_html( $top ).'"' ; ?> 
			<label class="description"><?php _e( 'Enter the no. levels you wish to have and press "Save changes" to generate', 'bbp-user-ranking' ); ?></label>
	</td>
	</tr>
	
	
	
	<tr>
	<th><?php _e ('Level' , 'bbp-user-ranking' ) ; ?></td>
	<th style="text-align:center"><?php _e ('Up to number' , 'bbp-user-ranking' ) ; ?></td>
	<th style="text-align:center"><?php _e ('Rank Name' , 'bbp-user-ranking' ) ; ?></td>
	<th style="text-align:center"><?php _e ('Image' , 'bbp-user-ranking' ) ; ?></td>
	<th style="text-align:center"><?php _e ('Image height' , 'bbp-user-ranking' ) ; ?></td>
	<th style="text-align:center"><?php _e ('Image width' , 'bbp-user-ranking' ) ; ?></td>
	</tr>
	<?php 
	$area1='posts' ;
	$area2='name' ;
	$area3='image' ;
	$area4='image_height' ;
	$area5='image_width' ;
	$area6='font_color' ;
	$area7='font' ;
	$area8='font_size' ;
	$area9='background_color' ;
	$area10='font_style' ;
	$area11='display_name_on_image' ;
	?>
	
	
	<?php $i=1 ; ?>
	<?php //*************START OF LEVEL LOOP************************  
	
	
	while($i<= $top)   {
	?>	
	<tr>
		<td style="vertical-align:top">
	<?php _e ('Level ' , 'bbp-user-ranking' ) ; ?>
	<?php echo $i ; ?>
	</td>
	
	<?php 
	
	$name = __('level', 'bbp-user-ranking').$i ;
	$item1="bur_ranks[".$name.$area1."]" ;
	$item2="bur_ranks[".$name.$area2."]" ;
	$item3="bur_ranks[".$name.$area3."]" ;
	$item4="bur_ranks[".$name.$area4."]" ;
	$item5="bur_ranks[".$name.$area5."]" ;
	$item5="bur_ranks[".$name.$area5."]" ;
	$item6="bur_ranks[".$name.$area6."]" ;
	$item7="bur_ranks[".$name.$area7."]" ;
	$item8="bur_ranks[".$name.$area8."]" ;
	$item9="bur_ranks[".$name.$area9."]" ;
	$item10="bur_ranks[".$name.$area10."]" ;
	$item11="bur_ranks[".$name.$area11."]" ;
	$value1 = (!empty($bur_ranks[$name.$area1]) ? $bur_ranks[$name.$area1] : '') ;
	$value2 = (!empty($bur_ranks[$name.$area2]) ? $bur_ranks[$name.$area2] : '') ;
	$value3 = (!empty($bur_ranks[$name.$area3]) ? $bur_ranks[$name.$area3] : '') ;
	$value4 = (!empty($bur_ranks[$name.$area4]) ? $bur_ranks[$name.$area4] : '') ;
	$value5 = (!empty($bur_ranks[$name.$area5]) ? $bur_ranks[$name.$area5] : '') ;
	$value5 = (!empty($bur_ranks[$name.$area5]) ? $bur_ranks[$name.$area5] : '') ;
	$value6 = (!empty($bur_ranks[$name.$area6]) ? $bur_ranks[$name.$area6] : '') ;
	$value7 = (!empty($bur_ranks[$name.$area7]) ? $bur_ranks[$name.$area7] : '') ;
	$value8 = (!empty($bur_ranks[$name.$area8]) ? $bur_ranks[$name.$area8] : '') ;
	$value9 = (!empty($bur_ranks[$name.$area9]) ? $bur_ranks[$name.$area9] : '') ;
	$value10 = (!empty($bur_ranks[$name.$area10]) ? $bur_ranks[$name.$area10] : '') ;
	$value11 = (!empty($bur_ranks[$name.$area11]) ? $bur_ranks[$name.$area11] : '') ;
		
	
	// Test if this is the last level, and if so don't ask for no. posts
	if ($i == $top) { ?>
	<td style="vertical-align:top">
	<?php _e ('Posts over the Level ' , 'bbp-user-ranking' ) ; 
	echo $top-1 ;
	_e (' will be allocated to this level' , 'bbp-user-ranking' ) ; ?>
	</td>
	<?php }
	if ($i <> $top ) { ?>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $value1 ).'"' ; ?> 
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( 'Enter the no. posts (as defined in Ranking Calculations above) eg 49, 599 etc.', 'bbp-user-ranking' ); ?></label></br>
			<?php } ?>
	</td>
	<?php }?>
	<?php  // END OF Test if this is the last level, and if so don't ask for no. posts ?>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $value2 ).'"' ; ?> 
			
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( 'Enter the name for this level if required', 'bbp-user-ranking' ); ?></label></br>
			<?php } ?>
	</td>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $value3 ).'"' ; ?>
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( 'Enter the URL of the image to use at this level if required', 'bbp-user-ranking' ); ?></label></br>
			<?php } ?>
	</td>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item4.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $value4 ).'"' ; ?> 
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( 'Image height if required eg 50px, 75% etc. ', 'bbp-user-ranking' ); ?></label></br>
			<?php } ?>
	</td>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item5.'" class="large-text" name="'.$item5.'" type="text" value="'.esc_html( $value5 ).'"' ; ?> 
			<?php if ($i == 1) { ?>
			<label class="description"><?php _e( 'Image width if required eg 50px, 75% etc.', 'bbp-user-ranking' ); ?></label></br>
			<?php } ?>
	</td>
	</tr>
	<tr>
	<td style="vertical-align:top"><i><?php _e( 'Name styling', 'bbp-user-ranking' ); ?></i></td>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item6.'" class="bur-color-picker" name="'.$item6.'" type="text" value="'.esc_html( $value6 ).'"' ; ?>
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( '<br/>Click to select the font color if required', 'bbp-user-ranking' ); ?></label></br>
			<?php }
				else { ?>
				<br><label class="description"><?php _e( '<br/>Font color', 'bbp-user-ranking' ); ?></label></br>	
				<?php } ?>
	</td>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item7.'" class="large-text" name="'.$item7.'" type="text" value="'.esc_html( $value7 ).'"' ; ?> 
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( 'Enter the font to use - default theme font', 'bbp-user-ranking' ); ?></label></br>
			<?php }
				else { ?>
				<br><label class="description"><?php _e( 'Font', 'bbp-user-ranking' ); ?></label></br>	
				<?php } ?>
	</td>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item8.'" class="large-text" name="'.$item8.'" type="text" value="'.esc_html( $value8 ).'"' ; ?> 
			<?php if ($i == 1) { ?>
			<label class="description"><?php _e( 'Enter the font size - Default 12px', 'bbp-user-ranking' ); ?></label></br>
			<?php }
				else { ?>
				<br><label class="description"><?php _e( 'Font size', 'bbp-user-ranking' ); ?></label></br>	
				<?php } ?>
	</td>
	<td style="vertical-align:top">
	<?php echo '<input id="'.$item9.'" class="bur-color-picker" name="'.$item9.'" type="text" value="'.esc_html( $value9 ).'"' ; ?>
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( '<br/>Click to select the background color if required', 'bbp-user-ranking' ); ?></label></br>
			<?php }
				else { ?>
				<br><label class="description"><?php _e( '<br/>Background color', 'bbp-user-ranking' ); ?></label></br>	
				<?php } ?>
	</td>
	
	
	<td style="vertical-align:top">
			<select name="<?php echo $item10 ; ?>">
			<?php echo '<option value="'.esc_html( $value10).'">'.esc_html( $value10 ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			<br>
			<?php _e ('Font style' , 'bbp-style-pack' ) ;?>	
			
			</td>
	</tr>
	
	<tr>
	
	<td style="vertical-align:top">
	</td> <td colspan="2">
	<?php echo '<input name="'.$item11.'" id="'.$item11.'" type="checkbox" value="1" class="code" ' . checked( 1,$value11, false ) . ' /> Show the rank name superimposed on the image';
 	?>
	</td>
	</tr>
	
	
	
	<?php
	//increments $i	
		$i++;	
	} ?>
	<?php //*************END OF LEVEL LOOP************************  ?>

	
	
	
	
	
	
	
	</table>
	
	<table class="form-table">
	<tr valign="top">
	</tr>

	
		
<!-- save the options -->
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save changes', 'bbp-user-ranking' ); ?>" />
				</p>
				</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->
	
	 
		

<?php

}




