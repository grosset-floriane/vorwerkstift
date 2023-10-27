<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package vorwerkstift
 */

/**
 * Get the location section of the current page
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function vorwerkstift_get_section_category() {
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

		return ['menuID' => $menuID, 'sectionTitle' => $sectionTitle];
	}

	return NULL;
	
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function vorwerkstift_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	$currentSection = vorwerkstift_get_section_category();
	if(!empty($currentSection)) {
		$classes[] = $currentSection["menuID"];
	}

	return $classes;
}
add_filter( 'body_class', 'vorwerkstift_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function vorwerkstift_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'vorwerkstift_pingback_header' );
