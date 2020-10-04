<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header( 'shop' ); ?>
<div class="main-container shop-page <?php if(isset($debaco_opt['product_banner']['url']) && ($debaco_opt['product_banner']['url'])!=''){ echo 'has-image';} ?>">
	<div class="title-breadcumbs">
		<!-- shop banner -->
		<?php if(isset($debaco_opt['product_banner']['url']) && ($debaco_opt['product_banner']['url'])!=''){ ?>
			<div class="shop-banner banner-image">
				<img src="<?php echo esc_url($debaco_opt['product_banner']['url']); ?>" alt="<?php esc_attr_e('Shop banner','debaco') ?>" />
			</div>
		<?php } ?>
		<div class="title-breadcumbs-text">
			<div class="container">
				<header class="entry-header shop-title">
					<h2 class="entry-title"><?php if(isset($debaco_opt['single_product_header_text']) && ($debaco_opt['single_product_header_text'] !='')) { echo esc_html($debaco_opt['single_product_header_text']); } else { esc_html_e('Product Details', 'debaco');}  ?></h2>
				</header>
				<div class="breadcrumb-container">
					<div class="container">
						<?php
							/**
							 * woocommerce_before_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
							 * @hooked woocommerce_breadcrumb - 20
							 */
							do_action( 'woocommerce_before_main_content' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="product-page">
		<div class="product-view">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php wc_get_template_part( 'content', 'single-product' ); ?>
			<?php endwhile; // end of the loop. ?>
			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>
			<?php
				/**
				 * woocommerce_sidebar hook
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				//do_action( 'woocommerce_sidebar' );
			?>
		</div> 
	</div> 
</div>
<?php get_footer( 'shop' ); ?>