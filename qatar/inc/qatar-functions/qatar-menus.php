<?php
/*
*--------------------------------------------
* register menu 
*/
function qatar_custom_menues() 
{
   register_nav_menus(
      array(
         'header-menu' => __( 'Header Menu' ),
         'footer-menu' => __( 'Footer Menu' )
      )
  );
}
add_action( 'init', 'qatar_custom_menues' );
/*
*--------------------------------------------
* data attributes for menu items
*/
function qatar_add_specific_menu_atts( $atts, $item, $args )
{
    $atts['data-id'] = $item->attr_title;
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'qatar_add_specific_menu_atts', 10, 3 );