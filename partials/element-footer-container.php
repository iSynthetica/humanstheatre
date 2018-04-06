<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 17.08.2017
 * Time: 17:03
 */

$email = get_field('footer_email_adress', 'option');
$youtube = get_field('footer_youtube_link', 'option');
$facebook = get_field('footer_facebook_link', 'option');
$instagram = get_field('footer_instagram_link', 'option');
?>

<div class="container footer__container">
    <div class="row footer-nav_row">
        <div class="col">
            <?php wp_nav_menu(
                array(
                    'theme_location'  => 'footer',
                    'container'       => 'nav',
                    'menu_class'      => 'footer-nav',
                    'menu_id'         => 'footer-menu',
                )
            ); ?>
        </div>
    </div>
    <div class="row footer__row">
        <div class="col-lg-3 logo__col">
            <?php the_custom_logo(); ?>
        </div>
        <div class="col-lg-3 push-lg-6 contact__col">
            <p><?php the_field('footer_phone_number', 'option'); ?></p>
            <p><a href="mailto:<?php echo $email ?>" target="_top"><?php echo $email ?></a></p>
            <p class="social">
                <?php
                if ($youtube) {
                    ?><a href="<?php echo $youtube ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a><?php
                }
                if ($facebook) {
                    ?><a href="<?php echo $facebook ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a><?php
                }
                if ($instagram) {
                    ?><a href="<?php echo $instagram ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a><?php
                }
                ?>


            </p>
        </div>
        <div class="col-lg-6 pull-lg-3 copyright_col">
            <p class="copyright-text"><?php echo __(get_field('footer_copyright_text', 'option')); ?></p>
        </div>
    </div>
</div>
