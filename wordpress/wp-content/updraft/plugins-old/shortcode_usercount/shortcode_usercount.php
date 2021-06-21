<?php
/*
Plugin Name: User count
Author: Matéo Fernandez
Description: Compte le nombre de compte inscrits sur le site.
Version: 1.0.0
*/

// Function to return user count
function wpb_user_count() { 
	$usercount = count_users();
	$result = $usercount['total_users']; 
	return $result; 
} 
// Creating a shortcode to display user count
add_shortcode('user_count', 'wpb_user_count');