<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package vorwerkstift
 */

/**
 * Get the location section of the current page
 *
 * @param array $postID id if a page of null (to fetch the correct subnavigation when needed)
 * @return array
 */
function vorwerkstift_get_section_category($postID) {
	if($postID) {
		$terms = get_the_terms($postID, 'section');
	} else {
		$terms = get_the_terms(get_the_ID(), 'section');
	}
	
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

	$currentSection = vorwerkstift_get_section_category(null);
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

/**
 * Get the Current exhibition
 *
 * @return array WP_Query $the_query
 */

function vorwerkstift_get_current_exhibition_in_loop() {
	// Get the id of the article to display
			// if override: show override  
	$aktuellID = 11;
	$currentID = 17;
	if (pll_current_language() === "en") {
		$postID = $currentID;
	} else {
		$postID = $aktuellID;
	}
	$overridePostID = get_field('exhibition_or_event_override', $postID);

	$args = array();

	if($overridePostID) {
		$args = array(
			'p' => $overridePostID, 
			'post_type' => 'exhibitions', 
			'posts_per_page' => 1,
		);
		$the_query = new WP_Query( $args );

	} else {
		// No override
		$baseArgs = array(
			'meta_key'          => 'end_date',
			'orderby'           => 'meta_value_num',
			'posts_per_page' => 1,
			'post_type'    => 'exhibitions',
			'order' => 'DESC'
		);

		$currentTime = date("Y-m-d");

		$args = array(
			'meta_key'          => 'end_date',
			'orderby'           => 'meta_value_num',
			'posts_per_page' => 1,
			'post_type'    => 'exhibitions',
			'order' => 'DESC',
			'meta_query' => array(
				// CURRENT DATE is between start and end date
				array(
					'relation' => 'AND',
					array(
						'key'	=>	'end_date',
						'value' => $currentTime,
						'type'	=>	'DATE',
						'compare' => '>='
					),
					array(
						'key'	=>	'start_date',
						'value' => $currentTime,
						'type'	=>	'DATE',
						'compare' => '<='
					),
				),
			)
		);

		$the_query = new WP_Query( $args );

		// there is no exhibition happening at the moment
		if(!$the_query->have_posts()) {
			// find the first exhibition that starts after today
			$args = $args = array(
				'meta_key'          => 'start_date',
				'orderby'           => 'meta_value_num',
				'posts_per_page' => 1,
				'post_type'    => 'exhibitions',
				'order' => 'ASC',
				'meta_query' => array(
					// CURRENT DATE is before the start date
					array(
						array(
							'key'	=>	'start_date',
							'value' => $currentTime,
							'type'	=>	'DATE',
							'compare' => '>='
						),
					),
				)
			);
			$the_query = new WP_Query( $args );

			// no exhibition starts after today
			if (!$the_query->have_posts()) {
				// find the last exhibition that hapened
				$args = array(
					'meta_key'          => 'end_date',
					'orderby'           => 'meta_value_num',
					'posts_per_page' => 1,
					'post_type'    => 'exhibitions',
					'order' => 'DESC',
				);
				$the_query = new WP_Query( $args );
			}
		}
	}

	return $the_query;
}

/**
 * Format the whole event period 
 *
 * @return string $period: d.m.y || d. - d.m.y || d.m. - d.m.y || d.m.y - d.m.y
 */

function formatEventPeriod() {
	$startDate = get_field('start_date');
	$endDate = get_field('end_date');

	$period = date("d.m.y",strtotime($endDate));

	$sameYear = date("Y",strtotime($startDate)) === date("Y",strtotime($endDate));
	$sameMonth = date("m",strtotime($startDate)) === date("m",strtotime($endDate));
	$sameDay = date("d",strtotime($startDate)) === date("d",strtotime($endDate));

	if(!$sameYear) {
		$period = date("d.m.y",strtotime($startDate)) . " - " . $period;
	} else if (!$sameMonth) {
		$period = date("d.m.",strtotime($startDate)) . " - " . $period;
	} else if (!$sameDay) {
		$period = date("d.",strtotime($startDate)) . " - " . $period;
	}

	return $period;
}

/**
 * Format opened hours
 *
 * @return string $openingAndOpeningHours
 */

function formatOpenedHours() {
	$openingStartTime = get_field('opening_start_time');
	$openingHours = get_cfc_meta( 'regular_days_open_dates_hours' );
	if (pll_current_language() === 'de') {
		// To format day names to German
		setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
	}

	$openingAndOpeningHours = '';
	if($openingStartTime) {
		$openingAndOpeningHours = 'Opening ' . strftime("%A: ", strtotime($openingStartTime)) . date("G:i",strtotime($openingStartTime)) ;
	} 

	foreach($openingHours as $key => $value) {
		$date = get_cfc_field('regular_days_open_dates_hours', 'date', false, $key);
		$startTime = get_cfc_field('regular_days_open_dates_hours', 'start-open-time', false, $key);
		$endTime = get_cfc_field('regular_days_open_dates_hours', 'end-open-time', false, $key);
		$openingAndOpeningHours .= ' | ' . strftime("%A", strtotime($date)) . ': ' . $startTime . ' - ' . $endTime;
	}

	if(!$openingStartTime) {
		$openingAndOpeningHours = ltrim(' | ', $openingAndOpeningHours);
	}

	return $openingAndOpeningHours;
}

/**
 * Format Entrance fee
 *
 * @return string $entranceFeesLine
 */

function formatEntranceFee() {
	$entranceFeesLine = '';
	$isEntranceFee = get_field('is_free_entrance');
	if ($isEntranceFee === 'free_entrance') {
		$entranceFeesLine = pll__( 'Free entrance' );
	} else if ($isEntranceFee === 'donation_based') {
		$entranceFeesLine = pll__( 'Donation based' );
		
		if(get_field('minimum_recommendation')) {
			$entranceFeesLine .= ': ' . pll__( 'recommendation from' ) . ' ' . get_field('minimum_recommendation') . '€';
			if(get_field('maximum_recommendation')) {
				$entranceFeesLine .= ' ' . pll__( 'to' ) . ' ' . get_field('maximum_recommendation') . '€';
			}
		}
	} else {
		$entranceFeesLine .= pll__( 'Entrance fee' ) . ': ' . str_replace(".",",", get_field('entrance_fee')) . '€';
	}

	return $entranceFeesLine;
}

/**
 * Get current/aktuell link
 *
 * @return string $currentURL
 */

function getCurrentUrl() {
	if (pll_current_language() === "en") {
		return '/en/current';
	}
	return '/de/aktuell';
}