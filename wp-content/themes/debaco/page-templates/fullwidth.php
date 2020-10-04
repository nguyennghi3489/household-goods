<?php
/**
 * Template Name: Full Width
 *
 * Description: Full Width page template
 *
 * @package WordPress
 * @subpackage Debaco
 * @since Debaco 1.0
 */
$debaco_opt = get_option( 'debaco_opt' );
get_header();
?>
<div class="main-container full-width">
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
	<div class="page-content">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
		</div> 
	</div>
</div>
<?php get_footer(); ?>