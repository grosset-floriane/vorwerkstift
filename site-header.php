<div id="header-container">
    <header id="masthead" class="site-header">
        <?php include 'components/site-branding/site-branding.php'; ?>

        <?php include 'components/mobile-nav/mobile-nav.php'; ?>

    </header><!-- #masthead -->
    <?php if (!is_front_page()) { ?>
    <aside id="sidebar-tablet" class="widget-area">
        <div class="container">
            <?php dynamic_sidebar( 'sidebar-tablet' ); ?>
        </div>
    </aside>
    <?php } ?>
</div>

<!-- Main navigation -->
<?php include 'components/desktop-nav/desktop-nav.php'; ?>