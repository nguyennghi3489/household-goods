<?php
/**
 * Template Name: Contact Template
 *
 * Description: Contact page template
 *
 * @package WordPress
 * @subpackage Debaco_Theme
 * @since Debaco 1.0
 */

$debaco_opt = get_option( 'debaco_opt' );

get_header();
?>
<div class="main-container contact-page">
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
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="entry-content">
			<div class="container">
				<?php the_content(); ?>
			</div>
		</div><!-- .entry-content -->
	<?php endwhile; // end of the loop. ?> 
</div>
<?php
if(isset($debaco_opt['enable_map']) && $debaco_opt['enable_map']) :
	//Add google map API
	wp_enqueue_script( 'gmap-api', 'http://maps.google.com/maps/api/js?sensor=false' , array(), '3', false );
	// Add jquery.gmap.js file
	wp_enqueue_script( 'jquery-gmap', get_template_directory_uri() . '/js/jquery.gmap.js', array(), '2.1.5', false );

	$map_desc = str_replace(array("\r\n", "\r", "\n"), "<br />", $debaco_opt['map_desc']);
	$map_desc = addslashes($map_desc);
?>
<?php endif; ?>
<?php get_footer('contact'); ?>