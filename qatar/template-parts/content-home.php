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

   <?php if (get_field('video')): ?>

   <div class="hero-landing__background video">
      <video autoplay loop muted>
         <source
            src="<?php the_field('video') ?>"
            type="video/mp4">
      </video>
   </div>

   <?php
      else:
      
      acf_image(
          'intro_image',
          array(
            'blur' => false,
            'data' => array(
               'aos' => 'fade-in'
            ),
            'classes' => array('hero-landing__background', 'image')
         )
      );

      endif;
   ?>

   <div class="hero-landing__text" data-aos="fade-up">
      <?php the_field('intro_text') ?>
   </div>

</section>

<section class="security">

   <?php acf_image('payment_image', array('blur' => false, 'classes' => array('plx'))) ?>

   <div class="security-text" data-aos="fade-left">
      <?php the_field('payment_text') ?>
   </div>

</section>
<!-- .security -->

<section class="enjoy">

   <h3>Enjoy</h3>

</section>
<!-- .enjoy -->