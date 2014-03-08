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
				<a href="<?php echo CONTACT_US; ?>" title="Request More Information"><img src="<?php echo get_template_directory_uri(); ?>/images/request-more-info.png" alt="Request More Information" /></a>
			</div>
			<div class="col-md-12">
				<hr />
			</div>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

				<div class="col-md-5 gallery">
						<?php //display site thumbnail ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
							<dl style="margin:0;">
								<dt>
									<div class="gallery1">
										<a href="<?php echo $large_image_url[0]; ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
								</dt>
							</dl>
						<?php } ?>
						<?php //display gallery code ?>
						<?php echo do_shortcode(' [gallery exclude="' . get_post_thumbnail_id( $post->ID ) . '"] '); ?>
	 			</div>
	 			<div class="col-md-7 inventory-entry">
 					<?php $price = get_post_meta( $post->ID, 'wpcf-price', true ); ?>
 					<div class="price">
						<h3><?php echo ludens_price_cleaning($price); ?></h3>
						 <a href="tel:<?php echo TEL_PHONE; ?>" title="Phone" class="phone-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/phone-icon.png" alt="phone" /></a>
						 <a href="<?php echo CONTACT_US; ?>" title="contact" class="email-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/mail-icon.png" alt="contact" /></a>
					</div>
					<div class="details">
						<?php the_excerpt(); ?>
						<div class="inventory_details">
							<?php 
								$manufacturers = types_render_field('manufacturers', array('output' => 'normal'));
								$inventory_details = Array(
									'alternative price' => get_post_meta( $post->ID, 'wpcf-alternative-price', true ),
									'model' => get_post_meta( $post->ID, 'wpcf-model', true ),
									'specification' => get_post_meta( $post->ID, 'wpcf-specification', true ),
									'year' => get_post_meta( $post->ID, 'wpcf-year', true ) ); 
								// echo "<pre>"; print_r($inventory_details); echo "</pre>";
								if (!empty($inventory_details)) {
									echo "<ul>";
									if (!empty($inventory_details['alternative price'])) {
										echo '<li><span>alternative price</span>: ' .  $inventory_details['alternative price'] . '</li>';
									}
									if (!empty($manufacturers)) {
										echo '<li><span>manufacturers</span>: ' .  $manufacturers . '</li>';
									}
									if (!empty($inventory_details['model'])) {
										echo '<li><span>model</span>: ' .  $inventory_details['model'] . '</li>';
									}
									echo '<li><span>price</span>: ' .  ludens_price_cleaning($price) . '</li>';
									if (!empty($inventory_details['year'])) {
										echo '<li><span>year</span>: ' .  $inventory_details['year'] . '</li>';
									}
									echo "</ul>";
									if (!empty($inventory_details['specification'])) {
										if ($key =="specification") {
											echo '<span class="lable">specifications</span>: ';
										} else {
											echo '';
										}
										echo  $inventory_details['specification'];
									}
								}
							 ?>
						</div>
					</div>
					<div class="disclaimer">
						<sup>*</sup> <i style="font-size:12px">This Information is Subject to Change</i>
					</div>

	 			</div>
				<?php endwhile;
				endif;
				/* Restore original Post Data */
				wp_reset_postdata();
	 		?>
		</div>
	</div>
</div>

<?php get_footer(); ?>