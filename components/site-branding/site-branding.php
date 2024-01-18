  <?php
    /**
   * Site branding
   *
   * Title and description
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
<div class="site-branding">
    <p class="site-title" translate="no" lang="de"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?><span></span></a></p>
    <?php
        $vorwerkstift_description = get_bloginfo( 'description', 'display' );
        if ( $vorwerkstift_description || is_customize_preview() ) :
    ?>
        <p class="site-description" translate="no" lang="de"><?php echo $vorwerkstift_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
    <?php endif; ?>
</div><!-- .site-branding -->
