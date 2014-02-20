<?php
/**
 * The template for displaying 404 pages (Not Found)
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
				<h1 class="page-title"><a href="/" title="Oops, Page Not Found">Oops, Page Not Found</a></h1>
			</div>
			<div class="col-md-3 more-info">
				<a href="<?php echo CONTACT_US; ?>" title="Request More Information"><img src="<?php echo get_template_directory_uri(); ?>/images/request-more-info.png" alt="Request More Information" /></a>
			</div>
			<div class="col-md-12">
				<hr />
			</div>
			<div class="col-md-9">
				<div class="entry">
					<p>
						The page you are trying to reach is either not avialable or can not be found. You can go to the <a href="/" title="Home">Home</a> page or use the site search to look for related pages.
					</p>
				</div>
 			</div>
 			<div class="col-md-3">
 				<?php get_sidebar( 'right' ); ?>
 			<div>
		</div>
	</div>
</div>

<?php get_footer(); ?>