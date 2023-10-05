<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vorwerkstift
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'vorwerkstift' ); ?></a>

	<header id="masthead" class="site-header">
 		<?php include 'components/site-branding/site-branding.php'; ?>

		<?php include 'components/mobile-nav/mobile-nav.php'; ?>

	</header><!-- #masthead -->
	<aside id="sidebar-tablet" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-tablet' ); ?>
	</aside>
<!-- Main navigation -->
	<?php include 'components/desktop-nav/desktop-nav.php'; ?>

