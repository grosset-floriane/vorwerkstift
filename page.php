<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vorwerkstift
 */

get_header();
?>
<div class="scrollable">
<main id="primary" class="site-main">
	<header>

		<?php
		while ( have_posts() ) :
			the_post();
	
			/* Check which section the page belongs to display the  
			** corresponding title in the current language and 
			** subnavigation.
			*/

			// get all the section categories
			$terms = get_the_terms(get_the_ID(), 'section');

			$activeLang = pll_current_language();
	
			if (! empty( $terms ) ) {
				foreach($terms as $term) {
					$menuID = $term->slug . '-menu';
					$sectionTitle = $term->name;
					if($activeLang === 'de') {
						$sectionTitle = $term->description;
					}
						
				}

				if($menuID) {
					?>
						<p class="section-title" id="section-title"><?php echo $sectionTitle; ?></p>
						<nav class="sub-navigation">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => $menuID,
										'menu_id'        => $menuID,
									)
								);
							?>
						</nav>
					<?php
				}
			}

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</header>

	</main><!-- #main -->

	<aside id="sidebar-desktop" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-desktop' ); ?>
	</aside>
<?php
get_footer();

?>
</div>
