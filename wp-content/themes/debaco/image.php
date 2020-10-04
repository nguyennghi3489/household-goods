<?php
/**
 * The template for displaying image attachments
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
$debaco_mainextraclass = NULl;
if($debaco_blogsidebar=='left') {
	$debaco_mainextraclass = 'order-lg-last';
}
switch($debaco_bloglayout) {
	case 'nosidebar':
		$debaco_blogclass = 'blog-nosidebar';
		$debaco_blogcolclass = 12;
		$debaco_blogsidebar = 'none';
		Debaco_Class::debaco_post_thumbnail_size('debaco-post-thumb');
		break;
	default:
		$debaco_blogclass = 'blog-sidebar';
		$debaco_blogcolclass = 9;
		Debaco_Class::debaco_post_thumbnail_size('debaco-category-thumb');
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
			<div class="col-12 <?php echo 'col-lg-'.$debaco_blogcolclass; ?> <?php echo esc_attr($debaco_mainextraclass);?>">
				<div class="page-content blog-page single <?php echo esc_attr($debaco_blogclass); if($debaco_blogsidebar=='left') {echo ' left-sidebar'; } if($debaco_blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<!--<header class="entry-header">
						<h2 class="entry-title"><?php //the_archive_title(); ?></h2>
					</header>-->
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
							<div class="entry-content">
								<div class="post-thumbnail">
									<div class="entry-attachment">
										<div class="attachment">
											<?php
											/*
											 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
											 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
											 */
											$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
											foreach ( $attachments as $k => $attachment ) :
												if ( $attachment->ID == $post->ID )
													break;
											endforeach;
											$k++;
											// If there is more than 1 attachment in a gallery
											if ( count( $attachments ) > 1 ) :
												if ( isset( $attachments[ $k ] ) ) :
													// get the URL of the next image attachment
													$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
												else :
													// or get the URL of the first image attachment
													$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
												endif;
											else :
												// or, if there's only 1 image, get the URL of the image
												$next_attachment_url = wp_get_attachment_url();
											endif;
											?>
											<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
											/**
											 * Filter the image attachment size to use.
											 *
											 * @since Debaco 1.0
											 *
											 * @param array $size {
											 *     @type int The attachment height in pixels.
											 *     @type int The attachment width in pixels.
											 * }
											 */
											$attachment_size = apply_filters( 'debaco_attachment_size', array( 960, 960 ) );
											echo wp_get_attachment_image( $post->ID, $attachment_size );
											?></a>
											<?php if ( ! empty( $post->post_excerpt ) ) : ?>
											<div class="entry-caption">
												<?php the_excerpt(); ?>
											</div>
											<?php endif; ?>
										</div><!-- .attachment -->
									</div><!-- .entry-attachment -->
								</div>
								<div class="entry-description">
									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'debaco' ), 'after' => '</div>' ) ); ?>
								</div><!-- .entry-description -->
							</div><!-- .entry-content -->
							<div class="postinfo-wrapper">
								<div class="post-date">
									<?php echo '<span class="day">'.get_the_date('d,', $post->ID).'</span><span class="month"><span class="separator">/</span>'.get_the_date('M', $post->ID).'</span>' ;?>
								</div>
								<div class="post-info">
									<h2><?php the_title(); ?></h2>
									<footer class="entry-meta">
										<?php
											$metadata = wp_get_attachment_metadata();
											printf( wp_kses(__( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s">%4$s &times; %5$s</a> in <a href="%6$s" rel="gallery">%8$s</a>.', 'debaco' ), array('span'=>array('class'=>array()), 'a'=>array('href'=>array(), 'title'=>array(), 'rel'=>array()), 'time'=>array('class'=>array(), 'datetime'=>array()))),
												esc_attr( get_the_date( 'c' ) ),
												esc_html( get_the_date() ),
												esc_url( wp_get_attachment_url() ),
												$metadata['width'],
												$metadata['height'],
												esc_url( get_permalink( $post->post_parent ) ),
												esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
												get_the_title( $post->post_parent )
											);
										?>
										<?php edit_post_link( esc_html__( 'Edit', 'debaco' ), '<span class="edit-link">', '</span>' ); ?>
									</footer><!-- .entry-meta -->
								</div>
							</div>
						</article><!-- #post -->
						<?php comments_template(); ?>
						<!--<nav id="image-navigation" class="navigation nav-single" role="navigation">
							<span class="previous-image nav-previous"><?php previous_image_link( false, esc_html__( '&larr; Previous', 'debaco' ) ); ?></span>
							<span class="next-image nav-next"><?php next_image_link( false, esc_html__( 'Next &rarr;', 'debaco' ) ); ?></span>
						</nav> #image-navigation -->
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>