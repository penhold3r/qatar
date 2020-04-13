<?php
/**
 * Template part for displaying faq content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Qatar
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('faq-page'); ?>>
	<header class="faq-page__header">
		<?php the_title( '<h2 class="faq-page__header__title"><em>', '</em></h2>' ); ?>
	</header><!-- .faq-page-header -->

	<div class="faq-page__content">

		<?php the_content(); ?>
	</div><!-- .faq-page-content -->

</article><!-- #post-<?php the_ID(); ?> -->
