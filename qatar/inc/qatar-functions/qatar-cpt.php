<?php


/*
* Creating  CPT
*/

 
function qatar_cpt()
{
   $sections = array(
      array(
         'singular_name'   => 'Vinos',
         'general_name'    => 'Vinos',
         'slug'            => 'wine-post-type'
      )
   );

   //  add icon and menu position
   foreach ($sections as $cpt) { 
      $cpt['position'] = array_search($cpt, $sections) + 10;
      create_custom_post_type($cpt);
   }

   //
   create_custom_taxonomy(array(
      'singular_name' => 'Bodega',
      'general_name' => 'Bodegas',
      'post_type' => 'product'
   ));
}

add_action( 'init', 'qatar_cpt', 0 );


