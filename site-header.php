<div id="header-container">
    <header id="masthead" class="site-header">
        <?php include 'components/site-branding/site-branding.php'; ?>

        <?php include 'components/mobile-nav/mobile-nav.php'; ?>

    </header><!-- #masthead -->
    <aside id="sidebar-tablet" class="widget-area">
        <div class="container">
            <?php dynamic_sidebar( 'sidebar-tablet' ); ?>
        </div>
    </aside>
</div>

<!-- Main navigation -->
<?php include 'components/desktop-nav/desktop-nav.php'; ?>