<?php

//badges settings page

function bur_badges() {

 ?>
			
						<table class="form-table">
					
					<tr valign="top">
						<th colspan="2">
						
						<h3>
						<?php _e ('Badges' , 'bur-user-ranking' ) ; ?>
						</h3>


						
					
<p>
<?php _e ('DO NOT FORGET TO CONFIGURE THE SETTINGS IN THE DISPLAY TAB TO ENSURE BADGES ARE SHOWN', 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('This section lets you create a number of badges, and then in user edit you can allocate one or more badges to individual users', 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('For instance you may want to have a badge for expert users, or to show what group(s) they belong to, or for donators to your site etc.', 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('You can set up as many badges as you wish' , 'bbp-user-ranking' ) ; ?>
</p>
<p>
<?php _e ('Use Dashboard>users and edit user to set which badges each user has' , 'bbp-user-ranking' ) ; ?>
</p>

<p>
<?php _e ('Where a user has multiple badges, they will be shown in the order below ie badge 1 followed by badge 2 etc.' , 'bbp-user-ranking' ) ; ?>
</p>
<p></p>





<?php global $bur_badges ;?>
	
	<Form method="post" action="options.php">
	<?php wp_nonce_field( 'badges', 'badges-nonce' ) ?>
	<?php settings_fields( 'bur_badges' );
	//create a style.css on entry and on saving
	generate_bur_css() ;
	?>	
	
<?php

	$name = __('show_in_rows', 'bbp-user-ranking') ;
	$item0="bur_badges[".$name."]" ;
	$value0 = (!empty($bur_badges[$name]) ? $bur_badges[$name] : 0) ;
	
?>
<hr>
<table>

	<tr>
		<td>
		</td>
		<td style="vertical-align:top">
			<?php
				echo '<input name="'.$item0.'" id="'.$value0.'" type="radio" value="0" class="code"  ' . checked( 0,$value0, false ) . ' />' ;
				_e ('Show multiple badges in columns' , 'bbp-style-pack' ) ;?>
				<br><label class="description"><?php _e( '<i>Where a user has multiple badges these will show under each other</i>' , 'bbp-style-pack' ); ?></label>
		</td>
		<td style="vertical-align:top">
			<?php
				echo '<input name="'.$item0.'" id="'.$value0.'" type="radio" value="1" class="code"  ' . checked( 1,$value0, false ) . ' />' ;
				_e ('Show multiple badges in rows' , 'bbp-style-pack' ) ;?>
				<br><label class="description"><?php _e( '<i>Where a user has multiple badges these will show beside each other </i>' , 'bbp-style-pack' ); ?></label>
				
		</td>
	
	</tr>

</table>
<hr>
<p>
<?php _e ('You can display a badge in 4 different ways' , 'bbp-user-ranking' ) ; ?>
</p>
	<table>
	<tr>
	<td style="width : 150px">
	<?php
	//show style image
	 echo '<img src="' . plugins_url( 'images/image3.jpg',dirname(__FILE__)  ) . '"  height=200px> '; ?>
	 </td>
	 <td style="width : 150px">
	 <?php
	 echo '<img src="' . plugins_url( 'images/image4.jpg',dirname(__FILE__)  ) . '" height=200px> '; ?>
	 </td>
	  <td style="width : 150px">
	 <?php
	 echo '<img src="' . plugins_url( 'images/image6.jpg',dirname(__FILE__)  ) . '" height=200px> '; ?>
	 </td>
	  <td style="width : 150px">
	 <?php
	 echo '<img src="' . plugins_url( 'images/image7.jpg',dirname(__FILE__)  ) . '" height=200px> '; ?>
	 </td>
	 </tr>
	 <tr>
	<th style="text-align:center"> Image</th>
	<th style="text-align:center"> Name </th>
	<th style="text-align:center"> Name superimposed on image </th>
	<th style="text-align:center"> Name below image </th>
	</tr>
	<tr>
	 </table>
	 
<hr>	 
	<table class="form-table">
	
		
	
	
	<tr>
	<td> 
	<?php _e ('Number of Badges' , 'bbp-user-ranking' ) ; ?>
	</td>
	<?php
	$name="number_of_badges" ;
	$item1="bur_badges[".$name."]" ;
	$top = (!empty($bur_badges[$name]) ? $bur_badges[$name] : '2') ;
	?>
	
	<td colspan = "4" style="vertical-align:top">
	<?php echo '<input id="'.$item1.'" class="small-text" name="'.$item1.'" type="text" value="'.esc_html( $top ).'"' ; ?> 
			<label class="description"><?php _e( 'Enter the no. of badges you wish to have and press "Save changes" to generate', 'bbp-user-ranking' ); ?></label>
	</td>
	</tr>
	
	</table>
	
<hr>	
	
	
	<table>
	<tr>
	<th ><?php _e ('Badge' , 'bbp-user-ranking' ) ; ?></th>
	
	<th></th>
	
	
	</tr>
	<table>
	<?php 
	$area0='type' ;
	$area1='name' ;
	$area2='image' ;
	$area3='image_height' ;
	$area4='image_width' ;
	$area5='font_color' ;
	$area6='font' ;
	$area7='font_size' ;
	$area8='background_color' ;
	$area9='font_style' ;
	$area10 = 'tooltip_text' 
	
	
	
		
	?>
	
	
	<?php $i=1 ; ?>
	<?php //*************START OF badges LOOP************************  
	
	
	while($i<= $top)   {
	?>	
	<table>
	<tr>
		<td style="vertical-align:top ">
	<?php _e ('Badge ' , 'bbp-user-ranking' ) ; ?>
	<?php echo $i ; ?>
	</td>
	<?php
	
	
	$name = __('badge', 'bbp-user-ranking').$i ;
	$item0="bur_badges[".$name.$area0."]" ;
	$item1="bur_badges[".$name.$area1."]" ;
	$item2="bur_badges[".$name.$area2."]" ;
	$item3="bur_badges[".$name.$area3."]" ;
	$item4="bur_badges[".$name.$area4."]" ;
	$item5="bur_badges[".$name.$area5."]" ;
	$item6="bur_badges[".$name.$area6."]" ;
	$item7="bur_badges[".$name.$area7."]" ;
	$item8="bur_badges[".$name.$area8."]" ;
	$item9="bur_badges[".$name.$area9."]" ;
	$item10="bur_badges[".$name.$area10."]" ;
	
	
	$value0 = (!empty($bur_badges[$name.$area0]) ? $bur_badges[$name.$area0] : 2) ;
	$value1 = (!empty($bur_badges[$name.$area1]) ? $bur_badges[$name.$area1] : '') ;
	$value2 = (!empty($bur_badges[$name.$area2]) ? $bur_badges[$name.$area2] : '') ;
	$value3 = (!empty($bur_badges[$name.$area3]) ? $bur_badges[$name.$area3] : '') ;
	$value4 = (!empty($bur_badges[$name.$area4]) ? $bur_badges[$name.$area4] : '') ;
	$value5 = (!empty($bur_badges[$name.$area5]) ? $bur_badges[$name.$area5] : '') ;
	$value6 = (!empty($bur_badges[$name.$area6]) ? $bur_badges[$name.$area6] : '') ;
	$value7 = (!empty($bur_badges[$name.$area7]) ? $bur_badges[$name.$area7] : '') ;
	$value8 = (!empty($bur_badges[$name.$area8]) ? $bur_badges[$name.$area8] : '') ;
	$value9 = (!empty($bur_badges[$name.$area9]) ? $bur_badges[$name.$area9] : '') ;
	$value10 = (!empty($bur_badges[$name.$area10]) ? $bur_badges[$name.$area10] : '') ;
	?>
	
	
		<td style="vertical-align:top">
		<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $value1 ).'"' ; 
				_e ('Badge Name' , 'bbp-style-pack' ) ;?>
				<?php if ($i == 1) { ?>
				<br><label class="description"><?php _e( '<i>(Enter the name for this badge)</i>' , 'bbp-style-pack' ); ?></label>
				<?php } ?>
		</td>
	
	</tr>
	<tr>
		<td>
		</td>
		<td style="vertical-align:top">
			<?php
				echo '<input name="'.$item0.'" id="'.$value0.'" type="radio" value="1" class="code"  ' . checked( 1,$value0, false ) . ' />' ;
				_e ('Click to display image' , 'bbp-style-pack' ) ;?>
				<?php if ($i == 1) { ?>
				<br><label class="description"><?php _e( '<i>(Use just an image that you have uploaded)</i>' , 'bbp-style-pack' ); ?></label>
				<?php } ?>
		</td>
		<td style="vertical-align:top">
			<?php
				echo '<input name="'.$item0.'" id="'.$value0.'" type="radio" value="2" class="code"  ' . checked( 2,$value0, false ) . ' />' ;
				_e ('Click to display name' , 'bbp-style-pack' ) ;?>
				<?php if ($i == 1) { ?>
				<br><label class="description"><?php _e( '<i>(Use just the badge name - with a background color if desired )</i>' , 'bbp-style-pack' ); ?></label>
				<?php } ?>
		</td>
	
		<td style="vertical-align:top">
			<?php
			echo '<input name="'.$item0.'" id="'.$value0.'" type="radio" value="3" class="code"  ' . checked( 3,$value0, false ) . ' />' ;
			_e ('Click to display name on top of image' , 'bbp-style-pack' ) ;?>
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( '<i>(Use the badge name superimposed on an image)</i>' , 'bbp-style-pack' ); ?></label>
			<?php } ?>
		</td>
	
		<td style="vertical-align:top">
			<?php
			echo '<input name="'.$item0.'" id="'.$value0.'" type="radio" value="4" class="code"  ' . checked( 4,$value0, false ) . ' />' ;
			_e ('Click to display name below image' , 'bbp-style-pack' ) ;?>
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( '<i>(Use the badge name below an image)</i>' , 'bbp-style-pack' ); ?></label>
			<?php } ?>
		</td>
	</tr>
	
	<tr>
		<td>
		</td>
		<td style="vertical-align:top">
		<?php 
		_e ('Tooltip Text' , 'bbp-style-pack' ) ;?>
		</td>
		<td colspan=2 style="vertical-align:top">
			<?php 
			echo '<input id="'.$item10.'" class="large-text" name="'.$item10.'" type="text" value="'.esc_html( $value10 ).'"' ; 
			_e ('Tooltip Text' , 'bbp-style-pack' ) ;?>
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( '<i>(Tooltip text will be shown when the user puts the mouse over the badge - leave blank or add text as desired)</i>' , 'bbp-style-pack' ); ?></label>
			<?php } ?>
		</td>
	</tr>
	
	
	<tr>
		<td> 
		</td>
	
		<td style="vertical-align:top">
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $value2 ).'"' ; ?>
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( 'Enter the FULL url of the image to use', 'bbp-user-ranking' ); ?></label></br>
			<?php }
				else { ?>
				<br><label class="description"><?php _e( 'url', 'bbp-user-ranking' ); ?></label></br>	
				<?php } ?>
		</td>
		<td style="vertical-align:top">
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $value3 ).'"' ; ?> 
			<?php if ($i == 1) { ?>
			<br><label class="description"><?php _e( 'Image height if required eg 50px etc. ', 'bbp-user-ranking' ); ?></label></br>
			<?php }
				else { ?>
				<br><label class="description"><?php _e( 'Height', 'bbp-user-ranking' ); ?></label></br>	
				<?php } ?>
		</td>
		<td style="vertical-align:top">
		<?php echo '<input id="'.$item4.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $value4 ).'"' ; ?> 
			<?php if ($i == 1) { ?>
			<label class="description"><?php _e( 'Image width if required eg 50px etc.', 'bbp-user-ranking' ); ?></label></br>
			<?php }
				else { ?>
				<br><label class="description"><?php _e( 'Width', 'bbp-user-ranking' ); ?></label></br>	
				<?php } ?>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top">
		</td>
	
	
		<td style="vertical-align:top">
		<?php echo '<input id="'.$item5.'" class="bur-color-picker" name="'.$item5.'" type="text" value="'.esc_html( $value5 ).'"' ; ?>
				<?php if ($i == 1) { ?>
				<br><label class="description"><?php _e( '<br/>Click to select the font color if required', 'bbp-user-ranking' ); ?></label></br>
				<?php }
					else { ?>
					<br><label class="description"><?php _e( '<br/>Font color', 'bbp-user-ranking' ); ?></label></br>	
					<?php } ?>
		</td>
		<td style="vertical-align:top">
		<?php echo '<input id="'.$item6.'" class="large-text" name="'.$item6.'" type="text" value="'.esc_html( $value6 ).'"' ; ?> 
				<?php if ($i == 1) { ?>
				<br><label class="description"><?php _e( 'Enter the font to use - default theme font', 'bbp-user-ranking' ); ?></label></br>
				<?php }
					else { ?>
					<br><label class="description"><?php _e( 'Font', 'bbp-user-ranking' ); ?></label></br>	
					<?php } ?>
		</td>
		<td style="vertical-align:top">
		<?php echo '<input id="'.$item7.'" class="large-text" name="'.$item7.'" type="text" value="'.esc_html( $value7 ).'"' ; ?> 
				<?php if ($i == 1) { ?>
				<label class="description"><?php _e( 'Enter the font size - Default 12px', 'bbp-user-ranking' ); ?></label></br>
				<?php }
					else { ?>
					<br><label class="description"><?php _e( 'Font size', 'bbp-user-ranking' ); ?></label></br>	
					<?php } ?>
		</td>
		<td style="vertical-align:top">
		<?php echo '<input id="'.$item8.'" class="bur-color-picker" name="'.$item8.'" type="text" value="'.esc_html( $value8 ).'"' ; ?>
				<?php if ($i == 1) { ?>
				<br><label class="description"><?php _e( '<br/>Click to select the background color if required', 'bbp-user-ranking' ); ?></label></br>
				<?php }
					else { ?>
					<br><label class="description"><?php _e( '<br/>Background color', 'bbp-user-ranking' ); ?></label></br>	
					<?php } ?>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td style="vertical-align:top">
			
			<select name="<?php echo $item9 ; ?>">
			<?php echo '<option value="'.esc_html( $value9).'">'.esc_html( $value9 ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			<br>
			<?php _e ('Font style' , 'bbp-style-pack' ) ;?>	
			
			</td>
	</tr>
<table>
<hr>
	
	
	
	
	
	<?php
	//increments $i	
		$i++;	
	} ?>
	<?php //*************END OF badges LOOP************************  ?>

	
	
	
	
	
	
	
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




