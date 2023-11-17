<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vorwerkstift
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
		<?php include 'components/site-branding/site-branding.php'; ?>
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer-menu',
					'menu_id'        => 'footer-menu',
				)
			);
			?>
		<address>
			Vorwerk-Stift | Galerie 21<br />
			Vorwerkstrasse 21<br />
			20357 Hamburg<br />
			Germany
		</address>
		</div><!-- .site-info -->
		<?php dynamic_sidebar( 'footer-widget' ); ?>

		<p class="copyright">©<?php echo  date("Y"); ?> Vorwerk-Stift All Rights Reserved</p>
	</footer><!-- #colophon -->
	</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
