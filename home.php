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
			<div></div>
		</div><!-- #home-banner -->
	</div><!-- #jumbotron -->
	<div id="primary" class="content container">
		<div class="row">
		<?php // The Query
			$args = array( 'cat' => '124' );
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post(); ?>

					<div class="col-md-3">
						<?php the_post_thumbnail(array(220,175)); ?>
						<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<?php $price = get_post_meta( $post->ID, 'wpcf-price', true ); ?>
						Price: <?php echo $price; ?>
					</div>

			<?php }
			} 
			/* Restore original Post Data */
			wp_reset_postdata();
 		?>
		</div>
	</div>

<?php get_footer(); ?>