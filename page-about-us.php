<?php
/*
Template Name: About Us
*/

get_header(); ?>
<div id="main" class="main wrapper">
	<div id="primary" class="content container">
		<div class="row">
			<div class="col-md-9">
				<h1 class="page-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			</div>
	 		<div class="col-md-3 search-form">
	 			<?php get_search_form(); ?>
	 		</div>
			<div class="col-md-12">
				<hr />
			</div>
			<div class="col-md-9">
				<?php if ( have_posts() ) : ?>
	
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
	
						<div class="entry">
							<?php the_content(); ?>
						</div>
	
					<?php endwhile;
					endif;
					/* Restore original Post Data */
					wp_reset_postdata();
		 		?>
			 		<?php
			 		$page_id     = get_queried_object_id();
			 		
			 		$page_args = array('post_parent'=>$page_id, 'post_type'=>'page', 'orderby' => 'menu_order', 'order' => ASC, 'posts_per_page' => 10);
			 		// echo '<pre>'; print_r($page_id); echo '</pre>';

			 		$page_children = get_posts($page_args);
			 		foreach($page_children as $page_child){
				 		
			 		if($page_child->ID == 32){continue;}
			 		$position = get_post_meta($page_child->ID, 'position', true);
			 		//echo '<pre>'; print_r($page_child); echo '</pre>';
			 		?>
			 		
		 		<div class="entry col-md-6">
		 			<h3><a href="<?php echo $page_child->guid; ?>" title="<?php echo $page_child->post_title; ?>"><?php echo $page_child->post_title; ?></a></h3>
		 			<h5><?php echo $position; ?></h5>
		 			<a href="<?php echo $page_child->guid; ?>" title="<?php echo $page_child->post_title; ?>"><?php echo get_the_post_thumbnail($page_child->ID, 'thumbnail'); ?></a>
		 		</div>
		 		<?php } ?>
 			</div>
 			<div class="col-md-3">
 				<?php get_sidebar( 'right' ); ?>
 			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>