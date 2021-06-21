
<?php 
$data1 = get_option('bur_display') ;
$data2 = get_option('bur_badges') ;
$data3 = get_option('bur_ranks') ;
$datacss=get_option('bur_css') ;
global $bur_badges ;
global $bur_ranks ;
?>



/* RANKS--------------------------------------------------------------------*/
/*  1 ----------------------  set the symbol color --------------------------*/
<?php 
$field=$data1['symbol_color'] ;
if (!empty ($field)) {
?>
.ur-symbol {
	font-family: arial, "Times New Roman", Times, serif;
	font-size : 14px ;
	color :  <?php echo $field ;?>  ;
	
}

<?php } ?>


/*2. add the styling for the level names--------------------------------------*/

<?php 

$name="number_of_levels" ;	
$number = (!empty($bur_ranks[$name]) ? $bur_ranks[$name] : '2') ;
$i=1 ; 
//*************START OF user display level LOOP************************  
while($i<= $number)   { 
//do all the font stuff as it doesn't matter if needed or not
	$field=$data3['level'.$i.'font_size'] ;
	if (!empty ($field)) {
	if (is_numeric($field)) $field=$field.'px' ;
	echo '#level'.$i ;
	?>
		 
	 {
	font-size:  <?php echo $field ; ?> ;
	 }
	 <?php } ?>
	 
	<?php 
	$field=$data3['level'.$i.'font_color'] ;
	if (!empty ($field)) {
	echo '#level'.$i ;
	?>
	
	 
	 {
	color:  <?php echo $field ; ?> ;
	 }
	 <?php } ?>
	 
	 <?php 
	$field=$data3['level'.$i.'font'] ;
	if (!empty ($field)) {
	echo '#level'.$i ;
	?>
	
	 
	 {
	Font-Family:  <?php echo $field ; ?> ;
	 }
	 <?php } ?>
	 
	<?php 
	$field=$data3['level'.$i.'font_style'] ;

	if (!empty ($field)) {
	if (strpos($field,'Italic') !== false) {
	echo '#level'.$i ;
	?>
	
	 
	 {
	Font-Style:  italic ; 
	 }
	 <?php } 

	if (strpos($field,'Bold') !== false) {
	echo '#level'.$i ;
	?>
	
	 
	 {
	Font-weight:  bold ; 
	 }
	 <?php }
	 else { 
	 echo '#level'.$i ;
	 ?>
	 
	{
	Font-weight:  normal ; 
	}
	 	 
	 <?php
	} //end of else
	 
	} // end of font style
	
	//now we check if we need a background or image
	$check = (!empty($data3['level'.$i.'display_name_on_image']) ? $data3['level'.$i.'display_name_on_image'] : '') ;
	//option display background - check is empty
	if (empty ($check)) {	
		$field=$data3['level'.$i.'background_color'] ;
		if (!empty ($field)) {
		echo '#level'.$i ;
		?>
			{
			background-color:  <?php echo $field ; ?> ; 
			}
		
		<?php
		}
	}
	
	//option display image - check is true
	if (!empty ($check)) {
		
		$background = 'level'.$i.'image' ;
		$background=  (!empty($bur_ranks[$background]) ? $bur_ranks[$background] : '');
		$image_height = (!empty($bur_rannks['level'.$i.'image_height']) ? $bur_ranks['level'.$i.'image_height'] : '') ;
		$image_width = (!empty($bur_ranks['level'.$i.'image_width']) ? $bur_ranks['level'.$i.'image_width'] : '') ;
		$padding = $image_height / 2 ;
		echo '#level'.$i ;
		?>
			
 		{
			background-image: url( <?php echo $background ; ?> ) ;
			background-repeat: no-repeat;
			height : <?php echo $image_height ; ?> ;
			width : <?php echo $image_width ; ?> ;
			text-align : center ;
			padding-top : <?php echo $padding ; ?>px ;
		}

		
		<?php  		
		} //end of check
	
			
	
	//increments $i	
		$i++;

} ?>
	




/* BADGES--------------------------------------------------------------------*/

<?php 

