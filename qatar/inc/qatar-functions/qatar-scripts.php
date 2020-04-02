<?php
/** 
 * load CSS and JS
 * 
 */
function qatar_styles_and_scripts()
{
   // styles
   wp_enqueue_style(
      'Qatar_Style', 
      get_stylesheet_directory_uri() . '/css/style.qatar.css'
   );
   // scripts
   wp_enqueue_script(
      'gmap', 
      'https://maps-api-ssl.google.com/maps/api/js?key=AIzaSyBZLEliDhUUlSxi5yjNAB8F9-lDYVVAoYM'
   );
   
   wp_register_script(
      'Qatar_Script', 
      get_stylesheet_directory_uri() . '/js/bundle.qatar.js', 
      '', 
      '', 
      true
   );
   
   $data = array('templateURL' => get_stylesheet_directory_uri());
   
   wp_localize_script('Qatar_Script', 'theme', $data);
   wp_enqueue_script('Qatar_Script');
}

add_action('wp_enqueue_scripts', 'qatar_styles_and_scripts');