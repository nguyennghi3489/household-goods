<?php
/**
 * The sidebar for content page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Debaco_Theme
 * @since Debaco 1.0
 */
$debaco_opt = get_option( 'debaco_opt' );
$debaco_page_sidebar_extra_class = NULl;
if($debaco_opt['sidebarse_pos']=='left') {
	$debaco_page_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
<div id="secondary" class="col-12 col-lg-3 <?php echo esc_attr($debaco_page_sidebar_extra_class);?>">
	<?php dynamic_sidebar( 'sidebar-page' ); ?>
</div>
<?php endif; ?>