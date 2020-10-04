<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Debaco_Theme
 * @since Debaco 1.0
 */
$debaco_opt = get_option( 'debaco_opt' );
$debaco_blogsidebar = 'right';
if(isset($debaco_opt['sidebarblog_pos']) && $debaco_opt['sidebarblog_pos']!=''){
	$debaco_blogsidebar = $debaco_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$debaco_blogsidebar = $_GET['sidebar'];
}
$debaco_blog_sidebar_extra_class = NULl;
if($debaco_blogsidebar=='left') {
	$debaco_blog_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="col-12 col-lg-3 <?php echo esc_attr($debaco_blog_sidebar_extra_class);?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>