<?php

//css settings page

function bur_custom_css() {
 ?>
	<table class="form-table">
					
	<tr valign="top">
	<th colspan="2">
		<h3>
		<?php _e ('Custom CSS' , 'bbp-user-ranking' ) ; ?>
		</h3>

			
<p>
<?php _e ('You can add any custom css here' , 'bbp-user-ranking' ) ; ?>
</p>
<p/>
<?php 
global $bur_css ;
	?>
	 <Form method="post" action="options.php">
	<?php wp_nonce_field( 'css', 'css-nonce' ) ?>
	<?php settings_fields( 'bur_css' );
	//create a style.css on entry and on saving
	generate_bur_css() ;
	?>	
	
		
<table class="form-table">
				
<!--add custom css---------------------------------------------------------------------->			
	<tr>
	<td>		
		<?php 
		$name = __('css', 'bbp-user-ranking') ;
		$item1="bur_css[".$name."]" ;
		$value1 = (!empty($bur_css[$name]) ? $bur_css[$name] : '');
		echo '<textarea id="'.$item1.'" class="large-text" name="'.$item1.'" rows="20" cols="40" >' ; 
		echo $value1 ; ?> 
		</textarea>
	</td>
	</tr>
			
</table>
<!-- save the options -->
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save changes', 'bbp-user-ranking' ); ?>" />
				</p>
				</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->

<?php
}


