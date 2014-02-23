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
 			</div>
 			<div class="col-md-3">
 				<?php get_sidebar( 'right' ); ?>
 			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>