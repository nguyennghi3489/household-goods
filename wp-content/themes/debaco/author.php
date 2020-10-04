<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
					<h2 class="entry-title"><?php the_archive_title(); ?></h2>
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
				<div class="page-content blog-page blogs <?php echo esc_attr($debaco_blogclass); if($debaco_blogsidebar=='left') {echo ' left-sidebar'; } if($debaco_blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<!--<header class="entry-header">
						<header class="entry-header">
							<h2 class="entry-title"><?php //the_archive_title(); ?></h2>
						</header>
					</header>-->
					<?php if ( have_posts() ) : ?>
						<?php
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							 *
							 * We reset this later so we can run the loop
							 * properly with a call to rewind_posts().
							 */
							the_post();
						?>
						<?php
						// If a user has filled out their description, show a bio on their entries.
						if ( get_the_author_meta( 'description' ) ) : ?>
							<div class="archive-header">
								<h3 class="archive-title"><?php printf( esc_html__( 'Author Archives: %s', 'debaco' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h3>
								<div class="author-info archives">
									<div class="author-avatar">
										<?php
										/**
										 * Filter the author bio avatar size.
										 *
										 * @since Debaco 1.0
										 *
										 * @param int $size The height and width of the avatar in pixels.
										 */
										$author_bio_avatar_size = apply_filters( 'debaco_author_bio_avatar_size', 68 );
										echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
										?>
									</div><!-- .author-avatar -->
									<div class="author-description">
										<h2><?php printf( esc_html__( 'About %s', 'debaco' ), get_the_author() ); ?></h2>
										<p><?php the_author_meta( 'description' ); ?></p>
									</div><!-- .author-description	-->
								</div><!-- .author-info -->
							</div><!-- .archive-header -->
						<?php endif; ?>
						<?php
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
						?>
						<div class="post-container">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
						</div>
						<?php Debaco_Class::debaco_pagination(); ?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>