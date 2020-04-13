<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Qatar
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('default-page'); ?>>
	<header class="default-page__header">
		<?php the_title( '<h2 class="default-page__header__title"><em>', '</em></h2>' ); ?>
	</header><!-- .default-page-header -->

	<div class="default-page__content">

		<?php the_content(); ?>
	</div><!-- .default-page-content -->

</article><!-- #post-<?php the_ID(); ?> -->
