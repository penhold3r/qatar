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

<section class="specs">
   <?php

      $specs = get_field_object('specs');

      foreach ($specs['sub_fields'] as $item):
   ?>

   <div class="spec">
      <div class="spec__icon">
         <i
            class="icon fal <?php echo $item['name'] ?>"></i>
      </div>
      <h4 class="spec__name">
         <?php echo $item['label'] ?>
      </h4>
      <p class="spec__text">
         <?php echo $specs['value'][$item['name']] ?>
      </p>
   </div>

   <?php endforeach; ?>
</section>
<!-- .security -->

<section class="enjoy">

   <h3>Enjoy</h3>

</section>
<!-- .enjoy -->