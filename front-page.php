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
if (pll_current_language() === "en") {
	$postID = 197;
} else {
	$postID = 199;
}

get_header();
?>
<div class="scrollable front-page">
	<div class="container-padding">
	<?php require('site-header.php'); ?>
	<main class="hero-section" id="hero-section">
		<h1 class="landing-title"><img src="/wp-content/themes/vorwerkstift/assets/images/title-landing.svg" alt="Vorwerk-Stift" /></h1>
		<div class="flex-container">
			<img src="/wp-content/themes/vorwerkstift/assets/images/img-landing-page.svg" alt="" class="house-image"/>
			<div class="text-block">
				<?php if( get_field('hero_text', $postID) ): ?>
			<p><?php the_field('hero_text', $postID); ?></p>
			<?php else: ?>
			<p><?php pll_e( 'an everchanging community fostering independent artistic creation since 1990.' ); ?></p>
		<?php endif; ?>
		<button id="scroll-button" aria-label="scroll down to main content" class="hero-arrow"></button>
			</div>
		
		</div>	
	</main>
	<div id="main-container">
		<div class="sliding-container">
			<aside id="sidebar-tablet" class="widget-area">
			<div class="container">
				<?php dynamic_sidebar( 'sidebar-tablet' ); ?>
			</div>
		</aside>
		</div>
		<div id="primary" class="site-main">
				<?php 
				$the_query = vorwerkstift_get_current_exhibition_in_loop();

				while ( $the_query->have_posts() ) :
					$the_query->the_post();

					get_template_part( 'template-parts/content', 'card' );
		
				endwhile; // End of the loop.

				?>
        
		</div><!-- #main -->
		<aside id="sidebar-desktop" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-desktop' ); ?>
		</aside>
	</div><!-- #main-container -->
	</div><!-- .container-padding -->
	
	<?php
	get_footer();

	?>
</div> <!-- .scrollable -->
