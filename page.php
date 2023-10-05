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

		<?php
		while ( have_posts() ) :
			the_post();
	
			/* Check which section the page belongs to display the  
			** corresponding title in the current language and 
			** subnavigation.
			*/

			// get all the section categories
			$currentSection = vorwerkstift_get_section_category();
			if(!empty($currentSection)) {
				$menuID = $currentSection["menuID"];
				$sectionTitle = $currentSection["sectionTitle"];

				if($menuID) {
					?>
					<header>
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
						</header>
					<?php
				}
			}

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>
		

	</main><!-- #main -->

	<aside id="sidebar-desktop" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-desktop' ); ?>
	</aside>
<?php
get_footer();

?>
</div>
