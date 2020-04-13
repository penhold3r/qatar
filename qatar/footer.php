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

   </main><!-- #content -->

	<footer id="colophon" class="site-footer">

      <form action="" class="subscription">
         <div class="subscription-title">Suscribirme</div>
         <input class="input" type="text" name="name" placeholder="Nombre">
         <input class="input" type="email" name="email" placeholder="E-mail">
         <input class="button button-primary submit" type="submit" value="ok">
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

      <div class="social">
         <ul class="social-links">
            <li>
               <a href="http://facebook.com" target="_blank" rel="noopener noreferrer">
                  <i class="icon fab fa-facebook-f"></i>
               </a>
            </li>
            <li>
               <a href="http://instagram.com" target="_blank" rel="noopener noreferrer">
                  <i class="icon fab fa-instagram"></i>
               </a>
            </li>
            <li>
               <a href="http://twitter.com" target="_blank" rel="noopener noreferrer">
                  <i class="icon fab fa-twitter"></i>
               </a>
            </li>
         </ul>
      </div>
      
		<div class="copy">
			<p>
            <small>Qatar &copy; <?php echo date("Y"); ?></small>
         </p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
