<?php
/*
Template Name: Search Page
*/
get_header();

global $query_string, $wp_query;

$total_results = $wp_query->found_posts;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$search = new WP_Query($search_query);

?>
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<?php 
				if(function_exists('bcn_display')) { 
					echo '<a href="/" title="Home" class="home">Home</a><span class="div">|</span><span class="current">Page Not Found</span>';
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
				<h1 class="page-title"><a href="/" title="<?php echo $_GET['s']; ?>"><?php if(!empty($total_results)) {echo $total_results . ' '; } ?>Result(s) for "<?php echo $_GET['s']; ?>"</a></h1>
			</div>
			<div class="col-md-3 more-info">
				<a href="<?php echo CONTACT_US; ?>" title="Request More Information"><img src="<?php echo get_template_directory_uri(); ?>/images/request-more-info.png" alt="Request More Information" /></a>
			</div>
			<div class="col-md-12">
				<hr />
			</div>
			<div class="col-md-9">
				<?php get_search_form(); ?>
				<?php if ( have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="entry">
							<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
						</div>
					<?php endwhile; ?> 
					<div class="col-md-12">
						<div class="nav-next alignleft green"><?php previous_posts_link( '&laquo; Previous Page' ); ?></div>
						<div class="nav-previous alignright green"><?php next_posts_link( 'Next Page &raquo;' ); ?></div>
					</div>
				<?php endif; ?>
 			</div>
 			<div class="col-md-3">
 				<?php get_sidebar( 'right' ); ?>
 			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>