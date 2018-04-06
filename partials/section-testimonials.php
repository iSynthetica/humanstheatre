<?php
$section            = current($section);
$id                 = $section->ID;
$section_id         = get_field( 'id', $id );
$section_classes    = ' ' . get_field( 'classes', $id );
$section_title      = get_field( 'content_title', $id );
$section_subtitle   = get_field( 'content_subtitle', $id );

$testimonials = get_posts(
    array(
        'post_type' => array('ht_testimonial'),
        'numberposts' => 4,
        'orderby'     => 'menu_order',
        'order'       => 'ASC',
    )
);
?>

<div id="<?php echo $section_id ?>" class="section<?php echo $section_classes ?>">
    <div class="portrait-overlay"></div>
    <div class="container">
        <div class="row<?php echo understrap_section_row_class($id); ?>">
            <div class="col col-start"></div>
            <div class="section-content<?php echo understrap_section_content_col_class($id); ?>">
                <?php
                if ( $section_title ) {
                    ?><h2><?php echo $section_title ?></h2><?php
                }

                if ( $section_subtitle ) {
                    ?><h3><?php echo $section_subtitle ?></h3><?php
                }

                if( !empty($testimonials) ) {
                    $i = 1;
                    $n = count( $testimonials );
                    foreach ($testimonials as $testimonial) {
                        ?>
                        <div class="testimonial-content">
                            <p>"<?php echo $testimonial->post_excerpt ?>"</p>
                        </div>
                        <?php if ($video = get_field('testimonial_video', $testimonial->ID)) {
                            $label = __('<!--:ua-->Відеовідгук<!--:--><!--:en-->Videoreview<!--:--><!--:ru-->Видеоотзыв<!--:-->');
                            ?>
                                <?php echo do_shortcode('[lightgallery_video id="testimonial_video'.$testimonial->ID.'" url="'.$video.'" thumb="http://humanstheatre.com/wp-content/uploads/2017/07/bg-intro.jpg" btn-label="'.$label.'"]'); ?>
                            <?php
                        } ?>
                        <div class="testimonial-meta">
                            <?php echo get_field('testimonial_author_name', $testimonial->ID) ?>
                        </div>
                        <?php
                        if ( $i < $n ) {
                            ?><div class="testimonial-divider"></div><?php
                        }
                        $i++;
                    }
                }
                ?>
            </div>
            <div class="col col-end"></div>
        </div>
        <?php understrap_show_template('element-section-bg-img.php', array('id' => $id)); ?>
    </div>
    <?php understrap_show_template('element-up-link.php', array('id' => $id)); ?>
</div>