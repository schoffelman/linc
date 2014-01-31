<?php /**  
* Functions.php file 
* @package WordPress  
* @subpackage Linc  
* @since Linc 1.0  
*/ 


/* 
* Theme Support Features 
*/

// Add menus to the linc theme
add_theme_support( 'menus' );

// Add post thumbnail funcitonality to theme
add_theme_support( 'post-thumbnails' );



/* 
* Theme features / enhancements 
*/

// Enable Custom Main Navigation Menue within WordPress admin
if (function_exists('register_nav_menus')){
	register_nav_menus( array(
		'main-navigation' => 'Top Main Navigation'
	) );
}


// Register the right sidebar for the interior pages
register_sidebar(array(
	'name' => 'Right Sidebar',
	'id' => 'right-sidebar',
	'before_widget' => '<li>',
	'after_widget' => "</li>",
	'before_title' => "<h3>",
	'after_title' => "</h3>",
    'description' => 'This sidebar is only for interior pages'
 ));

