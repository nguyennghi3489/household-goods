<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $woocommerce_loop;
$debaco_opt = get_option( 'debaco_opt' );
$debaco_viewmode = Debaco_Class::debaco_show_view_mode();
// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;
// Extra post classes
$classes = array();
$count   = $product->get_rating_count();
$debaco_shopclass = Debaco_Class::debaco_shop_class('');
$colwidth = 4;
if($debaco_shopclass=='shop-fullwidth') {
	if(isset($debaco_opt['product_per_row_fw'])){
		$woocommerce_loop['columns'] = $debaco_opt['product_per_row_fw'];
		if($woocommerce_loop['columns'] > 0){
			$colwidth = round(12/$woocommerce_loop['columns']);
		}
	}
	$classes[] = ' item-col col-6 col-md-4 col-xl-'.$colwidth ;
} else {
	if(isset($debaco_opt['product_per_row'])){
		$woocommerce_loop['columns'] = $debaco_opt['product_per_row'];
		if($woocommerce_loop['columns'] > 0){
			$colwidth = round(12/$woocommerce_loop['columns']);
		}
	}
	$classes[] = ' item-col col-6 col-sm-6 col-md-4 col-xl-'.$colwidth ;
}
$colwidth_over1600 = 3;
if($debaco_shopclass=='shop-fullwidth') {
	if(isset($debaco_opt['product_per_row_fw_over1600'])){
		$woocommerce_loop['columns_over1600'] = $debaco_opt['product_per_row_fw_over1600'];
		if($woocommerce_loop['columns_over1600'] > 0){
			$colwidth_over1600 = 'col-over-1600 col-over1600-'.$debaco_opt['product_per_row_fw_over1600'];
		}
		$classes[] = $colwidth_over1600 ;
	}
} else {
	if(isset($debaco_opt['product_per_row_over1600'])){
		$woocommerce_loop['columns_over1600'] = $debaco_opt['product_per_row_over1600'];
		if($woocommerce_loop['columns_over1600'] > 0){
			$colwidth_over1600 = 'col-over-1600 col-over1600-'.$debaco_opt['product_per_row_over1600'];
		}
		$classes[] = $colwidth_over1600 ;
	}
}
?>
<div <?php post_class( $classes ); ?>>
	<div class="product-wrapper gridview">
		<div class="list-col4">
			<div class="product-image">
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				<ul class="actions">
					<?php if ( class_exists( 'YITH_WCWL' ) ) { ?>
						<li class="add-to-wishlist"> 
							<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
						</li>
					<?php } ?>
					<?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
						<li class="add-to-compare">
							<?php echo do_shortcode('[yith_compare_button]'); ?>
						</li>
					<?php } ?>
					<li class="quickviewbtn">
						<a class="detail-link quickview fa fa-external-link" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Quick View', 'debaco');?></a>
					</li>
				</ul>
				<div class="add-to-cart">
					<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'"]') ?>
				</div>
			</div>
		</div>
		<div class="list-col8 <?php if ( !$count) { echo 'no-rating';} ?>">
			<div class="box-col">
				<div class="product-category">
					<?php echo wc_get_product_category_list($product->get_id()); ?>
				</div>
				<?php if ($count) { ?>
				<div class="product-rating-review">
					<div class="product-rating">
						<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
					</div>
					<div class="product-review-count">
						<?php 
							$review_count = $product->get_review_count();
							if ( $review_count > 0 ) { ?>
								<a href="<?php echo get_permalink() ?>#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s review','%s reviews', $review_count, 'debaco' ), esc_html( $review_count ) ); ?>)</a>
							<?php }
						?>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="product-name">
				<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			<!-- hook rating -->
			<?php if ( $product->get_price() != '' )  { ?>
				<div class="price-box">
					<div class="price-box-inner">
						<?php echo ''.$product->get_price_html(); ?>
					</div>
				</div>
			<?php } ?>
			<!-- end price -->
			<div class="count-down">
				<?php
				$countdown = false;
				$sale_end = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
				/* simple product */
				if($sale_end){
					$countdown = true;
					$sale_end = date('Y/m/d', (int)$sale_end);
					?>
					<div class="countbox hastime" data-time="<?php echo esc_attr($sale_end); ?>"></div>
				<?php } ?>
				<?php /* variable product */
				if($product->has_child()){
					$vsale_end = array();
					$pvariables = $product->get_children();
					foreach($pvariables as $pvariable){
						$vsale_end[] = (int)get_post_meta( $pvariable, '_sale_price_dates_to', true );
						if( get_post_meta( $pvariable, '_sale_price_dates_to', true ) ){
							$countdown = true;
						}
					}
					if($countdown){
						/* get the latest time */
						$vsale_end_date = max($vsale_end);
						$vsale_end_date = date('Y/m/d', $vsale_end_date);
						?>
						<div class="countbox hastime" data-time="<?php echo esc_attr($vsale_end_date); ?>"></div>
					<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<div class="product-wrapper listview">
		<div class="list-col4 <?php if($debaco_viewmode=='list-view'){ echo ' col-12 col-md-4';} ?>">
			<div class="product-image">
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				
				<ul class="actions">
					<?php if ( class_exists( 'YITH_WCWL' ) ) { ?>
						<li class="add-to-wishlist"> 
							<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
						</li>
					<?php } ?>
					<?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
						<li class="add-to-compare">
							<?php echo do_shortcode('[yith_compare_button]'); ?>
						</li>
					<?php } ?>
					<li class="quickviewbtn">
						<a class="detail-link quickview fa fa-external-link" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Quick View', 'debaco');?></a>
					</li>
				</ul>
				<div class="add-to-cart">
					<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'"]') ?>
				</div>
			</div>
		</div>
		<div class="list-col8 <?php if($debaco_viewmode=='list-view'){ echo ' col-12 col-md-8';} ?>">
			<div class="products-list-left">
				<div class="product-category">
					<?php echo wc_get_product_category_list($product->get_id()); ?>
				</div>
				<div class="product-name">
					<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<?php if ($count) { ?>
					<div class="product-rating-review">
						<div class="product-rating">
							<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
						</div>
						<div class="product-review-count">
							<?php 
								$review_count = $product->get_review_count();
								if ( $review_count > 0 ) { ?>
									<a href="<?php echo get_permalink() ?>#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s review','%s reviews', $review_count, 'debaco' ), esc_html( $review_count ) ); ?>)</a>
								<?php }
							?>
						</div>
					</div>
				<?php } ?>
				<!-- hook rating -->
				<div class="product-price-button">
					<?php if ( $product->get_price() != '' )  { ?>
						<div class="price-box">
							<div class="price-box-inner">
								<?php echo ''.$product->get_price_html(); ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php if ( has_excerpt() ) { ?>
					<div class="product-desc">
						<?php the_excerpt(); ?>
					</div>
				<?php } ?>
				<!-- end desc -->
			</div>
			
		</div>
	</div>
</div>