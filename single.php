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
				<?php $previous_page = $_SERVER['HTTP_REFERER']; ?>
				<h1 class="page-title">
					<a href="<?php echo $previous_page; ?>" title="back" class="prev-page"><img src="<?php echo get_template_directory_uri(); ?>/images/back-button.png" alt="back to previous page" /></a>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="link-page-title"><?php the_title(); ?></a>
				</h1>
			</div>
			<div class="col-md-3 more-info">
				<a href="#" title="#"><img src="<?php echo get_template_directory_uri(); ?>/images/request-more-info.png" alt="Request More Information" /></a>
			</div>
			<div class="col-md-12">
				<hr />
			</div>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

				<div class="col-md-5 gallery">
					<?php the_post_thumbnail(); ?>
	 			</div>
	 			<div class="col-md-7 inventory-entry">
 				
 					<div class="price">
						<h3><?php 
							$price = get_post_meta( $post->ID, 'wpcf-price', true ); 
						
							if ( $price != '$0.00' && $price != '$0' && !is_null($price)) {
								echo $price;
							} else {
								echo 'Call for Price';
							} 

						 ?></h3>
						 <a href="tel:16053515387" title="Phone" class="phone-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/phone-icon.png" alt="phone" /></a>
						 <a href="mailto:text@example.com" title="email" class="email-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/mail-icon.png" alt="email" /></a>
					</div>
					<div class="details">
						<?php the_content(); ?>
					</div>

	 			<div>
				<?php endwhile;
				endif;
				/* Restore original Post Data */
				wp_reset_postdata();
	 		?>
		</div>
	</div>
</div>

<?php get_footer(); ?>