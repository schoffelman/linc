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
 ?>

 <form role="search" method="get" id="searchform" class="search" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" value="Search Ludens" name="s" id="s" onfocus="this.value=''" onblur="this.value='Search Ludens'" />
        <input type="submit" id="searchsubmit" value="Search" />
    </div>
</form>