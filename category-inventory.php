<?php
/**
 * The category inventory template file
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
			<div class="col-md-7">
				<h1 class="page-title"><?php single_cat_title(); ?></h1>
			</div>
	 		<div class="col-md-5 search-form">
	 			<?php get_search_form(); ?>
	 		</div>
			<div class="col-md-12">
				<hr />
			</div>
			<div class="col-md-9">
				<div class="description">
					<?php echo category_description(); ?>
				</div>
				<ul class="inventory">
					<?php 
						$cat_id = get_category_by_slug('inventory');
						$args = array(
							'show_count' => 1,
							'child_of' => $cat_id->term_id,
							'depth' => 1,
							'title_li' => ''
						);
						wp_list_categories( $args ); 
					?> 
				</ul>
 			</div>
 			<div class="col-md-3 rightsidebar">
 				<?php get_sidebar( 'right' ); ?>
 			<div>
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