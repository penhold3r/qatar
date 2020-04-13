<?php
/**
 * Template part for displaying home content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Qatar
 */

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

?>

<section class="hero-landing">

   <div class="video-landing">
      <video autoplay loop muted>
         <source src="<?php the_field('video') ?>" type="video/mp4">
      </video>
   </div>

   <?php
   $loop = new WP_Query( $args );

   if ( $loop->have_posts() ) :
   
   ?>
   <div class="featured">
      <div class="featured-wrapper">
      
      <?php 
   
      $card_index = 0;
      while ( $loop->have_posts() ) : 
         $loop->the_post();
         global $product;
      ?>
         <div 
            data-index="<?php echo $card_index ?>" 
            class="featured-card <?php echo $card_index === 0 ? 'active' : '' ?>"
         >
            
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

               <a href="<?php echo get_permalink( $product->get_id() ) ?>" class="featured-link button button-icon icon-arrow-right">
                  <span>Comprar</span>
                  <i class="icon fal fa-arrow-right"></i>
               </a>
            </div>
         </div>
         
      <?php $card_index++; endwhile; ?>
      </div><!-- .featured-wrapper -->
   </div><!-- .featured -->
   <?php
   
   endif;

   wp_reset_postdata();
   ?>

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
      <a href="/tienda" class="button button-icon icon-arrow-right">
         <span><?php the_field('cta_button') ?></span>
         <i class="icon fal fa-arrow-right"></i>
      </a>
      <?php endif ?>

   </div>

</section><!-- .security -->