<?php
/*
Template Name: Export Header
*/
if (!is_page(array('export', 'all', 'cornheads', 'no-dupes'))) 
	header('Location: /');

header("Content-Type: text/plain");
global $post;
//echo "<pre>";print_r($post);echo "</pre>";

define('ITEMS_PER_PAGE', '-1');
$export_args = array();
if (is_page('all') && $post->post_parent) { // 2950 = all
	$export_args = array('category_name'=>'inventory', 'posts_per_page' => ITEMS_PER_PAGE);
} elseif (is_page('cornheads') && $post->post_parent) { // 2952 = cornheads
	$export_args = array('category_name'=>'corn-heads', 'posts_per_page' => ITEMS_PER_PAGE);
} elseif (is_page('no-dupes') && $post->post_parent) { // 2954 = no-dupes
	$export_args = array('category_name'=>'inventory', 'posts_per_page' => ITEMS_PER_PAGE);
} elseif (is_page('export')) { // 2948 = export (parent)
	$export_args = array('category_name'=>'inventory', 'posts_per_page' => ITEMS_PER_PAGE);
} else {
	die();
}


// The Query
$export_query = new WP_Query( $export_args );
$count = 0;

$tab_header = "inventory_id" . "\t";
$tab_header .= "title" . "\t";
$tab_header .= "model" . "\t";
$tab_header .= "description" . "\t";
$tab_header .= "price" . "\t";
$tab_header .= "manufacturer" . "\t";
$tab_header .= "image" . "\t\r\n";
echo $tab_header;
if ( $export_query->have_posts() ) : while ( $export_query->have_posts() ) : $export_query->the_post();
$count++;

$meta_array = get_post_meta( $post->ID, '', false);

// display the site inventory id
$tab_listing = $post->ID . "\t";

// display the title
$tab_listing .= get_the_title() . "\t";

if (!empty($meta_array['wpcf-model'])) { 
	$tab_listing .= $meta_array['wpcf-model'][0] . "\t";
	// print_r($meta_array['wpcf-model']);
}

if (get_the_content()) { 
	$clean_content = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', get_the_excerpt());
	$tab_listing .= trim($clean_content) . "\t";
}

if (!empty($meta_array['wpcf-price'])) { 
	$wpcf_price = preg_replace('/([\$,])/', '', $meta_array['wpcf-price']);
	$wpcf_price = preg_replace('/\.[0]{2}/', '', $wpcf_price);
	$tab_listing .= $wpcf_price[0] . "\t";
}

$manufacturers = types_render_field('manufacturers', array('output' => 'normal'));
// echo "********* "; print_r($manufacturers); echo " *********";
if (!empty($manufacturers)) { 
	$tab_listing .= $manufacturers . "\t";
}



// Pull Image Files
$gallery_images = get_post_gallery_images();
$gallery_list = '';
$gallery_count = count($gallery_images);
foreach($gallery_images as $key => $gallery_image) {
	$gallery_list .= $gallery_image;
	if ($key+1 < $gallery_count) {
		$gallery_list .= ", ";
	}
}
if($gallery_count > 1){
	$gallery_list .= "\t";
}

$tab_listing .= $gallery_list;

$tab_listing .= "\r\n";

// echo "<pre>" . get_the_title();print_r($meta_array); echo "</pre>";
echo $tab_listing;


endwhile; endif;

/* Restore original Post Data */
wp_reset_postdata();


