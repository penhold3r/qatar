<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Qatar
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

      <form action="" class="subscription">
         <div class="subscription-title">Suscribirme</div>
         <input class="input" type="text" name="name" placeholder="Nombre">
         <input class="input" type="email" name="email" placeholder="E-mail">
         <input class="button submit" type="submit" value="ok">
      </form>
      
      <?php
         wp_nav_menu( 
            array( 
               'theme_location'	=> 'footer-menu', 
               'menu'            => 'Footer Menu',
               'container'       => 'nav',
               'container_class' => 'footer-nav',
               'container_id'    => '',
               'menu_class'      => 'nav-list',
               'menu_id'         => '',
               'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
            ) 
         ); 
      ?>
      
		<div class="copy">
			<p>
            <small>Qatar &copy; <?php echo date("Y"); ?></small>
         </p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
