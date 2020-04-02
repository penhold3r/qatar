<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Qatar
 * 
 */

$nav_config = array( 
   'theme_location'	=> 'header-menu', 
   'menu'            => 'Header Menu',
   'container'       => 'nav',
   'container_class' => 'navigation',
   'container_id'    => 'main-nav',
   'menu_class'      => 'nav-list',
   'menu_id'         => '',
   'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
);

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

   <?php wp_head(); ?>
   <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule="" src="https://xunpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site fader">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'qatar' ); ?></a>

	<header id="masthead" class="site-header">

      <div class="inner-header">

         <button class="hamb-menu">
            <div class="bars-holder">
               <span class="menu-bar"></span>
               <span class="menu-bar"></span>
               <span class="menu-bar"></span>
            </div>
         </button>

         <h1 class="site-logo"><?php the_custom_logo(); ?></h1>
         
         <?php wp_nav_menu( $nav_config ); ?>

         <div class="side-nav" style="display:none">
            <?php wp_nav_menu( $nav_config ); ?>
         </div>

         <div class="cart">
					
            <a class="cart-link" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'ver carrito' ); ?>">
               <ion-icon name="cart" class="icon"></ion-icon>
               
               <div class="cart-details">
                  <div class="items">
                  <?php 
                     echo sprintf ( 
                        _n( '%d', '%d', 
                        WC()->cart->get_cart_contents_count() ), 
                        WC()->cart->get_cart_contents_count() 
                     ); 
                  ?> 
                  </div>
               
                  <?php echo WC()->cart->get_cart_total(); ?>
               </div>
            </a>
				
         </div>
                 
      </div>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
