<?php

/**
 * Add support.
 */
add_action('after_setup_theme', function()
{
   add_theme_support('woocommerce');
});

//-----------------------------------------------------------
/**
 * Remove default css.
 */

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

//-----------------------------------------------------------
/**
 * Store feat image
 */
function qatar_store_feat_img(array $custom = array())
{
   global $post;

   $defaults = array(
		'type' => 'full',
		'blur' => true,
		'classes' => array(),
      'max_width' => '1300px',
      'data' => array()
	);

   $options = array_merge($defaults, $custom);

   $classes = count($options['classes']) === 0 
      ? 'feat-img' 
      : implode(" ", $options['classes']) . ' feat-img';
      
   $data_attr = ''; 
   if(count($options['data']) !== 0){
      foreach($options['data'] as $data => $val){
         $data_attr .= 'data-'. $data .'="'. $val .'" ';      
      }
   } 

   if( is_shop() ) {
      $shop = get_option( 'woocommerce_shop_page_id' );
      
		if( has_post_thumbnail( $shop ) ) {    

         echo '<div class="'. $classes .'" '. $data_attr .'>';

         if ( $blur ) {
            echo '<div class="bg-placeholder-img" style="background-image: url(' . get_the_post_thumbnail_url( $shop, 'thumbnail' ) . ')"></div>';
         }

         echo get_the_post_thumbnail( $shop, $options['type'], array(
            'class' => 'feat-img-file' 
         ));

         echo '</div><!-- .feat-img -->';
		}
	}
}

//-----------------------------------------------------------
/**
 * Prevents add to cart on refresh.
 */
function custom_add_to_cart_redirect() 
{
   $current_url = '//'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   return $current_url;
}
   
add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );

//-----------------------------------------------------------
/**
 * Add direct checkout link to products
 */
function add_content_after_addtocart() {

   $current_product_id = get_the_ID();
   $product = wc_get_product( $current_product_id );
   $checkout_url = WC()->cart->get_checkout_url();
   $checkout_txt = get_locale() == 'es_ES' 
      ? 'Pagar' 
      : ( get_locale() == 'pt_PT' 
         ? 'Pagar' 
            : 'Checkout' );
   // run only on simple products
   if( $product->is_type( 'simple' ) ){
      echo '<a href="'.$checkout_url.'?add-to-cart='.$current_product_id.'" class="checkout-direct single_add_to_cart_button button alt">'.$checkout_txt.'</a>';
   }
}
//add_action( 'woocommerce_after_add_to_cart_button', 'add_content_after_addtocart' );


//-----------------------------------------------------------
/**
 * update cart view via ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'qatar_cart_count_fragments', 10, 1 );

function qatar_cart_count_fragments( $fragments ) {

   $items = sprintf ( 
      _n( '%d', '%d', 
      WC()->cart->get_cart_contents_count() ), 
      WC()->cart->get_cart_contents_count() 
   );

   $totals = WC()->cart->get_cart_total();
    
   $fragments['div.cart-details'] = '<div class="cart-details"><div class="items">'. $items .'</div>'. $totals .'</div>';
    
   return $fragments; 
}

//-----------------------------------------------------------
/**
 *  custom "eliminar" button
 */
function qatar_cart_totals_coupon_html( $value ) {

   $value = str_replace('[Eliminar]', 'Eliminar', $value);

   return $value;

}

add_filter( 'woocommerce_cart_totals_coupon_html', 'qatar_cart_totals_coupon_html', 10, 1 );


//-----------------------------------------------------------
/**
 * privacy policy translate
 */
add_filter( 'woocommerce_get_privacy_policy_text', function ( $text, $type ) {
   switch ( $type ) {
      case 'checkout':
         /* translators: %s privacy policy page name and link */
         $text = sprintf( __( 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our %s.', 'woocommerce' ), '[privacy_policy]' );
         break;
      case 'registration':
         /* translators: %s privacy policy page name and link */
         $text = sprintf( __( 'Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our %s.', 'woocommerce' ), '[privacy_policy]' );
         break;
   }

   return $text;
}, 10, 2);