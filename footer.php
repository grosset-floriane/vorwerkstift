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
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer-menu',
					'menu_id'        => 'footer-menu',
				)
			);
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'vorwerkstift' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'vorwerkstift' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'vorwerkstift' ), 'vorwerkstift', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
