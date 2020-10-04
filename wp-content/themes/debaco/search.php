<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Debaco_Theme
 * @since Debaco 1.0
 */
$debaco_opt = get_option( 'debaco_opt' );
get_header();
$debaco_bloglayout = 'sidebar';
if(isset($debaco_opt['blog_layout']) && $debaco_opt['blog_layout']!=''){
	$debaco_bloglayout = $debaco_opt['blog_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$debaco_bloglayout = $_GET['layout'];
}
$debaco_blogsidebar = 'right';
if(isset($debaco_opt['sidebarblog_pos']) && $debaco_opt['sidebarblog_pos']!=''){
	$debaco_blogsidebar = $debaco_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$debaco_blogsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-1' ) )  {
	$debaco_bloglayout = 'nosidebar';
}
$debaco_blog_main_extra_class = NULl;
if($debaco_blogsidebar=='left') {
	$debaco_blog_main_extra_class = 'order-lg-last';
}
$main_column_class = NULL;
switch($debaco_bloglayout) {
	case 'nosidebar':
		$debaco_blogclass = 'blog-nosidebar';
		$debaco_blogcolclass = 12;
		$debaco_blogsidebar = 'none';
		Debaco_Class::debaco_post_thumbnail_size('debaco-post-thumb');
		break;
	case 'largeimage':
		$debaco_blogclass = 'blog-large';
		$debaco_blogcolclass = 9;
		$main_column_class = 'main-column';
		Debaco_Class::debaco_post_thumbnail_size('debaco-post-thumbwide');
		break;
	case 'grid':
		$debaco_blogclass = 'grid';
		$debaco_blogcolclass = 9;
		$main_column_class = 'main-column';
		Debaco_Class::debaco_post_thumbnail_size('debaco-post-thumbwide');
		break;
	default:
		$debaco_blogclass = 'blog-sidebar';
		$debaco_blogcolclass = 9;
		$main_column_class = 'main-column';
		Debaco_Class::debaco_post_thumbnail_size('debaco-post-thumb');
}
?>
<div class="main-container <?php if(isset($debaco_opt['blog_banner']['url']) && ($debaco_opt['blog_banner']['url'])!=''){ echo 'has-image';} ?>">
	<div class="title-breadcumbs">
		<!-- blog banner -->
		<?php if(isset($debaco_opt['blog_banner']['url']) && ($debaco_opt['blog_banner']['url'])!=''){ ?>
			<div class="blog-banner banner-image">
				<img src="<?php echo esc_url($debaco_opt['blog_banner']['url']); ?>" alt="<?php esc_attr_e('Shop banner','debaco') ?>" />
			</div>
		<?php } ?>
		<!-- end blog banner -->
		<div class="title-breadcumbs-text">
			<div class="container">
				<header class="entry-header">
					<h2 class="entry-title"><?php printf( wp_kses(__( 'Search Results for: %s', 'debaco' ), array('span'=>array())), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</header>
				<div class="breadcrumb-container">
					<div class="container">
						<?php Debaco_Class::debaco_breadcrumb(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 <?php echo 'col-lg-'.$debaco_blogcolclass; ?> <?php echo ''.$main_column_class; ?> <?php echo esc_attr($debaco_blog_main_extra_class);?>">
				<!--<header class="entry-header">
						<header class="entry-header">
							<h2 class="entry-title"><?php //the_archive_title(); ?></h2>
						</header>
				</header>-->
				<div class="page-content blog-page blogs <?php echo esc_attr($debaco_blogclass); if($debaco_blogsidebar=='left') {echo ' left-sidebar'; } if($debaco_blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<?php if ( have_posts() ) : ?>
						<div class="post-container">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
						</div>
						<?php Debaco_Class::debaco_pagination(); ?>
					<?php else : ?>
						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'debaco' ); ?></h1>
							</header>
							<div class="entry-content">
								<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'debaco' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->
					<?php endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>