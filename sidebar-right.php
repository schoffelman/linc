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



// PUT THE LOOP HERE FOR FEATURED POSTS
$featured_args = array( 'category__in' => 124 );

// The Query
$the_query = new WP_Query( $featured_args );

// The Loop
if ( $the_query->have_posts() ) { 
	echo "<h2>Our Featured Items</h2>";
	echo "<ul>";
	while ( $the_query->have_posts() ) { $the_query->the_post();
		echo "<li>";

			the_post_thumbnail(); ?>
			<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
			<?php 
			$price = get_post_meta( $post->ID, 'wpcf-price', true );
			echo "Price: ". $price; 
		
		echo "</li>";
	} 
	echo "</ul>";
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

dynamic_sidebar( 'right-sidebar' ); 