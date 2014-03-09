<?php 
/**
 * The search form template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Linc
 * @since Linc 1.0
 */
if (!empty($_GET['s'])) {
	$form_value = $_GET['s'];
} else {
	$form_value = 'Search Ludens';
}
 ?>

 <form role="search" method="get" id="searchform" class="search" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" value="<?php echo $form_value; ?>" name="s" id="s" onfocus="this.value=''" />
        <input type="submit" id="searchsubmit" value="Search" />
    </div>
</form>