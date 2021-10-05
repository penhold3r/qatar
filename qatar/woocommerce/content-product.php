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
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li id="product-<?php echo $product->get_id() ?>" class="product-card">

  <div class="product-inner-card">

      <?php 
         feat_img(array(
            'id' => $product->get_id(), 
            'placeholder' => get_template_directory_uri() . '/css/img/bottle-placeholder.png'
         )); 
      ?>

      <h3 class="product-name"><?php echo $product->get_name(); ?></h3>

      <div class="price">
         <strong>$ <?php echo $product->get_price() ?></strong>
         <i class="icon fal fa-box" title="Precio x caja"></i>
      </div>

      <a href="<?php echo get_permalink( $product->get_id() ) ?>" class="product-link button button-primary button-icon icon-arrow-right">
         <span>Comprar</span>
         <i class="icon fal fa-arrow-right"></i>
      </a>
   </div>

</li>
