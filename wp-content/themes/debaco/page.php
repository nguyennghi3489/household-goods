<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Debaco_Theme
 * @since Debaco 1.0
 */
$debaco_opt = get_option( 'debaco_opt' );
$customsidebar = get_post_meta( $post->ID, '_debaco_custom_sidebar', true );
$customsidebar_pos = get_post_meta( $post->ID, '_debaco_custom_sidebar_pos', true );
$debaco_page_main_extra_class = NULl;
if (is_active_sidebar( $customsidebar )) {
	if ($customsidebar_pos == 'left') {
		$debaco_page_main_extra_class = 'order-lg-last';
	}
} elseif (is_active_sidebar('page') && isset($debaco_opt['sidebarse_pos']) && $debaco_opt['sidebarse_pos']=='left') {
	$debaco_page_main_extra_class = 'order-lg-last';
}
get_header();
?>
<div class="main-container default-page">
	<div class="title-breadcumbs">
		<div class="container">
			<header class="entry-header">
				<h2 class="entry-title"><?php the_title(); ?></h2>
			</header>
			<div class="breadcrumb-container">
				<?php Debaco_Class::debaco_breadcrumb(); ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row"> 
			<div class="col-12 <?php if ( (is_active_sidebar( $customsidebar ) && $customsidebar !='') || is_active_sidebar( 'sidebar-page' ) ) : ?>col-lg-9<?php endif; ?> <?php echo esc_attr($debaco_page_main_extra_class);?>">
				<!--<header class="entry-header">
					<h2 class="entry-title"><?php //the_title(); ?></h2>
				</header>-->
				<div class="page-content default-page">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'page' ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php
			if($customsidebar != ''){
				if($customsidebar_pos == 'left' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3 order-lg-first">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				}
				if($customsidebar_pos == 'right' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				get_sidebar('page');
			} ?>
		</div>
	</div> 
</div>
<?php get_footer(); ?>