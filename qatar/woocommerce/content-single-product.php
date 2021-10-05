<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-page', $product ); ?>>

   <?php 
   
   feat_img(
      array(
         'id' => $product->get_id(), 
         'blur' => false, 
         'classes' => array('header-image')
      )
   ); 
   
   ?>

	<div class="product-content">
      <?php feat_img(array('id' => $product->get_id(), 'blur' => false)); ?>

      <div class="product-summary" data-aos="fade-in">

         <?php the_title( '<h2 class="product-title" data-aos="fade-left">', '</h2>' ); ?>

         <?php $winery = get_the_terms( $product->get_id(), 'bodega' )[0];?>

         <?php if($winery): ?>
         <h3 class="winery">
            <span class="label">Bodega:</span>
            &nbsp;
            <span class="name">
               <strong><?php echo $winery->name ?></strong>
            </span>
         </h3>
         <?php endif; ?>

         <div class="desc">
            <?php the_field('desc'); ?>

            
            
            <?php if(get_field('pdf')): ?>
            <a 
               href="<?php the_field('pdf') ?>" 
               title="<?php echo $product->slug .'_ficha-tecnica.pdf' ?>"
               rel="noreferrer noopener" 
               target="_blank"
               class="button button-sm button-secondary button-icon"
               download="<?php echo $product->slug .'_ficha-tecnica' ?>">
               <span>Descargar Ficha</span>
               <i class="icon fal fa-file-download"></i>
            </a>
            <?php endif; ?>
         </div>

         <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?>">
            <?php echo $product->get_price_html(); ?>
            <small class="qty">&times; caja</small>
         </p>

         <?php
         $slug = $product->get_shipping_class_id();
         $slug_object = get_term_by('term_taxonomy_id', $slug, 'product_shipping_class');

         //print_r($slug_object);

         ?>
         <div class="shipping-details">
            <?php if($slug_object->description): ?>
            <i class="icon fal fa-truck"></i>
            <p class="shipping-desc"><?php  echo $slug_object->description; ?></p>
            <?php endif; ?>
            <div class="shipping-calc">
               <h3>Calcular Envío</h3>
               <form 
                  action="" 
                  method="post" 
                  class="calc-form" 
                  enctype="multipart/form-data"
                  data-product-price="<?php echo $product->get_price() ?>"
               >
                  <div class="input-block">
                     <label for="cp">Código Postal</label>
                     <input type="number" name="cp" class="input" size="4" placeholder="0000">
                  </div>
                  <input type="hidden" name="id" value="<?php echo $product->get_id() ?>">
                  <input class="button button-sm" type="submit" value="Calcular">
               </form>
               <div class="loading">
                  <i class="icon fal fa-spinner"></i>
               </div>
               <div class="shipping-prices">
                  <p class="shipping-price">
                     <span class="label">Costo del envío: </span>
                     <span class="value"><strong></strong></span>
                  </p>
                  <p class="shipping-total">
                     <span class="label">Total: </span>
                     <span class="value"><strong></strong></span>
                  </p>
               </div>
            </div>
         </div>

         <?php get_template_part('woocommerce/single-product/add-to-cart/simple', ''); ?>
         
      </div>
   </div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
