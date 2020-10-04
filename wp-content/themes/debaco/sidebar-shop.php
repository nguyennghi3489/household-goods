<?php
/**
 * The sidebar for shop page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Debaco_Theme
 * @since Debaco 1.0
 */
$debaco_opt = get_option( 'debaco_opt' );
$shopsidebar = 'left';
if(isset($debaco_opt['sidebarshop_pos']) && $debaco_opt['sidebarshop_pos']!=''){
	$shopsidebar = $debaco_opt['sidebarshop_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$shopsidebar = $_GET['sidebar'];
}
$debaco_shop_sidebar_extra_class = NULl;
if($shopsidebar=='left') {
	$debaco_shop_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
	<div id="secondary" class="col-12 col-lg-3 sidebar-shop <?php echo esc_attr($debaco_shop_sidebar_extra_class);?>">
		<?php dynamic_sidebar( 'sidebar-shop' ); ?>
	</div>
<?php endif; ?>