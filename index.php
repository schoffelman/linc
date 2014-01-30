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

get_header(); ?>
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<?php 
				if(function_exists('bcn_display')) { 
					echo '<a href="/" title="Home" class="home">Home</a><span class="div">|</span><span class="current">'; 
					bcn_display(); 
					echo "</span>";
				} else { 
					echo "Home"; 
				} 
			?>
		</div>
	</div>
</div>
<div id="main" class="main wrapper">
	<div id="primary" class="content container">
		<div class="row">
			<div class="col-md-9">
				<h1><?php single_cat_title(); ?></h1>
			</div>
			<div class="col-md-3">
				<a href="#" title="#"><img src="<?php echo get_template_directory_uri(); ?>/images/request-more-info.png" alt="Request More Information" /></a>
			</div>
			<div class="col-md-12">
				<hr />
			</div>
			<div class="col-md-9">
				<div class="description">
					<?php echo category_description(); ?>
				</div>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

						<div class="accordion">
							<?php the_post_thumbnail(); ?>
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
							<?php $price = get_post_meta( $post->ID, 'wpcf-price', true ); ?>
							Price: <?php echo $price; ?>
						</div>

				<?php endwhile;
				endif;
				/* Restore original Post Data */
				wp_reset_postdata();
	 		?>
 			</div>
 			<div class="col-md-3">
 				<?php get_sidebar(); ?>
 			<div>
		</div>
	</div>
</div>

<?php get_footer(); ?>