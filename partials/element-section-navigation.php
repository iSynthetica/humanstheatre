<div id="header-nav-menu">
    <div class="container header-nav_container">
        <div class="row header-nav_row">
            <div class="col-md-3 logo__col">
                <?php the_custom_logo(); ?>
            </div>
            <div class="col-md-6">
                <?php wp_nav_menu(
                    array(
                        'theme_location'  => 'footer',
                        'container'       => 'nav',
                        'menu_class'      => 'header-nav',
                        'menu_id'         => 'header-menu',
                    )
                ); ?>
            </div>
            <div class="col-md-3 language__col">
                <?php if ( is_active_sidebar( 'languages' ) ) : ?>
                    <?php dynamic_sidebar( 'languages' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>