<?php
/**
 * Template Name: Contact Page Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

global $post;

$youtube        = get_field('footer_youtube_link', 'option');
$facebook       = get_field('footer_facebook_link', 'option');
$instagram      = get_field('footer_instagram_link', 'option');

$bg_image = get_the_post_thumbnail_url( $post->ID );
?>

<?php get_header(); ?>

    <div id="contact-page-container" class="" style="background-image: url(<?php echo $bg_image ?>); background-position: bottom center;background-size: contain;background-repeat: no-repeat">
        <div class="container">
            <div class="row section-content__row">
                <div class="col section-content__col">
                    <main class="site-main" id="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                <header class="entry-header">
                                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <?php the_content(); ?>

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
                                </div><!-- .entry-content -->
                            </article><!-- #post-## -->
                        <?php endwhile; // end of the loop. ?>
                    </main><!-- #main -->
                </div>
            </div>

            <div class="row contact-form__row">
                <div class="col-lg-6 contact-form__col">
                    <?php echo do_shortcode( get_field( 'contact_form_shortcode', $post->ID ) ) ; ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>