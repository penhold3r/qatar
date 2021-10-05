<?php
/**
 * Template part for displaying contact content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Qatar
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('contact-page'); ?>>
	<header class="contact-page__header" data-aos="fade-up" data-aos-delay="500">
		<?php the_title( '<h2 class="contact-page__header__title"><em>', '</em></h2>' ); ?>
	</header><!-- .contact-page-header -->

	<div class="contact-page__content" data-aos="fade-down">

		<div class="contact-info">
         <?php the_content(); ?>
      </div>

      <?php

         $fields = get_field('form_fields');

         $form_fields = array();
         
         if($fields) {
            foreach ($fields as $field) {
               $type = 'text';

               $type = $field['value'] === 'email' ? 'email' : $type;
               $type = $field['value'] === 'phone' ? 'number' : $type;
               $type = $field['value'] === 'message' ? 'textarea' : $type;

               $icon = '';
               $icon = $field['value'] === 'name' ? 'fa-user' : $icon;
               $icon = $field['value'] === 'last_name' ? 'fa-user' : $icon;
               $icon = $field['value'] === 'email' ? 'fa-at' : $icon;
               $icon = $field['value'] === 'phone' ? 'fa-phone' : $icon;
               $icon = $field['value'] === 'message' ? 'fa-comment' : $icon;
               
               array_push($form_fields, array(
                  'type' => $type,
                  'name' => $field['value'],
                  'placeholder' => $field['label'],
                  'container_class' => ' fal '. $icon
               ));
            }
         };

         if(count($form_fields) !== 0){
            build_form(
               array(
                  'form_class' => 'contact-form',
                  'fields' => $form_fields,
                  'field_container' => 'input-wrapper',
                  'required' => true,
                  'submit_value' => 'Enviar',
                  'submit_class' => 'button button-icon button-cta',
                  'submit_content_before' => '<i class="icon fal fa-paper-plane"></i>',
                  'form_after' => '<div class="output-msg"><p></p></div>'
               )
            );
         }
      ?>

	</div><!-- .contact-page-content -->

</article><!-- #post-<?php the_ID(); ?> -->
