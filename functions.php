<?php /**  
* Functions.php file 
* @package WordPress  
* @subpackage Linc  
* @since Linc 1.0  
*/ 

define('PRICE_CONTACT_VERBIAGE', 'Contact Us');
define('CONTACT_US', '/contact-us');
define('TEL_PHONE', '16053634000');


// change the excerpt length
function custom_excerpt_length( $length ) {
    return 1500;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// remove ellipsis
function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');



/* 
* Theme Support Features 
*/

// Add menus to the linc theme
add_theme_support( 'menus' );

// Add post thumbnail funcitonality to theme
add_theme_support( 'post-thumbnails' );

// function used to preformat pricing
function ludens_price_cleaning($price) {

    // set default contact link if price isn't available
    $contact_link = '<a href="'.CONTACT_US.'" title="'.PRICE_CONTACT_VERBIAGE.'">'.PRICE_CONTACT_VERBIAGE.'</a>';

    // if price is "sold", format and return it
    if ($price == "sold"){
        return '<span style="font-weight:bold;">SOLD</span>';
    } 

    // check to see if the value is empty
    if (!empty($price)) {

        // clean it of all nonessential formatting
        $price = money_format('%.0n', preg_replace("/[^0-9.]/", "", $price));

        // if the price is numeric, empty and not equal to 0 - not sure if i actually need is_numeric
        if ( is_numeric($price) && $price != 0) {
            return '$' . number_format($price, 2);
        } 
    }

    // all else fails, return the contact link
    return $contact_link;
}

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
    'name' => 'Top Right Sidebar',
    'id' => 'top-right-sidebar',
    'before_widget' => '<div class="widget">',
    'after_widget' => "</div>",
    'before_title' => "<h3>",
    'after_title' => "</h3>",
    'description' => 'This is the top right sidebar for all interior pages'
 ));

// Register the right sidebar for the interior pages
register_sidebar(array(
    'name' => 'Bottom Right Sidebar',
    'id' => 'bottom-right-sidebar',
    'before_widget' => '<div class="widget">',
    'after_widget' => "</div>",
    'before_title' => "<h3>",
    'after_title' => "</h3>",
    'description' => 'This is the bottom right sidebar for all interior pages'
 ));




// Taken from the example by Eggplant Studios at:
// http://www.eggplantstudios.ca/wordpress-create-a-dropdown-select-menu-with-wp_nav_menu/
class Nav_Menu_Dropdown extends Walker_Nav_Menu {
 
    function start_lvl($output, $depth) {}
 
    function end_lvl($output, $depth) {}
 
    function start_el($output, $item, $depth, $args) {
        // Here is where we create each option.
        $item_output = '';
 
        // add spacing to the title based on the depth
        $item->title = str_repeat("&amp;nbsp;", $depth * 4) . $item->title;
 
        // Get the attributes.. Though we likely don't need them for this...
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' value="'   . esc_attr( $item->url        ) .'"' : '';
 
        // Add the html
        $item_output .= '<option'. $attributes .'>';
        $item_output .= apply_filters( 'the_title_attribute', $item->title );
 
        // Add this new item to the output string.
        $output .= $item_output;
 
    }
 
    function end_el($output, $item, $depth) {
        // Close the item.
        $output .= "</option>\n";
 
    }
 
}

add_action('wp_footer', 'dropdown_menu_scripts');
function dropdown_menu_scripts() {
    ?>
        <script>
          jQuery(document).ready(function ($) {
            $("select#drop-nav").change(function() {
                window.location = $(this).find("option:selected").val();
            });
          });
        </script>
    <?php
}

