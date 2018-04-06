<?php
/**
 * Template Name: Landing Page Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

global $post;
$sections = get_field( 'sections', $post->ID );
?>

<?php get_header('landing'); ?>

    <?php
    foreach( $sections as $section ) {
        $template = get_field( 'section_template', current($section)->ID );
        if ( ! $template ) {
            $template = 'section-default';
        }
        understrap_show_template($template . '.php', array('section' => $section));
    }
    ?>

<?php get_footer('landing'); ?>