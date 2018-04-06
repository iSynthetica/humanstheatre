<div id="header-mobile">
    <div class="container header-nav_container">
        <div class="row header-mobile_row">
            <div class="col logo-mobile__col">
				<?php the_custom_logo(); ?>
            </div>
        </div>
    </div>
</div>

<div class="mobile-header-nav-menu-icon">
    <i class="fa fa-bars open-ico" aria-hidden="true"></i>
    <i class="fa fa-times close-ico" aria-hidden="true"></i>
</div>

<div class="mobile-header-nav-menu">
    <?php wp_nav_menu(
        array(
            'theme_location'  => 'footer',
            'container'       => 'nav',
            'menu_class'      => 'mobile-header-nav',
            'menu_id'         => 'mobile-header-menu',
        )
    ); ?>
</div>

<div class="mobile-header-selected-language-btn">
    <i class="fa fa-times close-lng" aria-hidden="true"></i>
    <span class="open-lng"></span>
</div>

<div class="mobile-header-select-language">
    <?php if ( is_active_sidebar( 'languages' ) ) : ?>
        <?php dynamic_sidebar( 'languages' ); ?>
    <?php endif; ?>
</div>