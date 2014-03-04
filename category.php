<?php
/**
 * The category template file
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
				<h1 class="page-title"><?php single_cat_title(); ?></h1>
			</div>
			<div class="col-md-3">
				<a href="<?php echo CONTACT_US; ?>" title="Request More Information" class="more-info"><img src="<?php echo get_template_directory_uri(); ?>/images/request-more-info.png" alt="Request More Information" /></a>
			</div>
			<div class="col-md-12">
				<hr />
			</div>
			<?php 

				// query the current category
				$term = get_queried_object();

				// pull a list of categories, with the starting category as this currrent pages category.
				$children = get_terms( $term->taxonomy, array(
					'parent'    => $term->term_id,
					'hide_empty' => false
				) );

				//	echo "<pre>";print_r($children);echo "</pre>";

				// check to see if there are any children categories.
				if ( $children ) {

					// if there are any categories, pull a list of them like the category-inventory.php 
					// template using the current term as the parent
					$child_args = array(
						'show_count' => 1,
						'child_of' => $term->term_id,
						'depth' => 1,
						'title_li' => ''
					); ?>

					<div class="col-md-9">
						<div class="description">
							<?php echo category_description(); ?>
						</div>
						<ul class="inventory">
							<?php wp_list_categories( $child_args ); ?>
						</ul>
		 			</div>
		 			<div class="col-md-3 rightsidebar">
		 				<?php get_sidebar( 'right' ); ?>
		 			<div>

				<?php 

				// otherwise, if there are no child categories, display the posts within the current category.
				} else { 

					// list the parameters for the query
					// add 'paged' => get_query_var('paged') for prev/next links
					$product_args = array( 
						'posts_per_page' => -1,
						'cat' => $term->term_id,
						'orderby' => 'meta_value_num title',
						'meta_key' => 'wpcf-model',
						'order' => 'ASC'
					);

					$product_listing = new WP_Query( $product_args );
					// echo "<pre>"; print_r($product_listing); echo "</pre>";


					// The Loop
					if ( $product_listing->have_posts() ) : while ( $product_listing->have_posts() ) : $product_listing->the_post(); ?>

						<div class="col-md-3 products">						
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

				<?php endwhile; /*?>
					<div class="col-md-12">
						<div class="nav-next alignleft green"><?php previous_posts_link( '&laquo; Previous Page' ); ?></div>
						<div class="nav-previous alignright green"><?php next_posts_link( 'Next Page &raquo;' ); ?></div>
					</div>
				<?php */ endif;
				} 
				/* Restore original Post Data */
				wp_reset_postdata();
	 		?>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.inventory li').click(function(){
		var cat_url = $(this).children('a').attr("href");
		window.open(cat_url, "_self");
	});
});
</script>
<?php get_footer(); ?>