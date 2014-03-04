<?php
/**
 * The main template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Linc
 * @since Linc 1.0
 */

echo '<div class="sidebar">';

dynamic_sidebar( 'top-right-sidebar' ); 

// PUT THE LOOP HERE FOR FEATURED POSTS
$featured_args = array( 'category_name' => 'featured-items', 'posts_per_page' => '4' );

// The Query
$the_query = new WP_Query( $featured_args );

// The Loop
if ( $the_query->have_posts() ) { 
	echo "<h3>Our Featured Items</h3>";
	echo '<ul class="featured">';
	while ( $the_query->have_posts() ) { $the_query->the_post();
		echo '<li>';

			// checking for post thumbnail
			if ( has_post_thumbnail() ) { 
				// if available, display
				echo '<a href="' . get_permalink() . '" title="'. get_the_title() .'">';
				the_post_thumbnail(array(220, 175));
				echo '</a>';
			}  

			?>
			<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
			<?php 
			$price = get_post_meta( $post->ID, 'wpcf-price', true );

			echo '<div class="price">';
			if (is_numeric($price)) {
				$price = '$' . number_format($price, 2);
			} 
			
			if ( $price == '$0.00' | $price == '$0' || is_null($price) || empty($price)) {
				$price = '<a href="/contact" title="'.PRICE_CONTACT_VERBIAGE.'">'.PRICE_CONTACT_VERBIAGE.'</a>';
			} 
			echo 'Price: ' . $price;
			echo '</div>';
		
		echo "</li>";
	} 
	echo "</ul>";
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

dynamic_sidebar( 'bottom-right-sidebar' ); 

echo '</div>';