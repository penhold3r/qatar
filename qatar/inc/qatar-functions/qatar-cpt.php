<?php

function add_title_as_category( $postid ) {
   if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
   $post = get_post($postid);
   //if ( $post->post_type == 'post') { // change 'post' to any cpt you want to target
      $term = get_term_by('slug', $post->post_type, 'category');
      if ( empty($term) ) {
         $add = wp_insert_term( $post->post_type, 'category', array('slug'=> $post->post_type) );
         if ( is_array($add) && isset($add['term_id']) ) {
            wp_set_object_terms($postid, $add['term_id'], 'category', true );
         }
      }
   //}
}

//add_action('save_post', 'add_title_as_category');


/*
* Creating a function to create our CPT
*/

function qatar_get_post_types(){
   return array(
      array(
         'singular_name'   => 'Vinos',
         'general_name'    => 'Vinos',
         'slug'            => 'wine-post-type'
      )
   );
}
 
function qatar_cpt()
{
   $sections = qatar_get_post_types();

   // owl icon and menu position
   foreach ($sections as $cpt) {
      $cpt['position'] = array_search($cpt, $sections) + 10;
      $cpt['menu_icon'] = 'data:image/svg+xml;base64,' . base64_encode('
         <svg 
            id="qatar" 
            xmlns="http://www.w3.org/2000/svg" 
            x="0px" 
            y="0px"
            viewBox="0 0 56 56" 
            xml:space="preserve">
            <g>
               <path 
                  style="fill:#999999;" 
                  d="M42.5,19.2l7.5-7.5l-5.4-5.4L37,13.8c-3.7-2.5-8.5-2.3-11.5,0.6L1.3,41.3l13.6,13.6l26.9-24.2 C44.8,27.7,45,22.9,42.5,19.2z"/>
               <rect 
                  x="48.3" 
                  y="1.5" 
                  transform="matrix(0.7071 -0.7071 0.7071 0.7071 11.1502 37.5517)" 
                  style="fill:#999999;" 
                  width="5.2" 
                  height="7.7"/>
            </g>
         </svg>'
      );
      //$cpt['menu_icon'] = get_template_directory_uri() . '/images/qatar_owl.png';
      create_custom_post_type($cpt);
   }
}

add_action( 'init', 'qatar_cpt', 0 );

/**
 * Add category with ACF checkbox on wines
 */
add_action( 'save_post', function ( $post_id )
{
   global $wpdb;
   // Check for correct post type
   if ( get_post_type() == 'wine-post-type' || get_post_type() == 'contact-post-type' ) {  
      // Get category by ACF
      $line = get_field('line', $post_id);
      // Find the Category by slug
      if($line){
         $idObj = get_category_by_slug( $line );
         // Get the Category ID
         $id = $idObj->term_id;
      }
      // Set now the Category for this CPT
      wp_set_object_terms( $post_id, $id, 'category', true );
   }

});