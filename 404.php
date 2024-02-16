<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package vorwerkstift
 */

if ( pll_current_language() === "en" ) {
	$args = array("title" => "Page not found (Error 404)", 'post_type' => 'page') ;
} else {
	$args = array("title" => "Seite nicht gefunden (Fehler 404)", 'post_type' => 'page');
}
$the_query = new WP_Query( $args );
get_header();
?>
<div class="scrollable">
	<div class="container-padding">
	<?php require('site-header.php'); ?>
	<div id="main-container">
	<main id="primary" class="site-main">
	<?php 
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		
		/* Check which section the page belongs to display the  
		** corresponding title in the current language and 
		** subnavigation.
		*/
		// get all the section categories
		$currentSection = vorwerkstift_get_section_category(null);
				
		if(!empty($currentSection)) {
			$menuID = $currentSection["menuID"];
			$sectionTitle = $currentSection["sectionTitle"];

			if($menuID) {
				?>
				<header>
					<p class="section-title" id="section-title"><?php echo $sectionTitle; ?></p>
				</header>
				<?php
			}
		}

		// get all the section categories
		$currentSection = vorwerkstift_get_section_category(null);

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
</div> <!-- .scrollable -->
