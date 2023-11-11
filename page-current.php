<?php
/**
 * The template for displaying the current and aktuell pages
 *
 * @package vorwerkstift
 */

get_header();
?>
<div class="scrollable">
<div class="container-padding">
	<?php require('site-header.php'); ?>
	<div id="main-container">

		<main id="primary" class="site-main">
				<?php
				// Get the current exhibition
				$the_query = vorwerkstift_get_current_exhibition_in_loop();

				while ( $the_query->have_posts() ) :
					$the_query->the_post();
			
					/* Check which section the page belongs to display the  
					** corresponding title in the current language and 
					** subnavigation.
					*/
		
					// get all the section categories
					$currentSection = array( "menuID"=>  "galerie21-menu", "sectionTitle"=> "Galerie21" );
					// 17 is the ID of the current page, in order to display the Sub navigation properly
					$currentSection = vorwerkstift_get_section_category(17);
				
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
		</div><!-- #main-container -->
</div><!-- .container-padding -->
<?php
get_footer();

?>
</div>
