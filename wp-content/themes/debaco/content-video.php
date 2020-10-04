<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package WordPress
 * @subpackage Debaco_Theme
 * @since Debaco 1.0
 */
$debaco_opt = get_option( 'debaco_opt' );
$debaco_postthumb = Debaco_Class::debaco_post_thumbnail_size('');
if(Debaco_Class::debaco_post_odd_event() == 1){
	$debaco_postclass='even';
} else {
	$debaco_postclass='odd';
}
$content = apply_filters( 'the_content', get_the_content() );
$video = false;
// Only get video from the content if a playlist isn't present.
if ( false === strpos( $content, 'wp-playlist-script' ) ) {
	$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($debaco_postclass); ?>>
	<div class="post-inner">
		<?php if ( is_single() ) : ?>
			<div class="post-header">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<div class="post-meta">
					<span class="post-author">
						<span class="post-by"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a> </span>
					</span>
					<span class="post-separator">/</span>
					<span class="post-date"> 
						<?php 
							$archive_year  = get_the_time('Y', $post->ID);
							$archive_month = get_the_time('m', $post->ID);
						?>
						<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date('', $post->ID);?></a>
					</span>
					<?php if (do_shortcode(get_post_meta( $post->ID, '_debaco_post_intro', true )) == '') { ?>
						<?php if ( !has_post_thumbnail() ) { ?>
							<?php if(has_category()) { ?>
								<span class="post-separator">/</span>
								<span class="post-category">
									<?php echo get_the_category_list( ', ' ); ?>
								</span> 
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</div> 
			</div>
		<?php endif; ?>
		<?php if ( ! post_password_required() && ! is_attachment() ) : ?>
			<?php if ( is_single() ) { ?>
				<?php if (do_shortcode(get_post_meta( $post->ID, '_debaco_post_intro', true )) != '') { ?>
					<div class="post-thumbnail-wrapper">
						<div class="post-thumbnail">
							<?php echo do_shortcode(get_post_meta( $post->ID, '_debaco_post_intro', true )); ?>
							<?php if(has_category()) { ?>
								<div class="post-category">
									<?php echo get_the_category_list(' '); ?>
								</div> 
							<?php } ?>
						</div>
					</div>
				<?php } else { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="post-thumbnail-wrapper">
							<div class="post-thumbnail">
								<?php the_post_thumbnail(); ?> 
								<?php if(has_category()) { ?>
									<div class="post-category">
										<?php echo get_the_category_list(' '); ?>
									</div> 
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<?php if ( !is_single() ) { ?>
				<?php if (do_shortcode(get_post_meta( $post->ID, '_debaco_post_intro', true )) != '') { ?>
					<div class="post-thumbnail-wrapper">
						<div class="post-thumbnail">
							<?php echo do_shortcode(get_post_meta( $post->ID, '_debaco_post_intro', true )); ?>
							<?php if(has_category()) { ?>
								<div class="post-category">
									<?php echo get_the_category_list(' '); ?>
								</div> 
							<?php } ?>
						</div>
					</div>
				<?php } else { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="post-thumbnail-wrapper">
							<div class="post-thumbnail">
								<?php the_post_thumbnail(); ?> 
								<?php if(has_category()) { ?>
									<div class="post-category">
										<?php echo get_the_category_list(' '); ?>
									</div> 
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		<?php endif; ?>
		<div class="postinfo-wrapper <?php if ( !has_post_thumbnail() ) { echo 'no-thumbnail';} ?>">
			<div class="post-info">
				<?php if ( is_single() ) : ?>
					<div class="entry-content">
						<?php the_content( wp_kses(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'debaco' ), array('span'=>array('class'=>array())) )); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'debaco' ), 'after' => '</div>', 'pagelink' => '<span>%</span>' ) ); ?>
					</div>
				<?php else : ?>
					<h2 class="post-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
					<div class="post-meta">
						<span class="post-author">
							<span class="post-by"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a> </span>
						</span>
						<span class="post-separator">/</span>
						<span class="post-date"> 
							<?php 
								$archive_year  = get_the_time('Y', $post->ID);
								$archive_month = get_the_time('m', $post->ID);
							?>
							<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date('', $post->ID);?></a>
						</span>
						<?php if (do_shortcode(get_post_meta( $post->ID, '_debaco_post_intro', true )) == '') { ?>
							<?php if ( !has_post_thumbnail() ) { ?>
								<?php if(has_category()) { ?>
									<span class="post-separator">/</span>
									<span class="post-category no-thumbnail">
										<?php echo get_the_category_list( ', ' ); ?>
									</span>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</div>
					<div class="entry-summary">
						<?php 
							/* translators: %s: Name of current post */
							the_content( sprintf(
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'debaco' ),
								get_the_title()
							) );

							wp_link_pages( array(
								'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'debaco' ),
								'after'       => '</div>',
								'link_before' => '<span class="page-number">',
								'link_after'  => '</span>',
							) );
						?>
					</div>
				<?php endif; ?>
				<?php if ( is_single() ) : ?>
					<?php Debaco_Class::debaco_entry_meta(); ?>
					<?php if( function_exists('debaco_blog_sharing') ) { ?>
						<div class="social-sharing"><?php debaco_blog_sharing(); ?></div>
					<?php } ?>
					<?php if(get_the_author_meta()!="") { ?>
						<div class="author-info">
							<div class="author-avatar">
								<?php
								$author_bio_avatar_size = apply_filters( 'debaco_author_bio_avatar_size', 68 );
								echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
								?>
							</div>
							<div class="author-description">
								<h2><?php esc_html__( 'About the Author:', 'debaco'); printf( '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">%s</a>' , get_the_author()); ?></h2>
								<p><?php the_author_meta( 'description' ); ?></p>
							</div>
						</div>
					<?php } ?>
					<?php 
					//related posts
					$orig_post = $post;
					global $post;
					$tags = wp_get_post_tags($post->ID);
					if ($tags) { 
						$tag_ids = array();
						foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
						$args=array(
						'tag__in' => $tag_ids,
						'post__not_in' => array($post->ID),
						'posts_per_page'=>3, // Number of related posts to display.
						'ignore_sticky_posts'=>1
						);
						$my_query = new wp_query( $args );$tag_ids = array();
						if($my_query->have_posts()) { ?>
							<div class="relatedposts">
								<h3><?php esc_html_e('Related posts', 'debaco');?></h3>
								<div class="row">
									<?php
									while( $my_query->have_posts() ) {
										$my_query->the_post();
										?>
										<div class="relatedthumb col-6 col-lg-4 col-md-4">
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="image">
													<?php the_post_thumbnail('debaco-post-thumb'); ?>
												</div> 
											<?php endif; ?>
											<span class="post-date"> <?php echo get_the_date('', $post->ID);?> </span>
											<h4><a rel="external" href="<?php the_permalink()?>"><?php the_title(); ?></a></h4>
										</div>
									<?php }
									$post = $orig_post;
									wp_reset_postdata();
									?>
								</div> 
							</div>
						<?php } ?>
					<?php } ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>