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
	<?php 
            $activeLang = pll_current_language();
            if ($activeLang === "en") {
                $postID = 197;
            } else {
                $postID = 199;
            }

        ?>
        <main class="hero-section">
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
            
        </main>
	<div id="main-container">

		<div id="primary" class="site-main">
				<p>Here cards</p>
        
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
