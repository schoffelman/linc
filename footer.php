<?php /**  
* The template for displaying the footer  *  
* Contains footer content and the closing of the #main and #pagediv elements.  *  
* @package WordPress  
* @subpackage Linc  
* @since Linc 1.0  
*/ ?>
</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
        <div class ="site-info">
            <?php do_action( 'linc_credits'); ?>
            <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'linc' ) ); ?>" title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'linc' ); ?>"><?php printf( __( 'Proudly powered by %s', 'linc' ), 'WordPress'); ?></a> 
        </div><!-- .site-info -->
   	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?> 
</body> 
</html>
