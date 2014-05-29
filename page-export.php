<?php
/*
Template Name: Export No Header
*/
if (!is_page(array('export', 'all', 'cornheads', 'no-dupes'))) 
	header('Location: /');

header("Content-Type: text/plain; charset=utf-8");
global $post;
define('IMAGE_GALLERY_SIZE', '-220x165');
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
if ( $export_query->have_posts() ) : while ( $export_query->have_posts() ) : $export_query->the_post();
$count++;

// Dealer ID
$tab_listing = "1796" . "\t";

$meta_array = get_post_meta( $post->ID, '', false);

// display the site inventory id
$tab_listing = $post->ID . "\t";

// display the title
$tab_listing .= html_entity_decode(get_the_title(), ENT_QUOTES, 'UTF-8') . "\t"; // . get_the_title() . "\t";

if (!empty($meta_array['wpcf-model'])) { 
	$tab_listing .= $meta_array['wpcf-model'][0] . "\t";
	// print_r($meta_array['wpcf-model']);
}

if (get_the_content()) { 
	$clean_content = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', get_the_excerpt());
	$tab_listing .= html_entity_decode(trim($clean_content), ENT_QUOTES, 'UTF-8') . "\t";
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

// display year and new/used
if (!empty($meta_array['wpcf-year'])) { 
	$year = $meta_array['wpcf-year'][0];
	$tab_listing .= $year . "\t";
	if($year == date('Y') || $year == (date('Y')-1)){
		$tab_listing .= "New" . "\t";
	} else {
		$tab_listing .= "Used" . "\t";
	}
}

// display category
$count = 0;
$category_ids = wp_get_post_categories($post->ID);

$cat_count = count($category_ids);
$category_list = '';
foreach ($category_ids as $category_id) {
	$count++;
	// print_r($category->name);
	$category = get_category($category_id);
	$category_list .= $category->name;
	if ($count < $cat_count) {
		$category_list .= ", ";
	}
}
$tab_listing .= $category_list . "\t";

// Pull Image Files
$gallery_images = get_post_gallery_images();
$gallery_list = '';
$gallery_count = count($gallery_images);

// find the featured image URL
$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');

$featured_image = $large_image_url[0];
if ($gallery_count >= 1) {
	$featured_image .=  ", ";
} 

$gallery_list .= $featured_image;

foreach($gallery_images as $key => $gallery_image) {
	$gallery_image_clean = str_replace(IMAGE_GALLERY_SIZE, '', $gallery_image);
// echo "<pre>"; print_r($gallery_image_clean); echo "</pre>";
	$gallery_list .= $gallery_image_clean;
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


