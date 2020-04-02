<?php
/**
 * Template part for displaying home content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Qatar
 */

?>

<section class="hero-landing">

   <div class="video-landing">
      <video autoplay loop muted>
         <source src="<?php the_field('video') ?>" type="video/mp4">
      </video>
   </div>

   <div class="featured">
   <?php
   // $featured = get_field('featured');
   
   // $meta_query = array('relation' => 'OR');
   // foreach( $featured as $item ){
   //    $meta_query[] = array(
   //       'key'     => 'checkbox',
   //       'value'   => $item,
   //       'compare' => 'LIKE',
   //    );
   // }

   $args = array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'meta_query' => array(
         array(
            'key' => 'featured',
            'value' => true,
        ),
      )
   );

   $loop = new WP_Query( $args );

   if ( $loop->have_posts() ) :
      while ( $loop->have_posts() ) : 
         $loop->the_post();
         global $product;
      ?>
         <div class="featured-card">
            
            <?php feat_img(array('id' => $product->get_id(), 'blur' => false)); ?>

            <div class="featured-summary">
               <div class="tag">
                  <span>Oferta</span>
               </div>

               <h3 class="product-name"><?php echo $product->get_name(); ?></h3>
               
               <div class="price">
                  <strong>$ <?php echo $product->get_price() ?></strong>
                  <small class="qty">&times; caja</small>
               </div>

               <a href="<?php echo get_permalink( $product->get_id() ) ?>" class="featured-link button">
                  <span>Comprar</span>
                  <ion-icon class="icon" name="arrow-forward"></ion-icon>
               </a>
            </div>
         </div>
         
      <?php
      endwhile;
   else :
      echo __( 'No products found' );
   endif;

   wp_reset_postdata();
?>
   </div>

</section><!-- .hero-landing -->

<section class="about-landing">

   <?php 
   
   acf_image(
      'intro_image', 
      array(
         'blur' => false,
         'data' => array(
            'aos' => 'fade-up'
         )
      )
   ) 
   
   ?>

   <div class="about-text" data-aos="flip-up">
      <?php the_field('intro_text') ?>
   </div>

</section><!-- .about-landing -->

<section class="security">

   <?php acf_image('payment_image', array('blur' => false, 'classes' => array('plx'))) ?>

   <div class="security-text" data-aos="fade-left">
      <?php the_field('payment_text') ?>
   </div>

</section><!-- .security -->

<section class="cta">

   <div class="cta-text" data-aos="zoom-out">
      <?php the_field('cta_text') ?>

      <?php if( get_field('cta_button') ): ?>
      <a href="/tienda" class="button">
         <span><?php the_field('cta_button') ?></span>
         <ion-icon class="icon" name="arrow-forward"></ion-icon>
      </a>
      <?php endif ?>

   </div>

</section><!-- .security -->