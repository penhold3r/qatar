<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Qatar
 */

get_header();
?>

   <main id="main" class="site-main page">
   <?php
   if(is_cart()) :
      echo do_shortcode( '[woocommerce_cart]' );
   
   else:
      while ( have_posts() ) :
         the_post();

         if(is_front_page()):
            get_template_part('template-parts/content', 'home');
         
         else:
            get_template_part( 'template-parts/content', 'page' );
            
         endif;

      endwhile; // End of the loop.
   endif;
   ?>

   </main><!-- #main -->

<?php
get_footer();

