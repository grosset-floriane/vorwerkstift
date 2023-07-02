<?php 
  /**
   * Navigation
   *
   * Main navigation and toggle button
   *
   * @category   Components
   * @package    WordPress
   * @subpackage vorwerkstift
   * @author     Floriane Grosset <fl.grosset@gmail.com>
   * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
   * @link       https://vorwerkstift.de
   * @since      1.0.0
   */
?>

<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-controls="site-navigation" aria-haspopup="true">
  <?php esc_html_e( 'menu', 'vorwerkstift' ); ?>
</button>
<nav id="site-navigation" class="mobile-navigation">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'mobile-menu',
			'menu_id'        => 'mobile-menu',
		)
	);
	?>
</nav><!-- #site-mobile-navigation -->
