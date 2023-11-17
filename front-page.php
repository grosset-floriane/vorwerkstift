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
	<div class="container-padding">
	<?php require('site-header.php'); ?>
	<div id="main-container">

		<main id="primary" class="site-main">

        <?php 
            $activeLang = pll_current_language();
            if ($activeLang === "en") {
                $postID = 197;
            } else {
                $postID = 199;
            }

        ?>
        <section class="hero-section">
            <h1 class="landing-title"><img src="/wp-content/themes/vorwerkstift/assets/images/title-landing.svg" alt="Vorwerk-Stift" /></h1>
            <div class="flex-container">
                <img src="/wp-content/themes/vorwerkstift/assets/images/img-landing-page.png" alt="" class="house-image"/>
            
            <?php if( get_field('hero_text', $postID) ): ?>
                <p><?php the_field('hero_text', $postID); ?></p>
                <?php elseif ($activeLang === "en"): ?>
                <p>an everchanging community fostering independent artistic creation since 1990.</p>
                <?php else: ?>
                <p>eine sich ständig verändernde Gemeinschaft, die seit 1990 unabhängiges künstlerisches Schaffen fördert.</p>
            <?php endif; ?>
            </div>
            
        </section>

	
			<?php
			while ( have_posts() ) :
				the_post();
		
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
</div> <!-- .scrollable -->