$name="number_of_badges" ;	
$number = (!empty($bur_badges[$name]) ? $bur_badges[$name] : '2') ;
$i=1 ; 
//*************START OF user display badges LOOP************************  
while($i<= $number)   { 
//do all the font stuff as it doesn't matter if needed or not
	$field_size=$data2['badge'.$i.'font_size'] ;
	if (!empty ($field_size)) {
	if (is_numeric($field_size)) $field_size=$field_size.'px' ;
	echo '#badge'.$i ;
	?>
		 
	 {
	font-size:  <?php echo $field_size ; ?> ;
	 }
	 <?php } ?>
	 
	<?php 
	$field_color=$data2['badge'.$i.'font_color'] ;
	if (!empty ($field_color)) {
	echo '#badge'.$i ;
	?>
	
	 
	 {
	color:  <?php echo $field_color ; ?> ;
	 }
	 <?php } ?>
	 
	 <?php 
	$field=$data2['badge'.$i.'font'] ;
	if (!empty ($field)) {
	echo '#badge'.$i ;
	?>
	
	 
	 {
	Font-Family:  <?php echo $field ; ?> ;
	 }
	 <?php } ?>
	 
	<?php 
	$field=$data2['badge'.$i.'font_style'] ;

	if (!empty ($field)) {
	if (strpos($field,'Italic') !== false) {
	echo '#badge'.$i ;
	?>
	
	 
	 {
	Font-Style:  italic ; 
	 }
	 <?php } 

	if (strpos($field,'Bold') !== false) {
	echo '#badge'.$i ;
	?>
	
	 
	 {
	Font-weight:  bold ; 
	 }
	 <?php }
	 else { 
	 echo '#badge'.$i ;
	 ?>
	 
	{
	Font-weight:  normal ; 
	}
	 	 
	 <?php
	} //end of else
	 
	} // end of font style
	
	?>
	


	

<?php

//now see if we need to add styling for badge type
	$badgetype = 'badge'.$i.'type' ;
	$badgetype =  (!empty($bur_badges[$badgetype]) ? $bur_badges[$badgetype] : '2');
		//if type 1 - then just image so no css needed
		//if type 2 or 4, we need to add background color
		if (($badgetype == 2) || ($badgetype == 4)) {
		//add background color if specified 
		$background = 'badge'.$i.'background_color' ;
		$background=  (!empty($bur_badges[$background]) ? $bur_badges[$background] : '');
		if (!empty ($background)) {
		echo '#badge'.$i ;
		?>
			
 
			{
			background-color:  <?php echo $background ; ?> ; 
		}
		
		
		<?php } 		
		} //end of badgetype 2
		
		//if type 3 then add image as background 
		if ($badgetype == 3) {
		$background = 'badge'.$i.'image' ;
		$background=  (!empty($bur_badges[$background]) ? $bur_badges[$background] : '');
		$image_height = (!empty($bur_badges['badge'.$i.'image_height']) ? $bur_badges['badge'.$i.'image_height'] : '') ;
		$image_width = (!empty($bur_badges['badge'.$i.'image_width']) ? $bur_badges['badge'.$i.'image_width'] : '') ;
		$padding = $image_height / 2 ;
		echo '#badge'.$i ;
		?>
			
 		{
			background-image: url( <?php echo $background ; ?> ) ;
			background-repeat: no-repeat;
			height : <?php echo $image_height ; ?> ;
			width : <?php echo $image_width ; ?> ;
			text-align : center ;
			padding-top : <?php echo $padding ; ?>px ;
		}

		
		<?php		
		} //end of badgetype 3
		
		//set background for tooltip
		$background = 'badge'.$i.'background_color' ;
		$background=  (!empty($bur_badges[$background]) ? $bur_badges[$background] : 'grey');
		?>
		/* Tooltip text */
			<?php 
			echo '.bur-tooltip .bur-tooltiptext'.$i  ;
			?>
			{
				visibility: hidden;
				width : 180px;
				text-align: center;
				padding: 5px;
				border-radius: 6px;
				position: absolute;
				background-color:<?php echo $background ; ?> ;
				color: <?php echo $field_color ; ?> ;
				font-size:  <?php echo $field_size ; ?> ;
			}
			
			/* Show the tooltip text when you mouse over the tooltip container */
		<?php 
			echo '.bur-tooltip:hover .bur-tooltiptext'.$i  ;
			?>
		
		{
			
		visibility: visible;
		}
		<?php
		
		//increments $i	
		$i++;

} ?>


/*----------------------  set up li for buddypress display--------------------------*/


#buddypress div#item-header #bur_profile ul li
{
    float : none  ;
}

/*----------------------  set the tooltip text--------------------------*/
/* Tooltip container */
.bur-tooltip {
    position: relative;
    display: inline-block;
}




/*----------------------  custom css--------------------------*/
<?php

$field=$datacss['css'] ;
if (!empty ($field)) {
echo $field ;	
}
