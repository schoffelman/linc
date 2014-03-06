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
			<div class="home-banner-bg">
				<?php if( function_exists('cyclone_slider') ) cyclone_slider('homepage-slideshow'); ?>
			</div><!-- .home-banner-bg -->
		</div><!-- #home-banner -->
	</div><!-- #jumbotron -->
	<div id="primary" class="content container">
		<div class="home-content">
			<div class="col-md-9 col-sm-8 entry">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
				<?php endwhile;	endif;
					/* Restore original Post Data */
					wp_reset_postdata();
		 		?>
			</div>
	 		<div class="col-md-3 col-sm-4 search-form">
	 			<?php get_search_form(); ?>
	 		</div>
	 	</div>
	 	<div class="clear"></div>
		<div class="row featured-items">
		<?php // The Query
			$args = array( 'category_name' => 'featured-items', 'posts_per_page' => '4' );
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post(); ?>

					<div class="col-sm-6 col-xs-6 col-md-3 featured">							
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumb">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail(array(210, 175));
							} else {
								echo '<img src="'. get_template_directory_uri() .'/images/inventory-default.png" width="210" title="'. get_the_title() .'" />';
							} ?>
						</a>
						<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<?php 
							$price = get_post_meta( $post->ID, 'wpcf-price', true ); 
							if($price == "sold"){
								$price = '<span style="font-weight:bold;">SOLD</span>';
							} else {
								$price = money_format('%.0n', preg_replace("/[^0-9.]/", "", $price));
								if (is_numeric($price) && $price != 0) {
									$price = '$' . number_format($price, 2);
								} else {
									$price = '<a href="'.CONTACT_US.'" title="'.PRICE_CONTACT_VERBIAGE.'">'.PRICE_CONTACT_VERBIAGE.'</a>';
								} 
							}
						?>
						<span class="price">Price: <?php echo $price; ?></span>
					</div>

			<?php }
			} 
			/* Restore original Post Data */
			wp_reset_postdata();
 		?>
		</div>
	</div>

<?php get_footer(); ?>