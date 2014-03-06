<?php /**  
* The template for displaying the footer  *  
* Contains footer content and the closing of the #main and #pagediv elements.  *  
* @package WordPress  
* @subpackage Linc  
* @since Linc 1.0  
*/ ?>
</div><!-- #main .wrapper -->
<footer id="colophon" role="contentinfo">
    <div class="content container">
        <div class="row copyright col-md-9">
        	<div>&copy; 2001 - <?php echo date("Y"); ?> Ludens Inc. &mdash; All Rights Reserved - <a href="/about-us/privacy-policy" title="Privacy Policy">Privacy Policy</a></div>
	        <div class="disclaimer">
	        	<i style="font-size:12px">Information Presented is Subject to Change</i>
	        </div>
    	</div>
        <div class="bbb col-md-3">
        	<!-- a target="_blank" href="https://www.bbb.org/online/consumer/cks.aspx?id=109061511729"><img title="Click to verify BBB accreditation and to see a BBB report." border=0 src="/design/plain/images/bbbsealh2.gif" alt="Click to verify BBB accreditation and to see a BBB report." /></a -->
        	<iframe src="http://seal-nebraska.bbb.org/logo/sehzbus/iframe/ludens-300047291.html" width="100" height="38" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
        </div>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?> 
</body> 
</html>
