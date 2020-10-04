<?php
/**
 * Template Name: About Template
 *
 * Description: About page template
 *
 * @package WordPress
 * @subpackage Debaco_Theme
 * @since Debaco 1.0
 */
$debaco_opt = get_option( 'debaco_opt' );

get_header();
?>
<div class="main-container about-page">
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
	<div class="about-container">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="container">
				<?php get_template_part( 'content', 'page' ); ?>
			</div>
		<?php endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>