<?php
/**
 * The homepage template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Linc
 * @since Linc 1.0
 */

get_header(); ?>

	<div id="jumbotron" class="jumbotron">
		<div id="home-banner" class="container home-banner" role="main">
			<div class="home-banner-bg"></div>
			<?php // if ( function_exists('show_nivo_slider') ) { show_nivo_slider(); } ?>
		</div><!-- #home-banner -->
	</div><!-- #jumbotron -->
	<div id="primary" class="content container">
		<div class="row featured-items">
		<?php // The Query
			$args = array( 'cat' => '124' );
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post(); ?>

					<div class="col-md-3 featured">							
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumb">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail(array(210, 175));
							} else {
								echo '<img src="'. get_template_directory_uri() .'/images/inventory-default.png" width="210" title="'. get_the_title() .'" />';
							} ?>
						</a>
						<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<?php $price = get_post_meta( $post->ID, 'wpcf-price', true ); ?>
						<span class="price">Price: <?php
							if ( $price != '$0.00' && $price != '$0' && !is_null($price)) { 
								echo $price; 
							} else {
								echo '<a href="/contact" title="contact us">Contact Us</a>';
							}
						?></span>
					</div>

			<?php }
			} 
			/* Restore original Post Data */
			wp_reset_postdata();
 		?>
		</div>
	</div>

<?php get_footer(); ?>